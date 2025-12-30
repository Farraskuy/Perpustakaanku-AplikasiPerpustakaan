<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>
<section id="header" class="header h-auto" style="padding-top: 65px; font-family: poppins;">

    <div class="container text-black px-5 h-100">
        <div class="row px-md-5 h-100">
            <div class="col-12 col-md-7 d-flex flex-column pt-5 justify-content-start justify-content-md-center">
                <h1 class="fs-4" style="width: fit-content;">Selamat datang di Aplikasi Perpustakaanku!</h1>
                <p class="fs-6">
                    Aplikasi ini dibuat untuk mempermudah dan mempercepat pengelolaan, peminjaman, dan pengembalian buku
                </p>
                <a href="#layanan" type="button" class="btn btn-primary w-50 mw-25">Mulai jelajahi</a>
            </div>
            <div class="col-12 col-md-5 d-none d-md-flex align-items-center h-100">
                <img src="/assets/img/buku.png" class="float-end mh-100 w-100 p-5" alt="buku">
            </div>
        </div>
    </div>
</section>
<section id="layanan" class="layanan" style="padding-top: 65px; font-family: poppins;">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="fs-5 border-bottom border-secondary border-3 " style="width: fit-content;">Pengguna Baru?</h1>
            <p class="text-center mb-4 fs-6">Coba lihat langkah-langkah dibawah ini!</p>
        </div>
        <div class="row gap-3 justify-content-center text-center fs-6">
            <div class=" col-8 col-md-5 col-lg-4 col-xl-3  p-3 border border-2 rounded-3 item">
                <img src="/assets/img/member.png" alt="member">
                <p class="mt-3 fw-semibold">Cara Daftar Keanggotaan</p>
                <p class="mt-3 fs-6 text-secondary">Daftar Keanggotaan untuk dapat menikmati fasilitas di <span
                        class="fw-semibold">perpustakaanku</span></p>
            </div>
            <div class=" col-8 col-md-5 col-lg-4 col-xl-3  p-3 border border-2 rounded-3 item">
                <img src="/assets/img/pinjam.png" alt="member">
                <p class="mt-3 fw-semibold">Cara Pinjam Buku</p>
                <p class="mt-3 fs-6 text-secondary">Pinjam buku-buku baru untuk dibaca dalam batas waktu tertentu
                    dirumah</p>
            </div>
            <div class=" col-8 col-md-5 col-lg-4 col-xl-3 p-3  border border-2 rounded-3 item">
                <img src="/assets/img/kembalikan.png" alt="member">
                <p class="mt-3 fw-semibold">Cara Kembalikan Buku</p>
                <p class="mt-3 fs-6 text-secondary">Kembalikan buku yang telah di pinjam tepat waktu untuk meminjam buku
                    lainnya</p>
            </div>
        </div>
    </div>
</section>

<section id="buku" class="buku mb-4" style="padding-top: 65px; font-family: poppins;">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <h1 class="fs-5 border-bottom border-secondary border-3" style="width: fit-content;">Buku</h1>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4 px-2">

            <?php foreach ($buku as $item): ?>
                <div class="col">
                    <div class="card h-100" style=" text-decoration: none; cursor: pointer;">
                        <a href="/buku/<?= $item['slug'] ?>" class="text-decoration-none w-100 h-100 d-flex flex-column">
                            <img src="/upload/buku/<?= !empty($item['sampul']) ? $item['sampul'] : 'default.png' ?>"
                                class="card-img-top p-2" style="height: 170px; object-fit: contain;">
                            <div class="card-body py-1 h-auto">
                                <small class="text-secondary row g-0">
                                    <span class="wrap-text col-8"><?= $item['penerbit'] ?></span>
                                    <span class="col-4 d-flex justify-content-end">|
                                        <?= date('Y', strtotime($item['tanggal_terbit'])) ?></span>
                                </small>
                                <h1 class="text-dark card-title my-1 wrap-text judul fs-6"><?= $item['judul'] ?></h1>
                                <small class="text-secondary fw-semibold wrap-text judul"><?= $item['penulis'] ?></small>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <i class="fa-regular fa-bookmark fa-sm py-2" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Tandai Buku"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>
</section>

<footer id="kontak" class="container-fluid text-center text-lg-start bg-light text-muted"
    style="font-family: poppins; font-size: 14px;">
    <div class="container">

        <!-- head footer -->
        <section class="d-flex justify-content-center justify-content-lg-between p-3 border-bottom">
            <div class="me-5 d-none d-lg-flex align-items-center">
                <span>Kontak</span>
            </div>
            <div>
                <a href="" class="me-4 text-decoration-none link-secondary">
                    <i class="bi bi-instagram fs-5"></i>
                </a>
                <a href="" class="me-4 text-decoration-none link-secondary">
                    <i class="bi bi-linkedin fs-5"></i>
                </a>
                <a href="https://github.com/Farraskuy" class="me-4 text-decoration-none link-secondary">
                    <i class="bi bi-github fs-5"></i>
                </a>
            </div>
        </section>

        <!-- body footer -->
        <section class="container text-center text-md-start mt-5">

            <!-- baris -->
            <div class="row mt-3">
                <!-- kolom about -->
                <div class="col-md-12 col-lg-4 col-xl-3 mx-auto mb-4">
                    <a class="text-secondary text-decoration-none mb-2 d-flex align-items-center gap-2" href="/home">
                        <img src="/assets/img/logo.png" alt="Logo" width="35" height="35"
                            class="d-inline-block align-text-top">
                        <span class="h4 m-0">Perpustakaanku</span>
                    </a>
                    <p>
                        Perpustakaanku adalah aplikasi yang mempermudah
                        pengelolaan perpustakaan secara praktis dan cepat,
                        Sehingga dapat memaksimalkan waktu yang dimiliki
                    </p>
                </div>

                <!-- kolom layanan -->
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">

                    <h6 class="text-uppercase fw-bold mb-4">
                        Layanan
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Daftar keanggotaan</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Pinjam buku</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Kembalikan buku</a>
                    </p>
                </div>

                <!-- kolom kontak -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 d-flex flex-column align-items-center">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                    <p class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-at fs-4"></i>
                        farrasfadhil06@gmail.com
                    </p>
                    <p class="d-flex align-items-center gap-2 me-4 mb-3 ">
                        <i class="bi bi-linkedin fs-4"></i>
                        -
                    </p>
                    <p class="d-flex align-items-center gap-2">
                        <i class="bi bi-whatsapp me-3 fs-4 text-secondary"></i>
                        087733887683
                    </p>
                </div>

                <!-- kolom sumber daya -->
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4 text-md-end text-lg-center">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Sumber Daya
                    </h6>
                    <p>
                        Icon :
                        <a href="https://icons8.com/" class="text-reset">Icons8</a>
                    </p>
                </div>

            </div>
        </section>

        <!-- copyright -->
        <div class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="https://github.com/Farraskuy" target="_blank">Farraskuy</a>
        </div>
    </div>

</footer>

<?= $this->endSection(); ?>