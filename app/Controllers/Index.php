<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class Index extends BaseController
{

    public function index()
    {
        if (logged_in()) {
            if (in_groups(['admin', 'petugas'])) {
                return redirect()->to(base_url('admin'));
            }
        }
        return $this->home();
    }

    public function home()
    {
        $bukuModel = new BukuModel();
        $buku = $bukuModel->getDataBySlug();
        $this->data += [
            'title' => 'Home',
            'buku' => $buku,
        ];

        return view('/pages/home', $this->data);
    }
}
