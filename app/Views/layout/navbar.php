<nav id="navbar" class="navbar fixed-top navbar-expand-lg bg-light" style="font-family: 'poppins';">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/home">
            <img src="/assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
            <span class="h4 m-0">Perpustakaanku</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-pills flex-column flex-lg-row">
                    <li class="nav-item my-1 my-lg-0 ">
                        <a class="nav-link <?= $scrollSpy ? '' : 'text-dark' ?> " href="/home#header">Home</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0 ">
                        <a class="nav-link <?= $scrollSpy ? '' : 'text-dark' ?> " href="/home#layanan">Layanan</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0 ">
                        <a class="nav-link <?= $scrollSpy ? '' : 'text-dark' ?> " href="/home#buku">Buku</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0  pe-2">
                        <a class="nav-link <?= $scrollSpy ? '' : 'text-dark' ?> " href="/home#kontak">Kontak</a>
                    </li>
                    <li class="nav-item border-start border-4 ps-2 my-1 my-lg-0 ">
                        <a class="nav-link <?= $scrollSpy ? '' : 'text-dark' ?>" href="/pinjam">Pinjam Buku</a>
                    </li>
                </ul>
            <?php if (logged_in()) : ?>
                <a class="btn btn-primary ms-auto my-2 my-lg-0" href="/logout">Logout</a>
            <?php else : ?>
                <a class="btn btn-primary ms-auto my-2 my-lg-0" href="/login">Login</a>
            <?php endif ?>
        </div>
    </div>
</nav>