<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-lg" style="padding-top: 65px; font-family: poppins;">
    <div class="row justify-content-center py-4 px-sm-5 g-0">
        <div class="col-md-4 col-xl-3 row flex-column align-items-center justify-content-center">
            <div class="bg-white p-2 w-100 col-4" style="height: 400px;">
                <img src="/upload/buku/<?= $buku['sampul'] ?>" class="w-100 h-100" style="object-fit: contain;">
            </div>
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
        <div class="col-xl-3" style="height: 150px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tertarik dengan buku ini?</h5>
                    <p class="m-0">Booking buku untuk dipinjam atau dibaca dengan</p>
                    
                    <div class="my-2 row px-3 gap-2 flex-nowrap">
                        <a href="#" class="col-2 p-1 btn text-green border border-green border-2 bookmark" data-bs-toggle="tooltip" data-bs-title="Tandai Buku"><i class="bi bi-bookmark fs-5"></i></a>
                        <a href="/pinjam/<?= $buku['slug'] ?>" class="col btn btn-green d-flex justify-content-center align-items-center">Pinjam langsung</a>
                    </div>
                    <small><a href="" class="text-green">Syarat dan ketentuan yang berlaku</a></small>
                </div>
            </div>
        </div>


    </div>
</div>



<?= $this->endSection(); ?>