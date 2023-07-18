<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table      = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_pengembalian',  'id_anggota', 'id_petugas', 'keterangan', 'jumlah_buku', 'total_denda', 'tanggal_kembali', 'tanggal_pinjam'];

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

    public function getDataKembali($id_pengembalian = null, $id_anggota = null)
    {
        $pinjamBuilder = $this->db->table('pengembalian')->select(
            "pengembalian.id_pengembalian, 
            anggota.nama as nama_anggota, 
            petugas.nama as nama_petugas, 
            pengembalian.*,"
        )
            ->join('petugas', 'petugas.id_petugas = pengembalian.id_petugas', 'inner')
            ->join('anggota', 'anggota.id_anggota = pengembalian.id_anggota', 'inner');

        if ($id_anggota) {
            $dataPinjam = $pinjamBuilder->where('id_anggota', $id_anggota)->get()->getResultArray();
            $dataBuku = [];
            foreach ($dataPinjam as $data) {
                $dataBuku[$data['id_pengembalian']] = $this->db->table('detail_pengembalian')->join('buku', 'buku.id_buku = detail_pengembalian.id_buku', 'inner')->where('id_pengembalian', $data['id_pengembalian'])->get()->getResultArray();
            }
            return ['buku' => $dataBuku, 'pengembalian' => $dataPinjam];
        }
        if ($id_pengembalian) {
            $dataPengembalian = $pinjamBuilder->where('id_pengembalian', $id_pengembalian)->get()->getRowArray();
            $dataBuku = $this->db->table('detail_pengembalian')->join('buku', 'buku.id_buku = detail_pengembalian.id_buku', 'inner')->where('id_pengembalian', $dataPengembalian['id_pengembalian'])->get()->getResultArray();
            return ['buku' => $dataBuku, 'pengembalian' => $dataPengembalian];
        }

        return $pinjamBuilder->get()->getResultArray();
    }
}
