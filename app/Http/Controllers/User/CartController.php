<?php

namespace App\Http\Controllers\User;

use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('user.cart', compact('carts', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->stock < 1) {
            return back()->with('error', 'Produk stok habis!');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            if ($cart->quantity + 1 > $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok tersedia!');
            }
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:999'
        ]);

        if ($request->quantity > $cart->product->stock) {
            return back()->with('error', 'Jumlah melebihi stok tersedia!');
        }

        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Keranjang diupdate!');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $cart->delete();
        return back()->with('success', 'Item dihapus dari keranjang!');
    }

    public function checkoutForm()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Check stock
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return redirect()->route('cart.index')
                    ->with('error', 'Stok produk "' . $cart->product->name . '" tidak mencukupi!');
            }
        }

        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('user.checkout', compact('carts', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:500'
        ]);

        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $total = $carts->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'total' => $total,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null
            ]);

            foreach ($carts as $cart) {
                if ($cart->quantity > $cart->product->stock) {
                    throw new \Exception('Stok produk "' . $cart->product->name . '" tidak mencukupi!');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->product->price * $cart->quantity
                ]);

                $cart->product->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            // Send emails
            Mail::to($order->user->email)->send(new OrderCreated($order));
            Mail::to('admin@mouglowing.com')->send(new OrderCreated($order));

            return redirect()->route('order.success', $order)->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function checkoutWhatsApp()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return back()->with('error', 'Stok produk "' . $cart->product->name . '" tidak mencukupi!');
            }
        }

        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $message = "🛍️ *Pesanan Baru dari " . auth()->user()->name . "*\n\n";
        $message .= "📦 *Detail Pesanan:*\n";
        
        foreach ($carts as $cart) {
            $message .= "- " . $cart->product->name . "\n";
            $message .= "  Qty: " . $cart->quantity . " x Rp " . number_format($cart->product->price, 0, ',', '.') . "\n";
            $message .= "  Subtotal: Rp " . number_format($cart->product->price * $cart->quantity, 0, ',', '.') . "\n\n";
        }
        
        $message .= "💰 *Total: Rp " . number_format($total, 0, ',', '.') . "*\n\n";
        $message .= "📧 Email: " . auth()->user()->email . "\n";
        $message .= "📱 Mohon konfirmasi pesanan ini. Terima kasih!";

        $whatsappUrl = "https://wa.me/+6288293663097?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}