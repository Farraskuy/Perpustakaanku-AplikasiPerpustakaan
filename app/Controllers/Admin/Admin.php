<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\Admin\Anggota;
use App\Controllers\Admin\Buku;
use App\Controllers\Admin\Petugas;
use App\Models\BukuModel;

class Admin extends BaseController
{
    protected $bukuModel;
    protected $petugas;
    protected $anggota;
    protected $buku;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->petugas = new Petugas();
        $this->anggota = new Anggota();
        $this->buku = new Buku();
    }
    public function index()
    {

        $this->data += [
            "title" => "Home | Administrator",
            "navactive" => "admin",
        ];
        return view('admin/home', $this->data);
        
    }    
}
