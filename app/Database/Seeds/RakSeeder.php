<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RakSeeder extends Seeder
{
    public function run()
    {
        $rak = [
            ['id_rak' => 'RAK-001', 'kode_rak' => 'A-01', 'nama' => 'Rak Fiksi A1', 'lokasi' => 'Lantai 1 - Baris A'],
            ['id_rak' => 'RAK-002', 'kode_rak' => 'A-02', 'nama' => 'Rak Fiksi A2', 'lokasi' => 'Lantai 1 - Baris A'],
            ['id_rak' => 'RAK-003', 'kode_rak' => 'B-01', 'nama' => 'Rak Agama B1', 'lokasi' => 'Lantai 1 - Baris B'],
            ['id_rak' => 'RAK-004', 'kode_rak' => 'B-02', 'nama' => 'Rak Agama B2', 'lokasi' => 'Lantai 1 - Baris B'],
            ['id_rak' => 'RAK-005', 'kode_rak' => 'C-01', 'nama' => 'Rak Sains C1', 'lokasi' => 'Lantai 2 - Baris C'],
            ['id_rak' => 'RAK-006', 'kode_rak' => 'C-02', 'nama' => 'Rak Sains C2', 'lokasi' => 'Lantai 2 - Baris C'],
            ['id_rak' => 'RAK-007', 'kode_rak' => 'D-01', 'nama' => 'Rak Sejarah D1', 'lokasi' => 'Lantai 2 - Baris D'],
            ['id_rak' => 'RAK-008', 'kode_rak' => 'D-02', 'nama' => 'Rak Sejarah D2', 'lokasi' => 'Lantai 2 - Baris D'],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($rak as $r) {
            $r['created_at'] = $now;
            $r['updated_at'] = $now;
            $this->db->table('rak')->insert($r);
        }

        echo "Rak seeder berhasil!\n";
    }
}
