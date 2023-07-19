<?php

namespace App\Controllers\Admin\MasterBuku;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenerbitModel;
use App\Models\PenulisModel;
use App\Models\RakModel;

class Buku extends BaseController
{
    protected $buku;
    protected $penulis;
    protected $kategori;
    protected $penerbit;
    protected $rak;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->penulis = new PenulisModel();
        $this->penerbit = new PenerbitModel();
        $this->kategori = new KategoriModel();
        $this->rak = new RakModel();
        $this->data += ["inNavBuku" => true];
    }

    public function index()
    {
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Buku",
            "navactive" => "buku",
            "validation" => validation_errors(),
            "data" => $this->buku->getDataBySlug(),
            "dataKategori" => $this->kategori->findAll(),
            "dataPenulis" => $this->penulis->findAll(),
            "dataPenerbit" => $this->penerbit->findAll(),
            "dataRak" => $this->rak->findAll(),
        ];
        return view('admin/buku/dataBuku', $this->data);
    }

    public function detail($slug)
    {
        $buku = $this->buku->getDataBySlug($slug);
        if (empty($buku)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku "' . $slug . '" tidak ditemukan');
        }

        $this->data += [
            "title" => "Buku | " .  $buku['judul'],
            "data" => $buku,
            "navactive" => "buku",
            "validation" => validation_errors(),
            "dataKategori" => $this->kategori->findAll(),
            "dataPenulis" => $this->penulis->findAll(),
            "dataPenerbit" => $this->penerbit->findAll(),
            "dataRak" => $this->rak->findAll(),
        ];

        return view('admin/buku/detailBuku', $this->data);
    }

    public function detailEdit($slug)
    {
        return redirect()->to(base_url("/admin/buku/$slug"))->with('error_edit', ' ');
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
                'rules' => 'required|is_not_unique[penulis.id_penulis]',
                'errors' => [
                    'required' => 'Harap pilih penulis yang tersedia',
                    'in_list' => 'Harap pilih penulis yang tesedia',
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_not_unique[penerbit.id_penerbit]',
                'errors' => [
                    'required' => 'Harap pilih penerbit yang tersedia',
                    'in_list' => 'Harap pilih penerbit yang tesedia',
                ]
            ],
            'kategori' => [
                'rules' => 'required|is_not_unique[kategori.id_kategori]',
                'errors' => [
                    'required' => 'Harap pilih kategori yang tersedia',
                    'in_list' => 'Harap pilih kategori yang tesedia',
                ]
            ],
            'rak' => [
                'rules' => 'required|is_not_unique[rak.id_rak]',
                'errors' => [
                    'required' => 'Harap pilih rak yang tersedia',
                    'in_list' => 'Harap pilih rak yang tesedia',
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
            'jumlah_buku' => [
                'rules' => 'required|greater_than[0]|numeric',
                'errors' => [
                    'required' => 'Kolom tanggal terbit tidak boleh kosong',
                    'greater_than' => 'Tidak boleh menyetok sebanyak 0 atau kurang dari 0',
                    'numeric' => 'Harap isi kolom jumlah buku menggunakan angka',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namasampul = 'default.png';
        } else {
            $namasampul = $fileSampul->getRandomName();
            $fileSampul->move('upload/buku/', $namasampul);
        }

        $save = $this->buku->save([
            'id_buku' => uniqueID('BK', 'buku', 'id_buku'),
            'judul' => $this->request->getVar('judul'),
            'slug' =>  url_title($this->request->getVar('judul'), '-', true),
            'id_penulis' => $this->request->getVar('penulis'),
            'id_penerbit' => $this->request->getVar('penerbit'),
            'id_kategori' => $this->request->getVar('kategori'),
            'id_rak' => $this->request->getVar('rak'),
            'tanggal_terbit' => $this->request->getVar('tanggal_terbit'),
            'jumlah_buku' => $this->request->getVar('jumlah_buku'),
            'sampul' => $namasampul,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ]);

        if ($save) {
            return redirect()->to("/admin/buku")->with('pesan', "Data berhasil ditambahkan");
        }
        return redirect()->back()->with('error', "Data gagal ditambahkan, Coba muat ulang halaman");
    }

    public function hapus($id)
    {
        $buku = $this->buku->find($id);
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku yang ingin dihapus tidak ada, Harap ulangi proses atau muat ulang website');
        }
        $buku = $this->buku->where('id_buku', $id)->first();
        if ($buku['sampul'] != "default.png") {
            unlink('upload/buku/' . $buku['sampul']);
        }

        if ($this->buku->delete($id)) {
            return redirect()->to('/admin/buku')->with('pesan', "Data berhasil dihapus");
        }
        return redirect()->back()->with('pesan', "Data gagal dihapus");
    }

    public function edit($slug)
    {
        $buku = $this->buku->getDataBySlug($slug);
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku yang ingin diubah tidak ada, Harap ulangi proses atau muat ulang website');
        }

        $buku = $this->buku->getDataBySlug($slug);
        $id = $buku['id_buku'];
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
                'rules' => 'required|is_not_unique[penulis.id_penulis]',
                'errors' => [
                    'required' => 'Harap pilih penulis yang tersedia',
                    'is_not_unique' => 'Harap pilih penulis yang tesedia',
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_not_unique[penerbit.id_penerbit]',
                'errors' => [
                    'required' => 'Harap pilih penerbit yang tersedia',
                    'is_not_unique' => 'Harap pilih penerbit yang tesedia',
                ]
            ],
            'kategori' => [
                'rules' => 'required|is_not_unique[kategori.id_kategori]',
                'errors' => [
                    'required' => 'Harap pilih kategori yang tersedia',
                    'is_not_unique' => 'Harap pilih kategori yang tesedia',
                ]
            ],
            'rak' => [
                'rules' => 'required|is_not_unique[rak.id_rak]',
                'errors' => [
                    'required' => 'Harap pilih rak yang tersedia',
                    'is_not_unique' => 'Harap pilih rak yang tesedia',
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
            'jumlah_buku' => [
                'rules' => 'required|greater_than[0]|numeric',
                'errors' => [
                    'required' => 'Kolom stok tidak boleh kosong',
                    'greater_than' => 'Harap jumlah buku lebih dari 0',
                    'numeric' => 'Harap isi kolom jumlah dengan angka',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
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

        $save = $this->buku->save([
            'id_buku' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'id_penulis' => $this->request->getVar('penulis'),
            'id_penerbit' => $this->request->getVar('penerbit'),
            'id_kategori' => $this->request->getVar('kategori'),
            'id_rak' => $this->request->getVar('rak'),
            'tanggal_terbit' => $this->request->getVar('tanggal_terbit'),
            'sampul' => $namasampul,
            'jumlah_buku' => $this->request->getVar('jumlah_buku'),
            'sinopsis' => $this->request->getVar('sinopsis'),
        ]);

        if ($save) {
            return redirect()->to("/admin/buku/" . $slug)->with('pesan', "Data berhasil diubah");
        }
        
        return redirect()->to("/admin/buku/" . $slug)->with('pesan', "Data gagal diubah");
    }
}
