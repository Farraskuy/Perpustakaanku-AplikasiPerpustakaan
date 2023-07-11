<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\UsersModel;
use Myth\Auth\Password;

class Anggota extends BaseController
{
    protected $anggotaModel;
    protected $userModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Anggota",
            "navactive" => "anggota",
            "validation" => validation_errors(),
            "data" => $this->anggotaModel->ambilData(),
        ];
        return view('admin/anggota/dataAnggota', $this->data);
    }

    public function detail($id)
    {

        $anggota = $this->anggotaModel->ambilData($id);
        if (empty($anggota)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anggota dengan id "' . $id . '" tidak ditemukan');
        }

        $this->data += [
            "title" => "Anggota | Administrator",
            "data" => $anggota,
            "navactive" => "anggota",
            "validation" => validation_errors()
        ];

        return view('admin/anggota/detailAnggota', $this->data);
    }

    public function simpan()
    {

        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah digunakan'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah terdaftar',
                    'valid_email' => 'Harap isi kolom email dengan format yang benar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                ]
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom konfirmasi password tidak boleh kosong',
                    'matches' => 'Password tidak sama',

                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                ]
            ],
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harap masukan nomor telpon yang sesuai',
                    'numeric' => 'Harap masukan nomor telpon yang sesuai',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => 'Harap pilih jenis kelamin yang sesuai',
                    'in_list' => 'Harap pilih jenis kelamin yang sesuai',
                ]
            ],
            'agama' => [
                'rules' => 'required|in_list[Islam,Kristen,Protestan,Hindu,Buddha,Konghucu,Lainnya]',
                'errors' => [
                    'required' => 'Harap pilih agama tidak boleh kosong',
                    'in_list' => 'Harap pilih agama yang sesuai',
                ]
            ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|max_size[foto,1024]',
                'errors' => [
                    'mime_in' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'is_image' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'max_size' => 'Ukuran foto terlalu besar, Maksimal 5MB',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        // insert tabel users untuk login
        $this->userModel->withGroup('anggota')->save([
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password_hash' => Password::hash($this->request->getVar('password')),
            'active' => 1,
        ]);
        $id = $this->userModel->getInsertID();

        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('upload/anggota/', $namaFoto);
        }

        // insert data anggota
        $data = [
            'id_anggota' => uniqueID('AGT', 'anggota', 'id_anggota'),
            'id_login' => $id,
            'nama' => $this->request->getVar('nama'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' =>  $this->request->getVar('agama'),
            'alamat' =>  $this->request->getVar('alamat'),
            'foto' => $namaFoto,
        ];
        $this->anggotaModel->save($data);

        session()->setFlashdata('pesan', "Data berhasil ditambahkan");

        return redirect()->to("/admin/anggota");
    }

    public function hapus($id_anggota)
    {
        $anggota = $this->anggotaModel->where('id_anggota', $id_anggota)->first();
        if ($anggota['foto'] != "default.png") {
            unlink('upload/anggota/' . $anggota['foto']);
        }
        if ($anggota['id_login']) {
            $this->userModel->delete($anggota['id_login']);
        }
        $this->anggotaModel->delete($id_anggota);

        session()->setFlashdata('pesan', "Data berhasil dihapus");

        return redirect()->to('/admin/anggota');
    }

    public function edit($id_anggota)
    {
        $anggota = $this->anggotaModel->ambilData($id_anggota);

        $usernameRule = 'required';
        if ($anggota['username'] != $this->request->getVar('username')) {
            $usernameRule .= '|is_unique[users.username]';
        }
        $emailRule = 'required|valid_email';
        if ($anggota['email'] != $this->request->getVar('email')) {
            $emailRule .= '|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $usernameRule,
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah digunakan'
                ]
            ],
            'email' => [
                'rules' => $emailRule,
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah terdaftar',
                    'valid_email' => 'Harap isi kolom email dengan format yang benar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                ]
            ],
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harap masukan nomor telpon yang sesuai',
                    'numeric' => 'Harap masukan nomor telpon yang sesuai',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => 'Harap pilih jenis kelamin yang sesuai',
                    'in_list' => 'Harap pilih jenis kelamin yang sesuai',
                ]
            ],
            'agama' => [
                'rules' => 'required|in_list[Islam,Kristen,Protestan,Hindu,Buddha,Konghucu,Lainnya]',
                'errors' => [
                    'required' => 'Harap pilih agama tidak boleh kosong',
                    'in_list' => 'Harap pilih agama yang sesuai',
                ]
            ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|max_size[foto,1024]',
                'errors' => [
                    'mime_in' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'is_image' => 'Format file tidak didukung, Harap Masukan file berformat .png, .jpg, .jpeg',
                    'max_size' => 'Ukuran foto terlalu besar, Maksimal 5MB',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong'
                ]
            ],

        ])) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        $this->userModel->save([
            'id' => $anggota['id_login'],
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
        ]);


        $fileFoto = $this->request->getFile('foto');
        $fotolama =  $this->request->getVar('fotolama');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $fotolama;
        } else {
            if ($fotolama != 'default.png') {
                unlink('upload/anggota/' . $fotolama);
            }

            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('upload/anggota/', $namaFoto);
        }

        $this->anggotaModel->save([
            'id_anggota' => $id_anggota,
            'nama' => $this->request->getVar('nama'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' =>  $this->request->getVar('agama'),
            'alamat' =>  $this->request->getVar('alamat'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashdata('pesan', "Data berhasil diubah");

        return redirect()->to("admin/anggota/" . $id_anggota);
    }

    public function reset($id_anggota)
    {
        if (!$this->validate([
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                ]
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom konfirmasi password tidak boleh kosong',
                    'matches' => 'Password tidak sama',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('error_password', true);
        }

        $anggota = $this->anggotaModel->ambilData($id_anggota);
        $this->userModel->save([
            'id' => $anggota['id_login'],
            'password_hash' => Password::hash($this->request->getVar('password')),
        ]);

        session()->setFlashdata('pesan', "Password berhasil reset");

        return redirect()->to("admin/anggota/" . $id_anggota);
    }
}
