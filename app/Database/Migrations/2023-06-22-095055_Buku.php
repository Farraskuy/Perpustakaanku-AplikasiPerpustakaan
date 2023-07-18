<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
        // tabel buku
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
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_buku' => [
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
        // $this->forge->addKey('id_buku', true);
        // $this->forge->createTable('buku');

        // tabel rak
        $this->forge->addField([
            'id_rak' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kode_rak' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi' => [
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
        $this->forge->addKey('id_rak', true);
        $this->forge->createTable('rak');

        // tabel pengarang
        $this->forge->addField([
            'id_pengarang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
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
        $this->forge->addKey('id_pengarang', true);
        $this->forge->createTable('pengarang');

        // tabel penerbit
        $this->forge->addField([
            'id_penerbit' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
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
        $this->forge->addKey('id_penerbit', true);
        $this->forge->createTable('penerbit');

        // tabel kategori
        $this->forge->addField([
            'id_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
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
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
        $this->forge->dropTable('rak');
        $this->forge->dropTable('pengarang');
        $this->forge->dropTable('penerbit');
        $this->forge->dropTable('kategori');
    }
}
