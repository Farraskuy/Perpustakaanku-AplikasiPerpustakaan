<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

/**
 * Buku Seeder dengan data buku Indonesia yang aktual
 * Sampul menggunakan URL dari Open Library Covers API
 */
class BukuSeeder extends Seeder
{
    public function run()
    {
        // Data buku Indonesia yang populer dengan sampul dari Open Library
        $buku = [
            // === KATEGORI FIKSI (KAT-001) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-001',
                'judul' => 'Laskar Pelangi',
                'slug' => 'laskar-pelangi',
                'id_penulis' => 'PNL-001',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Novel tentang perjuangan 10 anak dari keluarga miskin di Belitung yang berjuang mendapatkan pendidikan. Kisah ini menginspirasi jutaan pembaca dengan semangat pantang menyerah dan persahabatan yang tulus.',
                'tanggal_terbit' => '2005-09-01',
                'sampul' => 'laskar-pelangi.png',
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
                'sinopsis' => 'Bagian pertama dari Tetralogi Buru yang mengisahkan Minke, seorang pribumi yang berpendidikan Eropa, dan cintanya kepada Annelies Mellema di era kolonial Belanda.',
                'tanggal_terbit' => '1980-08-25',
                'sampul' => 'bumi-manusia.png',
                'jumlah_buku' => 8,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-003',
                'judul' => 'Pulang',
                'slug' => 'pulang-tere-liye',
                'id_penulis' => 'PNL-003',
                'id_penerbit' => 'PNB-005',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Novel tentang Bujang, seorang pemuda yang harus meninggalkan kampung halamannya dan menjalani kehidupan penuh liku sebagai bagian dari keluarga penguasa dunia hitam di Jakarta.',
                'tanggal_terbit' => '2015-06-15',
                'sampul' => 'pulang.png',
                'jumlah_buku' => 12,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-004',
                'judul' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
                'slug' => 'supernova-ksatria-puteri-bintang-jatuh',
                'id_penulis' => 'PNL-005',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Novel fiksi ilmiah yang memadukan sains, spiritualitas, dan cinta. Mengisahkan Dimas dan Ruben yang menciptakan cerita dalam cerita tentang Ksatria, Puteri, dan Bintang Jatuh.',
                'tanggal_terbit' => '2001-02-14',
                'sampul' => 'supernova.png',
                'jumlah_buku' => 7,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-005',
                'judul' => 'Cantik Itu Luka',
                'slug' => 'cantik-itu-luka',
                'id_penulis' => 'PNL-007',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Novel realisme magis tentang Dewi Ayu, seorang perempuan indo yang dikutuk dengan kecantikan. Berlatar di kota pesisir selatan Jawa dari era kolonial hingga pasca kemerdekaan.',
                'tanggal_terbit' => '2002-05-20',
                'sampul' => 'cantik-itu-luka.png',
                'jumlah_buku' => 6,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-006',
                'judul' => 'Perahu Kertas',
                'slug' => 'perahu-kertas',
                'id_penulis' => 'PNL-005',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Kisah Kugy dan Keenan yang dipertemukan takdir di Bandung. Kugy dengan impiannya menjadi penulis dongeng dan Keenan dengan bakat melukisnya.',
                'tanggal_terbit' => '2009-06-28',
                'sampul' => 'perahu-kertas.png',
                'jumlah_buku' => 9,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-007',
                'judul' => 'Dilan: Dia Adalah Dilanku Tahun 1990',
                'slug' => 'dilan-1990',
                'id_penulis' => 'PNL-009',
                'id_penerbit' => 'PNB-003',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Novel romantis berlatar tahun 1990 di Bandung. Mengisahkan kisah cinta Milea dengan Dilan, anak motor yang unik dan penuh kejutan.',
                'tanggal_terbit' => '2014-06-01',
                'sampul' => 'dilan.png',
                'jumlah_buku' => 15,
            ],

            // === KATEGORI AGAMA (KAT-007) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-008',
                'judul' => 'Ayat-Ayat Cinta',
                'slug' => 'ayat-ayat-cinta',
                'id_penulis' => 'PNL-004',
                'id_penerbit' => 'PNB-005',
                'id_kategori' => 'KAT-007',
                'id_rak' => 'RAK-003',
                'sinopsis' => 'Kisah Fahri, mahasiswa Indonesia di Universitas Al-Azhar Mesir, yang menghadapi dilema cinta dan spiritual. Novel best-seller yang diangkat ke layar lebar.',
                'tanggal_terbit' => '2004-12-01',
                'sampul' => 'ayat-ayat-cinta.png',
                'jumlah_buku' => 15,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-009',
                'judul' => 'Ketika Cinta Bertasbih',
                'slug' => 'ketika-cinta-bertasbih',
                'id_penulis' => 'PNL-004',
                'id_penerbit' => 'PNB-005',
                'id_kategori' => 'KAT-007',
                'id_rak' => 'RAK-003',
                'sinopsis' => 'Kisah Khairul Azzam, mahasiswa Indonesia di Mesir yang berjuang antara cinta, tanggungjawab keluarga, dan menuntut ilmu agama.',
                'tanggal_terbit' => '2007-03-01',
                'sampul' => 'ketika-cinta-bertasbih.png',
                'jumlah_buku' => 10,
            ],

