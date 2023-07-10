<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="padding-top: 65px;">
    <div class="my-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="/pinjam" class="btn bg-white border border-3"><i class="fa-regular fa-arrow-left fa-lg"></i></a>
            <h4 class="m-0">Detail Peminjaman Buku</h4>
        </div>
        <div class="p-3 border rounded-3">
            <h6 class="mb-3"><strong class="border-end pe-2 me-2">No Peminjaman </strong> saduyg284y8rfiw4234 <span class="badge bg-warning">Menunggu Diambil</span></h6>
            <p>Maximal pengambilan tanggal : 12839621</p>
            <p>Jumlah buku : 12839621</p>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4 px-2">


                <div class="col">
                    <div class="card h-100" style=" text-decoration: none; cursor: pointer;">
                        <a href="/buku/<?= "" ?>" class="text-decoration-none w-100 h-100 d-flex flex-column">
                            <img src="/upload/buku/<?= "" ?>" class="card-img-top p-2" style="height: 170px; object-fit: contain;">
                            <div class="card-body py-1 h-auto">
                                <small class="text-secondary row g-0">
                                    <span class="wrap-text col-8"><?= "['penerbit']" ?></span>
                                    <span class="col-4 d-flex justify-content-end">| <?= "" ?></span>
                                </small>
                                <h1 class="text-dark card-title my-1 wrap-text judul fs-6"><?= "['judul'] " ?></h1>
                                <small class="text-secondary fw-semibold wrap-text judul"><?= "['penulis']" ?></small>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <i class="fa-regular fa-bookmark fa-sm py-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tandai Buku"></i>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>