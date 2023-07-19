<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $penulis;

    public function __construct()
    {
        $this->penulis = new PenulisModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Buku | Penulis",
            "subtitle" => 'Penulis',
            "navactive" => 'penulis',
            "validation" => validation_errors(),
            "data" => $this->penulis->findAll(),
        ];
        return view("admin/buku/dataPenulis", $this->data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'penulis' => [
                'rules' => 'required|is_unique[penulis.nama]',
                'errors' => [
                    'required' => 'Harap isi kolom nama penulis',
                    'is_unique' => 'Penulis dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        if ($this->penulis->save([
            'id_penulis' => uniqueIDNoUrut('PNS', 'penulis', 'id_penulis'),
            'nama' => $this->request->getVar('penulis')
        ])) {
            return redirect()->to(base_url('/admin/buku/penulis'))->with('pesan', 'Data penulis berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Penulis yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
    }

    public function hapus($id)
    {
        $penulis = $this->penulis->find($id);
        if (!$penulis) {
            return redirect()->back()->with('error', 'Penulis yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->penulis->delete($id)) {
            return redirect()->to(base_url('/admin/buku/penulis'))->with('pesan', 'Data penulis berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak bisa menghapus data, Harap ulangi proses atau muat ulang website');
    }

    public function edit($id)
    {
        $penulis = $this->penulis->find($id);
        $rules = 'required';
        if (!$penulis) {
            return redirect()->back()->with('error', 'penulis yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->request->getVar('penulis_edit') != $penulis['nama']) {
            $rules .= '|is_unique[penulis.nama]';
        }

        if (!$this->validate([
            'penulis_edit' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Harap isi kolom nama penulis',
                    'is_unique' => 'penulis dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        if ($this->penulis->save([
            'id_penulis' => $id,
            'nama' => $this->request->getVar('penulis_edit'),
        ])) {
            return redirect()->to(base_url('/admin/buku/penulis'))->with('pesan', 'Data penulis berhasil diubah');
        }
        return redirect()->back()->with('error', 'Tidak bisa mengubah data, Harap ulangi proses atau muat ulang website');
    }
}