            // === KATEGORI PENDIDIKAN (KAT-006) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-010',
                'judul' => 'Negeri 5 Menara',
                'slug' => 'negeri-5-menara',
                'id_penulis' => 'PNL-006',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-006',
                'id_rak' => 'RAK-005',
                'sinopsis' => 'Kisah inspiratif 6 sahabat di Pondok Madani yang bermimpi menggapai bintang. Man jadda wajada - siapa yang bersungguh-sungguh pasti berhasil.',
                'tanggal_terbit' => '2009-07-08',
                'sampul' => 'negeri-5-menara.png',
                'jumlah_buku' => 11,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-011',
                'judul' => 'Ranah 3 Warna',
                'slug' => 'ranah-3-warna',
                'id_penulis' => 'PNL-006',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-006',
                'id_rak' => 'RAK-005',
                'sinopsis' => 'Sekuel Negeri 5 Menara yang mengisahkan perjalanan Alif melanjutkan pendidikan ke universitas dan menghadapi tantangan baru.',
                'tanggal_terbit' => '2011-06-01',
                'sampul' => 'ranah-3-warna.png',
                'jumlah_buku' => 8,
            ],

            // === KATEGORI SEJARAH (KAT-004) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-012',
                'judul' => 'Laut Bercerita',
                'slug' => 'laut-bercerita',
                'id_penulis' => 'PNL-008',
                'id_penerbit' => 'PNB-002',
                'id_kategori' => 'KAT-004',
                'id_rak' => 'RAK-007',
                'sinopsis' => 'Novel tentang aktivis yang diculik dan "dihilangkan" pada era Orde Baru. Biru Laut dan kawan-kawannya berjuang melawan ketidakadilan.',
                'tanggal_terbit' => '2017-10-01',
                'sampul' => 'laut-bercerita.png',
                'jumlah_buku' => 5,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-013',
                'judul' => 'Anak Semua Bangsa',
                'slug' => 'anak-semua-bangsa',
                'id_penulis' => 'PNL-002',
                'id_penerbit' => 'PNB-010',
                'id_kategori' => 'KAT-004',
                'id_rak' => 'RAK-007',
                'sinopsis' => 'Bagian kedua Tetralogi Buru. Minke mulai menyadari identitasnya sebagai pribumi dan mulai melawan ketidakadilan kolonialisme.',
                'tanggal_terbit' => '1981-01-01',
                'sampul' => 'anak-semua-bangsa.png',
                'jumlah_buku' => 6,
            ],

            // === KATEGORI SAINS & TEKNOLOGI (KAT-003) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-014',
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'slug' => 'sapiens',
                'id_penulis' => 'PNL-010',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-003',
                'id_rak' => 'RAK-005',
                'sinopsis' => 'Buku fenomenal karya Yuval Noah Harari yang menelusuri perjalanan manusia dari zaman prasejarah hingga era modern. Edisi terjemahan Indonesia.',
                'tanggal_terbit' => '2017-05-01',
                'sampul' => 'sapiens.png',
                'jumlah_buku' => 7,
            ],

            // === KATEGORI BIOGRAFI (KAT-005) ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-015',
                'judul' => 'Soekarno: Penyambung Lidah Rakyat Indonesia',
                'slug' => 'soekarno-penyambung-lidah-rakyat',
                'id_penulis' => 'PNL-010',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-005',
                'id_rak' => 'RAK-007',
                'sinopsis' => 'Autobiografi Bung Karno yang ditulis oleh Cindy Adams. Mengisahkan perjalanan hidup Proklamator Indonesia dari kecil hingga menjadi presiden.',
                'tanggal_terbit' => '1965-01-01',
                'sampul' => 'soekarno.png',
                'jumlah_buku' => 4,
            ],

            // === TAMBAHAN BUKU FIKSI ===
            [
                'id_buku' => 'BK-' . date('Ymd') . '-016',
                'judul' => 'Sang Pemimpi',
                'slug' => 'sang-pemimpi',
                'id_penulis' => 'PNL-001',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Sekuel Laskar Pelangi yang mengisahkan perjuangan Ikal dan sahabatnya melanjutkan pendidikan ke SMA dan bermimpi ke Paris.',
                'tanggal_terbit' => '2006-07-01',
                'sampul' => 'sang-pemimpi.png',
                'jumlah_buku' => 8,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-017',
                'judul' => 'Edensor',
                'slug' => 'edensor',
                'id_penulis' => 'PNL-001',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Bagian ketiga Tetralogi Laskar Pelangi. Ikal berhasil kuliah di Eropa dan berkelana mencari cintanya.',
                'tanggal_terbit' => '2007-05-01',
                'sampul' => 'edensor.png',
                'jumlah_buku' => 6,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-018',
                'judul' => 'Maryamah Karpov',
                'slug' => 'maryamah-karpov',
                'id_penulis' => 'PNL-001',
                'id_penerbit' => 'PNB-004',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Penutup Tetralogi Laskar Pelangi. Ikal kembali ke Belitung dan bertemu dengan cinta sejatinya.',
                'tanggal_terbit' => '2008-06-01',
                'sampul' => 'maryamah-karpov.jpg',
                'jumlah_buku' => 5,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-019',
                'judul' => 'Bumi',
                'slug' => 'bumi-tere-liye',
                'id_penulis' => 'PNL-003',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-001',
                'sinopsis' => 'Novel fantasi tentang Raib, gadis SMP yang menemukan bahwa ia memiliki kekuatan supernatural dan petualangannya di dunia paralel.',
                'tanggal_terbit' => '2014-10-01',
                'sampul' => 'bumi.jpg',
                'jumlah_buku' => 12,
            ],
            [
                'id_buku' => 'BK-' . date('Ymd') . '-020',
                'judul' => 'Bulan',
                'slug' => 'bulan-tere-liye',
                'id_penulis' => 'PNL-003',
                'id_penerbit' => 'PNB-001',
                'id_kategori' => 'KAT-001',
                'id_rak' => 'RAK-002',
                'sinopsis' => 'Sekuel novel Bumi. Raib, Seli, dan Ali melanjutkan petualangan mereka menghadapi ancaman baru dari Klan Bulan.',
                'tanggal_terbit' => '2015-03-01',
                'sampul' => 'bulan.jpg',
                'jumlah_buku' => 10,
            ],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($buku as $book) {
            $book['created_at'] = $now;
            $book['updated_at'] = $now;
            $this->db->table('buku')->insert($book);
        }

        echo "Buku seeder berhasil! " . count($buku) . " buku ditambahkan.\n";
    }
}
