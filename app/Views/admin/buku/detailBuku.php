<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>



<div class="bg-white rounded p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/buku" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i>
            </a>
            <h5 class="m-0">Detail Buku</h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
            <span class="fs-5 fw-semibold text-dark border-end pe-3">Aksi</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button style="min-width: 80px;" class="btn btn-warning text-white fw-semibold" type="button"
                    data-bs-toggle="modal" data-bs-target="#edit"><i class="fa-regular fa-pen-to-square"></i>
                    Edit</button>
                <button style="min-width: 80px;" class="btn btn-danger text-white fw-semibold" type="button"
                    data-bs-toggle="modal" data-bs-target="#hapusSatu"><i class="fa-regular fa-trash-xmark"></i>
                    Hapus</button>
            </div>
        </div>
    </div>
</div>
<div class="bg-white rounded p-3 px-4">
    <div class="row g-0">
        <div class="col-md-4 col-xl-3 p-3 text-center" style="height: 400px;">
            <img src="/upload/buku/<?= !empty($data['sampul']) ? $data['sampul'] : 'default.png' ?>" class="rounded-3"
                style="max-height: 100%; max-width: 100%; object-fit: contain;">
        </div>
        <div class="col-md-8 col-xl-9 d-flex justify-content-center">
            <div class="container-fluid py-4 ">
                <div class="row">
                    <div class="col">
                        <span class="badge rounded-pill bg-secondary fw-semibold mb-2" style="font-size: 14px;">Rak
                            <?= $data['kode_rak'] . ' - ' . $data['lokasi'] ?></span>
                        <h5 class="m-0 text-truncate"><?= $data['judul'] ?></h5>
                    </div>
                </div>
                <hr class="mb-0">
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">ID Buku</p>
                    <p class="col-12 col-md m-0"><?= $data['id_buku'] ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Judul</p>
                    <p class="col-12 col-md m-0"><?= $data['judul'] ?>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Aliquam ipsa cupiditate saepe optio voluptatem obcaecati nisi harum velit
                        possimus sit. Illum at sint quae a? Facilis veniam ea id maxime aperiam odit error eaque beatae
                        minima in. Perspiciatis, aspernatur. Neque officiis mollitia molestiae aliquid magni odio
                        assumenda perferendis quod ducimus, quo voluptatum eligendi velit sit ex error, quam similique
                        ratione. Ullam odit qui molestias minima! Eum amet facere quae fuga sit natus iure, incidunt
                        cumque quidem tenetur ipsum suscipit molestias consectetur non veritatis ab laudantium quo
                        sapiente doloremque commodi exercitationem quam velit rerum enim. Molestias esse ex
                        exercitationem. Itaque, temporibus?</p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Penulis</p>
                    <p class="col-12 col-md m-0"><?= $data['penulis'] ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Penerbit</p>
                    <p class="col-12 col-md m-0"><?= $data['penerbit'] ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Kategori</p>
                    <p class="col-12 col-md m-0"><?= $data['kategori'] ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Tanggal Terbit</p>
                    <p class="col-12 col-md m-0"><?= formatTanggal($data['tanggal_terbit']) ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Jumlah Buku</p>
                    <p class="col-12 col-md m-0 fs-6">
                        <span class="badge rounded-pill text-bg-secondary">Total : <?= $data['jumlah_buku'] ?></span> =
                        <span class="flex-grow-1 badge rounded-pill text-bg-primary">Tersedia :
                            <?= $data['jumlah_buku'] - $data['jumlah_terpinjam'] - $data['jumlah_rusak'] - $data['jumlah_hilang'] ?></span>
                        <span class="flex-grow-1 badge rounded-pill text-bg-success">Terpinjam :
                            <?= $data['jumlah_terpinjam'] ?></span>
                        <span class="flex-grow-1 badge rounded-pill text-bg-warning text-white">Rusak :
                            <?= $data['jumlah_rusak'] ?></span>
                        <span class="flex-grow-1 badge rounded-pill text-bg-danger">Hilang :
                            <?= $data['jumlah_hilang'] ?></span>
                    </p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0" style="max-width: 175px;">Sinopsis</p>
                    <p class="col-12 col-md m-0"><?= $data['sinopsis'] ? $data['sinopsis'] : '-' ?></p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0 text-secondary" style="max-width: 175px;">Ditambahkan Pada
                    </p>
                    <p class="col-12 col-md m-0">
                        <?= formatTanggal($data['created_at']) . ' ' . date('H:i', strtotime($data['created_at'])) ?>
                    </p>
                </div>
                <div class="row g-0 border-bottom py-2">
                    <p class="col-12 col-md-3 fw-semibold m-0 text-secondary" style="max-width: 175px;">Diubah Pada</p>
                    <p class="col-12 col-md m-0">
                        <?= formatTanggal($data['updated_at']) . ' ' . date('H:i', strtotime($data['updated_at'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- hapus modal -->
<div class="modal fade" id="hapusSatu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="/admin/buku/<?= $data['id_buku'] ?>" method="post">
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
                <button type="submit" class="btn btn-danger text-white fw-semibold"><i
                        class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- edit data -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                    <label for="judul" class="col-sm-3 form-label label-input-required">Judul buku</label>
                    <div class="col-sm-9">
                        <input type="text"
                            class="form-control form-control-sm <?= isset($validation['judul']) ? 'is-invalid' : '' ?>"
                            value="<?= old('judul', $data['judul']) ?>" name="judul" id="judul" autofocus>
                        <div class="invalid-feedback"><?= isset($validation['judul']) ? $validation['judul'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-3 form-label label-input-required">Kategori</label>
                    <div class="col-sm-9">
                        <select
                            class="form-select form-select-sm <?= isset($validation['kategori']) ? 'is-invalid' : '' ?>"
                            id="kategori" name="kategori">
                            <option value="" <?= old('kategori') == '' ? 'selected' : '' ?>>Pilih kategori</option>

                            <?php foreach ($dataKategori as $item): ?>
                                <option value="<?= $item['id_kategori'] ?>" <?= old('kategori', $data['id_kategori']) == $item['id_kategori'] ? 'selected' : '' ?>><?= $item['nama'] ?>
                                </option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= isset($validation['kategori']) ? $validation['kategori'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="rak" class="col-sm-3 form-label label-input-required">Rak</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['rak']) ? 'is-invalid' : '' ?>"
                            id="rak" name="rak">
                            <option value="" <?= old('rak') == '' ? 'selected' : '' ?>>Pilih Rak</option>

                            <?php foreach ($dataRak as $item): ?>
                                <option value="<?= $item['id_rak'] ?>" <?= old('rak', $data['id_rak']) == $item['id_rak'] ? 'selected' : '' ?>>
                                    <?= $item['kode_rak'] . ' - ' . $item['nama'] . ' - ' . $item['lokasi'] ?>
                                </option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['rak']) ? $validation['rak'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-3 form-label label-input-required">Penulis</label>
                    <div class="col-sm-9">
                        <select
                            class="form-select form-select-sm <?= isset($validation['penulis']) ? 'is-invalid' : '' ?>"
                            id="penulis" name="penulis">
                            <option value="" <?= old('penulis') == '' ? 'selected' : '' ?>>Pilih Penerbit</option>

                            <?php foreach ($dataPenulis as $item): ?>
                                <option value="<?= $item['id_penulis'] ?>" <?= old('penulis', $data['id_penulis']) == $item['id_penulis'] ? 'selected' : '' ?>><?= $item['nama'] ?>
                                </option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['penulis']) ? $validation['penulis'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-3 form-label label-input-required">Penerbit</label>
                    <div class="col-sm-9">
                        <select
                            class="form-select form-select-sm <?= isset($validation['penerbit']) ? 'is-invalid' : '' ?>"
                            id="penerbit" name="penerbit">
                            <option value="" <?= old('penerbit') == '' ? 'selected' : '' ?>>Pilih Penulis</option>

                            <?php foreach ($dataPenerbit as $item): ?>
                                <option value="<?= $item['id_penerbit'] ?>" <?= old('penerbit', $data['id_penerbit']) == $item['id_penerbit'] ? 'selected' : '' ?>><?= $item['nama'] ?>
                                </option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= isset($validation['penerbit']) ? $validation['penerbit'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggalTerbit" class="col-sm-3 form-label label-input-required">Tanggal Terbit</label>
                    <div class="col-sm-9">
                        <input
                            class="form-control form-control-sm <?= isset($validation['tanggal_terbit']) ? 'is-invalid' : '' ?>"
                            id="tanggalTerbit"
                            value="<?= old('tanggal_terbit', date('Y-m-d', strtotime($data['tanggal_terbit']))) ?>"
                            name="tanggal_terbit" type="date" />
                        <div class="invalid-feedback">
                            <?= isset($validation['tanggal_terbit']) ? $validation['tanggal_terbit'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah_buku" class="col-sm-3 form-label label-input-required">Jumlah Buku</label>
                    <div class="col-sm-9">
                        <input
                            class="form-control form-control-sm <?= isset($validation['jumlah_buku']) ? 'is-invalid' : '' ?>"
                            id="jumlah_buku" value="<?= old('jumlah_buku', $data['jumlah_buku']) ?>" name="jumlah_buku"
                            type="number" />
                        <div class="invalid-feedback">
                            <?= isset($validation['jumlah_buku']) ? $validation['jumlah_buku'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3">Sampul</label>
                    <div class="col-sm-9">
                        <div class="border rounded-3 text-center">
                            <div style="height: 150px;" class="w-100 p-3">
                                <img class="w-100 h-100 sampulPreview" style="object-fit: contain;"
                                    src="/upload/buku/<?= !empty($data['sampul']) ? $data['sampul'] : 'default.png' ?>"
                                    alt="default sampul">
                            </div>
                            <input
                                class="form-control form-control-sm <?= isset($validation['sampul']) ? 'is-invalid' : '' ?>"
                                name="sampul" type="file" id="sampul" onchange="ubahPreview(this)">
                            <div class="invalid-feedback">
                                <?= isset($validation['sampul']) ? $validation['sampul'] : '' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="sinopsis" class="col-sm-3 form-label">Sinopsis</label>
                    <div class="col-sm-9">
                        <textarea
                            class="form-control form-control-sm <?= isset($validation['sinopsis']) ? 'is-invalid' : '' ?>"
                            name="sinopsis" id="sinopsis" rows="3"><?= old('sinopsis', $data['sinopsis']) ?></textarea>
                        <div class="invalid-feedback">
                            <?= isset($validation['sinopsis']) ? $validation['sinopsis'] : '' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning text-white fw-semibold"><i
                        class="fa-regular fa-pen-to-square"></i> Edit</button>
            </div>
        </form>
    </div>
</div>






<?= $this->endSection(); ?>