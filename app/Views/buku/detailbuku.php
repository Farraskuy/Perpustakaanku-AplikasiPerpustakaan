<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-lg" style="padding-top: 65px; font-family: poppins; font-size: 14px;">
    <div class="row justify-content-center py-4 g-0">
        <div class="col-md-4 col-xl-3 row flex-column align-items-center justify-content-center">
            <img src="/upload/buku/<?= $buku['sampul'] ?>" class="w-100" style=" height: 300px; object-fit: contain;">
        </div>
        <div class="col-md-7 col-xl-6 d-flex justify-content-center">
            <div class="container-fluid bg-white py-4">
                <div class="row">
                    <div class="col-12">
                        <h4 class="m-0"><?= $buku['judul'] ?></h4>
                    </div>
                </div>
                <hr>
                <div class="rov">
                    <div class="col">
                        <table class=" table-borderless">
                            <tbody>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Penulis</th>
                                    <td>: <?= $buku['penulis'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Penerbit</th>
                                    <td>: <?= $buku['penerbit'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-2 pe-3 py-1 ">Tanggal Terbit</th>
                                    <td>: <?= date("d-m-Y", strtotime($buku['tanggal_terbit'])) ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row flex-column">
                    <div class="col">
                        <h6 class="fw-bold">Sinopsis</h6>
                        <p><?= $buku['sinopsis'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xl-3 position-sticky" style=" bottom: -30px; height: 150px;">
            <div class="card">
                <div class="card-body">
                    <div class="d-none d-md-block">
                        <h6 class="card-title mb-3">Tertarik dengan buku ini?</h6>
                    </div>

                    <div class="my-2 row px-3 gap-2 flex-nowrap">
                        <a href="#" class="col-2 p-1 btn text-green border border-green border-2 bookmark" data-bs-toggle="tooltip" data-bs-title="Tandai Buku"><i class="fa-regular fa-bookmark"></i></a>
                        <a class="col btn btn-green d-flex justify-content-center align-items-center fs-6" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjam">Pinjam langsung</a>
                    </div>
                    <small><a href="" class="text-green">Syarat dan ketentuan yang berlaku</a></small>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form method="post" action="/buku/pinjam/<?= $buku['slug'] ?>" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Konfirmasi Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-12 col-md-4">
                    <img src="/upload/buku/<?= $buku['sampul'] ?>" class="w-100" style="height: 200px; object-fit: contain;">
                </div>
                <div class="col-12 col-md-8">
                    <p>Kamu akan meminjam buku berjudul</p>
                    <p><strong><?= $buku['judul'] ?></strong></p>
                    <p>dengan batas peminjaman 7 hari dari buku di ambil dari perpustakaan</p>
                    <p>Kuota peminjaman buku kamu : </p>
                    <p><strong><?= $buku['judul'] ?></strong></p>
                    <p class="small">*kembalikan buku untuk menambah kuota peminjaman</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-green">Pinjam</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>