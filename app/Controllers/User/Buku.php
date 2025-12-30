<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $buku = $this->bukuModel->ambilBuku();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON('fgfhfhfhkgou');
        }

    }

    public function detail($slug)
    {
        $buku = $this->bukuModel->ambilBuku($slug);
        if (empty($buku)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku "' . $slug . '" tidak ditemukan');
        }

        if (in_groups('admin')) {
            // Redirect admin ke halaman admin detail buku
            return redirect()->to('/admin/buku/' . $slug);
        }

        $this->data += [
            "title" => "Buku | " . $buku['judul'],
            "buku" => array_merge($buku, ['format_tanggal' => $this->formatTanggal($buku['tanggal_terbit'])]),
        ];

        if (logged_in()) {
            if ($this->bukuModel->isTerpinjam($buku['id_buku'], user_id())) {
                $this->data += ['terpinjam' => true];
            }
            $koleksiModel = new \App\Models\KoleksiModel();
            $anggotaModel = new \App\Models\AnggotaModel();
            $anggota = $anggotaModel->where('id_login', user_id())->first();
            if ($anggota && $koleksiModel->isKoleksi($buku['id_buku'], $anggota['id_anggota'])) {
                $this->data += ['in_koleksi' => true];
            } else {
                $this->data += ['in_koleksi' => false];
            }
            // Pass batas_pinjam to view for the borrow modal
            if ($anggota) {
                $this->data += ['batas_pinjam' => isset($anggota['batas_pinjam']) ? $anggota['batas_pinjam'] : 0];
            }
        }
        return view('buku/detailbuku', $this->data);
    }

    // AJAX
    public function listBuku()
    {
        return $this->response->setJSON($this->bukuModel->ambilBuku());
    }
    public function ambilBuku($id)
    {
        return $this->response->setJSON($this->bukuModel->find($id));
    }

    protected function formatTanggal($tanggal)
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $timestamp = strtotime($tanggal);
        $tanggal = date('d', $timestamp);
        $indexbulan = date('n', $timestamp);
        $tahun = date('Y', $timestamp);
        return $tanggal . " " . $bulan[$indexbulan - 1] . " " . $tahun;
    }
}
