<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mou Glowing 13 - Premium Skincare</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Mou Glowing 13 - Toko skincare online terpercaya dengan produk original. Jual masker wajah, cream wajah, dan kosmetik berkualitas untuk kecantikan kulit Anda.">
    <meta name="keywords" content="skincare, kosmetik, masker wajah, cream wajah, kecantikan, perawatan kulit, Mou Glowing 13">
    <meta name="author" content="Mou Glowing 13">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Mou Glowing 13 - Premium Skincare">
    <meta property="og:description" content="Toko skincare online terpercaya dengan produk original berkualitas tinggi">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="Mou Glowing 13">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mou Glowing 13 - Premium Skincare">
    <meta name="twitter:description" content="Toko skincare online terpercaya dengan produk original">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #DC143C;
            --dark-bg: #0a0a0a;
            --medium-dark: #1a1a1a;
            --light-text: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background: var(--dark-bg);
            color: var(--light-text);
        }
        
        /* Navbar */
        .navbar-custom {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(220, 20, 60, 0.3);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-red) !important;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .nav-link {
            color: var(--light-text) !important;
            margin: 0 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary-red) !important;
            transform: translateY(-2px);
        }
        
        .btn-custom {
            background: var(--primary-red);
            color: white;
            padding: 0.7rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-custom:hover {
            background: #b01030;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(220, 20, 60, 0.4);
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(220, 20, 60, 0.15) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(220, 20, 60, 0.1) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, white 0%, var(--primary-red) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeInUp 1s ease;
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #cccccc;
            animation: fadeInUp 1.2s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Features */
        .features {
            padding: 5rem 0;
            background: var(--medium-dark);
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(220, 20, 60, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.4s;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(220, 20, 60, 0.05);
            border-color: var(--primary-red);
            box-shadow: 0 20px 40px rgba(220, 20, 60, 0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary-red);
            margin-bottom: 1.5rem;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }
        
        .feature-card p {
            color: #cccccc;
        }
        
        /* Products Preview */
        .products-preview {
            padding: 5rem 0;
            background: var(--dark-bg);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }
        
        .section-title p {
            font-size: 1.2rem;
            color: #999;
        }
        
        .product-category {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid rgba(220, 20, 60, 0.3);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }
        
        .product-category:hover {
            transform: scale(1.05);
            border-color: var(--primary-red);
            background: rgba(220, 20, 60, 0.08);
        }
        
        .category-icon {
            font-size: 4rem;
            color: var(--primary-red);
            margin-bottom: 1.5rem;
        }
        
        .product-category h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: white;
        }

        /* Contact Section */
        .contact-section {
            padding: 5rem 0;
            background: var(--medium-dark);
        }

        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(220, 20, 60, 0.3);
        }

        .contact-icon {
            font-size: 3rem;
            color: var(--primary-red);
            margin-bottom: 1rem;
        }

        .contact-card h5 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .contact-card a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-card a:hover {
            color: var(--primary-red);
        }
        
        /* Footer */
        .footer {
            background: var(--dark-bg);
            padding: 3rem 0 1rem;
            border-top: 1px solid rgba(220, 20, 60, 0.2);
        }
        
        .footer-content {
            color: #999;
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 1rem;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            color: var(--primary-red);
            transform: translateY(-3px);
        }

        /* Floating Buttons */
        .floating-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 1000;
        }
        
        .floating-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }
        
        .floating-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
            color: white;
        }
        
        .floating-btn-whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        }
        
        .floating-btn-instagram {
            background: linear-gradient(135deg, #833AB4 0%, #FD1D1D 50%, #F77737 100%);
        }
        
        .floating-btn-zangi {
            background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .section-title h2 {
                font-size: 2rem;
            }
            .floating-buttons {
                bottom: 20px;
                right: 20px;
            }
            .floating-btn {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-spa"></i> MOU GLOWING 13
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-custom ms-3">Dashboard</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="btn btn-custom ms-3">Dashboard</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-custom ms-3">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1>Glow Your Beauty</h1>
                    <p>Temukan rahasia kulit sehat dan bercahaya dengan produk skincare premium kami. Dipercaya oleh ribuan wanita Indonesia.</p>
                    @auth
                        @if(auth()->user()->role === 'user')
                            <a href="{{ route('user.dashboard') }}" class="btn btn-custom btn-lg me-3">
                                <i class="fas fa-shopping-bag"></i> Belanja Sekarang
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-custom btn-lg me-3">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                    @endauth
                    <a href="#products" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-down"></i> Lihat Produk
                    </a>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <i class="fas fa-heart" style="font-size: 20rem; color: rgba(220, 20, 60, 0.2);"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features" id="about">
        <div class="container">
            <div class="section-title">
                <h2>Kenapa Memilih Kami?</h2>
                <p>Komitmen kami untuk kecantikan kulit Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>100% Original</h3>
                        <p>Semua produk dijamin keasliannya dan tersertifikasi BPOM</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>Pengiriman Cepat</h3>
                        <p>Pengiriman ke seluruh Indonesia dengan tracking real-time</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Customer Support</h3>
                        <p>Tim support kami siap membantu Anda 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview -->
    <section class="products-preview" id="products">
        <div class="container">
            <div class="section-title">
                <h2>Kategori Produk</h2>
                <p>Pilihan lengkap untuk kebutuhan skincare Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="product-category">
                        <div class="category-icon">
                            <i class="fas fa-mask"></i>
                        </div>
                        <h3>Masker Wajah</h3>
                        <p>Masker premium untuk perawatan intensif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-category">
                        <div class="category-icon">
                            <i class="fas fa-pump-soap"></i>
                        </div>
                        <h3>Cream Wajah</h3>
                        <p>Cream berkualitas untuk kulit halus dan lembut</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-category">
                        <div class="category-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h3>Kosmetik</h3>
                        <p>Makeup berkualitas untuk penampilan sempurna</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                @auth
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('user.dashboard') }}" class="btn btn-custom btn-lg">
                            <i class="fas fa-arrow-right"></i> Lihat Semua Produk
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-custom btn-lg">
                        <i class="fas fa-user-plus"></i> Daftar untuk Belanja
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Hubungi Kami</h2>
                <p>Ada pertanyaan? Kami siap membantu Anda!</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <div class="contact-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h5>WhatsApp</h5>
                                <a href="https://wa.me/+6288293663097" target="_blank">
                                    +62 882-9366-3097
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <div class="contact-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <h5>Instagram</h5>
                                <a href="https://www.instagram.com/mou_glowing/" target="_blank">
                                    @mou_glowing
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <div class="contact-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h5>Zangi</h5>
                                <a href="https://services.zangi.com/dl/conversation/1179117603" target="_blank">
                                    Chat di Zangi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer-content">
                    <h4 class="text-white mb-3">MOU GLOWING 13</h4>
                    <p>Solusi kecantikan terpercaya untuk kulit sehat dan bercahaya.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-white mb-3">Follow Us</h5>
                    <div class="social-links">
                        <a href="https://www.instagram.com/mou_glowing/" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://services.zangi.com/dl/conversation/1179117603" target="_blank" title="Zangi">
                            <i class="fas fa-comments"></i>
                        </a>
                        <a href="https://wa.me/+6288293663097" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(220, 20, 60, 0.2); margin: 2rem 0;">
            <div class="text-center footer-content">
                <p>&copy; 2024 Mou Glowing 13. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Social Buttons -->
    <div class="floating-buttons">
        <a href="https://wa.me/+6288293663097" target="_blank" class="floating-btn floating-btn-whatsapp" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://www.instagram.com/mou_glowing/" target="_blank" class="floating-btn floating-btn-instagram" title="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://services.zangi.com/dl/conversation/1179117603" target="_blank" class="floating-btn floating-btn-zangi" title="Zangi">
            <i class="fas fa-comments"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>