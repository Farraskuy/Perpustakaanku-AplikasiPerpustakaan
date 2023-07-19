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
        $this->data += ["inNavTransaksi" => true];
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
            "data" => $this->pengembalianModel->getDataKembali(),
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
            "title" => "Pengembalian",
            "subtitle" => "Detail Peminjaman",
            "navactive" => "pengembalian",
            "validation" => validation_errors(),
            "data" => $this->pengembalianModel->getDataKembali($id_pinjam)
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

        $this->pengembalianModel->save([
            'id_pengembalian' => uniqueID('KMB', 'pengembalian', 'id_pengembalian'),
            'id_petugas' => $this->userID,
            'id_anggota' => $pinjam['pinjam']['id_anggota'],
            'keterangan' => $dendaTelat ? 'tepatwaktu' : 'terlambat',
            'jumlah_buku' => $pinjam['pinjam']['jumlah_buku'],
            'total_denda' => $totalDenda,
            'tanggal_kembali' => $pinjam['pinjam']['tanggal_kembali'],
            'tanggal_pinjam' => $pinjam['pinjam']['created_at'],
        ]);

        $insertID =  $this->pengembalianModel->getInsertID();
        foreach ($pinjam['buku'] as $buku) {
            $dendaKondisi = 0;
            $kondisiBuku = $this->request->getVar('kondisi-' . $buku['id_buku']);
            if ($kondisiBuku == 'rusak') {
                $dendaKondisi = $config['denda_rusak'];
            } elseif ($kondisiBuku == 'hilang') {
                $dendaKondisi = $config['denda_hilang'];
            }
            $this->detailPengembalianModel->insert([
                'id_pengembalian' => $insertID,
                'id_buku' => $buku['id_buku'],
                'kondisi' => $buku['kondisi'],
                'kondisi_akhir' => $kondisiBuku,
                'denda_telat' => $dendaTelat ? $config['denda_telat'] : '0',
                'denda_kondisi' => $dendaKondisi,
                'total_denda' => $totalDenda
            ]);
        }

        $this->detailPinjamModel->delete($id_pinjam);
        $this->pinjamModel->delete($id_pinjam);

        return redirect()->to(base_url("/admin/pengembalian"))->with('pesan', 'Pinjaman berhasil dikembalikan');
    }

    public function hapus($id)
    {
        $this->detailPengembalianModel->where('id_pengembalian', $id)->delete();
        $this->pengembalianModel->delete($id);

        return redirect()->to(base_url('/admin/pengembalian/'))->with('pesan', 'Data peminjaman berhasil dihapus');
    }
}
