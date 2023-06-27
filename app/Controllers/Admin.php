<?php

namespace App\Controllers;

use App\Controllers\Petugas;
use App\Models\BukuModel;

class Admin extends BaseController
{
    protected $bukuModel;
    protected $petugas;
    protected $anggota;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->petugas = new Petugas();
        $this->anggota = new Anggota();
    }
    public function index()
    {

        $data = [
            "title" => "Home | Administrator",
            "scrollSpy" => false
        ];
        return view('admin/home', $data);
        
    }

    public function dataPetugas()
    {
        $data = [
            "title" => "Home | Administrator",
            "subtitle" => "Petugas",
            "navactive" => "petugas",
            "scrollSpy" => false,
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
            "scrollSpy" => false,
            "validation" => validation_errors(),
            "data" => $this->anggota->index(),
        ];
        return view('admin/dataAnggota', $data);
    }
}
