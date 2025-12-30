<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="row g-4 mb-4">
    <!-- Welcome Banner -->
    <div class="col-12">
        <div class="bg-purple text-white rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Selamat Datang di Dashboard Admin</h4>
                    <p class="mb-0 opacity-75">Kelola perpustakaan dengan mudah dan efisien</p>
                </div>
                <i class="fa-solid fa-book-open-reader fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fa-solid fa-books fa-lg text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Total Buku</h6>
                        <h3 class="mb-0"><?= $stats['total_buku'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fa-solid fa-users fa-lg text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Anggota</h6>
                        <h3 class="mb-0"><?= $stats['total_anggota'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fa-solid fa-book-arrow-right fa-lg text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Pinjam Aktif</h6>
                        <h3 class="mb-0"><?= $stats['pinjam_aktif'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fa-solid fa-rotate-left fa-lg text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Pengembalian</h6>
                        <h3 class="mb-0"><?= $stats['total_pengembalian'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Denda Stats Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="bg-white rounded-3 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fa-regular fa-money-bill-wave me-2 text-danger"></i>Statistik Denda</h5>
                <a href="/admin/denda" class="btn btn-sm btn-outline-primary">Lihat Detail <i
                        class="fa-regular fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-primary text-white">
                        <h6 class="mb-1 opacity-75">Total Pendapatan Denda</h6>
                        <h3 class="mb-0 fw-bold">Rp <?= number_format($stats['total_denda'], 0, ',', '.') ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-warning bg-opacity-10">
                        <h6 class="text-muted mb-1">Denda Keterlambatan</h6>
                        <h4 class="text-warning mb-0">Rp <?= number_format($stats['denda_telat'], 0, ',', '.') ?></h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-danger bg-opacity-10">
                        <h6 class="text-muted mb-1">Denda Kondisi Buku</h6>
                        <h4 class="text-danger mb-0">Rp <?= number_format($stats['denda_kondisi'], 0, ',', '.') ?></h4>
                        <small class="text-muted"><?= $stats['buku_rusak'] ?> rusak, <?= $stats['buku_hilang'] ?>
                            hilang</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="bg-white rounded-3 shadow-sm p-4">
            <h5 class="mb-3"><i class="fa-regular fa-bolt me-2"></i>Aksi Cepat</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="/admin/pinjam" class="btn btn-outline-primary w-100 py-3">
                        <i class="fa-regular fa-book-circle-arrow-right fa-lg mb-2 d-block"></i>
                        Peminjaman
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/admin/pengembalian" class="btn btn-outline-success w-100 py-3">
                        <i class="fa-regular fa-book-circle-arrow-up fa-lg mb-2 d-block"></i>
                        Pengembalian
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/admin/buku" class="btn btn-outline-info w-100 py-3">
                        <i class="fa-regular fa-books fa-lg mb-2 d-block"></i>
                        Data Buku
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/admin/anggota" class="btn btn-outline-warning w-100 py-3">
                        <i class="fa-regular fa-users fa-lg mb-2 d-block"></i>
                        Data Anggota
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>