#!/bin/bash

# ========================================================
# ANTI DIET CLUB - NGINX DEPLOYMENT SCRIPT
# ========================================================
# This script sets up Nginx to serve Anti Diet Club
# at santrigresik.me/antidietclub
# ========================================================

set -e

echo "🍪 Anti Diet Club - Nginx Deployment"
echo "======================================"
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo "❌ Please run this script with sudo"
    echo "   sudo ./deploy-nginx.sh"
    exit 1
fi

# Paths
ANTIDIET_PATH="/home/clawd/.openclaw/workspace/antidietclub"
NGINX_CONF="/etc/nginx/sites-available/santrigresik.me"
BACKUP_CONF="/etc/nginx/sites-available/santrigresik.me.backup.$(date +%Y%m%d_%H%M%S)"

echo "📁 Anti Diet Club path: $ANTIDIET_PATH"
echo "📁 Nginx config: $NGINX_CONF"
echo ""

# === Step 1: Backup current Nginx config ===
echo "📦 Backing up current Nginx configuration..."
if [ -f "$NGINX_CONF" ]; then
    cp "$NGINX_CONF" "$BACKUP_CONF"
    echo "✅ Backup saved to: $BACKUP_CONF"
else
    echo "⚠️  No existing config found, skipping backup"
fi
echo ""

# === Step 2: Create new Nginx config ===
echo "⚙️  Creating new Nginx configuration..."
cat > "$NGINX_CONF" << 'EOF'
server {
    server_name santrigresik.me www.santrigresik.me;
    root /home/clawd/annibros-santri/public;
    index index.php index.html index.htm;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    charset utf-8;

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

    # Main site (An-Nibros)
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 100M;

    listen [::]:443 ssl ipv6only=on; # managed by Certbot
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/santrigresik.me/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/santrigresik.me/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}

server {
    if ($host = www.santrigresik.me) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    if ($host = santrigresik.me) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    listen 80;
    listen [::]:80;
    server_name santrigresik.me www.santrigresik.me;
    return 404; # managed by Certbot
}
EOF

echo "✅ Nginx configuration created"
echo ""

# === Step 3: Set permissions ===
echo "🔒 Setting permissions for Anti Diet Club..."
cd "$ANTIDIET_PATH"

# Set directory permissions
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;

# Set ownership
chown -R www-data:www-data storage bootstrap/cache public

echo "✅ Permissions set"
echo ""

# === Step 4: Test Nginx configuration ===
echo "🧪 Testing Nginx configuration..."
if nginx -t; then
    echo "✅ Nginx configuration is valid"
else
    echo "❌ Nginx configuration test failed!"
    echo "📦 Restoring backup..."
    if [ -f "$BACKUP_CONF" ]; then
        cp "$BACKUP_CONF" "$NGINX_CONF"
        echo "✅ Backup restored"
    fi
    exit 1
fi
echo ""

# === Step 5: Reload Nginx ===
echo "🔄 Reloading Nginx..."
systemctl reload nginx
echo "✅ Nginx reloaded"
echo ""

# === Step 6: Clear Laravel cache ===
echo "🧹 Clearing Laravel cache..."
cd "$ANTIDIET_PATH"
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✅ Cache cleared"
echo ""

# === Step 7: Verify deployment ===
echo "🔍 Verifying deployment..."
echo ""
echo "📋 Summary:"
echo "  - Anti Diet Club: https://santrigresik.me/antidietclub"
echo "  - Admin Panel: https://santrigresik.me/antidietclub/admin"
echo "  - Main Site: https://santrigresik.me"
echo ""
echo "📝 Admin Credentials:"
echo "  - Email: admin@antidietclub.com"
echo "  - Password: admin123"
echo ""
echo "✅ Deployment complete!"
echo ""
echo "🧪 Test the website:"
echo "  curl -I https://santrigresik.me/antidietclub"
echo ""
echo "📖 View Nginx logs if needed:"
echo "  tail -f /var/log/nginx/error.log"
echo "  tail -f /var/log/nginx/access.log"
echo ""
echo "📦 Backup saved to: $BACKUP_CONF"
echo ""