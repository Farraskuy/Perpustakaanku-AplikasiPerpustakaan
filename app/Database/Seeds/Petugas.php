<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $gender = $faker->randomElements(['Laki-laki', 'Perempuan'])[0];
            $tanggal = $faker->dateTimeThisMonth();
            $data = [
                'foto' => 'default.png',
                'nama' => $faker->name($gender == 'Laki-laki' ? 'male' : 'female'),
                'jenis_kelamin' => $gender,
                'agama' => $faker->randomElements(['Islam', 'Protestan', 'Kristen', 'Hindu', 'Buddha', 'Khonghucu'])[0],
                'jabatan' => $faker->randomElements(['Pustakawan', 'Juru Arsip', 'Petugas Kebersihan', 'Penjaga Keamanan'])[0],
                'alamat' => $faker->address,
                'created_at' => Time::createFromTimestamp($tanggal->getTimestamp()),
                'updated_at' => Time::createFromTimestamp(strtotime($tanggal->format('d-m-Y H:i:s') . ' + ' . $faker->randomDigit() . ' day')),
            ];
            $this->db->table('petugas')->insert($data);
        }
    }
}
