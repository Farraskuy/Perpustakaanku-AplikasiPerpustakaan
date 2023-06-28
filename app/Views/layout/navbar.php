<nav id="navbar" class="navbar fixed-top navbar-expand-lg bg-light" style="font-family: 'poppins';">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/home">
            <img src="/assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
            <span class="h4 m-0">Perpustakaanku</span>
        </a>

        <?php if (logged_in()) : ?>
            <a class="btn btn-primary ms-auto my-2 my-lg-0" href="/logout">Logout</a>
        <?php else : ?>
            <a class="btn btn-primary ms-auto my-2 my-lg-0" href="/login">Login</a>
        <?php endif ?>
    </div>
</nav>