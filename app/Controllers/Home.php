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

        if (in_groups('admin')) {
            return redirect()->to(base_url('/admin'));
        }
        return $this->home();
    }
    public function home()
    {

        $buku = $this->bukuModel->ambilBuku();
        $this->data += [
            'title' => 'Home',
            'buku' => $buku,
        ];
        
        return view('/pages/home', $this->data);
    }
}
