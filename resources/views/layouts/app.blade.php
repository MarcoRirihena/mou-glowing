<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💄</text></svg>">
        <meta name="description" content="Mou Glowing 13 - Toko skincare online terpercaya dengan produk original">
        <meta name="keywords" content="skincare, kosmetik, masker wajah, cream wajah">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💄</text></svg>">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Custom CSS -->
        <style>
            :root {
                --primary-red: #DC143C;
                --dark-bg: #1a1a1a;
                --light-bg: #ffffff;
            }
            body {
                font-family: 'Figtree', sans-serif;
            }
            .bg-primary-red {
                background-color: var(--primary-red) !important;
            }
            .text-primary-red {
                color: var(--primary-red) !important;
            }
            .btn-primary-red {
                background-color: var(--primary-red);
                border-color: var(--primary-red);
                color: white;
            }
            .btn-primary-red:hover {
                background-color: #b01030;
                border-color: #b01030;
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
            
            /* .floating-btn-whatsapp {
                background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            }
             */
            .floating-btn-instagram {
                background: linear-gradient(135deg, #833AB4 0%, #FD1D1D 50%, #F77737 100%);
            }
            
            .floating-btn-zangi {
                background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
            }
            
            @media (max-width: 768px) {
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
            /* Mobile Responsive Fixes */
            @media (max-width: 768px) {
                .card-body {
                    padding: 1rem !important;
                }
                
                .py-12 {
                    padding-top: 2rem !important;
                    padding-bottom: 2rem !important;
                }
                
                .btn {
                    font-size: 0.875rem;
                }
                
                h1, .h1 {
                    font-size: 1.75rem !important;
                }
                
                h2, .h2 {
                    font-size: 1.5rem !important;
                }
                
                h3, .h3 {
                    font-size: 1.25rem !important;
                }
                
                .table-responsive {
                    font-size: 0.875rem;
                }
                
                .sticky-top {
                    position: relative !important;
                    top: auto !important;
                }
            }

            @media (max-width: 576px) {
                .container, .max-w-7xl {
                    padding-left: 1rem !important;
                    padding-right: 1rem !important;
                }
                
                .card {
                    margin-bottom: 1rem;
                }
                
                .btn-group .btn {
                    padding: 0.375rem 0.5rem;
                    font-size: 0.75rem;
                }
            }
        </style>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Floating Social Buttons (Only for User Dashboard) -->
        @if(auth()->check() && auth()->user()->role === 'user')
        <div class="floating-buttons">
            {{-- <a href="https://wa.me/6288293663097" target="_blank" class="floating-btn floating-btn-whatsapp" title="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a> --}}
            <a href="https://www.instagram.com/mou_glowing/" target="_blank" class="floating-btn floating-btn-instagram" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://services.zangi.com/dl/conversation/1179117603" target="_blank" class="floating-btn floating-btn-zangi" title="Zangi">
                <i class="fas fa-comments"></i>
            </a>
        </div>
        @endif
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Auto-hide Alert Script -->
        <script>
            // Auto hide alerts after 5 seconds with smooth animation
            document.addEventListener('DOMContentLoaded', function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    // Add fade-in animation
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease-in-out';
                    setTimeout(() => alert.style.opacity = '1', 100);
                    
                    // Auto hide after 5 seconds
                    setTimeout(function() {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 5000);
                });
            });
        </script>
    </body>
</html>