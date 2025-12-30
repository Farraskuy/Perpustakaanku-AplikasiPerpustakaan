<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeder utama yang menjalankan semua seeder lainnya
     * Urutan penting karena ada ketergantungan antar tabel
     */
    public function run()
    {
        echo "=== Memulai Database Seeding ===\n\n";

        // 1. Admin User & Groups (harus pertama karena tabel users dan groups)
        echo "1. Seeding Admin Users...\n";
        $this->call('AdminUserSeeder');
        echo "\n";

        // 2. App Config
        echo "2. Seeding App Config...\n";
        $this->call('AppConfigSeeder');
        echo "\n";

        // 3. Master Data (tidak ada ketergantungan)
        echo "3. Seeding Kategori...\n";
        $this->call('KategoriSeeder');
        echo "\n";

        echo "4. Seeding Penerbit...\n";
        $this->call('PenerbitSeeder');
        echo "\n";

        echo "5. Seeding Penulis...\n";
        $this->call('PenulisSeeder');
        echo "\n";

        echo "6. Seeding Rak...\n";
        $this->call('RakSeeder');
        echo "\n";

        // 4. Data yang bergantung pada master data
        echo "7. Seeding Buku...\n";
        $this->call('BukuSeeder');
        echo "\n";

        // 5. Anggota (membutuhkan users & groups sudah ada)
        echo "8. Seeding Anggota...\n";
        $this->call('AnggotaSeeder');
        echo "\n";

        // 6. Petugas tambahan (opsional, sudah ada di AdminUserSeeder)
        echo "9. Seeding Petugas tambahan...\n";
        $this->call('Petugas');
        echo "\n";

        echo "=== Database Seeding Selesai! ===\n";
        echo "\n--- Akun Login ---\n";
        echo "Admin: admin@perpustakaan.com / admin123\n";
        echo "Petugas: petugas@perpustakaan.com / petugas123\n";
        echo "Anggota: anggota1@perpustakaan.com s/d anggota10@perpustakaan.com / anggota123\n";
    }
}
