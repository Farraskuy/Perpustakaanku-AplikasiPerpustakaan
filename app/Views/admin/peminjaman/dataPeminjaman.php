<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
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
                <th scope="col">Petugas Yang Melayani</th>
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
                    <td>
                        <h6><span class="badge bg-<?= $item['status_type'] ?>"><?= $item['status_message'] ?></span></h6>
                    </td>
                    <td class="fit aksi">
                        <div class="p-1 border rounded-3">
                            <div class="d-flex gap-1 flex-column">
                                <button data-id="<?= $item['id_pinjam'] ?>" type="button" class="w-100 btn btn-sm btn-warning fw-semibold text-white" data-bs-toggle="modal" data-bs-target="#perpanjang"><i class="fa-regular fa-hourglass-clock"></i> Perpanjang</button>
                                <button data-id="<?= $item['id_pinjam'] ?>" type="button" class="w-100 btn btn-sm btn-orange fw-semibold" data-bs-toggle="modal" data-bs-target="#kembalikan"><i class="fa-regular fa-solid fa-reply-clock"></i> Kembalikan</button>
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
        <form class="modal-content" method="post" data-base-action="/admin/pinjam/">

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

<!-- modal edit -->
<div class="modal fade" id="perpanjang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data" data-base-action="/admin/pinjam/perpanjang/">

            <?= csrf_field() ?>

            <input type="hidden" name="_method" value="PUT">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Perpanjang Waktu <?= $subtitle ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <label for="waktu" class="col-sm-3 form-label">Perpanjang Selama</label>
                    <label for="waktu" class="col-auto form-label">:</label>
                    <div class="col-sm input-group has-validation">
                        <input min="1" max="8" class="form-control<?= isset($validation['waktu']) ? 'is-invalid' : '' ?>" id="waktu" value="<?= old('waktu') ?>" name="waktu" type="number" />
                        <span class="input-group-text">Hari</span>
                        <div class="invalid-feedback"><?= isset($validation['waktu']) ? $validation['waktu'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-warning text-white fw-semibold" type="submit"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade form-modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="post" enctype="multipart/form-data" autocomplete="off">

            <?= csrf_field() ?>

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah <?= $subtitle ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="peminjam" class="col-sm-3 form-label">Peminjam</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['peminjam']) ? 'is-invalid' : '' ?>" id="peminjam" name="peminjam" aria-label="Default select example">
                            <option value="" <?= old('peminjam') == '' ? 'selected' : '' ?>>Pilih Anggota</option>

                            <?php foreach ($dataanggota as $item) : ?>
                                <option value="<?= $item['id_anggota'] ?>" <?= old('peminjam') ==  $item['id_anggota']  ? 'selected' : '' ?>><?= $item['id_anggota'] . " - " . $item['nama'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback"><?= isset($validation['peminjam']) ? $validation['peminjam'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_pengembalian" class="col-sm-3 form-label">Tanggal Pengembalian</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm <?= isset($validation['tanggal_pengembalian']) ? 'is-invalid' : '' ?>" id="tanggal_pengembalian" value="<?= old('tanggal_pengembalian') ?>" name="tanggal_pengembalian" type="date" />
                        <div class="invalid-feedback"><?= isset($validation['tanggal_pengembalian']) ? $validation['tanggal_pengembalian'] : '' ?></div>
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