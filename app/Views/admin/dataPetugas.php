<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<section class="p-5 position-relative">
    <div class="bg-white rounded-3 p-3 px-4 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="m-0">Data | <?= $subtitle ?></h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded p-3 px-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['jenis_kelamin'] ?></td>
                        <td><?= $item['agama'] ?></td>
                        <td><?= $item['jabatan'] ?></td>
                        <td class="fit aksi">
                            <a class="btn btn-primary" href="/admin/petugas/<?= $item['id'] ?>"><i class="fa-regular fa-eye"></i></a>
                            <a class="btn btn-warning text-white" href="/admin/petugas/<?= $item['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" href="/admin/petugas/<?= $item['id'] ?>"><i class="fa-regular fa-trash-xmark"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</section>

<div class="modal fade  form-modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                        <textarea class="form-control <?= isset($validation['alamat']) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" rows="3"><?= old('alamat') ?></textarea>
                        <div class="invalid-feedback"><?= isset($validation['alamat']) ? $validation['alamat'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>