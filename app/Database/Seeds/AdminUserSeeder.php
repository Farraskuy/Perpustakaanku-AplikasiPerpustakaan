<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Buat admin user menggunakan Myth\Auth
        $users = [
            [
                'email'            => 'admin@perpustakaan.com',
                'username'         => 'admin',
                'password_hash'    => Password::hash('admin123'),
                'active'           => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'email'            => 'petugas@perpustakaan.com',
                'username'         => 'petugas',
                'password_hash'    => Password::hash('petugas123'),
                'active'           => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert users
        foreach ($users as $user) {
            $this->db->table('users')->insert($user);
        }

        // Buat groups (roles)
        $groups = [
            [
                'name'        => 'admin',
                'description' => 'Administrator dengan akses penuh',
            ],
            [
                'name'        => 'petugas',
                'description' => 'Petugas perpustakaan',
            ],
            [
                'name'        => 'anggota',
                'description' => 'Anggota perpustakaan',
            ],
        ];

        foreach ($groups as $group) {
            $this->db->table('auth_groups')->insert($group);
        }

        // Assign admin ke group admin
        $authGroupsUsers = [
            [
                'group_id' => 1, // admin group
                'user_id'  => 1, // admin user
            ],
            [
                'group_id' => 2, // petugas group
                'user_id'  => 2, // petugas user
            ],
        ];

        foreach ($authGroupsUsers as $agu) {
            $this->db->table('auth_groups_users')->insert($agu);
        }

        // Buat data petugas terkait dengan user
        $petugasData = [
            [
                'id_petugas'     => 'PTG-' . date('Ymd') . '-001',
                'foto'           => 'default.png',
                'nama'           => 'Administrator',
                'jenis_kelamin'  => 'Laki-laki',
                'agama'          => 'Islam',
                'jabatan'        => 'Admin',
                'akses_login'    => 'Ya',
                'id_login'       => 1,
                'nomor_telepon'  => '081234567890',
                'alamat'         => 'Jl. Perpustakaan No. 1, Indonesia',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id_petugas'     => 'PTG-' . date('Ymd') . '-002',
                'foto'           => 'default.png',
                'nama'           => 'Petugas Perpustakaan',
                'jenis_kelamin'  => 'Perempuan',
                'agama'          => 'Islam',
                'jabatan'        => 'Pustakawan',
                'akses_login'    => 'Ya',
                'id_login'       => 2,
                'nomor_telepon'  => '081234567891',
                'alamat'         => 'Jl. Perpustakaan No. 2, Indonesia',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($petugasData as $petugas) {
            $this->db->table('petugas')->insert($petugas);
        }

        echo "Admin user dan petugas berhasil dibuat!\n";
        echo "Admin: admin@perpustakaan.com / admin123\n";
        echo "Petugas: petugas@perpustakaan.com / petugas123\n";
    }
}
