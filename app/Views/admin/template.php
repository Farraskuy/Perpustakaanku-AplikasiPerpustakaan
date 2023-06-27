<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body style="font-family: poppins;">

    <nav class="navbar fixed-top navbar-expand bg-white shadow">
        <div class="container-fluid px-5 d-flex justify-content-between">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="/assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
                <span class="h4 m-0">Perpustakaanku</span>
            </a>

            <div class="nav navbar-nav">
                <div class="ms-auto dropdown">
                    <a class="text-decoration-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                        <div style="height: 45px; width: 170px;" class="row g-0">
                            <div class="text-dark text-nowrap wrap-text col-9 d-flex flex-column">
                                <small class="p-0 m-0 fw-semibold"><?= user()->username ?></small>
                                <small class="p-0 m-0"><?= user()->getRoles()['1'] ?></small>
                            </div>
                            <div class="h-100 col-3 text-center">
                                <img style="object-fit: contain;" class="rounded-circle" height="40" width="40" src="/assets/img/logo.png" alt="">
                            </div>
                        </div>
                    </a>
                    <ul style="top: 50px;" class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
                        <li><a class="dropdown-item"><i class="fa-regular fa-user"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider m-1">
                        </li>
                        <li>
                            <?php if (logged_in()) : ?>
                                <a class="dropdown-item" href="/logout"><i class="fa-regular fa-right-from-bracket"></i> Logout</a>
                            <?php else : ?>
                                <a class="dropdown-item" href="/login"><i class="fa-regular fa-arrow-right-from-bracket"></i> Login</a>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>


    <div class="d-flex">
        <div class="position-fixed bg-white pt-3 vh-100 shadow p-2 overflow-auto" style="z-index: 10; width: 15rem; ">

            <div class="" style="padding-top: 61px;">
                <div class="side-content px-4 nav-pills">
                    <div class="nav-item">
                        <a class="nav-link side-item p-3 gap-3 " href="/">
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
                        <div id="collapseOne" class="accordion-collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body pt-1">
                                <ul class="nav nav-pills flex-column gap-1">
                                    <li class="nav-item ">
                                        <a class="nav-link side-item  gap-3 p-3" href="/admin/petugas"><i class="fa-regular fa-user-tie-hair fs-5"></i>Data Petugas</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item  gap-3 p-3" href="/admin/anggota"><i class="fa-regular fa-square-star fs-5"></i> Data Anggota</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item  gap-3 p-3" href="/admin/buku"><i class="fa-regular fa-book fs-5"></i> Data Buku</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item  gap-3 p-3" href="/admin/peminjaman"><i class="fa-regular fa-book-circle-arrow-right fs-5"></i>Data Peminjaman</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link side-item  gap-3 p-3" href="/admin/pengembalian"><i class="fa-regular fa-book-circle-arrow-up fs-5"></i>Data Pengembalian</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-10 w-100 bg-light min-vh-100" style="padding-left: 15rem; padding-top: 61px;">
            <div class="position-absolute h-25 bg-purple" style="right: 0; left: 0;"></div>
            <?= $this->renderSection('content'); ?>

        </div>
    </div>

    <?= $this->include('layout/footer'); ?>
</body>

</html>