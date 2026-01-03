<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

/**
 * Demo Production Seeder
 * 
 * Seeder ini membuat data demo untuk production dengan semua role user.
 * Jalankan: php spark db:seed DemoProductionSeeder
 */
class DemoProductionSeeder extends Seeder
{
    /**
     * Demo credentials yang akan ditampilkan di login page
     */
    public const DEMO_CREDENTIALS = [
        'admin' => [
            'username' => 'admin',
            'email' => 'admin@perpustakaan.com',
            'password' => 'admin123',
            'role' => 'Administrator',
            'description' => 'Akses penuh ke semua fitur'
        ],
        'petugas' => [
            'username' => 'petugas',
            'email' => 'petugas@perpustakaan.com',
            'password' => 'petugas123',
            'role' => 'Petugas',
            'description' => 'Kelola buku, peminjaman, pengembalian'
        ],
        'anggota' => [
            'username' => 'anggota1',
            'email' => 'anggota1@perpustakaan.com',
            'password' => 'anggota123',
            'role' => 'Anggota',
            'description' => 'Pinjam buku, lihat histori'
        ],
    ];

    public function run()
    {
        echo "========================================\n";
        echo "  DEMO PRODUCTION SEEDER\n";
        echo "========================================\n\n";

        // Jalankan seeder individual
        $this->call('AdminUserSeeder');
        $this->call('AnggotaSeeder');
        $this->call('KategoriSeeder');
        $this->call('PenerbitSeeder');
        $this->call('PenulisSeeder');
        $this->call('RakSeeder');
        $this->call('BukuSeeder');

        echo "\n========================================\n";
        echo "  DEMO CREDENTIALS\n";
        echo "========================================\n\n";

        foreach (self::DEMO_CREDENTIALS as $type => $cred) {
            echo sprintf(
                "%-12s: %s / %s\n",
                strtoupper($cred['role']),
                $cred['username'],
                $cred['password']
            );
        }

        echo "\n========================================\n";
        echo "  SEEDING COMPLETED!\n";
        echo "========================================\n";
    }
}
