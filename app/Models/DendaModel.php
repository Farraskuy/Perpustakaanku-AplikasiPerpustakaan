<?php

namespace App\Models;

use CodeIgniter\Model;

class DendaModel extends Model
{
    protected $table      = 'denda';
    protected $primaryKey = 'id_denda';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_denda', 'id_anggota', 'id_petugas', 'total_denda', 'bayar', 'kembali'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
