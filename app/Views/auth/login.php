<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/logo.png" type="image/gif">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <!-- home style -->
    <link rel="stylesheet" href="/assets/css/home.css">

    <!-- Google font poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

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
                                        <img src="/assets/img/logo.png" alt="Logo" width="40" height="40"
                                            class="d-inline-block align-text-top">
                                        <span class="h4 m-0 fs-5">Perpustakaanku | <?= lang('Auth.register') ?></span>
                                    </div>

                                    <?= view('Myth\Auth\Views\_message_block') ?>

                                    <form action="<?= url_to('login') ?>" method="post">
                                        <?= csrf_field() ?>


                                        <?php if ($config->validFields === ['email']): ?>
                                            <div class="form-group mb-4">
                                                <label for="login"><?= lang('Auth.email') ?></label>
                                                <input type="email"
                                                    class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                                                    name="login" placeholder="<?= lang('Auth.email') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group mb-4">
                                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                                <input type="text"
                                                    class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                                                    name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="form-group mb-4">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <input type="password" name="password"
                                                class="form-control  <?php if (session('errors.password')): ?>is-invalid<?php endif ?>"
                                                placeholder="<?= lang('Auth.password') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.password') ?>
                                            </div>
                                        </div>


                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-lg btn-purple btn-block fs-6" style="color: white;"
                                                type="submit"><?= lang('Auth.loginAction') ?></button>
                                        </div>

                                        <?php if ($config->activeResetter): ?>
                                            <!-- <a class="small" href="<?= url_to('forgot') ?>">Lupa Password?</a> -->
                                        <?php endif; ?>

                                        <div class="demo-credentials mt-4">
                                            <div class="demo-header d-flex align-items-center mb-3">
                                                <i class="bi bi-shield-check text-primary me-2 fs-5"></i>
                                                <span class="fw-semibold text-dark">Akun Demo</span>
                                                <span class="badge bg-primary bg-opacity-10 text-primary ms-2"
                                                    style="font-size: 0.7rem;">PRODUCTION</span>
                                            </div>

                                            <div class="demo-cards">
                                                <!-- Admin -->
                                                <div class="demo-card" onclick="fillCredentials('admin', 'admin123')"
                                                    style="cursor: pointer;">
                                                    <div class="demo-card-icon admin">
                                                        <i class="bi bi-person-gear"></i>
                                                    </div>
                                                    <div class="demo-card-content">
                                                        <div class="demo-role">Administrator</div>
                                                        <div class="demo-cred">admin / admin123</div>
                                                    </div>
                                                    <i class="bi bi-arrow-right-circle demo-arrow"></i>
                                                </div>

                                                <!-- Petugas -->
                                                <div class="demo-card"
                                                    onclick="fillCredentials('petugas', 'petugas123')"
                                                    style="cursor: pointer;">
                                                    <div class="demo-card-icon petugas">
                                                        <i class="bi bi-person-badge"></i>
                                                    </div>
                                                    <div class="demo-card-content">
                                                        <div class="demo-role">Petugas</div>
                                                        <div class="demo-cred">petugas / petugas123</div>
                                                    </div>
                                                    <i class="bi bi-arrow-right-circle demo-arrow"></i>
                                                </div>

                                                <!-- Anggota -->
                                                <div class="demo-card"
                                                    onclick="fillCredentials('anggota1', 'anggota123')"
                                                    style="cursor: pointer;">
                                                    <div class="demo-card-icon anggota">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                    <div class="demo-card-content">
                                                        <div class="demo-role">Anggota</div>
                                                        <div class="demo-cred">anggota1 / anggota123</div>
                                                    </div>
                                                    <i class="bi bi-arrow-right-circle demo-arrow"></i>
                                                </div>
                                            </div>

                                            <p class="text-muted text-center mt-2" style="font-size: 0.75rem;">
                                                <i class="bi bi-hand-index-thumb me-1"></i>Klik untuk mengisi otomatis
                                            </p>
                                        </div>

                                        <style>
                                            .demo-credentials {
                                                background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
                                                border-radius: 12px;
                                                padding: 16px;
                                                border: 1px solid rgba(99, 102, 241, 0.1);
                                            }

                                            .demo-cards {
                                                display: flex;
                                                flex-direction: column;
                                                gap: 8px;
                                            }

                                            .demo-card {
                                                display: flex;
                                                align-items: center;
                                                padding: 10px 12px;
                                                background: white;
                                                border-radius: 10px;
                                                border: 1px solid #e5e7eb;
                                                transition: all 0.2s ease;
                                            }

                                            .demo-card:hover {
                                                border-color: #6366f1;
                                                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
                                                transform: translateX(4px);
                                            }

                                            .demo-card-icon {
                                                width: 36px;
                                                height: 36px;
                                                border-radius: 8px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                margin-right: 12px;
                                                font-size: 1.1rem;
                                            }

                                            .demo-card-icon.admin {
                                                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                                                color: white;
                                            }

                                            .demo-card-icon.petugas {
                                                background: linear-gradient(135deg, #10b981, #059669);
                                                color: white;
                                            }

                                            .demo-card-icon.anggota {
                                                background: linear-gradient(135deg, #f59e0b, #d97706);
                                                color: white;
                                            }

                                            .demo-card-content {
                                                flex: 1;
                                            }

                                            .demo-role {
                                                font-weight: 600;
                                                font-size: 0.85rem;
                                                color: #1f2937;
                                            }

                                            .demo-cred {
                                                font-size: 0.75rem;
                                                color: #6b7280;
                                                font-family: 'Courier New', monospace;
                                            }

                                            .demo-arrow {
                                                color: #9ca3af;
                                                font-size: 1.1rem;
                                                transition: all 0.2s ease;
                                            }

                                            .demo-card:hover .demo-arrow {
                                                color: #6366f1;
                                                transform: translateX(3px);
                                            }
                                        </style>

                                        <script>
                                            function fillCredentials(username, password) {
                                                document.querySelector('input[name="login"]').value = username;
                                                document.querySelector('input[name="password"]').value = password;

                                                // Visual feedback
                                                const btn = document.querySelector('button[type="submit"]');
                                                btn.classList.add('btn-success');
                                                btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Siap Login!';

                                                setTimeout(() => {
                                                    btn.classList.remove('btn-success');
                                                    btn.innerHTML = '<?= lang("Auth.loginAction") ?>';
                                                }, 1500);
                                            }
                                        </script>



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