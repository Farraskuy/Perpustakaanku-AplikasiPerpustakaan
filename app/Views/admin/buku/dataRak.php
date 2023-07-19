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
                <th scope="col">ID <?= $subtitle ?></th>
                <th scope="col">Kode <?= $subtitle ?></th>
                <th scope="col">Nama <?= $subtitle ?></th>
                <th scope="col">Lokasi</th>
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
                    <td><?= $item['id_rak'] ?></td>
                    <td><?= $item['kode_rak'] ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= $item['lokasi'] ?></td>
                    <td><?= formatTanggal($item['created_at']) . ' ' . date('H:i', strtotime($item['created_at'])) ?></td>
                    <td><?= formatTanggal($item['updated_at']) . ' ' . date('H:i', strtotime($item['updated_at'])) ?></td>
                    <td class="fit">
                        <button data-id="<?= $item['id_rak'] ?>" data-nilai="<?= $item['kode_rak'] ?>" data-nilai1="<?= $item['nama'] ?>" data-nilai2="<?= $item['lokasi'] ?>" type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target=".editMasterBuku"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button data-id="<?= $item['id_rak'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/<?= uri_string() ?>/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus <?= $subtitle ?> ini?</p>
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
                <div class="mb-3 row align-items-center">
                    <label for="kode_rak" class="col-sm-3 form-label m-0">Kode <?= $subtitle ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control <?= isset($validation['kode_rak']) ? 'is-invalid' : '' ?>" value="<?= old('kode_rak') ?>" name="kode_rak" id="kode_rak" placeholder="Contoh: P1 ...">
                        <div class="invalid-feedback"><?= isset($validation['kode_rak']) ? $validation['kode_rak'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="rak" class="col-sm-3 form-label m-0">Nama <?= $subtitle ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['rak']) ? 'is-invalid' : '' ?>" value="<?= old('rak') ?>" name="rak" id="rak" placeholder="Contoh: Rak Buku Programing ...">
                        <div class="invalid-feedback"><?= isset($validation['rak']) ? $validation['rak'] : '' ?></div>
                    </div>
                </div>
                <div class="row">
                    <label for="lokasi" class="col-sm-3 form-label m-0">Lokasi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= isset($validation['lokasi']) ? 'is-invalid' : '' ?>" value="<?= old('lokasi') ?>" name="lokasi" id="lokasi" placeholder="Contoh: Lantai 1 ...">
                        <div class="invalid-feedback"><?= isset($validation['lokasi']) ? $validation['lokasi'] : '' ?></div>
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

<!-- edit modal -->
<div class="modal fade editMasterBuku" id="edit" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-static">
        <form class="modal-content" method="post" action="/<?= uri_string() ?>/">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ubah <?= $subtitle ?></h1>
            </div>
            <div class="modal-body">
                <div class="mb-3 row align-items-center">
                    <label for="inputEditMasterBuku" class="col-sm-3 form-label m-0">Kode <?= $subtitle ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control <?= isset($validation['kode_rak_edit']) ? 'is-invalid' : '' ?>" value="<?= old('kode_rak_edit') ?>" name="kode_rak_edit" id="inputEditMasterBuku">
                        <div class="invalid-feedback"><?= isset($validation['kode_rak_edit']) ? $validation['kode_rak_edit'] : '' ?></div>
                    </div>
                </div>
                <div class="mb-3 row align-items-center">
                    <label for="inputEditMasterBuku1" class="col-sm-3 form-label m-0">Nama <?= $subtitle ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control <?= isset($validation['rak_edit']) ? 'is-invalid' : '' ?>" value="<?= old('rak_edit') ?>" name="rak_edit" id="inputEditMasterBuku1">
                        <div class="invalid-feedback"><?= isset($validation['rak_edit']) ? $validation['rak_edit'] : '' ?></div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <label for="inputEditMasterBuku2" class="col-sm-3 form-label m-0">Lokasi</label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control <?= isset($validation['lokasi_edit']) ? 'is-invalid' : '' ?>" value="<?= old('lokasi_edit') ?>" name="lokasi_edit" id="inputEditMasterBuku2">
                        <div class="invalid-feedback"><?= isset($validation['lokasi_edit']) ? $validation['lokasi_edit'] : '' ?></div>
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