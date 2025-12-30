<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBatasAmbilToPinjam extends Migration
{
    public function up()
    {
        $fields = [
            'batas_ambil' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'jumlah_buku'
            ],
        ];
        $this->forge->addColumn('pinjam', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pinjam', 'batas_ambil');
    }
}
