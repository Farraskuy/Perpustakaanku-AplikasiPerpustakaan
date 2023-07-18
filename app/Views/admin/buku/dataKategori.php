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
    <table class="table table-sm align-middle">
        <thead>
            <tr class="align-middle">
                <th scope="col">#</th>
                <th scope="col">ID Kategori</th>
                <th scope="col">Kategori</th>
                <th scope="col">Ditambahkan Pada</th>
                <th scope="col">Diubah Pada</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['id_kategori'] ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= formatTanggal($item['created_at']) . ' ' . date('H:i', strtotime($item['created_at'])) ?></td>
                    <td><?= formatTanggal($item['updated_at']) . ' ' . date('H:i', strtotime($item['updated_at'])) ?></td>
                    <td class="fit">
                        <button data-id="<?= $item['id_kategori'] ?>" data-nilai="<?= $item['nama'] ?>" type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target=".editMasterBuku"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button data-id="<?= $item['id_kategori'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/admin/buku/kategori/">
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
                <div class="row">
                    <label for="kategori" class="col-sm-3 form-label m-0">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['kategori']) ? 'is-invalid' : '' ?>" value="<?= old('kategori') ?>" name="kategori" id="kategori">
                        <div class="invalid-feedback"><?= isset($validation['kategori']) ? $validation['kategori'] : '' ?></div>
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

<!-- edit modal -->
<div class="modal fade editMasterBuku" id="edit" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-static">
        <form class="modal-content" method="post" action="/admin/buku/kategori/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ubah Kategori</h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="kategori_edit" class="col-sm-3 form-label m-0">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['kategori_edit']) ? 'is-invalid' : '' ?>" value="<?= old('kategori_edit') ?>" name="kategori_edit" id="kategori_edit">
                        <div class="invalid-feedback"><?= isset($validation['kategori_edit']) ? $validation['kategori_edit'] : '' ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning text-white fw-semibold"><i class="fa-regular fa-pen-to-square"></i> Ya, Ubah</button>
            </div>
        </form>
    </div>
</div>




<?= $this->endSection(); ?>