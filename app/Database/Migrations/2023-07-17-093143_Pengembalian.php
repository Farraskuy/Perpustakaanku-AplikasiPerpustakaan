<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengembalian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengembalian' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_petugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_buku' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total_denda' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'NULL'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'NULL'       => true,
            ],
        ]);
        $this->forge->addKey('id_pengembalian', true);
        $this->forge->createTable('pengembalian');
    }

    public function down()
    {
        $this->forge->dropTable('pengembalian');
    }
}
