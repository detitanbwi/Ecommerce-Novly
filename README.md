# Wirodayan Direct Marketplace - Production Setup Guide

A premium, high-contrast, artistic e-commerce platform built with Laravel 11. 

## 🌐 Server Requirements
- PHP 8.2 or higher
- Extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, **GD** (Critical for Image Processing)
- MySQL 8.0+ or MariaDB 10.4+
- Nginx or Apache with `mod_rewrite` enabled

## 🚀 Quick Setup (Copy & Paste to Terminal)

```bash
# 1. Install dependencies
composer install --optimize-autoloader --no-dev

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 3. Database & Storage Initialization
# Ensure DB credentials in .env are correct before running this!
php artisan migrate --force --seed
php artisan storage:link
```

## 🛠️ Production Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔐 Default Admin Account
- **Email:** `admin@novly.com`
- **Password:** `password`

## 📂 Permissions (Linux Servers)
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data .
```

## 🛠️ Web Server Configuration

### Standard (Nginx)
Point your root to the `/public` directory of the project.
```nginx
root /var/www/novly-ecommerce/public;
index index.php index.html;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### Subdirectory / Shared Hosting (Apache)
This project is pre-configured with a root `index.php` and `.htaccess` to support running from any directory. If your server doesn't allow changing the document root to `/public`, the application will still work seamlessly from the root folder.

---
Developed by **Antigravity** for Novly Ecommerce.
