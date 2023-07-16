<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\DetailPinjamModel;
use App\Models\PengembalianModel;
use App\Models\PinjamModel;
use CodeIgniter\I18n\Time;

class Pengembalian extends BaseController
{
    protected $pinjamModel;
    protected $detailPinjamModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->pinjamModel = new PinjamModel();
        $this->detailPinjamModel = new DetailPinjamModel();
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
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
                'rules' => 'required|in_list[baik,rusak]',
                'errors' => [
                    'required' => 'Harap pilih kondisi buku saat ini dengan kondisi yang tersedia',
                    'in_list' => 'Harap pilih kondisi yang tersedia'
                ]
            ]];
        }

        if (!$this->validate(array_merge($rules, $kondisiBukuArray))) {
            return redirect()->back()->withInput();
        }

        $this->pinjamModel
            ->set('status', 'dikembalikan')
            ->set('id_petugas_pengembalian', $this->userID)
            ->set('tanggal_dikembalikan', 'DATE(NOW())', false)
            ->update($id_pinjam);


        foreach ($pinjam['buku'] as $buku) {
            $this->detailPinjamModel
                ->set('kondisi_akhir', $this->request->getVar("kondisi-" . $buku['id_buku']))
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
