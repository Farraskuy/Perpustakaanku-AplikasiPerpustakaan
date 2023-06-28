<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body style="font-family: poppins; font-size: 14px;">

   <?= $this->include('layout/navbar') ;?>


    <div class="d-flex main">
        <div class="position-fixed bg-white pt-3 vh-100 shadow p-2 overflow-auto sidebar" style="z-index: 10; width: 15rem; ">

            <div class="" style="padding-top: 61px;">
                <div class="side-content px-4 nav-pills">
                    <div class="nav-item">
                        <a class="nav-link side-item <?= $navactive == 'admin' ? 'active' : '' ?> p-3 gap-3 " href="/">
                            <i class="fa-regular fa-house fs-5"></i> Dashboard
                        </a>
                    </div>
                </div>

                <hr class="mt-3">

                <div class="accordion side-content" id="accordionExample">
                    <div class="accordion-item border-0 ">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Data
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body pt-1">
                                <ul class="nav nav-pills flex-column gap-1">
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'petugas' ? 'active' : '' ?> gap-3 p-3" href="/admin/petugas"><i class="fa-regular fa-user-tie-hair fs-5"></i>Data Petugas</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'anggota' ? 'active' : '' ?> gap-3 p-3" href="/admin/anggota"><i class="fa-regular fa-square-star fs-5"></i> Data Anggota</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'buku' ? 'active' : '' ?> gap-3 p-3" href="/admin/buku"><i class="fa-regular fa-book fs-5"></i> Data Buku</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'peminjaman' ? 'active' : '' ?> gap-3 p-3" href="/admin/peminjaman"><i class="fa-regular fa-book-circle-arrow-right fs-5"></i>Data Peminjaman</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item <?= $navactive == 'pengembalian' ? 'active' : '' ?> gap-3 p-3" href="/admin/pengembalian"><i class="fa-regular fa-book-circle-arrow-up fs-5"></i>Data Pengembalian</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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