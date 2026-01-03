#!/bin/bash

# Azure App Service Linux Startup Script for CodeIgniter 4
# This script configures Apache to use the public/ folder as DocumentRoot

echo "Starting CodeIgniter 4 Azure configuration..."

# Check if running in Azure environment
if [ -d "/home/site/wwwroot" ]; then
    echo "Detected Azure App Service environment"
    
    # Update Apache DocumentRoot to point to public folder
    if [ -f "/etc/apache2/sites-available/000-default.conf" ]; then
        echo "Updating Apache DocumentRoot..."
        sed -i 's|/home/site/wwwroot|/home/site/wwwroot/public|g' /etc/apache2/sites-available/000-default.conf
        sed -i 's|<Directory /home/site/wwwroot>|<Directory /home/site/wwwroot/public>|g' /etc/apache2/sites-available/000-default.conf
    fi
    
    # Enable mod_rewrite for clean URLs
    echo "Enabling mod_rewrite..."
    a2enmod rewrite 2>/dev/null || true
    
    # Ensure writable directory has correct permissions
    if [ -d "/home/site/wwwroot/writable" ]; then
        echo "Setting permissions for writable directory..."
        chmod -R 775 /home/site/wwwroot/writable
    fi
    
    # Create session directory if not exists
    mkdir -p /home/site/wwwroot/writable/session
    chmod 775 /home/site/wwwroot/writable/session
    
    # Reload Apache configuration
    echo "Reloading Apache..."
    service apache2 reload 2>/dev/null || true
    
    echo "Azure configuration completed!"
else
    echo "Not running in Azure App Service environment"
fi

# Start Apache in foreground (required for Azure)
exec apache2-foreground
