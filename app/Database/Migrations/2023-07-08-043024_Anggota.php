<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPinjam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_login' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nomor_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'foto' => [
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
        ]);
        $this->forge->addKey('id_anggota', 'user', 'id');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pinjam');
    }
}
