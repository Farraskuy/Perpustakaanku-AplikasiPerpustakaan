<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<?php $pinjam = $data['pengembalian'] ?>


<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/pengembalian" class="btn bg-white border border-3"><i
                    class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h5 class="m-0">Detail Pengembalian</h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
            <span class="fs-5 fw-semibold text-dark border-end pe-3">Aksi</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button style="min-width: 80px;" class="btn btn-danger text-white fw-semibold" type="button"
                    data-bs-toggle="modal" data-bs-target="#hapusSatu"><i class="fa-solid fa-trash-xmark"></i>
                    Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded p-4">
    <div class="row align-items-start mb-3 row-gap-2">
        <div class="col-md-8">
            <h6 class="mb-3">
                <strong>No Pengembalian </strong>
                <span class="border-start border-end px-2 mx-2"><?= $pinjam['id_pengembalian'] ?></span>
            </h6>
            <div class="table-responsive">
                <table class="table table-sm table-borderless align-middle">
                    <tr class="border-bottom">
                        <th class="fit">Petugas yang melayani</th>
                        <td class="fit">:</td>
                        <td><?= $pinjam['nama_petugas'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Peminjam</th>
                        <td>:</td>
                        <td><?= $pinjam['nama_anggota'] ?></td>
                    </tr>
                    <tr class="border-bottom">
                        <th>Tanggal Pinjam</th>
                        <td>:</td>
                        <td><?= formatTanggal($pinjam['tanggal_pinjam']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>:</td>
                        <td><?= formatTanggal($pinjam['tanggal_kembali']) ?></td>
                    </tr>
                    <tr class="border-bottom">
                        <th>Tanggal Dikembalikan</th>
                        <td>:</td>
                        <td><?= formatTanggal($pinjam['created_at']) ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>:</td>
                        <td>
                            <?php if ($pinjam['keterangan'] == 'tepatwaktu'): ?>
                                <span class="badge bg-success">Tepat Waktu</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php endif ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row row-gap-3">
                <div class="col-6 col-md-12">
                    <div class="border rounded p-3 text-center">
                        <h6 class="text-muted mb-1">Jumlah Buku</h6>
                        <h3 class="mb-0 text-primary"><?= $pinjam['jumlah_buku'] ?></h3>
                    </div>
                </div>
                <div class="col-6 col-md-12">
                    <div class="border rounded p-3 text-center bg-danger bg-opacity-10">
                        <h6 class="text-muted mb-1">Total Denda</h6>
                        <h4 class="mb-0 text-danger fw-bold">Rp
                            <?= number_format($pinjam['total_denda'], 0, ',', '.') ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-3">

    <h6 class="mb-3"><i class="fa-regular fa-books me-2"></i>Daftar Buku</h6>
    <div class="p-2 table-responsive">
        <table class="table table-sm align-middle">
            <thead class="table-light">
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Kondisi Awal</th>
                    <th scope="col">Kondisi Akhir</th>
                    <th scope="col">Denda Telat</th>
                    <th scope="col">Denda Kondisi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($data['buku'] as $item): ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td class="fit pe-3"><img class="sampul"
                                src="/upload/buku/<?= !empty($item['sampul']) ? $item['sampul'] : 'default.png' ?>"
                                alt="foto <?= $item['judul'] ?>"></td>
                        <td><?= $item['judul'] ?></td>
                        <td><?= $item['penerbit'] ?? '-' ?></td>
                        <td><?= $item['penulis'] ?? '-' ?></td>
                        <td>
                            <?php
                            $kondisi = $item['kondisi'] ?? 'baik';
                            $badgeClass = $kondisi == 'baik' ? 'success' : ($kondisi == 'rusak' ? 'warning' : 'danger');
                            ?>
                            <span class="badge bg-<?= $badgeClass ?>"><?= ucfirst($kondisi) ?></span>
                        </td>
                        <td>
                            <?php
                            $kondisiAkhir = $item['kondisi_akhir'] ?? 'baik';
                            $badgeClassAkhir = $kondisiAkhir == 'baik' ? 'success' : ($kondisiAkhir == 'rusak' ? 'warning' : 'danger');
                            ?>
                            <span class="badge bg-<?= $badgeClassAkhir ?>"><?= ucfirst($kondisiAkhir) ?></span>
                        </td>
                        <td>Rp <?= number_format($item['denda_telat'] ?? 0, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($item['denda_kondisi'] ?? 0, 0, ',', '.') ?></td>
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
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya,
                    Hapus</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>