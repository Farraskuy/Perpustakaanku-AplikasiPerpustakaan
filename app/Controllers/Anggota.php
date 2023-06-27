<?php

namespace App\Controllers;

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
        return $this->anggotaModel->ambilData();
    }

    public function detail($id)
    {

        $anggota = $this->anggotaModel->ambilData($id);
        if (empty($anggota)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anggota dengan id "' . $id . '" tidak ditemukan');
        }

        $data = [
            "title" => "Anggota | " .  $anggota['nama'],
            "data" => $anggota,
            "navactive" => "anggota",
            "validation" => validation_errors()
        ];

        return view('admin/detailAnggota', $data);
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
            return redirect()->back()->withInput();
        }

        // insert tabel users login
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password_hash' => Password::hash($this->request->getVar('password')),
            'active' => 1,
        ];

        $this->userModel->withGroup('anggota')->save($data);
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
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' =>  $this->request->getVar('agama'),
            'alamat' =>  $this->request->getVar('alamat'),
            'foto' => $namaFoto,
        ];
        $this->anggotaModel->save($data);

        session()->setFlashdata('pesan', "Data berhasil ditambahkan");

        return redirect()->to("/admin/anggota");
    }

    public function hapus($id)
    {
        $anggota = $this->anggotaModel->where('id', $id)->first();
        if ($anggota['foto'] != "default.png") {
            unlink('upload/anggota/' . $anggota['foto']);
        }
        $this->anggotaModel->delete($id);
        $this->userModel->delete($id);
        $this->userModel->db->table('auth_groups_users')->delete($id);

        session()->setFlashdata('pesan', "Data berhasil dihapus");
        return redirect()->to('/admin/anggota');
    }

    public function edit($id)
    {
        $user = $this->userModel->where('id', $id)->first();

        $userRule = 'required';
        if ($user['username'] != $this->request->getVar('username')) {
            $userRule .= '|is_unique[users.username]';
        }
        $emailRule = 'required|valid_email';
        if ($user['email'] != $this->request->getVar('email')) {
            $emailRule .= '|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $userRule,
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
            return redirect()->back()->withInput();
        }

        $this->userModel->save([
            'id' => $id,
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
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' =>  $this->request->getVar('agama'),
            'alamat' =>  $this->request->getVar('alamat'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashdata('pesan', "Data berhasil Edit");

        return redirect()->to("admin/anggota/" . $id);
    }

    public function reset($id)
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
            return redirect()->back()->withInput()->with('error_password', validation_show_error('password'));
        }

        $this->userModel->save([
            'id' => $id,
            'password_hash' => Password::hash($this->request->getVar('password')),
        ]);

        session()->setFlashdata('pesan', "Password berhasil reset");

        return redirect()->to("admin/anggota/" . $id);
    }
}
