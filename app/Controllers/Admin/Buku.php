<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Buku",
            "navactive" => "buku",
            "validation" => validation_errors(),
            "data" => $this->bukuModel->ambilBuku(),
        ];
        return view('admin/buku/dataBuku', $this->data);
    }

    public function detail($slug)
    {
        $buku = $this->bukuModel->ambilBuku($slug);
        if (empty($buku)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku "' . $slug . '" tidak ditemukan');
        }

        $this->data += [
            "title" => "Buku | " .  $buku['judul'],
            "data" => array_merge($buku, ['format_tanggal' => $this->formatTanggal($buku['tanggal_terbit'])]),
            "navactive" => "buku",
            "validation" => validation_errors()
        ];

        return view('admin/buku/detailBuku', $this->data);
    }

    public function simpan()
    {

        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required' => 'Kolom judul tidak boleh kosong',
                    'is_unique' => 'Judul {value} sudah digunakan'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom penulis tidak boleh kosong'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom penerbit tidak boleh kosong'
                ]
            ],
            'tanggal_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal terbit tidak boleh kosong'
                ]
            ],
            'sampul' => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/png,image/jpg,image/jpeg]|max_size[sampul,1024]',
                'errors' => [
                    'mime_in' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'is_image' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'max_size' => 'Ukuran gambar terlalu besar, Maksimal 5MB',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom sinopsis tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/buku'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namasampul = 'default.png';
        } else {
            $namasampul = $fileSampul->getRandomName();
            $fileSampul->move('upload/buku/', $namasampul);
        }

        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' =>  url_title($this->request->getVar('judul'), '-', true),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tanggal_terbit' => $this->request->getVar('tanggal_terbit'),
            'sampul' => $namasampul,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ]);

        session()->setFlashdata('pesan', "Data berhasil ditambahkan");

        return redirect()->to("/admin/buku");
    }

    public function hapus($id)
    {
        $buku = $this->bukuModel->where('id', $id)->first();
        if ($buku['sampul'] != "default.png") {
            unlink('upload/buku/' . $buku['sampul']);
        }

        $this->bukuModel->delete($id);

        session()->setFlashdata('pesan', "Data berhasil dihapus");

        return redirect()->to('/admin/buku');
    }

    public function edit()
    {

        $buku = $this->bukuModel->ambilBuku($this->request->getVar('slug'));
        $id = $buku['id'];
        $ruleJudul = 'required';
        if ($buku['judul'] != $this->request->getVar('judul')) {
            $ruleJudul .= '|is_unique[buku.judul]';
        }


        if (!$this->validate([
            'judul' => [
                'rules' => $ruleJudul,
                'errors' => [
                    'required' => 'Kolom judul tidak boleh kosong',
                    'is_unique' => 'Judul {value} sudah digunakan'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom penulis tidak boleh kosong'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom penerbit tidak boleh kosong'
                ]
            ],
            'tanggal_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal terbit tidak boleh kosong'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,5120]|is_image[sampul]|mime_in[sampul,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'mime_in' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'is_image' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'max_size' => 'Ukuran gambar terlalu besar, Maksimal 5MB',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom sinopsis tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/buku/' . $this->request->getVar('slug')))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namasampul = $this->request->getVar('sampullama');
        } else {
            unlink('upload/buku/' . $this->request->getVar('sampullama'));
            $namasampul = $fileSampul->getRandomName();
            $fileSampul->move('upload/buku/', $namasampul);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tanggal_terbit' => $this->request->getVar('tanggal_terbit'),
            'sampul' => $namasampul,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ]);

        session()->setFlashdata('pesan', "Data berhasil diubah");

        return redirect()->to("/admin/buku/" . $slug);
    }

    protected function formatTanggal($tanggal)
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $timestamp = strtotime($tanggal);
        $tanggal = date('d', $timestamp);
        $indexbulan = date('n', $timestamp);
        $tahun = date('Y', $timestamp);
        return $tanggal . " " . $bulan[$indexbulan - 1] . " " . $tahun;
    }
}
