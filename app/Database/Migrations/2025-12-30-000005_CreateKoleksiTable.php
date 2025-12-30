<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKoleksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_koleksi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_anggota' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_buku' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addKey('id_koleksi', true);
        $this->forge->createTable('koleksi');
    }

    public function down()
    {
        $this->forge->dropTable('koleksi');
    }
}
