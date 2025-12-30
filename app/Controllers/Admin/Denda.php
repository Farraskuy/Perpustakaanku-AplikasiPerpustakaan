<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppConfigModel;
use App\Models\DetailPengembalianModel;
use App\Models\PengembalianModel;

class Denda extends BaseController
{
    protected $pengembalianModel;
    protected $detailPengembalianModel;
    protected $appConfigModel;

    public function __construct()
    {
        $this->pengembalianModel = new PengembalianModel();
        $this->detailPengembalianModel = new DetailPengembalianModel();
        $this->appConfigModel = new AppConfigModel();
        $this->data += ["inNavTransaksi" => true];
    }

    public function index()
    {
        // Get all pengembalian with denda > 0
        $pengembalianWithDenda = $this->pengembalianModel->getDataKembaliWithDenda();

        // Calculate statistics
        $dendaStats = $this->getDendaStatistics();

        $this->data += [
            "title" => "Denda | Admin",
            "subtitle" => "Laporan Denda",
            "navactive" => "denda",
            "data" => $pengembalianWithDenda,
            "stats" => $dendaStats,
            "config" => $this->appConfigModel->first(),
        ];

        return view('admin/denda/dataDenda', $this->data);
    }

    /**
     * Get denda statistics from detail_pengembalian
     */
    private function getDendaStatistics()
    {
        $db = \Config\Database::connect();

        // Total denda telat
        $dendaTelat = $db->table('detail_pengembalian')
            ->selectSum('denda_telat')
            ->get()
            ->getRowArray();

        // Total denda kondisi (rusak + hilang)
        $dendaKondisi = $db->table('detail_pengembalian')
            ->selectSum('denda_kondisi')
            ->get()
            ->getRowArray();

        // Total all denda
        $totalDenda = $db->table('pengembalian')
            ->selectSum('total_denda')
            ->get()
            ->getRowArray();

        // Count books by condition
        $bukuRusak = $db->table('detail_pengembalian')
            ->where('kondisi_akhir', 'rusak')
            ->countAllResults();

        $bukuHilang = $db->table('detail_pengembalian')
            ->where('kondisi_akhir', 'hilang')
            ->countAllResults();

        // Count late returns
        $pengembalianTelat = $db->table('pengembalian')
            ->where('keterangan', 'terlambat')
            ->countAllResults();

        return [
            'denda_telat' => (int) ($dendaTelat['denda_telat'] ?? 0),
            'denda_kondisi' => (int) ($dendaKondisi['denda_kondisi'] ?? 0),
            'total_denda' => (int) ($totalDenda['total_denda'] ?? 0),
            'buku_rusak' => $bukuRusak,
            'buku_hilang' => $bukuHilang,
            'pengembalian_telat' => $pengembalianTelat,
        ];
    }
}
