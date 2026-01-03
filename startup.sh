#!/bin/bash

# Azure App Service Linux Startup Script for CodeIgniter 4
# This script configures the environment and runs migrations

echo "=========================================="
echo "  CodeIgniter 4 Azure Startup Script"
echo "=========================================="

# Check if running in Azure environment
if [ -d "/home/site/wwwroot" ]; then
    echo "[1/5] Detected Azure App Service environment"
    
    cd /home/site/wwwroot
    
    # Ensure writable directory has correct permissions
    echo "[2/5] Setting permissions for writable directory..."
    mkdir -p /home/site/wwwroot/writable/session
    mkdir -p /home/site/wwwroot/writable/logs
    mkdir -p /home/site/wwwroot/writable/cache
    chmod -R 775 /home/site/wwwroot/writable
    
    # Run migrations automatically
    echo "[3/5] Running database migrations..."
    php spark migrate --all 2>&1 || echo "Migration warning (may already be up to date)"
    
    # Check if seeder needs to run (only on first deployment)
    SEEDER_LOCK="/home/site/wwwroot/writable/.seeder_done"
    if [ ! -f "$SEEDER_LOCK" ]; then
        echo "[4/5] Running demo seeder (first time only)..."
        php spark db:seed DemoProductionSeeder 2>&1 || echo "Seeder warning (may have errors)"
        touch "$SEEDER_LOCK"
        echo "Seeder completed and locked."
    else
        echo "[4/5] Skipping seeder (already executed previously)"
    fi
    
    echo "[5/5] Azure configuration completed!"
    echo "=========================================="
else
    echo "Not running in Azure App Service environment"
fi
