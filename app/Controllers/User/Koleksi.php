<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\KoleksiModel;
use App\Models\AnggotaModel;
use App\Models\BukuModel;

class Koleksi extends BaseController
{
    protected $koleksiModel;
    protected $anggotaModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->koleksiModel = new KoleksiModel();
        $this->anggotaModel = new AnggotaModel();
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return redirect()->to('/login');
        }

        $koleksi = $this->koleksiModel->getKoleksiAnggota($anggota['id_anggota']);

        $data = [
            'title' => 'Koleksi Bukuku',
            'koleksi' => $koleksi
        ];

        return view('buku/koleksiBuku', $data);
    }

    // AJAX Endpoint
    public function tambah($slug)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid Request']);
        }

        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Belum login']);
        }

        $buku = $this->bukuModel->ambilBuku($slug);
        if (!$buku) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Buku tidak ditemukan']);
        }

        $exists = $this->koleksiModel->isKoleksi($buku['id_buku'], $anggota['id_anggota']);
        if ($exists) {
            return $this->response->setJSON(['status' => 'exists', 'message' => 'Buku sudah ada di koleksi']);
        }

        $this->koleksiModel->save([
            'id_anggota' => $anggota['id_anggota'],
            'id_buku' => $buku['id_buku']
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Berhasil ditambahkan ke koleksi']);
    }

    // AJAX Endpoint
    public function hapus($slug)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid Request']);
        }

        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Belum login']);
        }

        $buku = $this->bukuModel->ambilBuku($slug);
        if (!$buku) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Buku tidak ditemukan']);
        }

        $item = $this->koleksiModel->isKoleksi($buku['id_buku'], $anggota['id_anggota']);
        if ($item) {
            $this->koleksiModel->delete($item['id_koleksi']);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Berhasil dihapus dari koleksi']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Buku tidak ada di koleksi']);
    }
}
