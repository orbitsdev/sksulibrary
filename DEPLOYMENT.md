# SKSU Library - Production Deployment Guide

## Server Information
- **IP Address:** 167.71.219.91
- **Username:** j7Solution
- **Stack:** Ubuntu + Nginx + PHP 8.1+ + MySQL + Laravel 10

---

## Prerequisites

### 1. Connect to Your Server
```bash
ssh j7Solution@167.71.219.91
```

---

## Step 1: Update System & Install Required Packages

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install required packages
sudo apt install -y curl git unzip software-properties-common

# Add PHP repository
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install PHP 8.1 and required extensions
sudo apt install -y php8.1-fpm php8.1-cli php8.1-common php8.1-mysql \
    php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml \
    php8.1-bcmath php8.1-intl php8.1-readline php8.1-pcov \
    php8.1-imagick php8.1-soap

# Install Nginx
sudo apt install -y nginx

# Install MySQL
sudo apt install -y mysql-server

# Install Node.js (for building assets)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

---

## Step 2: Configure MySQL

```bash
# Secure MySQL installation
sudo mysql_secure_installation

# Login to MySQL
sudo mysql

# Create database and user (run these SQL commands)
CREATE DATABASE sksulibrary;
CREATE USER 'sksulibrary'@'localhost' IDENTIFIED BY 'YOUR_STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON sksulibrary.* TO 'sksulibrary'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## Step 3: Configure PHP-FPM

```bash
# Edit PHP-FPM pool configuration
sudo nano /etc/php/8.1/fpm/pool.d/www.conf
```

Find and update these values:
```ini
user = www-data
group = www-data
listen = /run/php/php8.1-fpm.sock
listen.owner = www-data
listen.group = www-data
```

```bash
# Edit php.ini for production
sudo nano /etc/php/8.1/fpm/php.ini
```

Update these values:
```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 256M
max_execution_time = 300
```

```bash
# Restart PHP-FPM
sudo systemctl restart php8.1-fpm
```

---

## Step 4: Deploy Application

### Create Application Directory
```bash
# Create web directory
sudo mkdir -p /var/www/sksulibrary
sudo chown -R j7Solution:www-data /var/www/sksulibrary
```

### Clone/Upload Your Project

**Option A: Using Git**
```bash
cd /var/www/sksulibrary
git clone YOUR_REPOSITORY_URL .
```

**Option B: Using SCP (from local machine)**
```bash
# Run this from your local machine (Windows)
scp -r * j7Solution@167.71.219.91:/var/www/sksulibrary/
```

**Option C: Using rsync (recommended)**
```bash
# Run this from your local machine
rsync -avz --exclude='node_modules' --exclude='vendor' --exclude='.git' \
    ./ j7Solution@167.71.219.91:/var/www/sksulibrary/
```

### Install Dependencies
```bash
cd /var/www/sksulibrary

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
npm install
npm run build
```

---

## Step 5: Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Edit environment file
nano .env
```

Update `.env` with production values:
```env
APP_NAME="SKSU Library"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://167.71.219.91

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sksulibrary
DB_USERNAME=sksulibrary
DB_PASSWORD=YOUR_STRONG_PASSWORD_HERE

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### Generate Application Key & Run Migrations
```bash
# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed the database (creates test tellers)
php artisan db:seed --force

# Create storage link
php artisan storage:link

# Clear and cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Step 6: Set Permissions

```bash
# Set ownership
sudo chown -R j7Solution:www-data /var/www/sksulibrary

# Set directory permissions
sudo find /var/www/sksulibrary -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /var/www/sksulibrary -type f -exec chmod 644 {} \;

# Make storage and cache writable
sudo chmod -R 775 /var/www/sksulibrary/storage
sudo chmod -R 775 /var/www/sksulibrary/bootstrap/cache

# Ensure www-data can write to storage
sudo chgrp -R www-data /var/www/sksulibrary/storage /var/www/sksulibrary/bootstrap/cache
```

---

## Step 7: Configure Nginx

