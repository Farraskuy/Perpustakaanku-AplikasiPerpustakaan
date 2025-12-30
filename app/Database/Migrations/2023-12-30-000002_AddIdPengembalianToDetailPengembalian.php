<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdPengembalianToDetailPengembalian extends Migration
{
    public function up()
    {
        // Add id_pengembalian column to detail_pengembalian table
        $this->forge->addColumn('detail_pengembalian', [
            'id_pengembalian' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'id_peminjaman',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('detail_pengembalian', 'id_pengembalian');
    }
}
