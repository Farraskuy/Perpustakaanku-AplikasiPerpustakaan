<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\Admin\Anggota;
use App\Controllers\Admin\MasterBuku\Buku;
use App\Controllers\Admin\Petugas;
use App\Models\AppConfigModel;
use App\Models\BukuModel;

class Admin extends BaseController
{
    protected $bukuModel;
    protected $petugas;
    protected $anggota;
    protected $buku;
    protected $appConfigModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->petugas = new Petugas();
        $this->anggota = new Anggota();
        $this->buku = new Buku();
        $this->appConfigModel = new AppConfigModel();
    }
    public function index()
    {
        $this->data += [
            "title" => "Home | Dashboard",
            "navactive" => "admin",
        ];
        return view('admin/home', $this->data);
    }

    public function appConfig()
    {
        $this->data += [
            "title" => "Admin | informasi",
            "navactive" => "informasi",
            "validation" => validation_errors(),
        ];
        return view('/admin/config', $this->data);
    }

    public function appConfigDefault()
    {
        if (isset($this->appConfigModel->first()['id'])) {
            $configID = $this->appConfigModel->first()['id'];
            $this->appConfigModel->delete($configID);
        }
        return redirect()->back()->with('pesan', 'Data berhasil dirubah menjadi default');
    }

    public function appConfigSave()
    {

        if (!$this->validate([
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom nomor telepon perpustakaan tidak boleh kosong',
                    'numeric' => 'Harap isi dengan nomor telepon yang valid',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom email perpustakaan tidak boleh kosong',
                    'valid_email' => 'Harap masukan email yang valid'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom alamat perpustakaan tidak boleh kosong'
                ]
            ],
            'denda_rusak' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom denda rusak tidak boleh kosong',
                    'numeric' => 'Harap isi kolom denda rusak menggunakan angka',
                ]
            ],
            'denda_hilang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom denda hilang tidak boleh kosong',
                    'numeric' => 'Harap isi kolom denda rusak menggunakan angka',
                ]
            ],
            'denda_telat' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom denda telat tidak boleh kosong',
                    'numeric' => 'Harap isi kolom denda rusak menggunakan angka',
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [];
        if (isset($this->appConfigModel->first()['id'])) {
            $data = array_merge($data, ['id' => $this->appConfigModel->first()['id']]);
        }

        $this->appConfigModel->save(array_merge($data, [
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'denda_rusak' => $this->request->getVar('denda_rusak'),
            'denda_telat' => $this->request->getVar('denda_telat'),
            'denda_hilang' => $this->request->getVar('denda_hilang'),
        ]));

        return redirect()->back()->with('pesan', 'Data Berhasil Diperbarui');
    }
}
