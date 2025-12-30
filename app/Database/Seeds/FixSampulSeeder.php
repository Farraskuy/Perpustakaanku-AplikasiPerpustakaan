<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FixSampulSeeder extends Seeder
{
    /**
     * Seeder untuk memperbaiki sampul buku yang kosong atau menggunakan default.jpg
     */
    public function run()
    {
        // Update sampul yang kosong, null, atau menggunakan ekstensi salah
        $this->db->query("UPDATE buku SET sampul = 'default.png' WHERE sampul = 'default.jpg' OR sampul IS NULL OR sampul = ''");

        echo "Sampul buku berhasil diperbaiki!\n";
        echo "Semua buku dengan sampul kosong atau default.jpg akan menggunakan default.png\n";
    }
}
