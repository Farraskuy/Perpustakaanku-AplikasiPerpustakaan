<?php

namespace App\Models;

use CodeIgniter\Model;

class KoleksiModel extends Model
{
    protected $table = 'koleksi';
    protected $primaryKey = 'id_koleksi';
    protected $allowedFields = ['id_anggota', 'id_buku', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    // Helper to check if book is bookmarked by member
    public function isKoleksi($id_buku, $id_anggota)
    {
        return $this->where('id_buku', $id_buku)
            ->where('id_anggota', $id_anggota)
            ->first();
    }

    // Get list of books bookmarked by member
    public function getKoleksiAnggota($id_anggota)
    {
        return $this->select('koleksi.*, buku.judul, buku.slug, buku.sampul, penulis.nama as penulis, penerbit.nama as penerbit')
            ->join('buku', 'buku.id_buku = koleksi.id_buku')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'LEFT')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'LEFT')
            ->where('id_anggota', $id_anggota)
            ->findAll();
    }
}
