<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button class="btn btn-success fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
        </div>
    </div>
</div>

<div class="bg-white rounded p-3 px-4 table-responsive ">
    <table class="table align-middle">
        <thead>
            <tr class="align-middle">
                <th scope="col">#</th>
                <th scope="col">Sampul</th>
                <th scope="col">ID Buku</th>
                <th scope="col">Judul</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Penulis</th>
                <th scope="col">Kategori</th>
                <th scope="col">Rak</th>
                <th scope="col" class="px-3">Jumlah Buku</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                    <td><?= $item['id_buku'] ?></td>
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['penerbit'] ?></td>
                    <td><?= $item['penulis'] ?></td>
                    <td><?= $item['kategori'] ?></td>
                    <td><?= $item['kode_rak'] . ' - ' . $item['lokasi'] ?></td>
                    <td class="fit">
                        <div class="d-flex flex-column align-items-center gap-2 fs-6 border rounded-3 position-relative p-2  mt-2 pt-3">
                            <span class="badge rounded-pill text-bg-secondary position-absolute w-100" style="top: -10px;">Total : <?= $item['jumlah_buku'] ?></span>
                            <span class="flex-grow-1 badge rounded-pill w-100 text-bg-primary">Tersedia : <?= $item['jumlah_buku'] - $item['jumlah_terpinjam'] - $item['jumlah_rusak'] - $item['jumlah_hilang'] ?></span>
                            <span class="flex-grow-1 badge rounded-pill w-100 text-bg-success">Terpinjam : <?= $item['jumlah_terpinjam'] ?></span>
                            <span class="flex-grow-1 badge rounded-pill w-100 text-bg-warning text-white">Rusak : <?= $item['jumlah_rusak'] ?></span>
                            <span class="flex-grow-1 badge rounded-pill w-100 text-bg-danger">Hilang : <?= $item['jumlah_hilang'] ?></span>

                        </div>
                    </td>
                    <td class="fit aksi">
                        <a class="btn btn-primary" href="/admin/buku/<?= $item['slug'] ?>"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-warning text-white" href="/admin/buku/<?= $item['slug'] ?>/edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button data-id="<?= $item['id_buku'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/admin/buku/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus buku ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white fw-semibold"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah <?= $subtitle ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-3 form-label label-input-required">Judul</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm <?= isset($validation['judul']) ? 'is-invalid' : '' ?>" value="<?= old('judul') ?>" name="judul" id="judul">
                        <div class="invalid-feedback"><?= isset($validation['judul']) ? $validation['judul'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-3 form-label label-input-required">Kategori</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['kategori']) ? 'is-invalid' : '' ?>" id="kategori" name="kategori">
                            <option value="" <?= old('kategori') == '' ? 'selected' : '' ?>>Pilih kategori</option>

                            <?php foreach ($dataKategori as $item) : ?>
                                <option value="<?= $item['id_kategori'] ?>" <?= old('kategori') == $item['id_kategori'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['kategori']) ? $validation['kategori'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="rak" class="col-sm-3 form-label label-input-required">Rak</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['rak']) ? 'is-invalid' : '' ?>" id="rak" name="rak">
                            <option value="" <?= old('rak') == '' ? 'selected' : '' ?>>Pilih Rak</option>

                            <?php foreach ($dataRak as $item) : ?>
                                <option value="<?= $item['id_rak'] ?>" <?= old('rak') == $item['id_rak'] ? 'selected' : '' ?>><?= $item['kode_rak'] . ' - ' . $item['nama'] . ' - ' . $item['lokasi'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['rak']) ? $validation['rak'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-3 form-label label-input-required">Penulis</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['penulis']) ? 'is-invalid' : '' ?>" id="penulis" name="penulis">
                            <option value="" <?= old('penulis') == '' ? 'selected' : '' ?>>Pilih Penerbit</option>

                            <?php foreach ($dataPenulis as $item) : ?>
                                <option value="<?= $item['id_penulis'] ?>" <?= old('penulis') == $item['id_penulis'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['penulis']) ? $validation['penulis'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-3 form-label label-input-required">Penerbit</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit">
                            <option value="" <?= old('penerbit') == '' ? 'selected' : '' ?>>Pilih Penulis</option>

                            <?php foreach ($dataPenerbit as $item) : ?>
                                <option value="<?= $item['id_penerbit'] ?>" <?= old('penerbit') == $item['id_penerbit'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['penerbit']) ? $validation['penerbit'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggalTerbit" class="col-sm-3 form-label label-input-required">Tanggal Terbit</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm <?= isset($validation['tanggal_terbit']) ? 'is-invalid' : '' ?>" id="tanggalTerbit" value="<?= old('tanggal_terbit') ?>" name="tanggal_terbit" type="date" />
                        <div class="invalid-feedback"><?= isset($validation['tanggal_terbit']) ? $validation['tanggal_terbit'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah_buku" class="col-sm-3 form-label label-input-required">Jumlah Buku</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm <?= isset($validation['jumlah_buku']) ? 'is-invalid' : '' ?>" id="jumlah_buku" value="<?= old('jumlah_buku') ?>" name="jumlah_buku" type="number" />
                        <div class="invalid-feedback"><?= isset($validation['jumlah_buku']) ? $validation['jumlah_buku'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3">Sampul</label>
                    <div class="col-sm-9">
                        <div class="border rounded-3 text-center">
                            <div style="height: 150px;" class="w-100 p-3">
                                <img class="w-100 h-100 sampulPreview" style="object-fit: contain;" src="/upload/buku/default.png" alt="default sampul">
                            </div>
                            <input class="form-control form-control-sm <?= isset($validation['sampul']) ? 'is-invalid' : '' ?>" name="sampul" type="file" id="sampul" onchange="ubahPreview(this)">
                            <div class="invalid-feedback"><?= isset($validation['sampul']) ? $validation['sampul'] : '' ?></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sinopsis" class="col-sm-3 form-label">Sinopsis</label>
                    <div class="col-sm-9">
                        <textarea class="form-control form-control-sm <?= isset($validation['sinopsis']) ? 'is-invalid' : '' ?>" name="sinopsis" id="sinopsis" rows="3"><?= old('sinopsis') ?></textarea>
                        <div class="invalid-feedback"><?= isset($validation['sinopsis']) ? $validation['sinopsis'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success text-white fw-semibold">Tambah</button>
            </div>
        </form>
    </div>
</div>




<?= $this->endSection(); ?>