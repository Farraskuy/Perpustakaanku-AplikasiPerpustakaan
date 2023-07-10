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

                <hr class="my-3">

                <ul class="nav nav-pills flex-column row-gap-2 px-3">
                    <small class="fw-semibold text-secondary">Peminjaman</small>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'peminjaman' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/pinjam"><i class="fa-regular fa-book-circle-arrow-right fs-6"></i>Peminjaman</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'pengambilan' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/pengambilan"><i class="fa-regular fa-book-arrow-up fs-6"></i>Pengambilan Buku</a>
                    </li>
                </ul>

                <hr class="my-3">
                <ul class="nav nav-pills flex-column gap-1 px-3">
                    <small class="fw-semibold text-secondary">Data</small>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'petugas' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/petugas"><i class="fa-regular fa-user-tie-hair fs-6"></i>Data Petugas</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'anggota' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/anggota"><i class="fa-regular fa-square-star fs-6"></i> Data Anggota</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link side-item <?= $navactive == 'buku' ? 'active' : '' ?> gap-2 p-3 fw-semibold" href="/admin/buku"><i class="fa-regular fa-book fs-6"></i> Data Buku</a>
                    </li>
                </ul>

                <hr class="my-3">

            </div>
        </div>

        <div class="col-10 w-100 bg-light min-vh-100 konten" style="padding-left: 15rem; padding-top: 61px;">
            <div class="position-absolute h-25 bg-purple" style="right: 0; left: 0;"></div>
            <section class="p-5 position-relative">
                <div class="position-absolute px-5 d-flex justify-content-center" style="right: 0; left: 0; top: 0px" id="notifContainer"></div>
                <?= $this->renderSection('content'); ?>
            </section>
        </div>

    </div>

    <?= $this->include('layout/footer'); ?>
</body>

</html>