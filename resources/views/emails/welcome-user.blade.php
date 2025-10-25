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
            padding: 40px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .welcome-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .benefits {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .benefit-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .benefit-item:last-child {
            border-bottom: none;
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
            <h1>💄 Selamat Datang! 💄</h1>
            <p style="font-size: 18px;">di Mou Glowing 13</p>
        </div>
        
        <div class="content">
            <div class="welcome-box">
                <h2 style="color: #DC143C; margin-top: 0;">Halo {{ $user->name }}! 👋</h2>
                <p>Terima kasih telah bergabung dengan Mou Glowing 13, partner kecantikan terpercaya Anda!</p>
                <p>Kami sangat senang Anda memilih kami untuk perjalanan kecantikan Anda. ✨</p>
            </div>
            
            <div class="benefits">
                <h3 style="color: #DC143C; margin-top: 0;">Keuntungan Berbelanja di Mou Glowing 13:</h3>
                
                <div class="benefit-item">
                    ✅ <strong>Produk 100% Original</strong><br>
                    <small>Semua produk dijamin keasliannya dan tersertifikasi BPOM</small>
                </div>
                
                <div class="benefit-item">
                    🚚 <strong>Pengiriman Cepat</strong><br>
                    <small>Pengiriman ke seluruh Indonesia dengan tracking real-time</small>
                </div>
                
                <div class="benefit-item">
                    💬 <strong>Customer Support 24/7</strong><br>
                    <small>Tim support kami siap membantu Anda kapan saja</small>
                </div>
                
                <div class="benefit-item">
                    🎁 <strong>Promo & Diskon Spesial</strong><br>
                    <small>Dapatkan penawaran terbaik untuk member setia kami</small>
                </div>
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('user.dashboard') }}" class="btn">Mulai Belanja Sekarang</a>
            </p>
            
            <div style="background: #d1ecf1; padding: 15px; border-radius: 8px; border-left: 4px solid #17a2b8;">
                <strong>💡 Tips:</strong> Jangan lupa follow Instagram kami <a href="https://www.instagram.com/mou_glowing/">@mou_glowing</a> untuk info promo dan tips kecantikan terbaru!
            </div>
        </div>
        
        <div class="footer">
            <p>Hubungi kami kapan saja:</p>
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