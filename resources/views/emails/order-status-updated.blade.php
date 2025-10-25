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
        .status-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .status {
            font-size: 24px;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .status-pending { background: #ffc107; color: white; }
        .status-confirmed { background: #17a2b8; color: white; }
        .status-processing { background: #007bff; color: white; }
        .status-shipped { background: #28a745; color: white; }
        .status-delivered { background: #28a745; color: white; }
        .status-cancelled { background: #dc3545; color: white; }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #DC143C;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Update Status Pesanan</h1>
            <p>Pesanan #{{ $order->order_number }}</p>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $order->name }}</strong>,</p>
            <p>Status pesanan Anda telah diperbarui.</p>
            
            <div class="status-box">
                <h3 style="color: #DC143C; margin-top: 0;">Status Terbaru</h3>
                
                @php
                    $statusLabels = [
                        'pending' => 'Menunggu Konfirmasi',
                        'confirmed' => 'Pesanan Dikonfirmasi',
                        'processing' => 'Sedang Diproses',
                        'shipped' => 'Sedang Dikirim',
                        'delivered' => 'Pesanan Selesai',
                        'cancelled' => 'Pesanan Dibatalkan'
                    ];
                @endphp
                
                <div class="status status-{{ $order->status }}">
                    {{ $statusLabels[$order->status] }}
                </div>
                
                <p style="color: #666; margin-top: 15px;">
                    Diperbarui: {{ $order->updated_at->format('d F Y, H:i') }}
                </p>
                
                @if($order->status == 'shipped')
                    <div style="background: #d4edda; padding: 15px; border-radius: 8px; margin-top: 20px;">
                        <strong>🚚 Pesanan Anda Sedang Dalam Perjalanan!</strong><br>
                        <small>Mohon pastikan ada yang menerima paket di alamat tujuan.</small>
                    </div>
                @elseif($order->status == 'delivered')
                    <div style="background: #d4edda; padding: 15px; border-radius: 8px; margin-top: 20px;">
                        <strong>✅ Pesanan Telah Selesai!</strong><br>
                        <small>Terima kasih telah berbelanja di Mou Glowing 13. Semoga produk kami bermanfaat untuk Anda!</small>
                    </div>
                @elseif($order->status == 'cancelled')
                    <div style="background: #f8d7da; padding: 15px; border-radius: 8px; margin-top: 20px;">
                        <strong>❌ Pesanan Dibatalkan</strong><br>
                        <small>Jika Anda memiliki pertanyaan, silakan hubungi kami.</small>
                    </div>
                @endif
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('orders.show', $order) }}" class="btn">Lihat Detail Pesanan</a>
            </p>
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