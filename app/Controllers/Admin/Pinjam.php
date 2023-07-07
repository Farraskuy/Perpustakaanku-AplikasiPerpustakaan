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

        $pinjam =$this->pinjamModel->getData();
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Peminjaman",
            "navactive" => "peminjaman",
            "validation" => validation_errors(),
            "data" => $pinjam,
        ];
        return view('admin/peminjaman/dataPeminjaman', $this->data);
    }

    public function detail($id_pinjam)
    {

        $pinjam = $this->pinjamModel->dataPinjam(user_id(), $id_pinjam);
        $this->data += [
            "title" => "Pinjam",
            "pinjam" => $pinjam['pinjam'],
            "buku" => $pinjam['buku'],
        ];
        return view('/buku/detailPinjamBuku', $this->data);
    }

    public function simpan($slug)
    {
        $buku = $this->bukuModel->ambilBuku($slug);

        // cek kuota peminjaman
        if ($this->anggotaModel->find(user_id())['batas_pinjam'] == 0) {
            return redirect()->to('/buku/' . $slug)->with('error_pinjam', 'Tidak bisa meminjam kuota pinjam kamu 0');
        }
        // cek ketersediaan buku
        if ($buku['stok'] == 0) {
            return redirect()->back()->with('error_pinjam', 'Maaf buku ini sedang tidak tersedia');
        }

        $id_buku = $buku['id'];

        if ($this->bukuModel->isTerpinjam($id_buku, user_id())) {
        }
        $this->pinjamModel->save([
            'id' => $this->uniqueID(),
            'id_anggota' => user_id(),
            'status' => 'menunggu',
            'jumlah_pinjam' => 1,
            'batas_ambil' => Time::now()->addDays(2)->toDateTimeString()
        ]);

        $this->detailPinjamModel->save([
            'id_pinjam' => $this->pinjamModel->getInsertID(),
            'id_buku' => $id_buku,
            'status' => 'menunggu'
        ]);


        $this->anggotaModel->set('batas_pinjam', 'batas_pinjam - 1', false)->update(user_id());
        $this->bukuModel->set('stok', 'stok - 1', false)->update($id_buku);

        return redirect()->to('/buku/' . $slug)->with('sukses_pinjam', 'Berhasil Meminjam Buku');
    }

    public function hapus($id)
    {
        $pinjam = $this->pinjamModel->find($id);

        // cek anggota
        if ($pinjam['id_anggota'] != user_id()) {
            return redirect()->back();
        }

        $detailPinjam = $this->detailPinjamModel->where('id_pinjam', $id)->findAll();

        // mengembalikan semua stok buku dan kuota pinjam
        foreach ($detailPinjam as $item) {
            $this->anggotaModel->set('batas_pinjam', 'batas_pinjam + 1', false)->update(user_id());
            $this->bukuModel->set('stok', 'stok + 1', false)->update($item['id_buku']);
        }


        if ($this->detailPinjamModel->delete($id) &&  $this->pinjamModel->delete($id)) {
            return redirect()->to('/pinjam/')->with('sukses_pinjam', 'Berhasil Meminjam Buku');
        }

        return redirect()->back()->with('error_pinjam', 'Errror tidak bisa membatalkan pinjaman. Harap hubungi pihak perpustakaan');
    }

    protected function uniqueID()
    {
        $random = random_int(1000, 9999);
        $tanggal = Time::now()->format('Ymd');
        return "PIN$tanggal$random";
    }
}
