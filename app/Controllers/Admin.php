<?php

namespace App\Controllers;

use App\Models\BukuModel;
class Admin extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }
    public function index()
    {

        $data = [
            "title" => "Home | Administrator",
            "scrollSpy" => false
        ];
        return view('admin/home', $data);

    }
}
