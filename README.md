# Wirodayan Direct Marketplace - Setup Guide

A high-contrast, artistic, and minimalist e-commerce platform built with Laravel 11. Specifically optimized for XAMPP/Windows environments.

## 🚀 Setup Steps

Follow these steps to get the project running on your local server:

### 1. Requirements
*   PHP 8.2 or higher
*   Composer
*   MySQL/MariaDB (via XAMPP)
*   Apache (via XAMPP)

### 2. Physical Placement
Copy the whole project folder into your XAMPP `htdocs` directory.
Example path: `C:\xampp\htdocs\novly-ecommerce`

### 3. Dependency Installation
Open terminal/cmd inside the project folder and run:
```bash
composer install
```

### 4. Database Configuration
1.  Create a new database named `ecommerce_novly` in phpMyAdmin.
2.  Duplicate `.env.example` to `.env` (already done in this repo).
3.  Ensure database credentials in `.env` are correct:
    ```env
    DB_DATABASE=ecommerce_novly
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### 5. Migration & Seeding
Populate the database with tables and sample data:
```bash
php artisan migrate --seed
```
*Default Admin Login:* `admin@novly.com` / `password`

### 6. Storage Link (CRITICAL for Windows)
To ensure images are displayed correctly, connect the storage folder:
```cmd
rmdir public\storage
mklink /J public\storage storage\app\public
```
*Note: Run as administrator if `mklink` fails.*

### 7. Optimization
Clear all caches to ensure the new `APP_URL` and routes are active:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## 🛠️ Key Configurations (Applied)

*   **Subdirectory Support**: `APP_URL` is configured to `http://localhost/novly-ecommerce`.
*   **Root Entry Point**: The project entry point has been moved to the root `index.php` so you can access the site directly via `http://localhost/novly-ecommerce/` without typing `/public/`.
*   **Image Processing**: The system automatically converts all uploads to **WebP** for maximum performance.

## 📦 Features
- [x] AJAX Category Filtering & Pagination (No reload)
- [x] WhatsApp Checkout Integration
- [x] Interactive 3-Slot Image Upload with Preview
- [x] Product Slideshows on Catalog Cards
- [x] External Marketplace Links (Shopee/Tokopedia)
- [x] High-Contrast Artistic Design with Batik & Scribble Accents

---
Developed by **Antigravity** for Novly Ecommerce.
