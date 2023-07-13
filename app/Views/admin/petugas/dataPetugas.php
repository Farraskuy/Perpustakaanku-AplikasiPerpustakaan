<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>


<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button class="btn btn-success " type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
        </div>
    </div>
</div>
<div class="bg-white rounded p-3 px-4 table-responsive">
    <table class="table table-sm align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Petugas</th>
                <th scope="col">Nama</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Agama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Akses Login</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $item['id_petugas'] ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= $item['nomor_telepon'] ?></td>
                    <td><?= $item['jenis_kelamin'] ?></td>
                    <td><?= $item['agama'] ?></td>
                    <td><?= $item['jabatan'] ?></td>
                    <td><?= $item['akses_login'] ?></td>
                    <td class="fit aksi">
                        <a class="btn btn-primary" href="/admin/petugas/<?= $item['id_petugas'] ?>"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-warning text-white" href="/admin/petugas/<?= $item['id_petugas'] ?>/edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button data-id="<?= $item['id_petugas'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>


<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" data-base-action="/admin/petugas/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus petugas ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>




<!-- modal tambah -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Petugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?= csrf_field() ?>

                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['nama']) ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>" name="nama" id="nama" autofocus>
                        <div class="invalid-feedback"><?= isset($validation['nama']) ? $validation['nama'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="agama" class="col-sm-3 form-label">Agama</label>
                    <div class="col-sm-9">
                        <select class="form-select <?= isset($validation['agama']) ? 'is-invalid' : '' ?>" id="agama" name="agama" aria-label="Default select example">
                            <option value="" <?= old('agama') == '' ? 'selected' : '' ?>>Pilih agama</option>
                            <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                            <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                            <option value="Protestan" <?= old('agama') == 'Protestan' ? 'selected' : '' ?>>Protestan</option>
                            <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                            <option value="Buddha" <?= old('agama') == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                            <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                            <option value="Lainnya" <?= old('agama') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                        <div class="invalid-feedback"><?= isset($validation['agama']) ? $validation['agama'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-3 form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-select <?= isset($validation['jenis_kelamin']) ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
                            <option value="" <?= old('jenis_kelamin') == '' ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback"><?= isset($validation['jenis_kelamin']) ? $validation['jenis_kelamin'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jabatan" class="col-sm-3 form-label">Jabatan</label>
                    <div class="col-sm-9">
                        <select class="form-select <?= isset($validation['jabatan']) ? 'is-invalid' : '' ?>" id="jabatan" name="jabatan" aria-label="Default select example">
                            <option value="" <?= old('jabatan') == '' ? 'selected' : '' ?>>Pilih jabatan</option>
                            <option value="Pustakawan" <?= old('jabatan') == 'Pustakawan' ? 'selected' : '' ?>>Pustakawan</option>
                            <option value="Juru Arsip" <?= old('jabatan') == 'Juru Arsip' ? 'selected' : '' ?>>Juru Arsip</option>
                            <option value="Petugas Keamanan" <?= old('jabatan') == 'Petugas Keamanan' ? 'selected' : '' ?>>Petugas Keamanan</option>
                            <option value="Petugas Kebersihan" <?= old('jabatan') == 'Petugas Kebersihan' ? 'selected' : '' ?>>Petugas Kebersihan</option>
                        </select>
                        <div class="invalid-feedback"><?= isset($validation['jabatan']) ? $validation['jabatan'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nomor_telepon" class="col-sm-3 form-label">Nomor Telepon</label>
                    <div class="col-sm-9">
                        <input type="tel" class="form-control <?= isset($validation['nomor_telepon']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_telepon') ?>" name="nomor_telepon" id="nomor_telepon" autofocus>
                        <div class="invalid-feedback"><?= isset($validation['nomor_telepon']) ? $validation['nomor_telepon'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 form-label m-0 pt-3">Akses Login</label>
                    <div class="col-sm-9 ">
                        <div class="border rounded-3 p-3">
                            <div class="mb-3">
                                <div class="btn-group d-flex">
                                    <input type="radio" class="btn-check" value="none" onchange="toggleFormAkses(this.value)" name="akses_login" id="none" <?= old('akses_login', 'none') == 'none' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary" for="none">Tidak Ada</label>
                                    <input type="radio" class="btn-check" value="petugas" onchange="toggleFormAkses(this.value)" name="akses_login" id="petugas" <?= old('akses_login') == 'petugas' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary" for="petugas">Petugas</label>
                                    <input type="radio" class="btn-check" value="admin" onchange="toggleFormAkses(this.value)" name="akses_login" id="admin" <?= old('akses_login') == 'admin' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary" for="admin">Admin</label>
                                </div>
                            </div>
                            <fieldset <?= old('akses_login', 'none') == 'none' ? 'disabled' : '' ?> id="formAksesLogin">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?= isset($validation['username']) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Username">
                                        <label for="username">Username</label>
                                        <div class="invalid-feedback"><?= isset($validation['username']) ? $validation['username'] : '' ?></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control <?= isset($validation['email']) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="name@example.com">
                                        <label for="email">Email</label>
                                        <div class="invalid-feedback"><?= isset($validation['email']) ? $validation['email'] : '' ?></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control <?= isset($validation['password']) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
                                        <label for="password">Password</label>
                                        <div class="invalid-feedback"><?= isset($validation['password']) ? $validation['password'] : '' ?></div>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control <?= isset($validation['password_confirm']) ? 'is-invalid' : '' ?>" id="password_confirm" name="password_confirm" placeholder="Ulangi Password">
                                    <label for="password_confirm">Ulangi Password</label>
                                    <div class="invalid-feedback"><?= isset($validation['password_confirm']) ? $validation['password_confirm'] : '' ?></div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="foto" class="col-sm-3 form-label">Foto</label>
                    <div class="col-sm-9">
                        <input class="form-control <?= isset($validation['foto']) ? 'is-invalid' : '' ?>" name="foto" type="file" id="foto" onchange="ubahPreview(this)">
                        <div class="invalid-feedback"><?= isset($validation['foto']) ? $validation['foto'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <p>Preview</p>
                        <div style="height: 150px;" class="w-100 border rounded-3 text-center p-3">
                            <img class="w-100 h-100 sampulPreview" style="object-fit: contain;" src="/upload/petugas/default.png" alt="default sampul">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="alamat" class="col-sm-3 form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control <?= isset($validation['alamat']) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" rows="5"><?= old('alamat') ?></textarea>
                        <div class="invalid-feedback"><?= isset($validation['alamat']) ? $validation['alamat'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>