<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>


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

<div class="bg-white rounded p-3 px-4 table-responsive ">
    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sampul</th>
                <th scope="col">Judul</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Penulis</th>
                <th scope="col">Stok</th>
                <th scope="col" class="fit">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['penerbit'] ?></td>
                    <td><?= $item['penulis'] ?></td>
                    <td><?= $item['stok'] ?></td>
                    <td class="fit aksi">
                        <a class="btn btn-primary" href="/admin/buku/<?= $item['slug'] ?>"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-warning text-white" href="/admin/buku/<?= $item['slug'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="/admin/buku/<?= $item['slug'] ?>"><i class="fa-regular fa-trash-xmark"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>



<div class="modal fade  form-modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data" autocomplete="off">

            <?= csrf_field() ?>

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah <?= $subtitle ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-3 form-label">Judul</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['judul']) ? 'is-invalid' : '' ?>" value="<?= old('judul') ?>" name="judul" id="judul">
                        <div class="invalid-feedback"><?= isset($validation['judul']) ? $validation['judul'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-3 col-sm-3 form-label">Penulis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['penulis']) ? 'is-invalid' : '' ?>" value="<?= old('penulis') ?>" name="penulis" id="penulis">
                        <div class="invalid-feedback"><?= isset($validation['penulis']) ? $validation['penulis'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-3 form-label">Penerbit</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>" value="<?= old('penerbit') ?>" name="penerbit" id="penerbit">
                        <div class="invalid-feedback"><?= isset($validation['penerbit']) ? $validation['penerbit'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggalTerbit" class="col-sm-3 form-label">Tanggal Terbit</label>
                    <div class="col-sm-9">
                        <input class="form-control <?= isset($validation['tanggal_terbit']) ? 'is-invalid' : '' ?>" id="tanggalTerbit" value="<?= old('tanggal_terbit') ?>" name="tanggal_terbit" type="date" />
                        <div class="invalid-feedback"><?= isset($validation['tanggal_terbit']) ? $validation['tanggal_terbit'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sampul" class="col-sm-3 form-label">Sampul</label>
                    <div class="col-sm-9">
                        <input class="form-control <?= isset($validation['sampul']) ? 'is-invalid' : '' ?>" name="sampul" type="file" id="sampul" onchange="ubahPreview(this)">
                        <div class="invalid-feedback"><?= isset($validation['sampul']) ? $validation['sampul'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <p>Preview</p>
                        <div style="height: 150px;" class="w-100 border rounded-3 text-center p-3">
                            <img class="w-100 h-100 sampulPreview" style="object-fit: contain;" src="/upload/buku/default.png" alt="default sampul">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sinopsis" class="col-sm-3 form-label">Sinopsis</label>
                    <div class="col-sm-9">
                        <textarea class="form-control <?= isset($validation['sinopsis']) ? 'is-invalid' : '' ?>" name="sinopsis" id="sinopsis" rows="3"><?= old('sinopsis') ?></textarea>
                        <div class="invalid-feedback"><?= isset($validation['sinopsis']) ? $validation['sinopsis'] : '' ?></div>
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