```bash
# Create Nginx configuration
sudo nano /etc/nginx/sites-available/sksulibrary
```

Paste this configuration:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name 167.71.219.91;
    root /var/www/sksulibrary/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Livewire polling optimization
    location /livewire {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Increase buffer sizes for Livewire
    fastcgi_buffers 16 16k;
    fastcgi_buffer_size 32k;

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_proxied expired no-cache no-store private auth;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml application/javascript;
    gzip_disable "MSIE [1-6]\.";
}
```

```bash
# Enable the site
sudo ln -s /etc/nginx/sites-available/sksulibrary /etc/nginx/sites-enabled/

# Remove default site (optional)
sudo rm /etc/nginx/sites-enabled/default

# Test Nginx configuration
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx
```

---

## Step 8: Configure Firewall

```bash
# Allow SSH, HTTP, and HTTPS
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'

# Enable firewall
sudo ufw enable

# Check status
sudo ufw status
```

---

## Step 9: Create Session Table (Required)

Since `SESSION_DRIVER=database`, create the sessions table:

```bash
php artisan session:table
php artisan migrate --force
```

---

## Post-Deployment Verification

### Test the Application
```bash
# Check if site is accessible
curl -I http://167.71.219.91
```

### Access URLs
| Page | URL |
|------|-----|
| Main Site | 
 |
| Admin Panel | http://167.71.219.91/admin |
| Teller Login | http://167.71.219.91/teller/login |
| Queue Monitor | http://167.71.219.91/queque/monitor |

### Test Teller Accounts
| Teller | ID Number | Password |
|--------|-----------|----------|
| teller1 (A) | 123 | password |
| teller2 (B) | 1234 | password |
| teller3 (C) | 12345 | password |
| teller4 (D) | 12356 | password |

---

## Maintenance Commands

### Clear All Cache
```bash
cd /var/www/sksulibrary
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Rebuild Cache (after updates)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### View Logs
```bash
tail -f /var/www/sksulibrary/storage/logs/laravel.log
```

### Check Nginx Logs
```bash
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/nginx/access.log
```

---

## Updating the Application

```bash
cd /var/www/sksulibrary

# Pull latest changes (if using Git)
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart PHP-FPM
sudo systemctl restart php8.1-fpm
```

---

## Optional: SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Get SSL certificate (replace with your domain)
sudo certbot --nginx -d yourdomain.com

# Auto-renewal test
sudo certbot renew --dry-run
```

---

## Troubleshooting

### 502 Bad Gateway
```bash
sudo systemctl restart php8.1-fpm
sudo systemctl restart nginx
```

### Permission Denied Errors
```bash
sudo chown -R j7Solution:www-data /var/www/sksulibrary
sudo chmod -R 775 /var/www/sksulibrary/storage
sudo chmod -R 775 /var/www/sksulibrary/bootstrap/cache
```

### Livewire Not Working
```bash
# Ensure storage link exists
php artisan storage:link

# Check if Livewire assets are published
php artisan livewire:publish --assets
```

### Check PHP-FPM Status
```bash
sudo systemctl status php8.1-fpm
```

### Check Nginx Status
```bash
sudo systemctl status nginx
```

---

## Queue Feature Notes

**No WebSocket Required!**

The queue feature uses **Livewire polling** for real-time updates:
- Queue Monitor polls every **1 second** (`wire:poll.1s`)
- Teller Interface polls every **750ms** (`wire:poll.750ms`)

This works over standard HTTP requests - no WebSocket server, Pusher, or Redis needed.

---

## Quick Deploy Script

Save this as `deploy.sh` on your server:

```bash
#!/bin/bash
cd /var/www/sksulibrary

# Pull latest
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Laravel optimization
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions
sudo chown -R j7Solution:www-data /var/www/sksulibrary
sudo chmod -R 775 storage bootstrap/cache

# Restart services
sudo systemctl restart php8.1-fpm

echo "Deployment complete!"
```

Make it executable:
```bash
chmod +x deploy.sh
```

Run deployments with:
```bash
./deploy.sh
```
