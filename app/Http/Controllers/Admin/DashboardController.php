<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Stats
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Sales Data (Last 7 Days)
        $salesDates = [];
        $salesData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $salesDates[] = $date->format('d M');
            
            $dailySales = Order::whereDate('created_at', $date->format('Y-m-d'))
                ->where('status', '!=', 'cancelled')
                ->sum('total');
            
            $salesData[] = (float) $dailySales;
        }
        
        // Order Status Distribution
        $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
        
        $orderStatusLabels = [];
        $orderStatusData = [];
        
        $statusLabels = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled'
        ];
        
        foreach ($orderStatuses as $status) {
            $orderStatusLabels[] = $statusLabels[$status->status] ?? ucfirst($status->status);
            $orderStatusData[] = $status->count;
        }
        
        // Top Products
        $topProducts = OrderItem::select('product_id', 
                DB::raw('SUM(quantity) as total_sold'),
                DB::raw('SUM(subtotal) as total_revenue'))
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        
        // Recent Orders
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalOrders',
            'pendingOrders',
            'salesDates',
            'salesData',
            'orderStatusLabels',
            'orderStatusData',
            'topProducts',
            'recentOrders'
        ));
    }
}