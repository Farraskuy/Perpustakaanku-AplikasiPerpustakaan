<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
        </div>
    </div>
</div>

<div class="bg-white rounded p-3 px-4 table-responsive ">
    <table class="table align-middle">
        <thead>
            <tr class="align-middle">
                <th scope="col">#</th>
                <th scope="col">Nomor Peminjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Petugas Peminjaman</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Jumlah Pinjam</th>
                <th scope="col">Status</th>
                <th scope="col" class="fit">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td scope="row"><?= $i ?></td>
                    <td><?= $item['id_pinjam'] ?></td>
                    <td><?= $item['nama_anggota'] ?></td>
                    <td><?= $item['nama_petugas'] ?></td>
                    <td><?= formatTanggal($item['created_at']) ?></td>
                    <td><?= formatTanggal($item['tanggal_kembali']) ?></td>
                    <td><?= $item['jumlah_buku'] ?></td>
                    <td class="h6"><span class="badge bg-<?= $item['status_type'] ?>"><?= $item['status_message'] ?></span></td>
                    <td class="fit aksi">
                        <div class="p-1 border rounded-3">
                            <div class="d-flex gap-1 flex-column">
                                <button data-id="<?= $item['id_pinjam'] ?>" type="button" class="btn btn-sm btn-orange fw-semibold" data-bs-toggle="modal" data-bs-target="#pengembalian"><i class="fa-regular fa-solid fa-reply-clock"></i> Kembalikan</button>
                            </div>
                            <hr class="my-1">
                            <a class="btn btn-success" href="/admin/pinjam/<?= $item['id_pinjam'] ?>/tambah"><i class="fa-solid fa-books-medical"></i></a>
                            <a class="btn btn-primary" href="/admin/pinjam/<?= $item['id_pinjam'] ?>"><i class="fa-regular fa-eye"></i></a>
                            <a class="btn btn-warning text-white" href="/admin/pinjam/<?= $item['id_pinjam'] ?>/edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <button data-id="<?= $item['id_pinjam'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/admin/pinjam/">

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

<!-- pengembalian modal -->
<div class="modal fade" id="pengembalian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" method="post">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pengembalian</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin mengembalikan semua buku di peminjaman ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="/admin/pengembalian/kembali/" class="btn btn-orange fw-semibold"><i class="fa-regular fa-solid fa-reply-clock"></i> Ya, Kembalikan</a>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah pengembalian -->
<div class="modal fade form-modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post">

            <?= csrf_field() ?>

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
                                    <input type="radio" class="form-radio" name="peminjam" value="<?= $item['id_anggota'] ?>" id="<?= $item['id_anggota'] ?>" <?= old('peminjam') == $item['id_anggota'] ? 'checked' : '' ?> hidden>
                                    <label class="pilih-buku" for="<?= $item['id_anggota'] ?>"></label>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
                <div class="mb-3 row g-0 p-3 pb-0 align-items-center border-top">
                    <label for="tanggal_pengembalian" class="col-sm-3 form-label m-0">Tanggal Pengembalian</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm <?= isset($validation['tanggal_pengembalian']) ? 'is-invalid' : '' ?>" id="tanggal_pengembalian" value="<?= old('tanggal_pengembalian') ?>" name="tanggal_pengembalian" type="date" />
                        <div class="invalid-feedback"><?= isset($validation['tanggal_pengembalian']) ? $validation['tanggal_pengembalian'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <p class="col text-danger"><?= session()->getFlashdata('error_pinjam_buku') ? session()->getFlashdata('error_pinjam_buku') : '' ?></p>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>