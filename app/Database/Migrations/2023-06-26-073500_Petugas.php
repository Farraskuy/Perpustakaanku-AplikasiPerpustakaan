<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_petugas' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'foto' => [
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
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'akses_login' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_login' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nomor_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_petugas', true);
        $this->forge->createTable('petugas');
    }

    public function down()
    {
        $this->forge->dropTable('petugas');
    }
}
