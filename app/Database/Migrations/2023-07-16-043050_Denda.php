<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Denda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_denda' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_anggota' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_petugas' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'total_denda' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'bayar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'kembali' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
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
        $this->forge->addKey('id_denda', true);
        $this->forge->createTable('denda');

        $this->forge->addField([
            'id_denda' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_buku' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'denda' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'keterangan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'subtotal_denda' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('id_denda', 'denda', 'id_denda');
        $this->forge->createTable('detail_denda');
    }

    public function down()
    {
        $this->forge->dropTable('denda');
        $this->forge->dropTable('detail_denda');
    }
}
