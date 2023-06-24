<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    public function detail($slug)
    {
        $buku = $this->bukuModel->ambilBuku($slug);
        if (empty($buku)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku "' . $slug . '" tidak ditemukan');
        }
        $data = [
            "title" => "Buku | " .  $buku['judul'],
            "buku" => $buku,
            "scrollSpy" => false,
        ];

        return view('buku/detailBuku', $data);
    }
    
}
