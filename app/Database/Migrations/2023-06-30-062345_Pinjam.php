<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pinjam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjam' => [
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
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_buku' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_kembali' => [
                'type'       => 'DATETIME',
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
        $this->forge->addKey('id_pinjam', true);
        $this->forge->createTable('pinjam');
    }

    public function down()
    {
        $this->forge->dropTable('pinjam');
    }
}
