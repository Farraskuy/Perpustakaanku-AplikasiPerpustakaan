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

        $data = [
            'title' => 'Home',
            // 'buku' => $buku
            'buku' => []
        ];
        return view('/pages/home', $data);
    }
}
