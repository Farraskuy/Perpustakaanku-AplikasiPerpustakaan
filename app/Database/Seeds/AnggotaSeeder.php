<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Myth\Auth\Password;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Buat 10 anggota dengan user login
        for ($i = 1; $i <= 10; $i++) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $nama = $faker->name($gender == 'Laki-laki' ? 'male' : 'female');
            $email = 'anggota' . $i . '@perpustakaan.com';

            // Buat user untuk anggota
            $userData = [
                'email' => $email,
                'username' => 'anggota' . $i,
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
                'id_anggota' => 'AGT-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'id_login' => $userId,
                'nama' => $nama,
                'jenis_kelamin' => $gender,
                'agama' => $faker->randomElement(['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']),
                'nomor_telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'batas_pinjam' => 3, // Default borrowing limit
                'foto' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('anggota')->insert($anggotaData);
        }

        echo "Anggota seeder berhasil! 10 anggota dibuat.\n";
        echo "Login: anggota1@perpustakaan.com s/d anggota10@perpustakaan.com\n";
        echo "Password: anggota123\n";
    }
}
