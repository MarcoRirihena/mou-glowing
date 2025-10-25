# 🚀 Deployment Guide - Hostinger

## Pre-Deployment Checklist

- [ ] All testing passed
- [ ] Database cleaned from test data
- [ ] Admin password updated
- [ ] GitHub repository pushed
- [ ] .env configured for production

---

## Step 1: Purchase Hosting

1. Buka https://www.hostinger.co.id
2. Pilih paket: **Premium Web Hosting** (Rp 30.000/bulan)
3. Beli + Domain (atau gunakan domain existing)
4. Complete payment

---

## Step 2: Connect GitHub to Hostinger

### A. Generate SSH Key di Hostinger

1. Login Hostinger hPanel
2. Advanced > **SSH Access**
3. Enable SSH
4. Copy SSH command: `ssh u123456789@123.45.67.89`
5. Buka Terminal/PuTTY, jalankan SSH command
6. Password akan dikirim ke email

### B. Generate SSH Key untuk GitHub
```bash
# Di SSH Hostinger
ssh-keygen -t rsa -b 4096 -C "your-email@gmail.com"
# Enter 3x (default location, no passphrase)

# Copy public key
cat ~/.ssh/id_rsa.pub
```

7. Copy output (mulai dari `ssh-rsa` sampai email)
8. GitHub > Settings > SSH and GPG keys > New SSH key
9. Paste public key, Save

### C. Clone Repository
```bash
# Di SSH Hostinger
cd domains/your-domain.com

# Clone repo
git clone git@github.com:YOUR-USERNAME/mou-glowing.git
cd mou-glowing

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build
```

---

## Step 3: Setup Database

1. hPanel > Databases > **MySQL Databases**
2. Create database: `u123_mouglowing`
3. Create user: `u123_admin`
4. Set password (simpan!)
5. Add user to database > ALL PRIVILEGES

---

## Step 4: Configure Environment
```bash
# Copy .env
cp .env.example .env
nano .env
```

**Edit .env:**
```env
APP_NAME="Mou Glowing 13"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123_mouglowing
DB_USERNAME=u123_admin
DB_PASSWORD=your-database-password

SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Mou Glowing 13"

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
```

**Generate key:**
```bash
php artisan key:generate
```

---

## Step 5: Run Migration
```bash
php artisan migrate --force
php artisan db:seed --class=UpdateAdminSeeder --force
php artisan storage:link
```

---

## Step 6: Setup Public Directory

### A. Move Public Contents
```bash
# Dari folder mou-glowing/public/ ke public_html/
cp -r public/* ../public_html/
```

### B. Edit index.php di public_html
```bash
nano ../public_html/index.php
```

**Update paths:**
```php
require __DIR__.'/mou-glowing/vendor/autoload.php';
$app = require_once __DIR__.'/mou-glowing/bootstrap/app.php';
```

---

## Step 7: Set Permissions
```bash
chmod -R 775 storage bootstrap/cache
chmod -R 755 ../public_html
```

---

## Step 8: Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Step 9: Setup SSL (HTTPS)

1. hPanel > Security > **SSL**
2. Untuk domain your-domain.com
3. Install SSL Certificate (Free Let's Encrypt)
4. Wait 10-15 minutes
5. Force HTTPS di .htaccess

**Edit public_html/.htaccess, tambahkan setelah `RewriteEngine On`:**
```apache
# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Step 10: Test Production

1. Buka https://your-domain.com
2. Test semua fitur:
   - Landing page
   - Register/Login
   - Browse produk
   - Add to cart
   - Checkout
   - Upload payment proof
   - Admin login
   - Admin verify payment

---

## Maintenance & Updates

### Update Code dari GitHub
```bash
# SSH ke Hostinger
cd domains/your-domain.com/mou-glowing

# Pull latest changes
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Clear & cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Backup

1. hPanel > Databases > phpMyAdmin
2. Export database (SQL format)
3. Save locally

### Monitor Logs
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check error logs
tail -f ../logs/error_log
```

---

## Troubleshooting

**Error 500:**
```bash
php artisan config:clear
php artisan cache:clear
chmod -R 775 storage
```

**Images not loading:**
```bash
php artisan storage:link
chmod -R 755 public/storage
```

**Database connection error:**
- Check DB credentials di .env
- Pastikan DB user has privileges

---

## Support

- Hostinger Support: https://www.hostinger.co.id/bantuan
- Developer: marcoleonririhena@gmail.com