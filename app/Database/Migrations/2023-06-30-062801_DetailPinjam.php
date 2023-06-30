<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPinjam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjam' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
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
        $this->forge->addForeignKey('id_pinjam', 'pinjam', 'id');
        $this->forge->createTable('detail_pinjam');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pinjam');
    }
}
