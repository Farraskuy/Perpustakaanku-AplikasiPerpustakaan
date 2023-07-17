<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3 shadow">
    <h5 class="m-0">Informasi Perpustakaan</h5>
</div>

<form method="post" enctype="multipart/form-data" class="bg-white rounded p-3 px-4 shadow">

    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-6 border-end">
            <p class="modal-devider">Informasi Perpustakaan</p>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon Perpustakaan</label>
                <input type="text" class="form-control <?= isset($validation['nomor_telepon']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_telepon', isset($config['nomor_telepon']) ? $config['nomor_telepon'] : '') ?>" name="nomor_telepon" id="nomor_telepon">
                <div class="invalid-feedback"><?= isset($validation['nomor_telepon']) ? $validation['nomor_telepon'] : '' ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Perpustakaan</label>
                <input type="email" class="form-control <?= isset($validation['email']) ? 'is-invalid' : '' ?>" value="<?= old('email', isset($config['email']) ? $config['email'] : '') ?>" name="email" id="email">
                <div class="invalid-feedback"><?= isset($validation['email']) ? $validation['email'] : '' ?></div>
            </div>
            <div class="mb-3 mb-md-0">
                <label for="alamat" class="form-label">Alamat Perpustakaan</label>
                <textarea class="form-control <?= isset($validation['alamat']) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" rows="3"><?= old('alamat', isset($config['alamat']) ? $config['alamat'] : '') ?></textarea>
                <div class="invalid-feedback"><?= isset($validation['alamat']) ? $validation['alamat'] : '' ?></div>
            </div>
        </div>
        <div class="col-md-6 border-end">
            <p class="modal-devider">Utilitas</p>
            <div class="mb-3">
                <label for="denda_rusak" class="form-label">Denda Buku Rusak</label>
                <input type="hidden" name="denda_rusak" value="<?= preg_replace('/[^0-9]/', '', old('denda_rusak', isset($config['denda_rusak']) ? $config['denda_rusak'] : '')) ?>">
                <input oninput="valueToFormatRupiah(this)" type="text" class="form-control <?= isset($validation['denda_rusak']) ? 'is-invalid' : '' ?>" id="denda_rusak" value="<?= 'Rp ' . number_format(old('denda_rusak', isset($config['denda_rusak']) ? $config['denda_rusak'] : '0'), 0, ',', '.') ?>">
                <div class="invalid-feedback"><?= isset($validation['denda_rusak']) ? $validation['denda_rusak'] : '' ?></div>
            </div>
            <div class="mb-3">
                <label for="denda_hilang" class="form-label">Denda Buku Hilang</label>
                <input type="hidden" name="denda_hilang" value="<?= preg_replace('/[^0-9]/', '', old('denda_hilang', isset($config['denda_hilang']) ? $config['denda_hilang'] : '')) ?>">
                <input oninput="valueToFormatRupiah(this)" type="text" class="form-control <?= isset($validation['denda_hilang']) ? 'is-invalid' : '' ?>" id="denda_hilang" value="<?= 'Rp ' . number_format(old('denda_hilang', isset($config['denda_hilang']) ? $config['denda_hilang'] : '0'), 0, ',', '.') ?>">
                <div class="invalid-feedback"><?= isset($validation['denda_hilang']) ? $validation['denda_hilang'] : '' ?></div>
            </div>
            <div class="mb-3">
                <label for="denda_telat" class="form-label">Denda Terlambat Pengumpulan</label>
                <input type="hidden" name="denda_telat" value="<?= preg_replace('/[^0-9]/', '', old('denda_telat', isset($config['denda_telat']) ? $config['denda_telat'] : '')) ?>">
                <input oninput="valueToFormatRupiah(this)" type="text" class="form-control <?= isset($validation['denda_telat']) ? 'is-invalid' : '' ?>" id="denda_telat" value="<?= 'Rp ' . number_format(old('denda_telat', isset($config['denda_telat']) ? $config['denda_telat'] : '0'), 0, ',', '.') ?>">
                <div class="invalid-feedback"><?= isset($validation['denda_telat']) ? $validation['denda_telat'] : '' ?></div>
            </div>
        </div>
    </div>
    <div class="row pt-3 mt-3 justify-content-end border-top">
        <div class="col-6 text-end">
            <button type="button" class="btn btn-warning text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#reset">Reset</button>
            <button type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#simpan">Simpan Perubahan</button>
        </div>
    </div>

    <!-- reset modal -->
    <div class="modal fade" id="reset" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" method="post" data-base-action="/admin/anggota/">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi batalkan perubahan</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin membatalkan perubahan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <a href="/admin/konfigurasi" class="btn btn-warning text-white fw-semibold">Reset</a>
                </div>
            </div>
        </div>
    </div>

    <!-- simpan modal -->
    <div class="modal fade" id="simpan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Konfirmasi Simpan</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menyimpan pengaturan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-semibold">Ya, Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>




<?= $this->endSection(); ?>