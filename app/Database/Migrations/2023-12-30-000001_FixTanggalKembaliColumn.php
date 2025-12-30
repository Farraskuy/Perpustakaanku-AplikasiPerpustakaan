<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixTanggalKembaliColumn extends Migration
{
    public function up()
    {
        // Rename kolom tanggal-kembali menjadi tanggal_kembali
        $this->forge->modifyColumn('pengembalian', [
            'tanggal-kembali' => [
                'name' => 'tanggal_kembali',
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Revert back to original name
        $this->forge->modifyColumn('pengembalian', [
            'tanggal_kembali' => [
                'name' => 'tanggal-kembali',
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }
}
