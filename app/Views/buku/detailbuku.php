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
                        <p class="mb-3">Booking buku untuk dipinjam atau dibaca dengan</p>
                    </div>

                    <div class="my-2 row px-3 gap-2 flex-nowrap">
                        <a href="#" class="col-2 p-1 btn text-green border border-green border-2 bookmark" data-bs-toggle="tooltip" data-bs-title="Tandai Buku"><i class="fa-regular fa-bookmark"></i></a>
                        <a href="/pinjam/<?= $buku['slug'] ?>" class="col btn btn-green d-flex justify-content-center align-items-center fs-6">Pinjam langsung</a>
                    </div>
                    <small><a href="" class="text-green">Syarat dan ketentuan yang berlaku</a></small>
                </div>
            </div>
        </div>


    </div>
</div>



<?= $this->endSection(); ?>