<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenerbitSeeder extends Seeder
{
    public function run()
    {
        $penerbit = [
            ['id_penerbit' => 'PNB-001', 'nama' => 'Gramedia Pustaka Utama'],
            ['id_penerbit' => 'PNB-002', 'nama' => 'Erlangga'],
            ['id_penerbit' => 'PNB-003', 'nama' => 'Mizan'],
            ['id_penerbit' => 'PNB-004', 'nama' => 'Bentang Pustaka'],
            ['id_penerbit' => 'PNB-005', 'nama' => 'Republika'],
            ['id_penerbit' => 'PNB-006', 'nama' => 'Kompas'],
            ['id_penerbit' => 'PNB-007', 'nama' => 'Grasindo'],
            ['id_penerbit' => 'PNB-008', 'nama' => 'Elex Media Komputindo'],
            ['id_penerbit' => 'PNB-009', 'nama' => 'Pustaka Jaya'],
            ['id_penerbit' => 'PNB-010', 'nama' => 'Balai Pustaka'],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($penerbit as $pub) {
            $pub['created_at'] = $now;
            $pub['updated_at'] = $now;
            $this->db->table('penerbit')->insert($pub);
        }

        echo "Penerbit seeder berhasil!\n";
    }
}
