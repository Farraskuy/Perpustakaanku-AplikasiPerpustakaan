<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/logo.png" type="image/gif">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <!-- home style -->
    <link rel="stylesheet" href="/assets/css/home.css">

    <!-- Google font poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <title><?= lang('Auth.register') ?></title>
</head>

<body class="bg-light">

    <section class="vh-100 bg-light">
        <div class="container py-5 h-100" style="font-family: poppins;">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col col-md-9">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0 align-items-center">
                            <!-- gambar -->
                            <div class="col-md-6 d-none d-lg-block p-lg-5">
                                <img src="/assets/img/buku.png" alt="login form" class="img-fluid p-5" />
                            </div>

                            <div class="col-lg-6 p-2 p-sm-4 p-md-3">
                                <div class="card-body text-black">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="/assets/img/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                                        <span class="h4 m-0 fs-5">Perpustakaanku | <?= lang('Auth.register') ?></span>
                                    </div>

                                    <?= view('Myth\Auth\Views\_message_block') ?>

                                    <form action="<?= url_to('login') ?>" method="post">
                                        <?= csrf_field() ?>


                                        <?php if ($config->validFields === ['email']) : ?>
                                            <div class="form-group mb-4">
                                                <label for="login"><?= lang('Auth.email') ?></label>
                                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="form-group mb-4">
                                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="form-group mb-4">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.password') ?>
                                            </div>
                                        </div>


                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-lg btn-purple btn-block fs-6" style="color: white;" type="submit"><?= lang('Auth.loginAction') ?></button>
                                        </div>

                                        <?php if ($config->activeResetter) : ?>
                                            <a class="small" href="<?= url_to('forgot') ?>">Lupa Password?</a>
                                        <?php endif; ?>
                                       


                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>