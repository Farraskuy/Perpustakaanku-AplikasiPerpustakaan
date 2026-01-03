#!/bin/bash

# Azure App Service Linux Startup Script for CodeIgniter 4
# This script configures nginx to use the public/ folder as root

echo "Starting CodeIgniter 4 Azure configuration..."

# Check if running in Azure environment
if [ -d "/home/site/wwwroot" ]; then
    echo "Detected Azure App Service environment"
    
    # Ensure writable directory has correct permissions
    if [ -d "/home/site/wwwroot/writable" ]; then
        echo "Setting permissions for writable directory..."
        chmod -R 775 /home/site/wwwroot/writable
    fi
    
    # Create session directory if not exists
    mkdir -p /home/site/wwwroot/writable/session
    chmod 775 /home/site/wwwroot/writable/session
    
    # Create logs directory if not exists
    mkdir -p /home/site/wwwroot/writable/logs
    chmod 775 /home/site/wwwroot/writable/logs
    
    echo "Azure configuration completed!"
else
    echo "Not running in Azure App Service environment"
fi
