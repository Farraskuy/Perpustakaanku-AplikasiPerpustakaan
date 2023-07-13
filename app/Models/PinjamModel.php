<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $table      = 'pinjam';
    protected $primaryKey = 'id_pinjam';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_pinjam',  'id_anggota', 'id_petugas', 'status', 'jumlah_buku', 'tanggal_kembali'];

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

    public function keteranganPinjam($id_anggota)
    {
        $bataspinjam = $this->db->table('anggota')->select('batas_pinjam as batas_pinjam')->where('id', $id_anggota)->get()->getRowArray();
        $jumlahmenunggu = $this->select('count(*) as jumlah_menunggu')->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id_pinjam', 'inner')->where('detail_pinjam.status', 'menunggu')->where('pinjam.id_anggota', $id_anggota)->first();
        $jumlahpinjam = $this->select('count(*) as jumlah_pinjam')->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id_pinjam', 'inner')->where('detail_pinjam.status', 'terpinjam')->where('pinjam.id_anggota', $id_anggota)->first();
        $jumlahkembali = $this->select('count(*) as jumlah_kembali')->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id_pinjam', 'inner')->where("detail_pinjam.status = 'terpinjam' AND DATE(NOW()) > pinjam.batas_kembali")->where('pinjam.id_anggota', $id_anggota)->first();

        return array_merge($bataspinjam, $jumlahmenunggu, $jumlahpinjam, $jumlahkembali);
    }

    public function getData($id_pinjam = null, $id_anggota = null)
    {
        $pinjamBuilder = $this->db->table('pinjam')->select(
            "pinjam.id_pinjam, anggota.nama as nama_anggota, petugas.nama as nama_petugas, pinjam.*,
            CASE
                WHEN DATE(NOW()) > pinjam.tanggal_kembali THEN 'danger'
                ELSE 'warning'
                END AS status_type,
            CASE
                WHEN DATE(NOW()) > pinjam.tanggal_kembali THEN 'Telat Dikumpulkan'    
                ELSE 'Belum dikembalikan'
            END AS status_message,
            DATEDIFF(DATE(NOW()), pinjam.tanggal_kembali) AS denda_perhari
        "
        )
            ->join('petugas', 'petugas.id_petugas = pinjam.id_petugas', 'inner')
            ->join('anggota', 'anggota.id_anggota = pinjam.id_anggota', 'inner');

        if ($id_anggota) {
            $dataPinjam = $pinjamBuilder->where('id_anggota', $id_anggota)->get()->getResultArray();
            $dataBuku = [];
            foreach ($dataPinjam as $data) {
                $dataBuku[$data['id_pinjam']] = $this->db->table('detail_pinjam')->join('buku', 'buku.id_buku = detail_pinjam.id_buku', 'inner')->where('id_pinjam', $data['id_pinjam'])->get()->getResultArray();
            }
            return ['buku' => $dataBuku, 'pinjam' => $dataPinjam];
        }
        if ($id_pinjam) {
            $dataPinjam = $pinjamBuilder->where('id_pinjam', $id_pinjam)->get()->getRowArray();
            $dataBuku = $this->db->table('detail_pinjam')->join('buku', 'buku.id_buku = detail_pinjam.id_buku', 'inner')->where('id_pinjam', $dataPinjam['id_pinjam'])->get()->getResultArray();
            return ['buku' => $dataBuku, 'pinjam' => $dataPinjam];
        }

        return $pinjamBuilder->get()->getResultArray();
    }
}
