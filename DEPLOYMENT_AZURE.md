# Panduan Deployment Azure App Service - Perpustakaanku

## Persiapan

### Prasyarat

- Azure account dengan subscription aktif
- Git repository (GitHub/Azure DevOps)
- Database MySQL (Azure Database for MySQL atau external)

### File Konfigurasi

Aplikasi ini sudah dikonfigurasi untuk Azure dengan file berikut:

- `public/web.config` - URL rewriting untuk IIS (Windows)
- `startup.sh` - Startup script untuk Apache (Linux)
- `azure_settings.json` - Template environment variables

---

## Langkah Deployment

### 1. Buat Azure Web App

1. Buka [Azure Portal](https://portal.azure.com)
2. Klik **Create a resource** → **Web App**
3. Konfigurasi:
   | Setting | Value |
   |---------|-------|
   | Subscription | Pilih subscription Anda |
   | Resource Group | Buat baru atau pilih existing |
   | Name | `perpustakaanku` (harus unik) |
   | Publish | Code |
   | Runtime stack | **PHP 8.2** |
   | Operating System | **Linux** (DISARANKAN) |
   | Region | Southeast Asia |

### 2. Konfigurasi DocumentRoot

#### Untuk Linux (Apache):

1. Buka App Service → **Configuration** → **General settings**
2. Di bagian **Startup Command**, masukkan:
   ```bash
   bash /home/site/wwwroot/startup.sh
   ```

#### Untuk Windows (IIS):

1. Buka App Service → **Configuration** → **Path mappings**
2. Ubah **Virtual path** `/` menjadi physical path:
   ```
   site\wwwroot\public
   ```

### 3. Set Environment Variables

Buka App Service → **Configuration** → **Application settings**, tambahkan:

| Name                        | Value                                   |
| --------------------------- | --------------------------------------- |
| `CI_ENVIRONMENT`            | `production`                            |
| `app.baseURL`               | `https://[nama-app].azurewebsites.net/` |
| `database.default.hostname` | `[hostname MySQL]`                      |
| `database.default.database` | `[nama database]`                       |
| `database.default.username` | `[username]`                            |
| `database.default.password` | `[password]`                            |
| `database.default.DBDriver` | `MySQLi`                                |
| `database.default.port`     | `3306`                                  |

> **Tip:** Anda bisa import dari `azure_settings.json` menggunakan Azure CLI:
>
> ```bash
> az webapp config appsettings set --resource-group [RG] --name [APP] --settings @azure_settings.json
> ```

### 4. Setup Database

1. Buat **Azure Database for MySQL Flexible Server**
2. Di **Networking**, aktifkan **Allow access to Azure services**
3. Connect via MySQL client dan import database:
   ```bash
   mysql -h [hostname] -u [username] -p [database] < database_export.sql
   ```

### 5. Deploy Aplikasi

#### Opsi A: GitHub Actions (Disarankan)

1. Buka App Service → **Deployment Center**
2. Pilih **GitHub** → Authorize → Pilih repository
3. Azure otomatis membuat workflow file di `.github/workflows/`

#### Opsi B: Azure CLI

```bash
# Login
az login

# Deploy via ZIP
zip -r deploy.zip . -x ".git/*" "vendor/*"
az webapp deployment source config-zip --resource-group [RG] --name [APP] --src deploy.zip

# Install dependencies di Azure
az webapp ssh --resource-group [RG] --name [APP]
cd /home/site/wwwroot
composer install --no-dev --optimize-autoloader
```

### 6. Jalankan Migration

```bash
# SSH ke App Service
az webapp ssh --resource-group [RG] --name [APP]

# Jalankan migration
cd /home/site/wwwroot
php spark migrate
```

---

## Troubleshooting

### Error: "Index not found"

- Pastikan DocumentRoot mengarah ke folder `public/`
- Untuk Linux: Cek Startup Command sudah benar
- Untuk Windows: Cek Path mappings sudah benar

### Error: "Route not found" / 404

- Pastikan `web.config` ada di folder `public/` (Windows)
- Pastikan `.htaccess` ada di folder `public/` (Linux)
- Cek mod_rewrite sudah enabled

### Error: Database Connection

- Pastikan environment variables database sudah benar
- Cek firewall Azure Database for MySQL
- Aktifkan "Allow access to Azure services"

### Melihat Log

```bash
# Via Azure CLI
az webapp log tail --resource-group [RG] --name [APP]

# Atau di Azure Portal
App Service → Monitoring → Log stream
```

---

## Struktur File Penting

```
Perpustakaanku/
├── app/
│   └── Config/
│       └── App.php           # Base URL configuration
├── public/
│   ├── index.php             # Front controller
│   ├── .htaccess             # Apache URL rewrite
│   └── web.config            # IIS URL rewrite
├── startup.sh                # Linux startup script
├── writable/                 # Logs & cache (harus writable)
└── azure_settings.json       # Environment template
```
