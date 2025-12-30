<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="padding-top: 65px;">
    <div class="my-4">
        <h4 class="mb-3">Koleksi Bukuku</h4>

        <?php if (empty($koleksi)): ?>
            <div class="alert alert-info text-center">
                Belum ada buku di koleksi kamu. <a href="/" class="alert-link">Cari buku sekarang</a>
            </div>
        <?php else: ?>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4 px-2">
                <?php foreach ($koleksi as $item): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm" style="text-decoration: none; cursor: pointer;">
                            <a href="/buku/<?= $item['slug'] ?>" class="text-decoration-none w-100 h-100 d-flex flex-column">
                                <img src="/upload/buku/<?= !empty($item['sampul']) ? $item['sampul'] : 'default.png' ?>"
                                    class="card-img-top p-2" style="height: 170px; object-fit: contain;">
                                <div class="card-body py-1 h-auto">
                                    <small class="text-secondary row g-0">
                                        <span class="wrap-text col-12 text-truncate"><?= $item['penulis'] ?></span>
                                    </small>
                                    <h6 class="text-dark card-title my-1 wrap-text judul text-truncate"><?= $item['judul'] ?>
                                    </h6>
                                </div>
                            </a>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-end">
                                <i onclick="toggleKoleksi('<?= $item['slug'] ?>', this)"
                                    class="fa-solid fa-bookmark fa-lg text-success" style="cursor: pointer;"
                                    data-bs-toggle="tooltip" data-bs-title="Hapus dari Koleksi"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection(); ?>