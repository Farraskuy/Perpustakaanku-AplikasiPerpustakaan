<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AppConfigSeeder extends Seeder
{
    public function run()
    {
        $config = [
            'id'            => 1,
            'nomor_telepon' => '021-12345678',
            'email'         => 'info@perpustakaan.com',
            'denda_telat'   => 1000,  // Rp 1.000 per hari
            'denda_hilang'  => 50000, // Rp 50.000 per buku
            'denda_rusak'   => 25000, // Rp 25.000 per buku
            'logo'          => 'logo.png',
            'alamat'        => 'Jl. Perpustakaan No. 1, Kota, Indonesia 12345',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $this->db->table('app_config')->insert($config);

        echo "App Config seeder berhasil!\n";
    }
}
