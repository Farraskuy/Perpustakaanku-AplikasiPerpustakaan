<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Petugas extends Seeder
{
    /**
     * Seeder untuk menambahkan petugas tambahan (tanpa akses login)
     * Petugas dengan akses login sudah dibuat di AdminUserSeeder
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 3; $i <= 7; $i++) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $tanggal = $faker->dateTimeThisMonth();
            $data = [
                'id_petugas'     => 'PTG-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'foto'           => 'default.png',
                'nama'           => $faker->name($gender == 'Laki-laki' ? 'male' : 'female'),
                'jenis_kelamin'  => $gender,
                'agama'          => $faker->randomElement(['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']),
                'jabatan'        => $faker->randomElement(['Pustakawan', 'Juru Arsip', 'Petugas Kebersihan', 'Petugas Keamanan']),
                'akses_login'    => 'Tidak', // Petugas tanpa akses login
                'id_login'       => 0,       // Tidak terhubung ke user
                'nomor_telepon'  => $faker->phoneNumber,
                'alamat'         => $faker->address,
                'created_at'     => Time::createFromTimestamp($tanggal->getTimestamp()),
                'updated_at'     => Time::createFromTimestamp(strtotime($tanggal->format('d-m-Y H:i:s') . ' + ' . $faker->randomDigit() . ' day')),
            ];
            $this->db->table('petugas')->insert($data);
        }

        echo "5 Petugas tambahan (tanpa akses login) berhasil dibuat!\n";
    }
}
