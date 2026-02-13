# 🍪 Anti Diet Club - Nginx Deployment Guide

## 🌐 Access URL

**Website:** https://santrigresik.me/antidietclub

**Admin Panel:** https://santrigresik.me/antidietclub/admin

**Credentials:**
- Email: `admin@antidietclub.com`
- Password: `admin123`

---

## 📋 Deployment Steps

### Method 1: Automated Deployment (Recommended) ⭐

SSH ke server dan jalankan:

```bash
ssh root@68.183.237.106
cd /home/clawd/.openclaw/workspace/antidietclub
sudo ./deploy-nginx.sh
```

**Script akan:**
1. Backup konfigurasi Nginx yang lama
2. Update Nginx config untuk `/antidietclub` subdirectory
3. Set permission folder (storage, cache)
4. Test konfigurasi Nginx
5. Reload Nginx
6. Clear Laravel cache

**Waktu:** ~2 menit

---

### Method 2: Manual Deployment

#### 1. Update Nginx Configuration

```bash
sudo nano /etc/nginx/sites-available/santrigresik.me
```

Tambahkan konfigurasi ini di dalam server block:

```nginx
# Anti Diet Club subdirectory
location /antidietclub {
    alias /home/clawd/.openclaw/workspace/antidietclub/public;
    try_files $uri $uri/ @antidietclub;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME /home/clawd/.openclaw/workspace/antidietclub/public/index.php;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
}

location @antidietclub {
    rewrite /antidietclub/(.*)$ /antidietclub/index.php?$1 last;
}
```

#### 2. Set Permissions

```bash
cd /home/clawd/.openclaw/workspace/antidietclub

# Storage & cache permissions
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;

# Ownership
sudo chown -R www-data:www-data storage bootstrap/cache public
```

#### 3. Test & Reload Nginx

```bash
# Test configuration
sudo nginx -t

# Reload if test passes
sudo systemctl reload nginx
```

#### 4. Clear Laravel Cache

```bash
cd /home/clawd/.openclaw/workspace/antidietclub
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🧪 Testing Deployment

### 1. Test HTTP Response

```bash
curl -I https://santrigresik.me/antidietclub
```

Expected: `HTTP/2 200` or `HTTP/1.1 200`

### 2. Test Main Page

```bash
curl -s https://santrigresik.me/antidietclub | grep -o '<title>.*</title>'
```

Expected: `<title>Anti Diet Club - Deliciously Different</title>`

### 3. Test Admin Panel

```bash
curl -I https://santrigresik.me/antidietclub/admin
```

Expected: `HTTP/2 200` or redirect to login page

---

## 🔍 Troubleshooting

### 404 Not Found

**Problem:** Halaman tidak ditemukan

**Solution:**
1. Check Nginx config path: `/home/clawd/.openclaw/workspace/antidietclub/public`
2. Check file permissions: `ls -la public/`
3. Check PHP socket: `/run/php/php8.3-fpm.sock`

### 403 Forbidden

**Problem:** Permission denied

**Solution:**
```bash
sudo chown -R www-data:www-data /home/clawd/.openclaw/workspace/antidietclub
sudo chmod -R 755 /home/clawd/.openclaw/workspace/antidietclub
```

### 500 Internal Server Error

**Problem:** Laravel error

**Solution:**
```bash
# Check Laravel logs
tail -50 /home/clawd/.openclaw/workspace/antidietclub/storage/logs/laravel.log

# Check Nginx logs
sudo tail -50 /var/log/nginx/error.log

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Images Not Loading

**Problem:** Storage link not created

**Solution:**
```bash
cd /home/clawd/.openclaw/workspace/antidietclub
php artisan storage:link
sudo chown -R www-data:www-data public/storage
```

---

## 📊 Architecture

### Directory Structure

```
/home/clawd/.openclaw/workspace/antidietclub/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── ProductController.php
│   │       ├── BlogController.php
│   │       └── CartController.php
├── resources/
│   └── views/
│       ├── home.blade.php
│       ├── products/
│       ├── blog/
│       └── cart/
├── public/
│   ├── index.php (entry point)
│   └── storage (symlink to storage/app/public)
├── storage/
│   └── app/
│       └── public/ (uploaded images)
└── routes/
    └── web.php
```

### Nginx Flow

1. Request: `https://santrigresik.me/antidietclub/products`
2. Nginx matches: `location /antidietclub`
3. Alias to: `/home/clawd/.openclaw/workspace/antidietclub/public`
4. Try files: `$uri` → `/antidietclub/products`
5. If not found: `@antidietclub` → rewrite to `/antidietclub/index.php?$1`
6. PHP-FPM executes: Laravel routing

---

## 🔧 Configuration Files

### Nginx Config Location
- **Path:** `/etc/nginx/sites-available/santrigresik.me`
- **Backup:** `/etc/nginx/sites-available/santrigresik.me.backup.YYYYMMDD_HHMMSS`

### Laravel .env Key Locations
- **App URL:** `APP_URL=https://santrigresik.me/antidietclub`
- **Asset URL:** `ASSET_URL=https://santrigresik.me/antidietclub`

---

## 🚀 Next Steps After Deployment

1. **Test All Pages**
   - Home: https://santrigresik.me/antidietclub
   - Products: https://santrigresik.me/antidietclub/products
   - Blog: https://santrigresik.me/antidietclub/blog
   - Cart: https://santrigresik.me/antidietclub/cart
   - Admin: https://santrigresik.me/antidietclub/admin

2. **Upload Product Images**
   - Login to admin panel
   - Go to Products → Edit
   - Upload product photos
   - Set primary image

3. **Configure WhatsApp Number**
   - Go to Settings
   - Update WhatsApp number
   - Test order flow

4. **Monitor Logs**
   ```bash
   # Nginx logs
   sudo tail -f /var/log/nginx/access.log
   sudo tail -f /var/log/nginx/error.log

   # Laravel logs
   tail -f /home/clawd/.openclaw/workspace/antidietclub/storage/logs/laravel.log
   ```

---

## 📞 Support

If issues arise after deployment:

1. Check logs: `tail -f /var/log/nginx/error.log`
2. Restart services: `sudo systemctl restart nginx php8.3-fpm`
3. Restore backup: `sudo cp /etc/nginx/sites-available/santrigresik.me.backup.* /etc/nginx/sites-available/santrigresik.me`

---

**Created:** 2026-02-12
**Project:** Anti Diet Club
**Deployment:** Nginx + PHP-FPM
**URL:** https://santrigresik.me/antidietclub