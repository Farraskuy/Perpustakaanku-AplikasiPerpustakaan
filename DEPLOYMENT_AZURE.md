# Panduan Deployment Perpustakaanku ke Azure App Service

Berikut adalah langkah-langkah untuk men-deploy aplikasi CodeIgniter 4 ini ke Microsoft Azure.

## 1. Persiapan Database (Azure Database for MySQL)

1.  Buka **Azure Portal**.
2.  Buat resource baru: **Azure Database for MySQL (Flexible Server)**.
3.  Konfigurasi:
    - **Resource Group**: Buat baru atau pilih yang ada.
    - **Server name**: (contoh: `perpustakaanku-db`).
    - **Region**: Pilih yang terdekat (misal: Southeast Asia).
    - **Workload type**: Development or Hobby (untuk biaya lebih murah).
    - **Authentication**: Masukkan username dan password admin.
4.  **Networking**:
    - Pilih "Allow public access from any Azure service within Azure to this server" (PENTING agar Web App bisa akses DB).
    - Tambahkan IP Anda sendiri ke firewall rules agar bisa akses dari PC lokal (untuk migrasi awal).

## 2. Persiapan Web App (Azure App Service)

1.  Buat resource baru: **Web App**.
2.  Konfigurasi:
    - **Publish**: Code.
    - **Runtime stack**: **PHP 8.1** (atau 8.2 sesuai kebutuhan).
    - **Operating System**: **Linux** (Rekomendasi).
    - **Pricing Plan**: Free (F1) atau Basic (B1).
3.  Review & Create.

## 3. Konfigurasi Web App

Setelah Web App dibuat, masuk ke menu resource tersebut.

### A. Environment Variables (Application Settings)

Masuk ke menu **Settings** -> **Environment variables** -> **App settings**. Tambahkan variable berikut:

| Name                             | Value                                        |
| -------------------------------- | -------------------------------------------- |
| `CI_ENVIRONMENT`                 | `production`                                 |
| `app.baseURL`                    | `https://<nama-app-anda>.azurewebsites.net/` |
| `database.default.hostname`      | `<nama-server-db>.mysql.database.azure.com`  |
| `database.default.database`      | `perpustakaanku`                             |
| `database.default.username`      | `<db-username>`                              |
| `database.default.password`      | `<db-password>`                              |
| `database.default.DBDriver`      | `MySQLi`                                     |
| `SCM_DO_BUILD_DURING_DEPLOYMENT` | `true`                                       |

_(Note: Anda perlu menyesuaikan `app/Config/Database.php` Anda agar mengambil nilai dari environment variables jika belum)_

### B. Konfigurasi Document Root

CodeIgniter 4 menggunakan folder `public` sebagai root.

1.  Masuk ke **Settings** -> **Configuration** -> **General Settings**.
2.  Cari **Startup Command**. Masukkan:
    ```bash
    cp /home/site/wwwroot/public/.htaccess /home/site/wwwroot/public/index.php /home/site/wwwroot/ && apache2-foreground
    ```
    _Atau cara yang lebih bersih:_
    Masuk ke **Settings** -> **Environment variables**. Edit `AZURE_WEB_APP_FLAG_USE_APACHE_REWRITE_MODULE` = `true`.
    Kemudian set `APACHE_DOCUMENT_ROOT` = `/home/site/wwwroot/public`.

## 4. Proses Deployment (Via GitHub)

1.  Pastikan kode Anda sudah di-push ke GitHub.
2.  Di Azure Web App, masuk ke menu **Deployment** -> **Deployment Center**.
3.  **Source**: GitHub.
4.  Authorize akun GitHub Anda.
5.  Pilih **Organization**, **Repository** (Perpustakaanku), dan **Branch** (master).
6.  Klik **Save**.
7.  Azure akan otomatis membuat Workflow di GitHub Actions dan mulai proses deploy.

## 5. Migrasi Database

Setelah deploy berhasil, Anda perlu membuat tabel database.

1.  Di menu Web App, pilih **Development Tools** -> **SSH**.
2.  Klik **Go**. Terminal akan terbuka.
3.  Jalankan perintah berikut:

```bash
# Pindah ke direktori root aplikasi
cd /home/site/wwwroot

# Jalankan migrasi database
php spark migrate

# (Opsional) Jalankan seeder data awal
php spark db:seed DatabaseSeeder
```

## Troubleshooting Umum

- **Error 500 / Blank Page**:
  - Cek **Log Stream** di Azure Portal untuk melihat detail error PHP.
  - Pastikan variable database benar.
- **CSS/JS Tidak Muncul**:
  - Pastikan `app.baseURL` diisi dengan benar (https).
  - Pastikan Document Root mengarah ke folder `public`.
