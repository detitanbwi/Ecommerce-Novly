# Wirodayan Direct Marketplace - Production Setup Guide

A premium, high-contrast, artistic e-commerce platform built with Laravel 11. 

## 🌐 Server Requirements
- PHP 8.2 or higher
- Extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, **GD** (Critical for Image Processing)
- MySQL 8.0+ or MariaDB 10.4+
- Nginx or Apache with `mod_rewrite` enabled

## 🚀 Deployment Steps (Production)

### 1. Upload & Install
Clone the repository to your server and navigate to the root directory:
```bash
git clone https://github.com/detitanbwi/Ecommerce-Novly.git .
composer install --optimize-autoloader --no-dev
```

### 2. Environment Configuration
Copy `.env.example` to `.env` and update the following:
```env
APP_NAME="Wirodayan Direct"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
Generate the application key:
```bash
php artisan key:generate
```

### 3. Permissions
Ensure the web server has write access to:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data . # For Ubuntu/Nginx
```

### 4. Database Initialization
Run migrations and seed the initial categories and admin account:
```bash
php artisan migrate --force --seed
```
*Note: Default admin: `admin@novly.com` / `password`.*

### 5. Media & Storage Link
Initialize the storage system:
```bash
php artisan storage:link
```
If you are on a local Windows server (XAMPP), use the Junction command:
`mklink /J public\storage storage\app\public`

### 6. Production Optimization
Run these commands to speed up the application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
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
