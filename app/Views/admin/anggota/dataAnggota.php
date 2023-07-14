<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>


<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
        </div>
    </div>
</div>

<div class="bg-white rounded p-3 px-4 table-responsive ">
    <table class="table table-sm align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Anggota</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col" class="fit">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $item['id_anggota'] ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['nomor_telepon'] ?></td>
                    <td class="fit aksi">
                        <a class="btn btn-primary" href="/admin/anggota/<?= $item['id_anggota'] ?>"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-warning text-white" href="/admin/anggota/<?= $item['id_anggota'] ?>/edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button class="btn btn-danger" data-id="<?= $item['id_anggota'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/admin/anggota/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus anggota ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- tambah modal -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data" autocomplete="off">

            <?= csrf_field() ?>

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-devider">Data Login</p>
                <div class="mb-3 mt-1 row">
                    <label for="username" class="col-sm-3 form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['username']) ? 'is-invalid' : '' ?>" value="<?= old('username', "") ?>" name="username" id="username" autofocus autocomplete="off">
                        <div class="invalid-feedback"><?= isset($validation['username']) ? $validation['username'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control <?= isset($validation['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" name="email" id="email">
                        <div class="invalid-feedback"><?= isset($validation['email']) ? $validation['email'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= isset($validation['password']) ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" name="password" id="password" autocomplete="off">
                        <div class="invalid-feedback"><?= isset($validation['password']) ? $validation['password'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password_confirm" class="col-sm-3 form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= isset($validation['password_confirm']) ? 'is-invalid' : '' ?>" value="<?= old('password_confirm') ?>" name="password_confirm" id="password_confirm">
                        <div class="invalid-feedback"><?= isset($validation['password_confirm']) ? $validation['password_confirm'] : '' ?></div>
                    </div>
                </div>

                <p class="modal-devider">Data Anggota</p>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['nama']) ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>" name="nama" id="nama">
                        <div class="invalid-feedback"><?= isset($validation['nama']) ? $validation['nama'] : '' ?></div>
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
                            <img class="w-100 h-100 sampulPreview" style="object-fit: contain;" src="/upload/anggota/default.png" alt="default sampul">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="alamat" class="col-sm-3 form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control <?= isset($validation['alamat']) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" rows="3"><?= old('alamat') ?></textarea>
                        <div class="invalid-feedback"><?= isset($validation['alamat']) ? $validation['alamat'] : '' ?></div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success text-white">Tambah</button>
            </div>
        </form>
    </div>
</div>




<?= $this->endSection(); ?>