<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="padding-top: 65px;">
    <div class="my-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="/pinjam" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h4 class="m-0">Detail Peminjaman Buku</h4>
        </div>
        <div class="p-3 border rounded-3">
            <div class="row align-items-center mb-3 row-gap-2">
                <div class="col border-end">
                    <h6 class="mb-3">
                        <strong>No Peminjaman </strong>
                        <span class="border-start border-end px-2 mx-2"><?= $pinjam['id'] ?></span>
                        <span class="badge bg-<?= $pinjam['status_type'] ?>"><?= $pinjam['status_message'] ?></span>
                    </h6>
                    <?php if ($pinjam['status'] == 'menunggu') : ?>
                        <p class="m-0">Batas waktu pengambilan : <?= $pinjam['batas_ambil'] ?></p>
                    <?php endif ?>
                    <?php if ($pinjam['status'] == 'terpinjam') : ?>
                        <p class="m-0">Batas waktu pengembalian : <?= $pinjam['tanggal_kembali'] ?></p>
                        <p class="m-0">Batas waktu pengembalian : <?= $pinjam['batas_kembali'] ?></p>
                    <?php endif ?>
                </div>
                <div class="col-12 col-md-auto">
                    <h6 class="text-md-end">Jumlah Buku</h6>
                    <h4 class="text-md-end"><?= $pinjam['jumlah_pinjam'] ?></h4>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 px-2">
                <?php foreach ($buku as $item) : ?>
                    <div class="col">
                        <div class="card mb-3 p-3" style="max-width: 540px;">
                            <div class="row g-0 row-gap-3">
                                <div class="col-sm-4">
                                    <img src="/upload/buku/<?= $item['sampul'] ?>" class="h-100 w-100 rounded-start" style="max-height: 150px; object-fit: contain;" alt="...">
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body p-0 ps-3 h-100 d-flex flex-column justify-content-between row-gap-2">
                                        <div>
                                            <p class="d-flex justify-content-between m-0">Status <span class="d-flex align-items-center badge bg-<?= $pinjam['status_type'] ?>"><?= $pinjam['status_message'] ?></span></p>
                                            <hr class="my-2">
                                            <small class="text-secondary row g-0">
                                                <span class="wrap-text col-8"><?= $item['penerbit'] ?></span>
                                                <span class="col-4 d-flex justify-content-end">| <?= date('Y', strtotime($item['tanggal_terbit'])) ?></span>
                                            </small>
                                            <h1 class="text-dark card-title my-1 wrap-text judul fs-6"><?= $item['judul'] ?></h1>
                                            <small class="text-secondary fw-semibold wrap-text judul"><?= $item['penulis'] ?></small>
                                        </div>
                                        <div class="w-50 ms-auto d-flex justify-content-end" role="group" aria-label="Basic example">
                                            <!-- <a href="" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus dari list"><i class="fa-regular fa-square-minus" ></i></a> -->
                                            <a href="/buku/<?= $item['slug'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail"><i class="fa-regular fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>