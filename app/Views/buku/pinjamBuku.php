<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="padding-top: 65px;">
    <div class="my-4">
        <h4 class="mb-3">Daftar Pinjaman Buku</h4>
        <div class="row gap-2 flex-lg-nowrap">
            <div class="col-lg-3 border rounded-3 p-3" style="height: fit-content;">
                <h6 class="mb-3">Keterangan</h6>
                <div class="row row-cols-2 row-cols-lg-1 g-0">
                    <div class="col mb-lg-3 p-2 p-lg-0">
                        <div class="card border-0 text-bg-primary">
                            <div class="card-body align-items-end">
                                <div class="row justify-content-between h-100 fw-semibold fw-semibold">
                                    <p class="m-0 col-12 col-md-auto">Batas peminjaman</p>
                                    <p class="m-0 col-12 col-md-auto h-auto border-start border-white border-2"><?= $ketpinjam['batas_pinjam'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-lg-3 p-2 p-lg-0">
                        <div class="card border-0 text-white text-bg-warning">
                            <div class="card-body">
                                <div class="row justify-content-between h-100 fw-semibold">
                                    <p class="m-0 col-12 col-md-auto">Menunggu diambil</p>
                                    <p class="m-0 col-12 col-md-auto h-auto border-start border-white border-2"><?= $ketpinjam['jumlah_menunggu'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-lg-3 p-2 p-lg-0">
                        <div class="card border-0 text-bg-success">
                            <div class="card-body">
                                <div class="row justify-content-between h-100 fw-semibold">
                                    <p class="m-0 col-12 col-md-auto">Dipinjam</p>
                                    <p class="m-0 col-12 col-md-auto h-auto border-start border-white border-2"><?= $ketpinjam['jumlah_pinjam'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-lg-3 p-2 p-lg-0">
                        <div class="card border-0 text-bg-danger">
                            <div class="card-body">
                                <div class="row justify-content-between h-100 fw-semibold">
                                    <p class="m-0 col-12 col-md-auto">Harus dikembalikan</p>
                                    <p class="m-0 col-12 col-md-auto h-auto border-start border-white border-2"><?= $ketpinjam['jumlah_kembali'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 d-flex flex-column border rounded-3 p-3">
                <div class="mb-lg-3 p-2 p-lg-0 d-flex">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto position-relative d-flex align-items-center">
                            <label class="position-absolute ms-3" for="seacrh"><i class="fa-regular fa-magnifying-glass"></i></label>
                            <input type="text" id="search" class="form-control ps-5" placeholder="Cari nomor peminjaman">
                        </div>
                    </div>
                </div>
                <div class="row align-items-center gap-2">
                    <p class="col-auto text-nowrap"><strong>Status</strong></p>
                    <p class="col-auto text-nowrap border rounded-3 px-2 py-1 status-filter-bar">
                        Menungu Diambil
                    </p>
                    <p class="col-auto text-nowrap border rounded-3 px-2 py-1 status-filter-bar">
                        Dipinjam
                    </p>
                    <p class="col-auto text-nowrap border rounded-3 px-2 py-1 status-filter-bar">
                        Dikembalikan
                    </p>
                </div>
                <div class="d-flex flex-column row-gap-3">

                    <?php foreach ($data_pinjam as $pinjam) : ?>
                        <div class="card">
                            <div class="card-header d-flex gap-2 flex-wrap">
                                <strong>Peminjaman </strong>
                                <span class="px-2 border-start border-end border-dark"><?= date('d M Y', strtotime($pinjam['created_at'])) ?></span>
                                <span><?= $pinjam['id'] ?></span>
                                <span class="d-flex align-items-center badge bg-<?= $pinjam['status_type'] ?>"> <?= $pinjam['status_message'] ?></span>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center row-gap-2">
                                    <div class="col-auto m-0 border-end">

                                        <?php foreach ($data_buku[$pinjam['id']] as $gambar) : ?>
                                            <img src="/upload/buku/<?= $gambar['sampul'] ?>" height="50" width="50" class="rounded-3" style="object-fit: cover;" alt="">
                                        <?php endforeach ?>

                                    </div>
                                    <div class="col border-end">

                                        <?php if ($pinjam['status'] == 'menunggu') : ?>
                                            <p class="m-0">Batas waktu pengambilan : <?= $pinjam['batas_ambil'] ?></p>
                                        <?php endif ?>
                                        <?php if ($pinjam['status'] == 'terpinjam') : ?>
                                            <p class="m-0">Batas waktu pengembalian : <?= $pinjam['tanggal_kembali'] ?></p>
                                            <p class="m-0">Batas waktu pengembalian : <?= $pinjam['batas_kembali'] ?></p>
                                        <?php endif ?>

                                    </div>
                                    <div class="col-auto">
                                        <small>Jumlah Pinjam</small>
                                        <h4 class="m-0 text-end"><?= $pinjam['jumlah_pinjam'] ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white d-flex gap-2 justify-content-end">
                                <a data-bs-idpinjam="<?= $pinjam['id'] ?>" data-bs-toggle="modal" data-bs-target="#hapus" class="btn border border-danger text-danger fw-semibold">Batal</a>
                                <a href="/pinjam/<?= $pinjam['id'] ?>" class="btn btn-primary fw-semibold">Detail</a>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusPinjam" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="/pinjam/" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Konfirmasi Pembatalan</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin membatalkan peminjaman ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Batal</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>