<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\DetailPinjamModel;
use App\Models\PinjamModel;
use CodeIgniter\I18n\Time;

class Pinjam extends BaseController
{
    protected $pinjamModel;
    protected $detailPinjamModel;
    protected $bukuModel;
    protected $anggotaModel;
    protected $pengembalianModel;
    protected $detailPengembalianModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
        $this->pinjamModel = new PinjamModel();
        $this->detailPinjamModel = new DetailPinjamModel();
        $this->pengembalianModel = new \App\Models\PengembalianModel();
        $this->detailPengembalianModel = new \App\Models\DetailPengembalianModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        // Ambil ID Anggota dari user_id
        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        $id_anggota = $anggota ? $anggota['id_anggota'] : null;

        // Data Pinjam Aktif
        $pinjam = $this->pinjamModel->getDataPinjam(null, $id_anggota);
        $ketpinjam = $this->pinjamModel->keteranganPinjam($id_anggota);

        // Data History Pengembalian
        $history = [];
        if ($id_anggota) {
            $history = $this->pengembalianModel->getHistoryAnggota($id_anggota);
        }

        $this->data += [
            "title" => "Pinjam",
            "ketpinjam" => $ketpinjam,
            "data_buku" => $pinjam['buku'],
            "data_pinjam" => $pinjam['pinjam'],
            "history_pengembalian" => isset($history['pengembalian']) ? $history['pengembalian'] : [],
            "history_buku" => isset($history['buku']) ? $history['buku'] : []
        ];
        return view('/buku/pinjamBuku', $this->data);
    }

    public function detail($id)
    {
        // Cek prefix ID untuk menentukan sumber data
        if (strpos($id, 'KMB') === 0) {
            // Data dari Pengembalian
            $kembali = $this->pengembalianModel->getDataKembali($id);
            // Struktur return getDataKembali:
            // return ['pengembalian' => $data, 'buku' => $dataBuku, 'anggota' => $anggota];

            // Wait, getDataKembali logic di PengembalianModel (Admin) mungkin berbeda return structurenya.
            // Cek file PengembalianModel.php lines 62-92.
            // Jika ID diberikan, return array single row?
            // "if ($id_pinjam) ... return ['pengembalian' => ..., 'buku' => ..., 'anggota' => ...]"

            $this->data += [
                "title" => "Detail Pengembalian",
                "pinjam" => $kembali['pengembalian'], // Reuse var name 'pinjam' for view compatibility or adjust view
                "buku" => $kembali['buku'],
                "is_history" => true // Flag for view
            ];
        } else {
            // Data dari Pinjam
            $pinjam = $this->pinjamModel->getDataPinjam($id);
            $this->data += [
                "title" => "Detail Peminjaman",
                "pinjam" => $pinjam['pinjam'],
                "buku" => $pinjam['buku'],
                "is_history" => false
            ];
        }

        return view('/buku/detailPinjamBuku', $this->data);
    }

    public function simpan($slug)
    {
        $buku = $this->bukuModel->ambilBuku($slug);

        // cek kuota peminjaman
        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return redirect()->back()->with('error_pinjam', 'Data anggota tidak ditemukan');
        }

        $batas_pinjam = isset($anggota['batas_pinjam']) ? $anggota['batas_pinjam'] : 0;

        if ($batas_pinjam == 0) {
            return redirect()->to('/buku/' . $slug)->with('error_pinjam', 'Tidak bisa meminjam kuota pinjam kamu 0');
        }
        // cek ketersediaan buku
        // Note: jumlah_buku di model, tapi stok di controller? Cek field database
        // Asumsi jumlah_buku adalah stok available.
        if ($buku['jumlah_buku'] == 0) {
            return redirect()->back()->with('error_pinjam', 'Maaf buku ini sedang tidak tersedia');
        }

        $id_buku = $buku['id_buku'];
        $id_anggota = $anggota['id_anggota']; // Gunakan ID Anggota, bukan user_id (ID Login)

        if ($this->bukuModel->isTerpinjam($id_buku, $id_anggota)) {
            return redirect()->back()->with('error_pinjam', 'Anda sedang meminjam buku ini');
        }

        // Ambil petugas default (misal petugas pertama)
        $petugas = $this->db->table('petugas')->limit(1)->get()->getRowArray();
        $id_petugas = $petugas ? $petugas['id_petugas'] : 'PTG-DEFAULT'; // Fallback if empty logic needed

        $id_pinjam = $this->uniqueID();

        $this->pinjamModel->save([
            'id_pinjam' => $id_pinjam,
            'id_anggota' => $id_anggota,
            'id_petugas' => $id_petugas,
            'status' => 'menunggu',
            'jumlah_buku' => 1,
            'batas_ambil' => Time::now()->addDays(2)->toDateTimeString()
        ]);

        $this->detailPinjamModel->save([
            'id_pinjam' => $id_pinjam,
            'id_buku' => $id_buku,
            'status' => 'menunggu'
        ]);


        $this->anggotaModel->set('batas_pinjam', 'batas_pinjam - 1', false)->where('id_anggota', $id_anggota)->update();
        $this->bukuModel->set('jumlah_buku', 'jumlah_buku - 1', false)->update($id_buku); // field jumlah_buku not stok

        return redirect()->to('/buku/' . $slug)->with('sukses_pinjam', 'Berhasil Meminjam Buku');
    }

    public function hapus($id)
    {
        $pinjam = $this->pinjamModel->find($id);
        if (!$pinjam) {
            return redirect()->back()->with('error_pinjam', 'Data peminjaman tidak ditemukan');
        }

        $anggota = $this->anggotaModel->where('id_login', user_id())->first();
        if (!$anggota) {
            return redirect()->back(); // Should not happen if logged in
        }

        // cek anggota
        if ($pinjam['id_anggota'] != $anggota['id_anggota']) {
            return redirect()->back();
        }

        $detailPinjam = $this->detailPinjamModel->where('id_pinjam', $id)->findAll();

        // mengembalikan semua stok buku dan kuota pinjam
        foreach ($detailPinjam as $item) {
            $this->anggotaModel->set('batas_pinjam', 'batas_pinjam + 1', false)->where('id_anggota', $anggota['id_anggota'])->update();
            $this->bukuModel->set('jumlah_buku', 'jumlah_buku + 1', false)->update($item['id_buku']);
        }


        if ($this->detailPinjamModel->delete($id) && $this->pinjamModel->delete($id)) {
            return redirect()->to('/pinjam/')->with('sukses_pinjam', 'Berhasil Membatalkan Peminjaman');
        }

        return redirect()->back()->with('error_pinjam', 'Errror tidak bisa membatalkan pinjaman. Harap hubungi pihak perpustakaan');
    }

    protected function uniqueID()
    {
        $random = random_int(1000, 9999);
        $tanggal = Time::now()->format('Ymd');
        return "PIN$tanggal$random";
    }
}
