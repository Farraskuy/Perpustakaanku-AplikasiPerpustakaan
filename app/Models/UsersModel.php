<?php

namespace App\Models;

use Myth\Auth\Models\UserModel;

class UsersModel extends UserModel
{
    protected $returnType     = 'array';
    protected $skipValidation = true;
    protected $useSoftDeletes = false;

    public function getUser($id)
    {
        $query = $this->db->query("SELECT union_table.userID, users.id
        FROM (
            SELECT anggota.id_anggota AS userID, anggota.id_login
            FROM anggota
            UNION
            SELECT petugas.id_petugas AS userID, petugas.id_login
            FROM petugas
        ) AS union_table
        RIGHT JOIN users ON union_table.id_login = users.id WHERE users.id = $id");
        return $query->getRowArray();
    }
}
