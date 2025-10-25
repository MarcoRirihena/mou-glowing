<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #DC143C 0%, #b01030 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .order-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .product-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .total {
            background: #DC143C;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #DC143C;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✨ Pesanan Berhasil Dibuat! ✨</h1>
            <p>Terima kasih telah berbelanja di Mou Glowing 13</p>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $order->name }}</strong>,</p>
            <p>Pesanan Anda telah berhasil kami terima dan sedang menunggu konfirmasi.</p>
            
            <div class="order-info">
                <h3 style="color: #DC143C; margin-top: 0;">Detail Pesanan</h3>
                <p><strong>No. Pesanan:</strong> {{ $order->order_number }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y, H:i') }}</p>
                <p><strong>Status:</strong> <span style="background: #ffc107; padding: 5px 10px; border-radius: 5px;">Menunggu Konfirmasi</span></p>
                
                <h4 style="margin-top: 20px;">Produk yang Dipesan:</h4>
                @foreach($order->items as $item)
                    <div class="product-item">
                        <strong>{{ $item->product_name }}</strong><br>
                        <small>{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }} = Rp {{ number_format($item->subtotal, 0, ',', '.') }}</small>
                    </div>
                @endforeach
                
                <div class="total">
                    <h3 style="margin: 0;">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h3>
                </div>
                
                <h4 style="margin-top: 20px;">Alamat Pengiriman:</h4>
                <p>
                    {{ $order->name }}<br>
                    {{ $order->phone }}<br>
                    {{ $order->address }}<br>
                    {{ $order->city }}, {{ $order->postal_code }}
                </p>
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('orders.show', $order) }}" class="btn">Lihat Detail Pesanan</a>
            </p>
            
            <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107;">
                <strong>⏰ Informasi:</strong> Tim kami akan menghubungi Anda dalam 1x24 jam untuk konfirmasi pesanan dan detail pengiriman.
            </div>
        </div>
        
        <div class="footer">
            <p>Butuh bantuan? Hubungi kami:</p>
            <p>
                📱 WhatsApp: <a href="https://wa.me/6288293663097">+62 882-9366-3097</a><br>
                📧 Email: contact@mouglowing.com<br>
                📸 Instagram: <a href="https://www.instagram.com/mou_glowing/">@mou_glowing</a>
            </p>
            <p style="margin-top: 20px;">
                &copy; 2024 Mou Glowing 13. All Rights Reserved.
            </p>
        </div>
    </div>
</body>
</html>