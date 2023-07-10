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
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Peminjaman</th>
                <th scope="col">Nama Anggota</th>
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
                    <td scope="row"><?= $item['id'] ?></td>
                    <td scope="row"><?= $item['id'] ?></td>
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
                    <label for="peminjam" class="col-sm-3 form-label">Peminjam</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm <?= isset($validation['peminjam']) ? 'is-invalid' : '' ?>" id="peminjam" name="peminjam" aria-label="Default select example">
                            <option value="" <?= old('peminjam') == '' ? 'selected' : '' ?>>Pilih Anggota</option>

                            <?php foreach ($dataanggota as $item) : ?>
                                <option value="<?= $item['id'] ?>" <?= old('peminjam') ==  $item['id']  ? 'selected' : '' ?>><?= $item['id'] . " - " . $item['nama'] ?></option>
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