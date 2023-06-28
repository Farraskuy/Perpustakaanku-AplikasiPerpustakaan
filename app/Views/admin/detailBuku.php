<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>



<div class="bg-white rounded p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/buku" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i> </a>
            <h4 class="m-0">Detail Buku</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">

            <span class="fs-5 fw-semibold text-dark border-end pe-3">Aksi</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button style="min-width: 80px;" class="btn btn-warning text-white fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                <button style="min-width: 80px;" class="btn btn-danger text-white fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i> Hapus</button>
            </div>

        </div>
    </div>
</div>
<div class="bg-white rounded p-3 px-4">
    <div class="row g-0">
        <div class="col-md-4 col-xl-3 row flex-column align-items-center">
            <div class="p-3 w-100 col-4" style="height: 400px;">
                <img src="/upload/buku/<?= $data['sampul'] ?>" class="w-100 h-100" style="object-fit: contain;">
            </div>
        </div>
        <div class="col-md-8 col-xl-9 d-flex justify-content-center">
            <div class="container-fluid py-4 ">
                <div class="row">
                    <div class="col-12">
                        <h4 class="m-0"><?= $data['judul'] ?></h4>
                    </div>
                </div>
                <hr>
                <div class="rov">
                    <div class="col">
                        <table class=" table-borderless">
                            <tbody>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Judul</th>
                                    <td>: <?= $data['judul'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Penulis</th>
                                    <td>: <?= $data['penulis'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Penerbir</th>
                                    <td>: <?= $data['penerbit'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Tanggal Terbit</th>
                                    <td>: <?= $data['format_tanggal'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Stok</th>
                                    <td>: <?= $data['stok'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row flex-column">
                    <div class="col">
                        <h6 class="fw-bold">Sinopsis</h6>
                        <p><?= $data['sinopsis'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- modal -->
    <!-- hapus -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="/admin/buku/<?= $data['id'] ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus buku ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- edit data -->
    <div class="modal fade form-modal" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="slug" value="<?= $data['slug'] ?>">
                <input type="hidden" name="sampullama" value="<?= $data['sampul'] ?>">

                <?= csrf_field() ?>

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Edit Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-3 form-label">Judul buku</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= isset($validation['judul']) ? 'is-invalid' : '' ?>" value="<?= old('judul', $data['judul']) ?>" name="judul" id="judul" autofocus>
                            <div class="invalid-feedback"><?= isset($validation['judul']) ? $validation['judul'] : '' ?></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penulis" class="col-sm-3 col-sm-3 form-label">Penulis</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= isset($validation['penulis']) ? 'is-invalid' : '' ?>" value="<?= old('penulis', $data['penulis']) ?>" name="penulis" id="penulis">
                            <div class="invalid-feedback"><?= isset($validation['penulis']) ? $validation['penulis'] : '' ?></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penerbit" class="col-sm-3 form-label">Penerbit</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>" value="<?= old('penerbit', $data['penerbit']) ?>" name="penerbit" id="penerbit">
                            <div class="invalid-feedback"><?= isset($validation['penerbit']) ? $validation['penerbit'] : '' ?></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggalTerbit" class="col-sm-3 form-label">Tanggal Terbit</label>
                        <div class="col-sm-9">
                            <input class="form-control <?= isset($validation['tanggal_terbit']) ? 'is-invalid' : '' ?>" id="tanggalTerbit" value="<?= old('tanggal_terbit', date('Y-m-d', strtotime($data['tanggal_terbit']))) ?>" name="tanggal_terbit" type="date" />
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
                                <img class="w-100 h-100 sampulPreview" style="object-fit: contain;" src="/upload/buku/<?= $data['sampul'] ?>" alt="default sampul">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="sinopsis" class="col-sm-3 form-label">Sinopsis</label>
                        <div class="col-sm-9">
                            <textarea class="form-control <?= isset($validation['sinopsis']) ? 'is-invalid' : '' ?>" name="sinopsis" id="sinopsis" rows="3"><?= old('sinopsis', $data['sinopsis']) ?></textarea>
                            <div class="invalid-feedback"><?= isset($validation['sinopsis']) ? $validation['sinopsis'] : '' ?></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                </div>
            </form>
        </div>
    </div>






    <?= $this->endSection(); ?>