<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="padding-top: 65px;">
    <div class="my-4">
        <h4 class="mb-3">Profil Anggota</h4>

        <div class="row g-4">
            <!-- Biodata Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <img src="/upload/anggota/<?= !empty($anggota['foto']) ? $anggota['foto'] : 'default.png' ?>"
                            class="rounded-circle mb-3" width="120" height="120"
                            style="object-fit: cover; border: 4px solid #f8f9fa;">
                        <h5><?= $anggota['nama'] ?></h5>
                        <p class="text-muted"><?= $anggota['id_anggota'] ?></p>
                        <hr>
                        <div class="text-start">
                            <p class="mb-1 small text-secondary">Email/Username</p>
                            <p class="fw-semibold"><?= user()->username ?></p>
                            <!-- Assuming Myth:Auth user() helper available -->

                            <p class="mb-1 small text-secondary">Nomor Telepon</p>
                            <p class="fw-semibold"><?= $anggota['nomor_telepon'] ?></p>

                            <p class="mb-1 small text-secondary">Alamat</p>
                            <p class="fw-semibold"><?= $anggota['alamat'] ?></p>

                            <p class="mb-1 small text-secondary">Sisa Kuota Pinjam</p>
                            <p class="fw-semibold text-primary"><?= $anggota['batas_pinjam'] ?> Buku</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats & History -->
            <div class="col-lg-8">
                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 bg-primary text-white h-100">
                            <div class="card-body">
                                <h6>Pinjaman Aktif</h6>
                                <h2><?= $stats['pinjam_aktif'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-success text-white h-100">
                            <div class="card-body">
                                <h6>Total Dikembalikan</h6>
                                <h2><?= $stats['total_kembali'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-danger text-white h-100">
                            <div class="card-body">
                                <h6>Total Denda Terbayar</h6>
                                <h2>Rp <?= number_format($stats['total_denda'], 0, ',', '.') ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="m-0">Riwayat Aktivitas Terakhir</h6>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($history['pengembalian'])): ?>
                            <div class="p-4 text-center text-muted">Belum ada riwayat peminjaman</div>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php foreach (array_slice($history['pengembalian'], 0, 5) as $item): ?>
                                    <a href="/pinjam/<?= $item['id_pengembalian'] ?>"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Pengembalian Buku (<?= $item['jumlah_buku'] ?> buku)</h6>
                                                <small
                                                    class="text-muted"><?= date('d M Y H:i', strtotime($item['created_at'])) ?>
                                                    | ID: <?= $item['id_pengembalian'] ?></small>
                                            </div>
                                            <div class="text-end">
                                                <?php if ($item['total_denda'] > 0): ?>
                                                    <span class="badge bg-danger rounded-pill">Denda: Rp
                                                        <?= number_format($item['total_denda'], 0, ',', '.') ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-success rounded-pill">Selesai</span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <?php if (count($history['pengembalian']) > 5): ?>
                                <div class="p-2 text-center border-top">
                                    <a href="/pinjam" class="text-decoration-none small">Lihat Semua di Menu Pinjaman</a>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>