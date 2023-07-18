<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class detailPengembalian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kondisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kondisi_akhir' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'denda_telat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'denda_kondisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'total_denda' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'NULL'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'NULL'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'NULL'       => true,
            ],
        ]);
        $this->forge->createTable('detail_pengembalian');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pengembalian');
    }
}
