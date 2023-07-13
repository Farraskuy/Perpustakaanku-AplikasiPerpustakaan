<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\DetailPinjamModel;
use App\Models\PinjamModel;
use CodeIgniter\I18n\Time;

class Pinjam extends BaseController
{
    protected $pinjamModel;
    protected $detailPinjamModel;
    protected $bukuModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
        $this->pinjamModel = new PinjamModel();
        $this->detailPinjamModel = new DetailPinjamModel();
    }
    public function index()
    {
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "dataanggota" => $this->anggotaModel->ambilData(),
            "data" => $this->pinjamModel->getData(),
        ];
        return view('admin/peminjaman/dataPeminjaman', $this->data);
    }

    public function detail($id_pinjam)
    {
        $this->data += [
            "title" => "Pinjam",
            "subtitle" => "Detail Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "dataanggota" => $this->anggotaModel->findAll(),
            "databuku" => $this->bukuModel->ambilBukuKecuali($id_pinjam),
            "data" => $this->pinjamModel->getData($id_pinjam)
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

        session()->setFlashdata('pesan', 'Data peminjaman berhasil ditambahkan');

        return redirect()->to('/admin/pinjam/' . $insertID);
    }

    public function edit($id)
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
            'id_pinjam' => $id,
            'id_anggota' => $this->request->getVar('peminjam'),
            'id_petugas' => $this->userID,
            'status' => 'terpinjam',
            'tanggal_kembali' => $this->request->getVar('tanggal_pengembalian')
        ]);

        session()->setFlashdata('pesan', 'Data peminjaman berhasil diubah');

        return redirect()->to('/admin/pinjam/' . $id);
    }

    public function hapus($id)
    {
        $detailPinjam = $this->detailPinjamModel->where('id_pinjam', $id)->findAll();
        // mengembalikan semua stok buku dan kuota pinjam
        foreach ($detailPinjam as $item) {
            $this->bukuModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($item['id_buku']);
        }

        if ($this->detailPinjamModel->delete($id) &&  $this->pinjamModel->delete($id)) {
            return redirect()->to('/admin/pinjam/')->with('sukses_pinjam', 'Berhasil Meminjam Buku');
        }

        return redirect()->back()->with('error_pinjam', 'Errror tidak bisa membatalkan pinjaman. Harap hubungi pihak perpustakaan');
    }

    public function tambahDetail($id)
    {
        if (!$this->validate([
            'buku.*' => [
                'rules' => 'is_not_unique[buku.id_buku]',
                'errors' => [
                    'is_not_unique' => 'Harap pilih buku yang tersedia'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_pinjam_buku', 'Harap pilih buku yang tersedia');
        }

        foreach ($this->request->getVar('buku') as $id_buku) {
            $this->detailPinjamModel->insert([
                'id_pinjam' => $id,
                'id_buku' => $id_buku,
                'status' => 'terpinjam',
            ]);
            $this->pinjamModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($id);
            $this->bukuModel->set('jumlah_buku', 'jumlah_buku - 1', false)->update($id_buku);
        }

        session()->setFlashdata('pesan', 'Data buku pinjaman berhasil ditambahkan');

        return redirect()->back();
    }

    public function hapusDetail($id_pinjam, $id_buku)
    {
        if (!$this->detailPinjamModel->where('id_pinjam', $id_pinjam)->where('id_buku', $id_buku)->first()) {
            return redirect()->back()->with('error', "Data buku dengan ID \"$id_pinjam\" atau peminjaman dengan ID \"$id_pinjam\" tidak ditemukan");
        }

        $this->detailPinjamModel->where('id_buku', $id_buku)->where('id_pinjam', $id_pinjam)->delete();
        $this->pinjamModel->set('jumlah_buku', 'jumlah_buku - 1', false)->update($id_pinjam);
        $this->bukuModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($id_buku);

        session()->setFlashdata('pesan', 'Data buku pinjaman berhasil dihapus');

        return redirect()->back();
    }

    public function perpanjangWaktu($id_pinjam)
    {
        if (!$this->validate([
            'waktu' => [
                'rules' => 'is_natural|greater_than[0]|less_than_equal_to[8]',
                'errors' => [
                    'is_natural' => 'Harap isi dengan angka',
                    'less_than_equal_to' => 'Tidak boleh memperpanjang lebih dari 8 Hari',
                    'greater_than' => 'Tidak boleh memperpanjang kurang dari 1 Hari',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_perpanjang', 'true');
        }

        $waktu = $this->request->getVar('waktu');
        $this->pinjamModel->set('tanggal_kembali', "tanggal_kembali + INTERVAL " . $waktu . " DAY", false)->update($id_pinjam);

        session()->setFlashdata('pesan', 'Waktu peminjaman berhasil diperpanjang');

        return redirect()->back();
    }
}
