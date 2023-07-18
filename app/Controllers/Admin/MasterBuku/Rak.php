<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rak;

    public function __construct()
    {
        $this->rak = new RakModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Buku | Rak",
            "subtitle" => 'Rak',
            "navactive" => 'rak',
            "validation" => validation_errors(),
            "data" => $this->rak->findAll(),
        ];
        return view("admin/buku/dataRak", $this->data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode_rak' => [
                'rules' => 'required|is_unique[rak.kode_rak]',
                'errors' => [
                    'required' => 'Harap isi kolom kode rak',
                    'is_unique' => 'rak dengan kode {value} sudah ada'
                ]
            ],
            'rak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harap isi kolom nama rak',
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harap isi kolom nama rak',
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        if ($this->rak->save([
            'id_rak' => uniqueIDNoUrut('PNG', 'rak', 'id_rak'),
            'kode_rak' => $this->request->getVar('kode_rak'),
            'nama' => $this->request->getVar('rak'),
            'lokasi' => $this->request->getVar('lokasi'),
        ])) {
            return redirect()->to(base_url('/admin/buku/rak'))->with('pesan', 'Data rak berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'rak yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
    }

    public function hapus($id)
    {
        $rak = $this->rak->find($id);
        if (!$rak) {
            return redirect()->back()->with('error', 'rak yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->rak->delete($id)) {
            return redirect()->to(base_url('/admin/buku/rak'))->with('pesan', 'Data rak berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak bisa menghapus data, Harap ulangi proses atau muat ulang website');
    }

    public function edit($id)
    {
        $rak = $this->rak->find($id);
        $rules = 'required';
        if (!$rak) {
            return redirect()->back()->with('error', 'rak yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->request->getVar('kode_rak_edit') != $rak['kode_rak']) {
            $rules .= '|is_unique[rak.kode_rak]';
        }

        if (!$this->validate([
            'kode_rak_edit' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Harap isi kolom kode rak',
                    'is_unique' => 'rak dengan kode {value} sudah ada'
                ]
            ],
            'rak_edit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harap isi kolom nama rak',
                    'is_unique' => 'rak dengan nama {value} sudah ada'
                ]
            ],
            'lokasi_edit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harap isi kolom nama rak',
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        if ($this->rak->save([
            'id_rak' => $id,
            'kode_rak' => $this->request->getVar('kode_rak_edit'),
            'nama' => $this->request->getVar('rak_edit'),
            'lokasi' => $this->request->getVar('lokasi_edit'),
        ])) {
            return redirect()->to(base_url('/admin/buku/rak'))->with('pesan', 'Data rak berhasil diubah');
        }
        return redirect()->back()->with('error', 'Tidak bisa mengubah data, Harap ulangi proses atau muat ulang website');
    }
}
