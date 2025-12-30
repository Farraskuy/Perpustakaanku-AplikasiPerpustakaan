<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid bg-white min-vh-100" style="padding-top: 65px;">

    <div class="container-lg">
        <div class="row justify-content-center py-4 g-0">
            <div class="col-md-4 col-xl-3 row flex-column align-items-center justify-content-center">
                <img src="/upload/buku/<?= !empty($buku['sampul']) ? $buku['sampul'] : 'default.png' ?>" class="w-100"
                    style=" height: 300px; object-fit: contain;">
            </div>
            <div class="col-md-7 col-xl-6 d-flex justify-content-center">
                <div class="container-fluid bg-white py-4">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="m-0"><?= $buku['judul'] ?></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <table class=" table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="ps-2 pe-3 py-1 ">Penulis</th>
                                        <td>: <?= isset($buku['penulis']) ? $buku['penulis'] : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th class="ps-2 pe-3 py-1 ">Penerbit</th>
                                        <td>: <?= isset($buku['penerbit']) ? $buku['penerbit'] : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th class="ps-2 pe-3 py-1 ">Tanggal Terbit</th>
                                        <td>:
                                            <?= isset($buku['tanggal_terbit']) ? date("d-m-Y", strtotime($buku['tanggal_terbit'])) : '-' ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row flex-column">
                        <div class="col">
                            <h6 class="fw-bold">Sinopsis</h6>
                            <p><?= isset($buku['sinopsis']) ? $buku['sinopsis'] : 'Sinopsis tidak tersedia' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-xl-3 position-sticky" style=" bottom: -30px; height: 150px;">
                <div class="card">
                    <div class="card-body">
                        <div class="d-none d-md-block">
                            <h6 class="card-title mb-3">Tertarik dengan buku ini?</h6>
                            <p>Ketersediaan Buku : <strong
                                    class="text-success"><?= isset($buku['stok']) ? $buku['stok'] : (isset($buku['jumlah_buku']) ? $buku['jumlah_buku'] : 0) ?></strong>
                            </p>
                        </div>

                        <div class="my-2 row px-3 gap-2 flex-nowrap">
                            <a onclick="toggleKoleksi('<?= $buku['slug'] ?>', this)"
                                class="col-2 p-1 btn text-success border border-success border-2 bookmark"
                                style="cursor: pointer;" data-bs-toggle="tooltip"
                                data-bs-title="<?= (isset($in_koleksi) && $in_koleksi) ? 'Hapus dari Koleksi' : 'Tambahkan Ke Koleksi' ?>">
                                <i
                                    class="<?= (isset($in_koleksi) && $in_koleksi) ? 'fa-solid' : 'fa-regular' ?> fa-bookmark"></i>
                            </a>
                            <?php if (logged_in()): ?>
                                <?php if (isset($terpinjam) && $terpinjam): ?>
                                    <div class="col btn-group p-0" role="group" aria-label="Basic example">
                                        <a
                                            class=" btn btn-success d-flex justify-content-center gap-2 align-items-center fs-6">Terpinjam</a>
                                        <a class=" btn border-success border-2 d-flex justify-content-center align-items-center fs-6 p-0"
                                            href="/pinjam" data-bs-toggle="tooltip" data-bs-title="Lihat Pinjaman"><i
                                                class="fa-solid fa-eye text-success"></i></a>
                                    </div>
                                <?php else: ?>
                                    <a class="col btn btn-success d-flex justify-content-center align-items-center fs-6"
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjam">Pinjam
                                        Sekarang</a>
                                <?php endif ?>

                            <?php else: ?>
                                <a href="/login"
                                    class="col btn btn-success d-flex justify-content-center align-items-center fs-6"
                                    class="btn btn-primary">Pinjam langsung</a>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal -->
<?php if (logged_in()): ?>
    <div class="modal fade" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <form method="post" action="/pinjam/<?= $buku['slug'] ?>" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Konfirmasi Peminjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-12 col-md-4">
                        <img src="/upload/buku/<?= !empty($buku['sampul']) ? $buku['sampul'] : 'default.png' ?>"
                            class="w-100" style="height: 200px; object-fit: contain;">
                    </div>
                    <div class="col-12 col-md-8">
                        <p>Kamu akan meminjam buku berjudul</p>
                        <p><strong><?= $buku['judul'] ?></strong></p>
                        <p>Batas peminjaman kamu : </p>
                        <p><strong
                                class="<?= isset($batas_pinjam) && $batas_pinjam == 0 ? 'text-danger' : '' ?>"><?= isset($batas_pinjam) ? $batas_pinjam : 0 ?></strong>
                            Buku</p>
                        <p class="small m-0">Catatan :</p>
                        <ul>
                            <li class="small">Kembalikan buku keperpustakaan untuk menambah batas peminjaman</li>
                            <li class="small">Pengambilan buku ke perpustakaan berlaku 2 hari setelah mengklik tombol pinjam
                            </li>
                            <li class="small">Batas peminjaman buku 7 hari setelah buku di ambil dari perpustakaan</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="me-auto text-danger">
                        <?= session()->getFlashdata('error_pinjam') ? session()->getFlashdata('error_pinjam') : '' ?>
                    </p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Pinjam</button>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>




<?= $this->endSection(); ?>