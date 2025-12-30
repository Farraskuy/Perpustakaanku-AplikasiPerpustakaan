<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $buku = [
            [
                'id_buku' => 'BK-' . date('Ymd') . '-001',
                'judul' => 'Laskar Pelangi',
                'slug' => 'laskar-pelangi',
                'id_penulis' => 'PNL-001',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Novel tentang perjuangan pendidikan anak-anak di Belitung yang menginspirasi jutaan pembaca.',
                'tanggal_terbit' => '2005-09-01',
                'sampul' => 'default.png',
                'jumlah_buku' => 10,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-002',
                'judul' => 'Bumi Manusia',
                'slug' => 'bumi-manusia',
                'id_penulis' => 'PNL-002',
                'id_penerbit' => 'PNB-010',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Kisah cinta dan perjuangan Minke di era kolonial Belanda.',
                'tanggal_terbit' => '1980-08-25',
                'sampul' => 'default.png',
                'jumlah_buku' => 8,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-003',
                'judul' => 'Pulang',
                'slug' => 'pulang',
                'id_penulis' => 'PNL-003',
                'id_penerbit' => 'PNB-01',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Novel tentang perjalanan hidup seseorang yang mencari makna pulang.',
                'tanggal_terbit' => '2015-06-15',
                'sampul' => 'default.png',
                'jumlah_buku' => 12,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-004',
                'judul' => 'Ayat-Ayat Cinta',
                'slug' => 'ayat-ayat-cinta',
                'id_penulis' => 'PNL-004',
                'id_penerbit' => 'PNB-03',
                'id_kategori' => 'KAT-007',
                'id_rak' => 'RAK-003',
                'sinopsis' => 'Kisah cinta yang dibalut nilai-nilai spiritual di Mesir.',
                'tanggal_terbit' => '2004-12-01',
                'sampul' => 'default.png',
                'jumlah_buku' => 15,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-005',
                'judul' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
                'slug' => 'supernova-ksatria-puteri-bintang-jatuh',
                'id_penulis' => 'PNL-005',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-004',
                'sinopsis' => 'Novel fiksi ilmiah tentang cinta, sains, dan spiritualitas.',
                'tanggal_terbit' => '2001-02-14',
                'sampul' => 'default.png',
                'jumlah_buku' => 7,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-006',
                'judul' => 'Negeri 5 Menara',
                'slug' => 'negeri-5-menara',
                'id_penulis' => 'PNL-006',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-006',
                'id_rak' => 'RAK-005',
                'sinopsis' => 'Kisah inspiratif tentang persahabatan dan pendidikan di pondok pesantren.',
                'tanggal_terbit' => '2009-07-08',
                'sampul' => 'default.png',
                'jumlah_buku' => 9,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-007',
                'judul' => 'Cantik Itu Luka',
                'slug' => 'cantik-itu-luka',
                'id_penulis' => 'PNL-007',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-006',
                'sinopsis' => 'Novel realisme magis tentang kutukan dan cinta di pesisir Jawa.',
                'tanggal_terbit' => '2002-05-20',
                'sampul' => 'default.png',
                'jumlah_buku' => 6,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-008',
                'judul' => 'Laut Bercerita',
                'slug' => 'laut-bercerita',
                'id_penulis' => 'PNL-008',
                'id_penerbit' => 'PNB-002',
                'id_kategori' => 'KAT-004',
                'id_rak' => 'RAK-007',
                'sinopsis' => 'Novel tentang tragedi 1965-1966 dan para aktivis yang hilang.',
                'tanggal_terbit' => '2017-10-01',
                'sampul' => 'default.png',
                'jumlah_buku' => 5,
            ],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($buku as $book) {
            $book['created_at'] = $now;
            $book['updated_at'] = $now;
            $this->db->table('buku')->insert($book);
        }

        echo "Buku seeder berhasil!\n";
    }
}
