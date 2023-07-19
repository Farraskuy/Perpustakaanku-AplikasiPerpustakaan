<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Buku | Kategori",
            "subtitle" => 'Kategori',
            "navactive" => 'kategori',
            "validation" => validation_errors(),
            "data" => $this->kategori->findAll(),
        ];
        return view("admin/buku/dataKategori", $this->data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kategori' => [
                'rules' => 'required|is_unique[kategori.nama]',
                'errors' => [
                    'required' => 'Harap isi kolom nama kategori',
                    'is_unique' => 'Kategori dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', 'true');
        }

        $this->kategori->save([
            'id_kategori' => uniqueIDNoUrut('KTG', 'kategori', 'id_kategori'),
            'nama' => $this->request->getVar('kategori')
        ]);

        return redirect()->to(base_url('/admin/buku/kategori'))->with('pesan', 'Data kategori berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $kategori = $this->kategori->find($id);
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->kategori->delete($id)) {
            return redirect()->to(base_url('/admin/buku/kategori'))->with('pesan', 'Data kategori berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak bisa menghapus data, Harap ulangi proses atau muat ulang website');
    }

    public function edit($id)
    {
        $kategori = $this->kategori->find($id);
        $rules = 'required';
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->request->getVar('kategori_edit') != $kategori['nama']) {
            $rules .= '|is_unique[kategori.nama]';
        }

        if (!$this->validate([
            'kategori_edit' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Harap isi kolom nama kategori',
                    'is_unique' => 'Kategori dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        if ($this->kategori->save([
            'id_kategori' => $id,
            'nama' => $this->request->getVar('kategori_edit'),
        ])) {
            return redirect()->to(base_url('/admin/buku/kategori'))->with('pesan', 'Data kategori berhasil diubah');
        }
        return redirect()->back()->with('error', 'Tidak bisa mengubah data, Harap ulangi proses atau muat ulang website');
    }
}
