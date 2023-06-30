<?php

namespace App\Controllers;

use App\Controllers\Petugas;
use App\Models\BukuModel;

class Pinjam extends BaseController
{
    public function index(){

        return view('/buku/pinjam');
    }
}
