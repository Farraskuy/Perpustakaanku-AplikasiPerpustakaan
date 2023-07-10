<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
            $this->forge->addField([
                'id_buku' => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 255,
                ],
                'judul' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'slug' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'penulis' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'penerbit' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'sinopsis' => [
                    'type'       => 'TEXT',
                ],
                'tanggal_terbit' => [
                    'type'       => 'DATETIME',
                    'NULL'       => true,
                ],
                'sampul' => [
                    'type'       => 'DATETIME',
                    'NULL'       => true,
                ],
                'stok' => [
                    'type'       => 'INT',
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
        $this->forge->addKey('id_buku', true);
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
