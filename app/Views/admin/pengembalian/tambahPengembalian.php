<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<?php $pinjam = $data['pinjam'] ?>

<?= d($validation) ?>
<?= d($data) ?>
<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/pinjam" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h5 class="m-0"><?= $subtitle ?></h5>
        </div>
    </div>
</div>

<div class="bg-white rounded p-4">
    <form class="border rounded-3 p-3" method="post">

        <?= csrf_field() ?>

        <div class="table-responsive">
            <table class="table table-borderless align-middle">
                <tr>
                    <th class="fit">Nomor Peminjaman</th>
                    <td class="fit">:</td>
                    <td><?= $pinjam['id_pinjam'] ?></td>
                </tr>
                <tr>
                    <th>Nama Peminjam</th>
                    <td>:</td>
                    <td><?= $pinjam['nama_anggota'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <td>:</td>
                    <td><?= formatTanggal($pinjam['tanggal_kembali']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>:</td>
                    <td><?= formatTanggal($pinjam['created_at']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td class="h6"><span class="badge rounded-pill bg-<?= $pinjam['status_type'] ?>"><?= $pinjam['status_message'] ?></span></td>
                </tr>
                <tr>
                    <th>Keterlambatan Pengembalian <span class="badge rounded-pill text-bg-danger">Denda Telat <?= 'Rp ' . number_format($config['denda_telat'], 0, ',', '.') ?>/Hari/Buku</span></th>
                    <td>:</td>
                    <td class="text-danger"><?= $pinjam['keterlambatan'] ?> Hari</td>
                </tr>
            </table>
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
                        <th scope="col" class="fit px-4">Kondisi Buku Awal</th>
                        <th scope="col" class=" px-4">Kondisi Buku Akhir</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    $totalDenda = $totalterlambat = 0; ?>
                    <?php foreach ($data['buku'] as $item) : ?>
                        <?php
                        $totalterlambat += ($config['denda_telat'] * $pinjam['keterlambatan']);
                        $totalDenda += old("kondisi-" . $item['id_buku']) == '' && old("kondisi-" . $item['id_buku']) == 'baik' ? 0 : 0;
                        $totalDenda += old("kondisi-" . $item['id_buku']) == 'rusak' ? $config['denda_rusak'] : 0;
                        $totalDenda += old("kondisi-" . $item['id_buku']) == 'hilang' ? $config['denda_hilang'] : 0;
                        ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                            <td><?= $item['judul'] ?></td>
                            <td><?= $item['penerbit'] ?></td>
                            <td><?= $item['penulis'] ?></td>
                            <td class="fit px-4"><?= $item['kondisi'] ?></td>
                            <td class="px-4">
                                <select kondisi-lama="<?= old("kondisi-" . $item['id_buku']) ?>" onchange="cekKondisi(this)" class="form-select form-select-sm <?= isset($validation["kondisi-" . $item['id_buku']]) ? 'is-invalid' : '' ?>" name="kondisi-<?= $item['id_buku'] ?>" aria-label="Default select example">
                                    <option value="" <?= old("kondisi-" . $item['id_buku']) == '' ? 'selected' : '' ?>>Pilih Kondisi</option>
                                    <option value="baik" <?= old("kondisi-" . $item['id_buku']) == 'baik' ? 'selected' : '' ?>>Normal - Kondisi seperti saat dipinjam</option>
                                    <option value="rusak" <?= old("kondisi-" . $item['id_buku']) == 'rusak' ? 'selected' : '' ?>>Rusak - Kondisi lebih rusak (Denda <?= 'Rp ' . number_format($config['denda_rusak'], 0, ',', '.') ?>)</option>
                                    <option value="hilang" <?= old("kondisi-" . $item['id_buku']) == 'hilang' ? 'selected' : '' ?>>Hilang - Buku hilang (Denda <?= 'Rp ' . number_format($config['denda_hilang'], 0, ',', '.') ?>)</option>
                                </select>
                                <div class="invalid-feedback"><?= isset($validation["kondisi-" . $item['id_buku']]) ? $validation["kondisi-" . $item['id_buku']] : '' ?></div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end">
            <fieldset class="col-md-7">
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="denda_telat">Denda Terlambat</label>
                    <input type="text" class="form-control disabled col" id="denda_telat" readonly value="<?= 'Rp ' . number_format($totalterlambat, 0, ',', '.') ?>">
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="denda_kondisi">Denda Kondisi</label>
                    <input type="text" class="form-control disabled col" id="denda_kondisi" readonly value="<?= 'Rp ' . number_format($totalDenda, 0, ',', '.') ?>">
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="jumlah_denda">Jumlah Denda</label>
                    <input type="text" class="form-control disabled col" id="jumlah_denda" readonly value="<?= 'Rp ' . number_format($totalterlambat + $totalDenda, 0, ',', '.') ?>">
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label for="bayar" class="col-3">Bayar</label>
                    <input type="hidden" name="bayar" value="<?= preg_replace('/[^0-9]/', '', old('bayar', isset($config['bayar']) ? $config['bayar'] : '0')) ?>">
                    <input oninput="valueToFormatRupiah(this)" type="text" class="form-control col pe-4 <?= isset($validation['bayar']) ? 'is-invalid' : '' ?>" id="bayar" value="<?= 'Rp ' . number_format(old('bayar', isset($config['bayar']) ? $config['bayar'] : '0'), 0, ',', '.') ?>">
                    <div class="invalid-feedback"><?= isset($validation['bayar']) ? $validation['bayar'] : '' ?></div>
                </div>
                <hr>
                <div class="row g-0 align-items-center gap-2 mb-3">
                    <label class="col-3" for="kembali">Kembali</label>
                    <input type="text" class="form-control disabled col" id="kembali" readonly>
                </div>
                <div class="row g-0 align-items-center gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#simpan">Simpan Pengembalian</button>
                </div>
            </fieldset>
        </div>

        <!-- hapus modal -->
        <div class="modal fade" id="simpan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pengembalian</h1>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menyelesaikan pengembalian ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success text-white">Ya, Kembalikan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>



<?= $this->endSection(); ?>