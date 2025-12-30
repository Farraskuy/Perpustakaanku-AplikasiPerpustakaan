<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            ['id_kategori' => 'KAT-001', 'nama' => 'Fiksi'],
            ['id_kategori' => 'KAT-002', 'nama' => 'Non-Fiksi'],
            ['id_kategori' => 'KAT-003', 'nama' => 'Sains & Teknologi'],
            ['id_kategori' => 'KAT-004', 'nama' => 'Sejarah'],
            ['id_kategori' => 'KAT-005', 'nama' => 'Biografi'],
            ['id_kategori' => 'KAT-006', 'nama' => 'Pendidikan'],
            ['id_kategori' => 'KAT-007', 'nama' => 'Agama'],
            ['id_kategori' => 'KAT-008', 'nama' => 'Kesehatan'],
            ['id_kategori' => 'KAT-009', 'nama' => 'Ekonomi & Bisnis'],
            ['id_kategori' => 'KAT-010', 'nama' => 'Seni & Budaya'],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($kategori as $kat) {
            $kat['created_at'] = $now;
            $kat['updated_at'] = $now;
            $this->db->table('kategori')->insert($kat);
        }

        echo "Kategori seeder berhasil!\n";
    }
}
