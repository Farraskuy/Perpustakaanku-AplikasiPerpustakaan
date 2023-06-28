<?php

namespace App\Controllers;

use App\Controllers\Petugas;
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

        $data = [
            "title" => "Home | Administrator",
            "navactive" => "admin",
        ];
        return view('admin/home', $data);
        
    }

    public function dataPetugas()
    {
        $data = [
            "title" => "Home | Administrator",
            "subtitle" => "Petugas",
            "navactive" => "petugas",
            "validation" => validation_errors(),
            "data" => $this->petugas->index(),
        ];
        return view('admin/dataPetugas', $data);
    }

    public function dataAnggota()
    {
        $data = [
            "title" => "Home | Administrator",
            "subtitle" => "Anggota",
            "navactive" => "anggota",
            "validation" => validation_errors(),
            "data" => $this->anggota->index(),
        ];
        return view('admin/dataAnggota', $data);
    }

    public function dataBuku()
    {
        $data = [
            "title" => "Home | Administrator",
            "subtitle" => "Buku",
            "navactive" => "buku",
            "validation" => validation_errors(),
            "data" => $this->buku->index(),
        ];
        return view('admin/dataBuku', $data);
    }
}
