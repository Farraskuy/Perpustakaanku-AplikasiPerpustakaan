<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\PengarangModel;

class Pengarang extends BaseController
{
    protected $pengarang;

    public function __construct()
    {
        $this->pengarang = new PengarangModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Buku | Pengarang",
            "subtitle" => 'Pengarang',
            "navactive" => 'pengarang',
            "validation" => validation_errors(),
            "data" => $this->pengarang->findAll(),
        ];
        return view("admin/buku/dataPengarang", $this->data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'pengarang' => [
                'rules' => 'required|is_unique[pengarang.nama]',
                'errors' => [
                    'required' => 'Harap isi kolom nama pengarang',
                    'is_unique' => 'Pengarang dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        if ($this->pengarang->save([
            'id_pengarang' => uniqueIDNoUrut('PNG', 'pengarang', 'id_pengarang'),
            'nama' => $this->request->getVar('pengarang')
        ])) {
            return redirect()->to(base_url('/admin/buku/pengarang'))->with('pesan', 'Data pengarang berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Pengarang yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
    }

    public function hapus($id)
    {
        $pengarang = $this->pengarang->find($id);
        if (!$pengarang) {
            return redirect()->back()->with('error', 'Pengarang yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->pengarang->delete($id)) {
            return redirect()->to(base_url('/admin/buku/pengarang'))->with('pesan', 'Data pengarang berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak bisa menghapus data, Harap ulangi proses atau muat ulang website');
    }

    public function edit($id)
    {
        $pengarang = $this->pengarang->find($id);
        $rules = 'required';
        if (!$pengarang) {
            return redirect()->back()->with('error', 'pengarang yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->request->getVar('pengarang_edit') != $pengarang['nama']) {
            $rules .= '|is_unique[pengarang.nama]';
        }

        if (!$this->validate([
            'pengarang_edit' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Harap isi kolom nama pengarang',
                    'is_unique' => 'pengarang dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        if ($this->pengarang->save([
            'id_pengarang' => $id,
            'nama' => $this->request->getVar('pengarang_edit'),
        ])) {
            return redirect()->to(base_url('/admin/buku/pengarang'))->with('pesan', 'Data pengarang berhasil diubah');
        }
        return redirect()->back()->with('error', 'Tidak bisa mengubah data, Harap ulangi proses atau muat ulang website');
    }
}
