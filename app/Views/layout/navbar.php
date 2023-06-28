<nav class="navbar fixed-top navbar-expand bg-white shadow">
    <div class="<?= in_groups('admin') ? 'container-fluid px-5 d-flex justify-content-between' : 'container' ?>">
        <div class="d-flex gap-3">
            <?php if (in_groups('admin')) : ?>
                <button class="btn text-purple" type="button" onclick="toggleSidebar()"><i class="fa-solid fa-bars fa-lg"></i></button>
            <?php endif ?>
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="/assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
                <span class="h5 fs-5 m-0">Perpustakaanku</span>
            </a>
        </div>

        <div class="nav navbar-nav">
            <div class="ms-auto dropdown">
                <a class="text-decoration-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                    <div style="height: 45px; width: 170px;" class="row g-0">
                        <div class="text-dark text-nowrap wrap-text col-9 d-flex flex-column justify-content-center">
                            <small class="p-0 m-0 fw-semibold"><?= isset($username) ? $username : 'Guest' ?></small>
                            <?php if (isset($role)) : ?>
                                <small class="p-0 m-0"><?= $role ?></small>
                            <?php endif ?>
                        </div>
                        <div class="h-100 col-3 text-center">
                            <img style="object-fit: cover;" class="rounded-circle" height="40" width="40" src="/upload/petugas/<?= isset($foto) ? $foto : 'default.png' ?>" alt="">
                        </div>
                    </div>
                </a>
                <ul style="top: 50px;" class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
                    <li><a class="dropdown-item small"><i class="fa-regular fa-user"></i> Profile</a></li>
                    <li>
                        <hr class="dropdown-divider m-1">
                    </li>
                    <li>
                        <?php if (logged_in()) : ?>
                            <a class="dropdown-item small" href="/logout"><i class="fa-regular fa-right-from-bracket"></i> Logout</a>
                        <?php else : ?>
                            <a class="dropdown-item small" href="/login"><i class="fa-regular fa-arrow-right-from-bracket"></i> Login</a>
                        <?php endif ?>
                    </li>
                </ul>
            </div>

        </div>
    </div>

</nav>