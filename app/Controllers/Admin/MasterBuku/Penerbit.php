<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbit;

    public function __construct()
    {
        $this->penerbit = new PenerbitModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Buku | Penerbit",
            "subtitle" => 'Penerbit',
            "navactive" => 'penerbit',
            "validation" => validation_errors(),
            "data" => $this->penerbit->findAll(),
        ];
        return view("admin/buku/dataPenerbit", $this->data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'penerbit' => [
                'rules' => 'required|is_unique[penerbit.nama]',
                'errors' => [
                    'required' => 'Harap isi kolom nama penerbit',
                    'is_unique' => 'penerbit dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        if ($this->penerbit->save([
            'id_penerbit' => uniqueIDNoUrut('PNB', 'penerbit', 'id_penerbit'),
            'nama' => $this->request->getVar('penerbit')
        ])) {
            return redirect()->to(base_url('/admin/buku/penerbit'))->with('pesan', 'Data penerbit berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'penerbit yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
    }

    public function hapus($id)
    {
        $penerbit = $this->penerbit->find($id);
        if (!$penerbit) {
            return redirect()->back()->with('error', 'penerbit yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->penerbit->delete($id)) {
            return redirect()->to(base_url('/admin/buku/penerbit'))->with('pesan', 'Data penerbit berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak bisa menghapus data, Harap ulangi proses atau muat ulang website');
    }

    public function edit($id)
    {
        $penerbit = $this->penerbit->find($id);
        $rules = 'required';
        if (!$penerbit) {
            return redirect()->back()->with('error', 'penerbit yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }
        if ($this->request->getVar('penerbit_edit') != $penerbit['nama']) {
            $rules .= '|is_unique[penerbit.nama]';
        }

        if (!$this->validate([
            'penerbit_edit' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Harap isi kolom nama penerbit',
                    'is_unique' => 'penerbit dengan nama {value} sudah ada'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        if ($this->penerbit->save([
            'id_penerbit' => $id,
            'nama' => $this->request->getVar('penerbit_edit'),
        ])) {
            return redirect()->to(base_url('/admin/buku/penerbit'))->with('pesan', 'Data penerbit berhasil diubah');
        }
        return redirect()->back()->with('error', 'Tidak bisa mengubah data, Harap ulangi proses atau muat ulang website');
    }
}
