<?php

namespace App\Models;

use Myth\Auth\Models\UserModel;

class UsersModel extends UserModel
{
    protected $returnType     = 'array';
    protected $skipValidation     = true;
}
