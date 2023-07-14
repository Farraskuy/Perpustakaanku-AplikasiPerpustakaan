<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<?php $pinjam = $data['pinjam'] ?>

<?= d($validation) ?>
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
                    <td class="h6"><span class="badge bg-<?= $pinjam['status_type'] ?>"><?= $pinjam['status_message'] ?></span></td>
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

                    <?php $i = 1 ?>
                    <?php foreach ($data['buku'] as $item) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td class="fit pe-3"><img class="sampul" src="/upload/buku/<?= $item['sampul'] ?>" alt="foto <?= $item['judul'] ?>"></td>
                            <td><?= $item['judul'] ?></td>
                            <td><?= $item['penerbit'] ?></td>
                            <td><?= $item['penulis'] ?></td>
                            <td class="fit px-4"><?= $item['kondisi'] ?></td>
                            <td class="px-4">
                                <select class="form-select form-select-sm <?= isset($validation["kondisi-" . $item['id_buku']]) ? 'is-invalid' : '' ?>" name="kondisi-<?= $item['id_buku'] ?>" aria-label="Default select example">
                                    <option value="" <?= old("kondisi-" . $item['id_buku']) == '' ? 'selected' : '' ?>>Pilih Kondisi</option>
                                    <option value="baik" <?= old("kondisi-" . $item['id_buku']) == 'baik' ? 'selected' : '' ?>>Normal - Sama seperti semula</option>
                                    <option value="rusak" <?= old("kondisi-" . $item['id_buku']) == 'rusak' ? 'selected' : '' ?>>Rusak - Lebih Rusak dari semula</option>
                                </select>
                                <div class="invalid-feedback"><?= isset($validation["kondisi-" . $item['id_buku']]) ? $validation["kondisi-" . $item['id_buku']] : '' ?></div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-7">
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="denda_telat">Denda Terlambat</label>
                    <input type="text" class="form-control disabled col text-end" id="denda_telat" readonly>
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="denda_kondisi">Denda Kondisi</label>
                    <input type="text" class="form-control disabled col text-end" id="denda_kondisi" readonly>
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="jumlah_denda">Jumlah Denda</label>
                    <input type="text" class="form-control disabled col text-end" id="jumlah_denda" readonly>
                </div>
                <div class="row g-0 align-items-center gap-2 mb-2">
                    <label class="col-3" for="bayar">Bayar</label>
                    <input type="number" class="form-control col text-end pe-4 <?= isset($validation["bayar"]) ? 'is-invalid' : '' ?>" id="bayar" name="bayar">
                    <div class="invalid-feedback text-end"><?= isset($validation["bayar"]) ? $validation["bayar"] : '' ?></div>
                </div>
                <hr>
                <div class="row g-0 align-items-center gap-2 mb-3">
                    <label class="col-3" for="jumdenda">Kembali</label>
                    <input type="text" class="form-control disabled col text-end" id="jumdenda" readonly>
                </div>
                <div class="row g-0 align-items-center gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#simpan">Simpan Pengembalian</button>
                </div>
            </div>
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