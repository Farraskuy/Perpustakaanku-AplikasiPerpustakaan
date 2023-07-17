<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h5 class="m-0">Data | <?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data <?= $subtitle ?></button>
        </div>
    </div>
</div>

<div class="bg-white rounded p-3 px-4 table-responsive ">
    <table class="table align-middle">
        <thead>
            <tr class="align-middle">
                <th scope="col">#</th>
                <th scope="col">Nomor Peminjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Petugas Pengembalian</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Batas Kembali</th>
                <th scope="col">Tanggal Dikembalikan</th>
                <th scope="col" class="fit">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td scope="row"><?= $i++ ?></td>
                    <td><?= $item['id_pengembalian'] ?></td>
                    <td><?= $item['nama_anggota'] ?></td>
                    <td><?= $item['nama_petugas'] ?></td>
                    <td><?= formatTanggal($item['tanggal_pinjam']) ?></td>
                    <td><?= formatTanggal($item['tanggal_kembali']) ?></td>
                    <td><?= formatTanggal($item['created_at']) ?></td>
                    <td class="fit aksi">
                        <a class="btn btn-primary" href="/admin/pengembalian/<?= $item['id_pengembalian'] ?>"><i class="fa-regular fa-eye"></i></a>
                        <button data-id="<?= $item['id_pengembalian'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"><i class="fa-regular fa-trash-xmark"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>

<!-- hapus modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="/admin/pengembalian/">

            <?= csrf_field() ?>

            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-xmark"></i> Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>


<!-- modal tambah pengembalian -->
<div class="modal fade form-modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                    <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">Form Pengembalian Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row g-0 w-100">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fa-regular fa-magnifying-glass"></i></span>
                            <input type="search" class="form-control" id="cariBuku" placeholder="Cari Buku, ID, judul, penulis, penerbit ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body position-relative p-0">

                <table class="table table-responsive align-middle">
                    <thead class="table-light position-sticky" style="top: 0; z-index: 2;">
                        <tr class="align-middle">
                            <th scope="col">#</th>
                            <th scope="col">Nomor Pengembalian</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Jumlah Buku</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        <?php foreach ($datapinjam as $item) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $item['id_pinjam'] ?></td>
                                <td><?= $item['nama_anggota'] ?></td>
                                <td><?= formatTanggal($item['created_at']) ?></td>
                                <td><?= formatTanggal($item['tanggal_kembali']) ?></td>
                                <td class="h6"><span class="badge bg-<?= $item['status_type'] ?>"><?= $item['status_message'] ?></span></td>
                                <td class="fit"><a href="/admin/pengembalian/kembali/<?= $item['id_pinjam'] ?>" class="btn btn-orange text-white fw-semibold"><i class="fa-regular fa-solid fa-reply-clock"></i> Kembalikan</a></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer justify-content-between">
                <p class="col text-danger"><?= session()->getFlashdata('error_pinjam_buku') ? session()->getFlashdata('error_pinjam_buku') : '' ?></p>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>