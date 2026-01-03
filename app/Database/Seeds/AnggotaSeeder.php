<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

/**
 * Anggota Seeder untuk Production
 * 
 * Versi ini tidak menggunakan Faker sehingga bisa dijalankan di production
 */
class AnggotaSeeder extends Seeder
{
    public function run()
    {
        // Data anggota statis (tanpa faker)
        $anggotaList = [
            ['nama' => 'Ahmad Fauzi', 'gender' => 'Laki-laki', 'agama' => 'Islam', 'telp' => '081234567001', 'alamat' => 'Jl. Merdeka No. 1, Jakarta'],
            ['nama' => 'Siti Nurhaliza', 'gender' => 'Perempuan', 'agama' => 'Islam', 'telp' => '081234567002', 'alamat' => 'Jl. Sudirman No. 25, Jakarta'],
            ['nama' => 'Budi Santoso', 'gender' => 'Laki-laki', 'agama' => 'Katolik', 'telp' => '081234567003', 'alamat' => 'Jl. Gatot Subroto No. 10, Bandung'],
            ['nama' => 'Dewi Lestari', 'gender' => 'Perempuan', 'agama' => 'Hindu', 'telp' => '081234567004', 'alamat' => 'Jl. Diponegoro No. 5, Surabaya'],
            ['nama' => 'Eko Prasetyo', 'gender' => 'Laki-laki', 'agama' => 'Protestan', 'telp' => '081234567005', 'alamat' => 'Jl. Ahmad Yani No. 100, Semarang'],
            ['nama' => 'Fitri Handayani', 'gender' => 'Perempuan', 'agama' => 'Islam', 'telp' => '081234567006', 'alamat' => 'Jl. Pahlawan No. 50, Yogyakarta'],
            ['nama' => 'Gunawan Wibowo', 'gender' => 'Laki-laki', 'agama' => 'Buddha', 'telp' => '081234567007', 'alamat' => 'Jl. Asia Afrika No. 15, Bandung'],
            ['nama' => 'Hana Permata', 'gender' => 'Perempuan', 'agama' => 'Islam', 'telp' => '081234567008', 'alamat' => 'Jl. Veteran No. 30, Malang'],
            ['nama' => 'Irfan Hakim', 'gender' => 'Laki-laki', 'agama' => 'Islam', 'telp' => '081234567009', 'alamat' => 'Jl. Pemuda No. 20, Surabaya'],
            ['nama' => 'Jasmine Putri', 'gender' => 'Perempuan', 'agama' => 'Khonghucu', 'telp' => '081234567010', 'alamat' => 'Jl. Hayam Wuruk No. 8, Jakarta'],
        ];

        // Buat 10 anggota dengan user login
        foreach ($anggotaList as $i => $data) {
            $index = $i + 1;
            $email = 'anggota' . $index . '@perpustakaan.com';

            // Buat user untuk anggota
            $userData = [
                'email' => $email,
                'username' => 'anggota' . $index,
                'password_hash' => Password::hash('anggota123'),
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('users')->insert($userData);
            $userId = $this->db->insertID();

            // Assign ke group anggota (group_id = 3)
            $this->db->table('auth_groups_users')->insert([
                'group_id' => 3,
                'user_id' => $userId,
            ]);

            // Buat data anggota
            $anggotaData = [
                'id_anggota' => 'AGT-' . date('Ymd') . '-' . str_pad($index, 3, '0', STR_PAD_LEFT),
                'id_login' => $userId,
                'nama' => $data['nama'],
                'jenis_kelamin' => $data['gender'],
                'agama' => $data['agama'],
                'nomor_telepon' => $data['telp'],
                'alamat' => $data['alamat'],
                'batas_pinjam' => 3,
                'foto' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('anggota')->insert($anggotaData);
        }

        echo "Anggota seeder berhasil! 10 anggota dibuat.\n";
        echo "Login: anggota1 s/d anggota10\n";
        echo "Password: anggota123\n";
    }
}
