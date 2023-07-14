<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<?php $pinjam = $data['pinjam'] ?>


<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <a href="/admin/pengembalian" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h5 class="m-0"><?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
            <span class="fs-5 fw-semibold text-dark border-end pe-3">Aksi</span>
            <div class="btn-group" role="group" aria-label="Basic example">
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
                        <td><?= formatTanggal($pinjam['created_at']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>:</td>
                        <td><?= formatTanggal($pinjam['tanggal_kembali']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>:</td>
                        <td><?= formatTanggal($pinjam['tanggal_dikembalikan']) ?></td>
                    </tr>
                </table>
            </div>
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


<?= $this->endSection(); ?>