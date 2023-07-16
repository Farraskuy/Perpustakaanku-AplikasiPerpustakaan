<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConfigApp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'value' => [
                'type'       => 'TEXT',
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('config_app');
    }

    public function down()
    {
        $this->forge->dropTable('config_app');
    }
}
