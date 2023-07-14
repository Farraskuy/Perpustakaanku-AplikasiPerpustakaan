<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class Home extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $buku = $bukuModel->ambilBuku();
        $this->data += [
            'title' => 'Home',
            'buku' => $buku,
        ];

        return view('/pages/home', $this->data);
    }
}
