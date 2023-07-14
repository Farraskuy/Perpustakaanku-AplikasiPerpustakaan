<?php

namespace App\Controllers;

use App\Controllers\User\Home;
use App\Models\PetugasModel;

class Index extends BaseController
{
    public function index()
    {
        $home = new Home();

        if (in_groups(['admin', 'petugas'])) {
            return redirect()->to(base_url('/admin'));
        }


        return $home->index();
    }
}
