<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }
    public function index()
    {

        return $this->home();

    }
    public function home()
    {

        $buku = $this->bukuModel->ambilBuku();
        $data = [
            'scrollSpy' => true,
            'title' => 'Home',
            'buku' => $buku,
        ];
        return view('/pages/home', $data);
    }
}
