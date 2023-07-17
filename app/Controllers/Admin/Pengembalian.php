<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppConfigModel;
use App\Models\BukuModel;
use App\Models\DetailPengembalianModel;
use App\Models\DetailPinjamModel;
use App\Models\PengembalianModel;
use App\Models\PinjamModel;

class Pengembalian extends BaseController
{
    protected $pinjamModel;
    protected $detailPinjamModel;
    protected $bukuModel;
    protected $config;
    protected $pengembalianModel;
    protected $detailPengembalianModel;

    public function __construct()
    {
        $this->config = new AppConfigModel();
        $this->bukuModel = new BukuModel();
        $this->pinjamModel = new PinjamModel();
        $this->detailPinjamModel = new DetailPinjamModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->detailPengembalianModel = new DetailPengembalianModel();
    }

    public function index()
    {
        // cek konfigurasi aplikasi
        if (!$this->config->first()) {
            return redirect()->to(base_url('/'))->with('error', 'Harap minta Admin untuk melegkapi informasi perpustakaan untuk menggunakan fitur ini!');
        }

        $this->data += [
            "title" => "Pengembalian | Admin",
            "subtitle" => "Pengembalian",
            "navactive" => "pengembalian",
            "validation" => validation_errors(),
            "data" => $this->pinjamModel->getDataKembali(),
            "datapinjam" => $this->pinjamModel->getDataPinjam(),
        ];
        return view('admin/pengembalian/dataPengembalian', $this->data);
    }

    public function detail($id_pinjam)
    {
        // cek konfigurasi aplikasi
        if (!$this->config->first()) {
            return redirect()->to(base_url('/'))->with('error', 'Harap minta Admin untuk melegkapi informasi perpustakaan untuk menggunakan fitur ini!');
        }

        $this->data += [
            "title" => "Pinjam",
            "subtitle" => "Detail Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "data" => $this->pinjamModel->getDataKembali($id_pinjam)
        ];
        return view('/admin/pengembalian/detailPengembalian', $this->data);
    }
    public function detailEdit($id)
    {
        return redirect()->to(base_url("/admin/pengembalian/$id"))->with('error_edit', ' ');
    }

    public function kembali($id_pinjam)
    {
        // cek konfigurasi aplikasi
        if (!$this->config->first()) {
            return redirect()->to(base_url('/'))->with('error', 'Harap minta Admin untuk melegkapi informasi perpustakaan untuk menggunakan fitur ini!');
        }

        $this->data += [
            "title" => "Pengembalian | Admin",
            "subtitle" => "Pengembalian",
            "navactive" => "pengembalian",
            "validation" => validation_errors(),
            "data" => $this->pinjamModel->getDataPinjam($id_pinjam),
        ];
        return view('admin/pengembalian/tambahPengembalian', $this->data);
    }

    public function aksiKembali($id_pinjam)
    {
        $pinjam = $this->pinjamModel->getDataPinjam($id_pinjam);
        $config = $this->config->first();

        $rules = [
            'bayar' => [
                'rules' => 'required|is_natural',
                'errors' => [
                    'required' => 'Kolom Bayar Perlu diisi',
                    'number' => 'Harap masukan kolom bayar dengan angka',
                ]
            ]
        ];
        $kondisiBukuArray = [];

        foreach ($pinjam['buku'] as $buku) {
            $kondisiBukuArray += ["kondisi-" . $buku['id_buku'] => [
                'rules' => 'required|in_list[baik,rusak,hilang]',
                'errors' => [
                    'required' => 'Harap pilih kondisi buku saat ini dengan kondisi yang tersedia',
                    'in_list' => 'Harap pilih kondisi yang tersedia'
                ]
            ]];
        }

        if (!$this->validate(array_merge($rules, $kondisiBukuArray))) {
            return redirect()->back()->withInput();
        }

        $dendaTelat = $dendaKondisi = 0;
        foreach ($pinjam['buku'] as $buku) {
            $dendaTelat += $pinjam['pinjam']['keterlambatan'] * $config['denda_telat'];
            $kondisiBuku = $this->request->getVar('kondisi-' . $buku['id_buku']);
            if ($kondisiBuku == 'rusak') {
                $dendaKondisi += $config['denda_rusak'];
            } elseif ($kondisiBuku == 'hilang') {
                $dendaKondisi += $config['denda_hilang'];
            }
        }

        $totalDenda = $dendaKondisi + $dendaTelat;
        $bayar = (int)$this->request->getVar('bayar');
        if ($bayar < $totalDenda) {
            return redirect()->back()->withInput()->with('error', 'Harap masukan nominal pembayaran yang setara atau lebih');
        }
        $kembali = $totalDenda - $bayar;

        $this->pinjamModel
            ->set('status', 'dikembalikan')
            ->set('id_petugas_pengembalian', $this->userID)
            ->set('tanggal_dikembalikan', 'DATE(NOW())', false)
            ->update($id_pinjam);

        foreach ($pinjam['buku'] as $buku) {

            $this->detailPinjamModel
                ->set('kondisi_akhir', $kondisiBuku)
                ->set('status', 'dikembalikan')
                ->where('id_pinjam', $id_pinjam)
                ->where('id_buku', $buku['id_buku'])
                ->update();
            $this->bukuModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($buku['id_buku']);
        }

        return redirect()->to(base_url("/admin/pengembalian"))->with('pesan', 'Pinjaman berhasil dikembalikan');
    }

    public function edit($id)
    {
        return redirect()->to('/admin/pinjam/' . $id)->with('pesan', 'Data peminjaman berhasil diubah');
    }

    public function hapus($id)
    {
        return redirect()->back()->with('error_pinjam', 'Errror tidak bisa membatalkan pinjaman. Harap hubungi pihak perpustakaan');
    }
}
