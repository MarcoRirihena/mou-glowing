# 🌟 Mou Glowing 13 - E-Commerce Platform

Platform e-commerce modern untuk penjualan produk skincare dengan sistem manajemen lengkap.

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)

## 🚀 Fitur Utama

### 👨‍💼 Admin Panel
- Dashboard dengan real-time analytics & charts
- CRUD Produk lengkap dengan upload gambar
- Manajemen order dengan update status
- Verifikasi bukti pembayaran
- Statistik penjualan & top products

### 🛍️ Customer Features
- Katalog produk responsive
- Shopping cart system
- Checkout dengan form alamat lengkap
- Upload bukti pembayaran
- Order tracking & history
- Multi payment method (Transfer Bank / WhatsApp)

### 🎨 Landing Page
- Modern design (Red-Black-White theme)
- Fully responsive
- SEO optimized
- Floating social buttons

### 🔐 Security
- Role-based access control
- CSRF & XSS protection
- Rate limiting
- Secure authentication

## 💻 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Bootstrap 5, Chart.js, Font Awesome
- **Database:** MySQL
- **PHP:** 8.2+

## 📦 Installation
```bash
# Clone repository
git clone https://github.com/yourusername/mou-glowing.git
cd mou-glowing

# Install dependencies
composer install
npm install && npm run build

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed
php artisan storage:link

# Run server
php artisan serve
```

## 👤 Default Accounts

**Admin:**
- Email: admin@mouglowing.com
- Password: admin123

**User Test:**
- Email: user@test.com  
- Password: user123

## 🚀 Deployment

### Requirements
- PHP >= 8.2
- MySQL >= 5.7
- Composer
- Node.js & NPM

### Production Setup
```bash
# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set permissions
chmod -R 775 storage bootstrap/cache
```

## 📝 Environment Variables
```env
APP_URL=https://your-domain.com
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Gmail SMTP
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password

# Google OAuth (optional)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
```

## 📞 Contact

- **WhatsApp:** +62 882-9366-3097
- **Email:** contact@mouglowing.com
- **Instagram:** [@mou_glowing](https://www.instagram.com/mou_glowing/)

## 📄 License

Proprietary - Mou Glowing 13

---

**Developed with ❤️ - 2025**