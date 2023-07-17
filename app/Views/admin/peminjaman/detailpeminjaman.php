<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<?php $pinjam = $data['pinjam'] ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/pinjam" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h5 class="m-0"><?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
            <span class="fs-5 fw-semibold text-dark border-end pe-3">Aksi</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button style="min-width: 80px;" class="btn btn-success fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#pinjamBuku"><i class="fa-solid fa-books-medical"></i> Tambahkan Buku</button>
                <button style="min-width: 80px;" class="btn btn-warning text-white fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#edit"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                <button style="min-width: 80px;" class="btn btn-danger text-white fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#hapusSatu"><i class="fa-solid fa-trash-xmark"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded p-4">
    <div class="row align-items-start mb-3 row-gap-2">
        <div class="col">
            <h6 class="mb-3">
                <strong>No Peminjaman </strong>
                <span class="border-start border-end px-2 mx-2"><?= $pinjam['id_pinjam'] ?></span>
                <span class="badge bg-<?= $pinjam['status_type'] ?>"><?= $pinjam['status_message'] ?></span>
            </h6>
            <p class="m-0">Petugas yang melayani : <?= $pinjam['nama_petugas'] ?></p>
            <p class="m-0">Waktu pengambilan : <?= formatTanggal($pinjam['created_at']) . ' ' . date('H:i', strtotime($pinjam['created_at'])) ?></p>
            <p class="m-0">Batas waktu pengembalian : <?= formatTanggal($pinjam['tanggal_kembali']) . ' ' . date('H:i', strtotime($pinjam['tanggal_kembali'])) ?></p>
        </div>
        <div class="col-12 col-md-auto border-start">
            <h6 class="text-md-end">Jumlah Buku</h6>
            <h4 class="text-md-end"><?= $pinjam['jumlah_buku'] ?></h4>
        </div>
    </div>
    <div class="p-2 table-responsive">
        <table class="table table-sm align-middle">
            <thead class="table-light">
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Kondisi Buku</th>
                    <th scope="col" class="fit">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($data['buku'] as $item) : ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                        <td><?= $item['judul'] ?></td>
                        <td><?= $item['penerbit'] ?></td>
                        <td><?= $item['penulis'] ?></td>
                        <td><?= $item['kondisi'] ?></td>
                        <td class="fit aksi">
                            <button data-id="<?= $item['id_buku'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusdetail"><i class="fa-regular fa-trash-xmark"></i></button>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>




<!-- hapus modal -->
<div class="modal fade" id="hapusSatu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post">

            <?= csrf_field() ?>

            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- hapus detail modal -->
<div class="modal fade" id="hapusdetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="/admin/pinjam/<?= $pinjam['id_pinjam'] ?>/" method="post">

            <?= csrf_field() ?>

            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- modal EDIT pengembalian -->
<div class="modal fade form-modal" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post">

            <?= csrf_field() ?>

            <input type="hidden" name="_method" value="PUT">
            <div class="modal-header flex-column">
                <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                    <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">Form Peminjaman Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row g-0 w-100">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fa-regular fa-magnifying-glass"></i></span>
                            <input type="search" class="form-control" id="cariAnggota" placeholder="Cari ID Anggota, Nama">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body position-relative p-0">

                <table class="table table-responsive align-middle">
                    <thead class="table-light position-sticky" style="top: 0; z-index: 2;">
                        <tr class="align-middle">
                            <th scope="col">#</th>
                            <th scope="col">ID Anggota</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        <?php foreach ($dataanggota as $item) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $item['id_anggota'] ?></td>
                                <td><?= $item['nama'] ?></td>
                                <td class="fit aksi position-relative">
                                    <input type="radio" class="form-radio" name="peminjam" value="<?= $item['id_anggota'] ?>" id="<?= $item['id_anggota'] ?>" <?= old('peminjam', $pinjam['id_anggota']) == $item['id_anggota'] ? 'checked' : '' ?> hidden>
                                    <label class="pilih-buku" for="<?= $item['id_anggota'] ?>"></label>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
                <div class="mb-3 row g-0 p-3 pb-0 align-items-center border-top">
                    <label for="tanggal_pengembalian" class="col-sm-3 form-label m-0">Tanggal Pengembalian</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm <?= isset($validation['tanggal_pengembalian']) ? 'is-invalid' : '' ?>" id="tanggal_pengembalian" value="<?= old('tanggal_pengembalian', $pinjam['tanggal_kembali']) ?>" name="tanggal_pengembalian" type="date" />
                        <div class="invalid-feedback"><?= isset($validation['tanggal_pengembalian']) ? $validation['tanggal_pengembalian'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <p class="col text-danger"><?= session()->getFlashdata('error_pinjam_buku') ? session()->getFlashdata('error_pinjam_buku') : '' ?></p>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white fw-semibold"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- modal tambah buku -->
<div class="modal fade form-modal" id="pinjamBuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data" autocomplete="off">

            <?= csrf_field() ?>

            <div class="modal-header flex-column">
                <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                    <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">Form Tambah Buku Pinjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row g-0 w-100">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fa-regular fa-magnifying-glass"></i></span>
                            <input type="search" class="form-control" id="cariBuku" placeholder="Cari Buku, ID, judul, penulis, penerbit ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body position-relative p-0">

                <table class="table table-responsive align-middle">
                    <thead class="table-light position-sticky" style="top: 0; z-index: 2;">
                        <tr class="align-middle">
                            <th scope="col">#</th>
                            <th scope="col">Sampul</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Penulis</th>
                            <th scope="col" class="px-3">Ketersediaan Buku</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        <?php foreach ($databuku as $item) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                                <td><?= $item['judul'] ?></td>
                                <td><?= $item['penerbit'] ?></td>
                                <td><?= $item['penulis'] ?></td>
                                <td class="fit px-3"><?= $item['jumlah_buku'] ?></td>

                                <td>
                                    <select class="form-select form-select-sm <?= isset($validation["kondisi-" . $item['id_buku']]) ? 'is-invalid' : '' ?>" name="kondisi-<?= $item['id_buku'] ?>" aria-label="Default select example">
                                        <option value="" <?= old("kondisi-" . $item['id_buku']) == '' ? 'selected' : '' ?>>Pilih Kondisi</option>
                                        <option value="baik" <?= old("kondisi-" . $item['id_buku']) == 'baik' ? 'selected' : '' ?>>Baik</option>
                                        <option value="rusak" <?= old("kondisi-" . $item['id_buku']) == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                                    </select>
                                    <div class="invalid-feedback"><?= isset($validation["kondisi-" . $item['id_buku']]) ? $validation["kondisi-" . $item['id_buku']] : '' ?></div>
                                </td>
                                <td class="fit aksi position-relative">
                                    <input type="checkbox" class="form-check" name="buku[]" value="<?= $item['id_buku'] ?>" id="<?= $item['id_buku'] ?>" <?= old('buku') ? (in_array($item['id_buku'], old('buku')) ? 'checked' : '') : '' ?> hidden>
                                    <label class="pilih-buku" for="<?= $item['id_buku'] ?>"></label>
                                </td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer justify-content-between">
                <p class="col text-danger"><?= session()->getFlashdata('error_pinjam_buku') ? session()->getFlashdata('error_pinjam_buku') : '' ?></p>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success text-white">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>