<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
    public function run()
    {
        $penulis = [
            ['id_penulis' => 'PNL-001', 'nama' => 'Andrea Hirata'],
            ['id_penulis' => 'PNL-002', 'nama' => 'Pramoedya Ananta Toer'],
            ['id_penulis' => 'PNL-003', 'nama' => 'Tere Liye'],
            ['id_penulis' => 'PNL-004', 'nama' => 'Habiburrahman El Shirazy'],
            ['id_penulis' => 'PNL-005', 'nama' => 'Dewi Lestari'],
            ['id_penulis' => 'PNL-006', 'nama' => 'Ahmad Fuadi'],
            ['id_penulis' => 'PNL-007', 'nama' => 'Eka Kurniawan'],
            ['id_penulis' => 'PNL-008', 'nama' => 'Leila S. Chudori'],
            ['id_penulis' => 'PNL-009', 'nama' => 'Ayu Utami'],
            ['id_penulis' => 'PNL-010', 'nama' => 'NH. Dini'],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($penulis as $author) {
            $author['created_at'] = $now;
            $author['updated_at'] = $now;
            $this->db->table('penulis')->insert($author);
        }

        echo "Penulis seeder berhasil!\n";
    }
}
