<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBatasPinjamToAnggota extends Migration
{
    public function up()
    {
        $fields = [
            'batas_pinjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 3,
                'after' => 'nomor_telepon'
            ],
        ];
        $this->forge->addColumn('anggota', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('anggota', 'batas_pinjam');
    }
}
