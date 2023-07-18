<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body style="font-family: poppins; font-size: 14px;">

    <?= $this->include('layout/navbar'); ?>

    <div class="d-flex main">

        <div class="position-fixed bg-white pt-3 vh-100 shadow p-2 overflow-auto sidebar" style="z-index: 10; width: 15rem; ">
            <div class="" style="padding-top: 61px;">
                <div class="side-content px-3 nav-pills">
                    <div class="nav-item">
                        <a class="nav-link side-item <?= $navactive == 'admin' ? 'active' : '' ?> p-3 gap-2 fw-semibold" href="/">
                            <i class="fa-regular fa-house fs-6"></i> Dashboard
                        </a>
                    </div>
                </div>

                <hr class="my-3 mb-0">

                <div class="accordion accordion-flush accordion-custom">
                    <div class="accordion-item">
                        <button class="accordion-button accordion-button-custom <?= !isset($inNavTransaksi) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#transaksi" aria-controls="transaksi" aria-expanded="false">
                            <small class="text-secondary fw-semibold" style="font-size: 12.5px;"><i class="fa-regular fa-arrow-right-arrow-left me-3 fs-6"></i>Transaksi</small>
                        </button>
                        <div id="transaksi" class="accordion-collapse collapse <?= isset($inNavTransaksi) ? 'show' : '' ?>">
                            <div class="accordion-body pb-2">
                                <ul class="nav nav-pills flex-column row-gap-2">
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'peminjaman' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/pinjam"><i class="fa-regular fa-book-circle-arrow-right fs-6"></i>Peminjaman</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'pengembalian' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/pengembalian"><i class="fa-regular fa-book-circle-arrow-up fs-6"></i>Pengembalian</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-button <?= !isset($inNavBuku) ? 'collapsed' : '' ?> accordion-button-custom" type="button" data-bs-toggle="collapse" data-bs-target="#data" aria-controls="data" aria-expanded="false">
                            <small class="text-secondary fw-semibold" style="font-size: 12.5px;"><i class="fa-regular fa-book fs-6 me-2"></i>Data Master Buku</small>
                        </button>
                        <div id="data" class="accordion-collapse collapse <?= isset($inNavBuku) ? 'show' : '' ?>">
                            <div class="accordion-body pb-2">
                                <ul class="nav nav-pills flex-column row-gap-2">
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'buku' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku"><i class="fa-regular fa-book-copy fs-6"></i>Data Buku</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'pengarang' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku/pengarang"><i class="fa-regular fa-pen-nib fs-6"></i>Pengarang</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'penerbit' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku/penerbit"><i class="fa-regular fa-file-arrow-up fs-6"></i>Penerbit</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'kategori' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku/kategori"><i class="fa-regular fa-bookmark"></i>Kategori</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'rak' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku/rak"><i class="fa-regular fa-shelves-empty fs-6"></i>Rak Buku</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-0">
                <ul class="nav nav-pills flex-column row-gap-2 p-3">
                    <small class="fw-semibold text-secondary">Data</small>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'petugas' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/petugas"><i class="fa-regular fa-user-tie-hair fs-6"></i>Data Petugas</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'anggota' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/anggota"><i class="fa-regular fa-square-star fs-6"></i> Data Anggota</a>
                    </li>
                </ul>
                <hr class="my-0">


                <hr class="mb-3 my-0">

                <?php if (in_groups('admin')) : ?>
                    <div class="side-content px-3 nav-pills">
                        <div class="nav-item my-2">
                            <a class="nav-link side-item <?= $navactive == 'informasi' ? 'active' : '' ?> p-3 gap-2 fw-semibold" href="/admin/informasi">
                                <i class="fa-regular fa-gear"></i><small>Informasi Perpustakaan</small>
                            </a>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>

        <div class="col-10 w-100 bg-light min-vh-100 konten" style="padding-left: 15rem; padding-top: 61px;">
            <div class="position-absolute h-25 bg-purple" style="right: 0; left: 0;"></div>
            <section class="p-5 position-relative">
                <div class="position-absolute px-5 d-flex justify-content-center" style="right: 0; left: 0; top: 0px; z-index: 2;" id="notifContainer"></div>
                <?= $this->renderSection('content'); ?>
            </section>
        </div>

    </div>

    <?= $this->include('layout/footer'); ?>
</body>

</html>