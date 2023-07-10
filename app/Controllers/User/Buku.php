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
            $this->data += [
                "title" => "Buku | " .  $buku['judul'],
                "data" => array_merge($buku, ['format_tanggal' => $this->formatTanggal($buku['tanggal_terbit'])]),
                "navactive" => "buku",
                "validation" => validation_errors()
            ];

            return view('admin/detailBuku', $this->data);
        }

        $this->data += [
            "title" => "Buku | " .  $buku['judul'],
            "buku" => array_merge($buku, ['format_tanggal' => $this->formatTanggal($buku['tanggal_terbit'])]),
        ];

        if (logged_in()) {
            if ($this->bukuModel->isTerpinjam($buku['id'], user_id())) {
                $this->data += ['terpinjam' => true];
            }
        }
        return view('buku/detailBuku', $this->data);
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
