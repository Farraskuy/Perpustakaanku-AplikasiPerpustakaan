<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'tanggal_terbit', 'stok', 'sampul', 'sinopsis'];

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    // Dates
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

    public function ambilBuku($slug = '')
    {
        if ($slug) {
            return $this->where('slug', $slug)->first();
        }
        return $this->findAll();
    }

    public function isTerpinjam($idBuku, $userId)
    {
        $terpinjamBuilder = $this->db->table('pinjam')
            ->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id', 'inner')
            ->where('pinjam.id_anggota', $userId)
            ->where('detail_pinjam.id_buku', $idBuku)->get()->getNumRows();

        return $terpinjamBuilder == 0 ? false : true;
    }
}
