<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PengembalianModel;
use App\Models\PinjamModel;

class Profile extends BaseController
{
    protected $anggotaModel;
    protected $pinjamModel;
    protected $pengembalianModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->pinjamModel = new PinjamModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return redirect()->to('/')->with('error', 'Data anggota tidak ditemukan');
        }

        $id_anggota = $anggota['id_anggota'];

        // Statistik
        $total_pinjam_aktif = $this->pinjamModel->where('id_anggota', $id_anggota)->where('status', 'menunggu')->orWhere('status', 'terpinjam')->countAllResults(); // Simplifikasi count
        // Hitung total denda dari history
        $history = $this->pengembalianModel->getHistoryAnggota($id_anggota);
        $total_denda = 0;
        $total_kembali = 0;
        if (!empty($history['pengembalian'])) {
            foreach ($history['pengembalian'] as $item) {
                $total_denda += $item['total_denda'];
                $total_kembali++;
            }
        }

        $data = [
            'title' => 'Profil Anggota',
            'anggota' => $anggota,
            'stats' => [
                'pinjam_aktif' => $total_pinjam_aktif,
                'total_kembali' => $total_kembali,
                'total_denda' => $total_denda
            ],
            'history' => $history
        ];

        return view('user/profile', $data);
    }
}
