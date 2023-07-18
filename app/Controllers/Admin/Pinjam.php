<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\AppConfigModel;
use App\Models\BukuModel;
use App\Models\DetailPinjamModel;
use App\Models\PinjamModel;

class Pinjam extends BaseController
{
    protected $pinjamModel;
    protected $detailPinjamModel;
    protected $bukuModel;
    protected $anggotaModel;
    protected $config;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
        $this->pinjamModel = new PinjamModel();
        $this->detailPinjamModel = new DetailPinjamModel();
        $this->config = new AppConfigModel();
        $this->data += ["inNavTransaksi" => true];
    }
    public function index()
    {
        // cek konfigurasi aplikasi
        if (!$this->config->first()) {
            return redirect()->to(base_url('/'))->with('error', 'Harap minta Admin untuk melegkapi informasi perpustakaan untuk menggunakan fitur ini!');
        }

        $this->data += [
            "title" => "Peminjaman",
            "subtitle" => "Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "dataanggota" => $this->anggotaModel->ambilData(),
            "data" => $this->pinjamModel->getDataPinjam(),
        ];
        return view('admin/peminjaman/dataPeminjaman', $this->data);
    }

    public function detail($id_pinjam)
    {
        // cek konfigurasi aplikasi
        if (!$this->config->first()) {
            return redirect()->to(base_url('/'))->with('error', 'Harap minta Admin untuk melegkapi informasi perpustakaan untuk menggunakan fitur ini!');
        }
        $this->data += [
            "title" => "Peminjaman",
            "subtitle" => "Detail Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "dataanggota" => $this->anggotaModel->findAll(),
            "databuku" => $this->bukuModel->ambilBukuKecuali($id_pinjam),
            "data" => $this->pinjamModel->getDataPinjam($id_pinjam)
        ];
        return view('/admin/peminjaman/detailPeminjaman', $this->data);
    }
    public function detailTambah($id_pinjam)
    {
        return redirect()->to(base_url("/admin/pinjam/$id_pinjam"))->with('error_pinjam_buku', ' ');
    }
    public function detailEdit($id)
    {
        return redirect()->to(base_url("/admin/pinjam/$id"))->with('error_edit', ' ');
    }


    public function simpan()
    {
        if (!$this->validate([
            'peminjam' => [
                'rules' => 'required|is_not_unique[anggota.id_anggota]',
                'errors' => [
                    'required' => 'Kolom peminjam tidak boleh kosong',
                    'is_not_unique' => 'Harap pilih anggota yang ada',
                ]
            ],
            'tanggal_pengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal pengembalian tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        $this->pinjamModel->save([
            'id_pinjam' => uniqueID('PIN', 'pinjam', 'id_pinjam'),
            'id_anggota' => $this->request->getVar('peminjam'),
            'id_petugas' => $this->userID,
            'status' => 'terpinjam',
            'tanggal_kembali' => $this->request->getVar('tanggal_pengembalian')
        ]);

        $insertID = $this->pinjamModel->getInsertID();

        return redirect()->to('/admin/pinjam/' . $insertID)->with('pesan', 'Data peminjaman berhasil ditambahkan')->with('error_pinjam_buku', ' ');
    }

    public function edit($id)
    {
        // cek buku
        if (!$this->pinjamModel->find($id)) {
            return redirect()->to(base_url('/admin/pinjam'))->with('error', 'Peminjaman dengan ID "' . $id . '", Tidak ditemukan');
        }
        if (!$this->validate([
            'peminjam' => [
                'rules' => 'required|is_not_unique[anggota.id_anggota]',
                'errors' => [
                    'required' => 'Kolom peminjam tidak boleh kosong',
                    'is_not_unique' => 'Harap pilih anggota yang ada',
                ]
            ],
            'tanggal_pengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal pengembalian tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        $this->pinjamModel->save([
            'id_pinjam' => $id,
            'id_anggota' => $this->request->getVar('peminjam'),
            'id_petugas' => $this->userID,
            'status' => 'terpinjam',
            'tanggal_kembali' => $this->request->getVar('tanggal_pengembalian')
        ]);

        return redirect()->to('/admin/pinjam/' . $id)->with('pesan', 'Data peminjaman berhasil diubah');
    }

    public function hapus($id)
    {
        if ($this->detailPinjamModel->delete($id) &&  $this->pinjamModel->delete($id)) {
            return redirect()->to('/admin/pinjam/')->with('pesan', 'Berhasil menghapus data');
        }

        return redirect()->back()->with('error', 'Errror tidak bisa membatalkan pinjaman. Harap hubungi pihak perpustakaan');
    }

    public function tambahDetail($id)
    {
        $kondisiArray = [];
        foreach ($this->request->getVar('buku') as $id_buku) {
            $kondisiArray += ["kondisi-$id_buku" => [
                'rules' => 'required|in_list[baik,rusak]',
                'errors' => [
                    'required' => 'Harap pilih kondisi buku saat ini dengan kondisi yang tersedia',
                    'in_list' => 'Harap pilih kondisi yang tersedia'
                ]
            ]];
        }

        if (!$this->validate(array_merge($kondisiArray, [
            'buku.*' => [
                'rules' => 'is_not_unique[buku.id_buku]',
                'errors' => [
                    'is_not_unique' => 'Harap pilih buku yang tersedia'
                ]
            ]
        ]))) {
            return redirect()->back()->withInput()->with('error_pinjam_buku', 'Harap pilih buku yang tersedia');
        }

        foreach ($this->request->getVar('buku') as $id_buku) {
            $this->detailPinjamModel->insert([
                'id_pinjam' => $id,
                'id_buku' => $id_buku,
                'kondisi' => $this->request->getVar("kondisi-$id_buku"),
            ]);
            $this->pinjamModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($id);
        }

        return redirect()->back()->with('pesan', 'Data buku pinjaman berhasil ditambahkan');
    }

    public function hapusDetail($id_pinjam, $id_buku)
    {
        if (!$this->detailPinjamModel->where('id_pinjam', $id_pinjam)->where('id_buku', $id_buku)->first()) {
            return redirect()->back()->with('error', "Data buku dengan ID \"$id_pinjam\" atau peminjaman dengan ID \"$id_pinjam\" tidak ditemukan");
        }

        $this->detailPinjamModel->where('id_buku', $id_buku)->where('id_pinjam', $id_pinjam)->delete();
        $this->pinjamModel->set('jumlah_buku', 'jumlah_buku - 1', false)->update($id_pinjam);

        return redirect()->back()->with('pesan', 'Data buku pinjaman berhasil dihapus');
    }
}
