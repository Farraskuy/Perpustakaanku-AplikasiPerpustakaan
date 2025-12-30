<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaToRak extends Migration
{
    public function up()
    {
        // Tambah kolom nama ke tabel rak
        $fields = [
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'kode_rak'
            ],
        ];

        $this->forge->addColumn('rak', $fields);

        // Update data existing rak dengan nama default
        $this->db->query("UPDATE rak SET nama = CONCAT('Rak ', kode_rak) WHERE nama IS NULL");
    }

    public function down()
    {
        $this->forge->dropColumn('rak', 'nama');
    }
}
