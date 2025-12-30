<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_buku', 'judul', 'slug', 'id_penulis', 'id_penerbit', 'id_kategori', 'id_rak', 'tanggal_terbit', 'jumlah_buku', 'sampul', 'sinopsis'];

    protected $primaryKey = 'id_buku';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    // protected $useSoftDeletes = true;

    // Dates
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getDataBySlug($slug = null)
    {
        $builder = $this->db->table('buku')->select("
            buku.*, penulis.nama as penulis, penerbit.nama as penerbit, kategori.nama as kategori, rak.kode_rak, rak.lokasi,
            (SELECT COUNT(*) FROM detail_pinjam WHERE detail_pinjam.id_buku = buku.id_buku) as jumlah_terpinjam,
            (SELECT COUNT(*) FROM detail_pengembalian WHERE detail_pengembalian.id_buku = buku.id_buku AND kondisi_akhir = 'rusak') as jumlah_rusak,
            (SELECT COUNT(*) FROM detail_pengembalian WHERE detail_pengembalian.id_buku = buku.id_buku AND kondisi_akhir = 'hilang') as jumlah_hilang
        ", false)
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'LEFT')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'LEFT')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'LEFT')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'LEFT');

        if ($slug) {
            return $builder->where('slug', $slug)->get()->getRowArray();
        }
        return $builder->get()->getResultArray();
    }

    public function ambilBukuKecuali($id_pinjam)
    {
        $detailPinjamBuilder = $this->db->table('detail_Pinjam')->select('id_buku')->where('id_pinjam', $id_pinjam);
        return $this->db->table('buku')
            ->select('buku.*, penulis.nama as penulis, penerbit.nama as penerbit')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'LEFT')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'LEFT')
            ->whereNotIn('id_buku', $detailPinjamBuilder)
            ->get()
            ->getResultArray();
    }

    public function ambilBuku($slug = null)
    {
        $bukuBuilder = $this->db->table('buku')
            ->select('buku.*, penulis.nama as penulis, penerbit.nama as penerbit, kategori.nama as kategori, rak.kode_rak, rak.lokasi')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'LEFT')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'LEFT')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'LEFT')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'LEFT');

        if ($slug) {
            return $bukuBuilder->where('slug', $slug)->get()->getRowArray();
        }
        return $bukuBuilder->get()->getResultArray();
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
