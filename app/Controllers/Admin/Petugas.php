<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PetugasModel;
use App\Models\UsersModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Password;

class Petugas extends BaseController
{
    protected $userModel;
    protected $petugasModel;
    protected $groupModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->petugasModel = new PetugasModel();
        $this->groupModel = new GroupModel();
    }

    public function index()
    {
        $this->data += [
            "title" => "Home | Administrator",
            "subtitle" => "Petugas",
            "navactive" => "petugas",
            "validation" => validation_errors(),
            "data" => $this->petugasModel->getData(),
        ];
        return view('admin/petugas/dataPetugas', $this->data);
    }

    public function detail($id)
    {
        $petugas = $this->petugasModel->getData($id);
        if (empty($petugas)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Petugas dengan id "' . $id . '" tidak ditemukan');
        }
        $this->data += [
            "title" => "Petugas | " .  $petugas['nama'],
            "navactive" => "petugas",
            "validation" => validation_errors(),
            "data" => $petugas,
        ];

        return view('admin/petugas/detailPetugas', $this->data);
    }

    public function detailEdit($id)
    {
        return redirect()->to(base_url("/admin/petugas/$id"))->with('error_edit', ' ');
    }

    public function simpan()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah digunakan'
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
            'jabatan' => [
                'rules' => 'required|in_list[Pustakawan,Juru Arsip,Petugas Kebersihan,Petugas Keamanan]',
                'errors' => [
                    'required' => 'Harap pilih jabatan yang sesuai',
                    'in_list' => 'Harap pilih jabatan yang sesuai',
                ]
            ],
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harap masukan nomor telpon yang sesuai',
                    'numeric' => 'Harap masukan nomor telpon yang sesuai',
                ]
            ],
            'akses_login' => [
                'rules' => 'required|in_list[none,petugas,admin]',
                'errors' => [
                    'required' => 'Harap pilih akses login yang sesuai',
                    'in_list' => 'Harap pilih akses login yang sesuai',
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
        ];

        if ($this->request->getVar('akses_login') != 'none') {
            $rules = array_merge($rules, [
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
            ]);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error_tambah', true);
        }

        // insert tabel users
        if ($this->request->getVar('akses_login') != 'none') {
            $this->userModel->withGroup($this->request->getVar('akses_login'))->save([
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password_hash' => Password::hash($this->request->getVar('password')),
                'active' => 1,
            ]);
            $insertID = $this->userModel->getInsertID();
        }

        // insert tabel petugas
        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('upload/petugas/', $namaFoto);
        }

        $data = [
            'id_petugas' => uniqueID('PTGS', 'petugas', 'id_petugas'),
            'akses_login' => $this->request->getVar('akses_login'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'nama' => $this->request->getVar('nama'),
            'foto' => $namaFoto,
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'jabatan' => $this->request->getVar('jabatan'),
            'alamat' => $this->request->getVar('alamat'),
        ];

        if (isset($insertID)) {
            $data = array_merge($data, ['id_login' => $insertID]);
        }

        $this->petugasModel->save($data);

        session()->setFlashdata('pesan', "Data berhasil ditambahkan");

        return redirect()->to("/admin/petugas");
    }

    public function hapus($id)
    {
        $petugas = $this->petugasModel->where('id_petugas', $id)->first();
        if ($petugas['foto'] != "default.png" && file_exists($petugas['foto'])) {
            unlink('upload/petugas/' . $petugas['foto']);
        }
        if ($petugas['id_login']) {
            $this->userModel->delete($petugas['id_login']);
        }
        $this->petugasModel->delete($id);

        session()->setFlashdata('pesan', "Data berhasil dihapus");

        return redirect()->to('/admin/petugas');
    }

    public function edit($id)
    {

        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong',
                    'is_unique' => '{field} {value} sudah digunakan'
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
            'jabatan' => [
                'rules' => 'required|in_list[Pustakawan,Juru Arsip,Petugas Kebersihan,Petugas Keamanan]',
                'errors' => [
                    'required' => 'Harap pilih jabatan yang sesuai',
                    'in_list' => 'Harap pilih jabatan yang sesuai',
                ]
            ],
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harap masukan nomor telpon yang sesuai',
                    'numeric' => 'Harap masukan nomor telpon yang sesuai',
                ]
            ],
            'akses_login' => [
                'rules' => 'required|in_list[none,petugas,admin]',
                'errors' => [
                    'required' => 'Harap pilih akses login yang sesuai',
                    'in_list' => 'Harap pilih akses login yang sesuai',
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
        ];

        $petugas = $this->petugasModel->getData($id);
        $akses_login = $petugas['akses_login'];
        $idLogin = $petugas['id_login'];

        if ($this->request->getVar('akses_login') != 'none') {

            $usernameRules = 'required';
            // menambahkan unique username jika kondisi baru ditambahkan atau berbeda dari username sebelumnya
            if (!$idLogin || $petugas['username'] != $this->request->getVar('username')) {
                $usernameRules .= '|is_unique[users.username]';
            }
            $emailRules = 'required|valid_email';
            // menambahkan unique email jika kondisi baru ditambahkan atau berbeda dari email sebelumnya
            if (!$idLogin || $petugas['email'] != $this->request->getVar('email')) {
                $emailRules .= '|is_unique[users.email]';
            }

            $rules = array_merge($rules, [
                'username' => [
                    'rules' => $usernameRules,
                    'errors' => [
                        'required' => 'Kolom {field} tidak boleh kosong',
                        'is_unique' => '{field} {value} sudah digunakan'
                    ]
                ],
                'email' => [
                    'rules' => $emailRules,
                    'errors' => [
                        'required' => 'Kolom {field} tidak boleh kosong',
                        'is_unique' => '{field} {value} sudah terdaftar',
                        'valid_email' => 'Harap isi kolom email dengan format yang benar'
                    ]
                ],
            ]);
            // jika akses login lama bernilai none
            if ($akses_login == 'none') {
                $rules = array_merge($rules, [
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
                ]);
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error_edit', true);
        }

        $getAksesLogin = $this->request->getVar('akses_login');
        // jika akses login berubah menjadi none
        if ($getAksesLogin == 'none' && $akses_login != 'none') {
            $this->userModel->delete($idLogin);
        }

        // jika akses login bukan none
        if ($getAksesLogin != 'none') {

            if ($akses_login == 'none') {
                // jika akses login diberikan 
                $this->userModel->withGroup($getAksesLogin)->save([
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password_hash' => Password::hash($this->request->getVar('password')),
                    'active' => 1,
                ]);
                $insertID = $this->userModel->getInsertID();
            } else {
                // jika akses login sama dengan yang sebelumnya
                $this->groupModel->removeUserFromAllGroups($idLogin);

                $groupId = $this->groupModel->where('name', $getAksesLogin)->first()->id;
                $this->groupModel->addUserToGroup($idLogin, $groupId);
                $this->userModel->save([
                    'id' => $idLogin,
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                ]);
            }
        }

        $fileFoto = $this->request->getFile('foto');
        $fotolama =  $this->request->getVar('fotolama');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $fotolama;
        } else {
            if ($fotolama != 'default.png') {
                unlink('upload/petugas/' . $fotolama);
            }

            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('upload/petugas/', $namaFoto);
        }

        $data = [
            'id_petugas' => $id,
            'akses_login' => $getAksesLogin,
            'nama' => $this->request->getVar('nama'),
            'foto' => $namaFoto,
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'jabatan' => $this->request->getVar('jabatan'),
            'alamat' => $this->request->getVar('alamat'),
        ];

        if (!isset($insertID) && $getAksesLogin == 'none') {
            $data = array_merge($data, ['id_login' => null]);
        } elseif (isset($insertID)) {
            $data = array_merge($data, ['id_login' => $insertID]);
        }

        $this->petugasModel->save($data);

        session()->setFlashdata('pesan', "Data berhasil diubah");

        return redirect()->to("admin/petugas/" . $id);
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
            return redirect()->back()->withInput()->with('error_password', true);
        }

        $this->userModel->save([
            'id' => $id,
            'password_hash' => Password::hash($this->request->getVar('password')),
        ]);

        session()->setFlashdata('pesan', "Password berhasil di reset");

        return redirect()->to("admin/anggota/" . $id);
    }
}
