<?php

namespace App\Controllers;

use App\Controllers\Petugas;
use App\Models\BukuModel;

class Admin extends BaseController
{
    protected $bukuModel;
    protected $petugas;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->petugas = new Petugas();
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
            "subtitle" => "Data | Petugas",
            "navactive" => "petugas",
            "scrollSpy" => false,
            "data" => $this->petugas->index(),
        ];
        return view('admin/dataPetugas', $data);
    }
}
