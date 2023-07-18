<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_buku', 'judul', 'slug', 'penulis', 'penerbit', 'tanggal_terbit', 'jumlah_buku', 'sampul', 'sinopsis'];

    protected $primaryKey = 'id_buku';

    protected $useAutoIncrement = false;

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

    public function ambilBuku($slug = null)
    {
        $builder = $this->db->table('buku')->select("
            buku.*,
            (SELECT COUNT(*) FROM detail_pinjam WHERE detail_pinjam.id_buku = buku.id_buku) as jumlah_terpinjam,
            (SELECT COUNT(*) FROM detail_pengembalian WHERE detail_pengembalian.id_buku = buku.id_buku AND kondisi_akhir = 'rusak') as jumlah_rusak,
            (SELECT COUNT(*) FROM detail_pengembalian WHERE detail_pengembalian.id_buku = buku.id_buku AND kondisi_akhir = 'hilang') as jumlah_hilang
        ", false);


        if ($slug) {
            return $builder->where('slug', $slug)->get()->getRowArray();
        }
        return $builder->get()->getResultArray();
    }

    public function ambilBukuKecuali($id_pinjam)
    {
        $detailPinjamBuilder = $this->db->table('detail_Pinjam')->select('id_buku')->where('id_pinjam', $id_pinjam);
        return $this->db->table('buku')->whereNotIn('id_buku', $detailPinjamBuilder)->get()->getResultArray();
    }

    public function isTerpinjam($idBuku, $userId)
    {
        $terpinjamBuilder = $this->db->table('pinjam')
            ->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id_pinjam', 'inner')
            ->where('pinjam.id_anggota', $userId)
            ->where('detail_pinjam.id_buku', $idBuku)->get()->getNumRows();

        return $terpinjamBuilder == 0 ? false : true;
    }
}
