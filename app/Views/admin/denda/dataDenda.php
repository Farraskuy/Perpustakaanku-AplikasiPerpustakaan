<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<div class="bg-white rounded-3 p-3 px-4 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-3">
            <h5 class="m-0"><i class="fa-regular fa-money-bill-wave me-2"></i><?= $subtitle ?></h5>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
            <?php if (in_groups('admin')): ?>
                <a href="/admin/informasi" class="btn btn-outline-primary">
                    <i class="fa-regular fa-gear me-1"></i> Pengaturan Denda
                </a>
            <?php endif ?>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block mb-2">
                    <i class="fa-solid fa-coins fa-2x text-primary"></i>
                </div>
                <h6 class="text-muted mb-1">Total Denda</h6>
                <h4 class="mb-0 fw-bold text-primary">Rp <?= number_format($stats['total_denda'], 0, ',', '.') ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-block mb-2">
                    <i class="fa-solid fa-clock fa-2x text-warning"></i>
                </div>
                <h6 class="text-muted mb-1">Denda Keterlambatan</h6>
                <h4 class="mb-0 fw-bold text-warning">Rp <?= number_format($stats['denda_telat'], 0, ',', '.') ?></h4>
                <small class="text-muted"><?= $stats['pengembalian_telat'] ?> pengembalian telat</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 d-inline-block mb-2">
                    <i class="fa-solid fa-book-skull fa-2x text-danger"></i>
                </div>
                <h6 class="text-muted mb-1">Denda Kondisi Buku</h6>
                <h4 class="mb-0 fw-bold text-danger">Rp <?= number_format($stats['denda_kondisi'], 0, ',', '.') ?></h4>
                <small class="text-muted"><?= $stats['buku_rusak'] ?> rusak, <?= $stats['buku_hilang'] ?> hilang</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-block mb-2">
                    <i class="fa-solid fa-cog fa-2x text-info"></i>
                </div>
                <h6 class="text-muted mb-1">Tarif Denda</h6>
                <div class="small">
                    <div>Telat: <strong>Rp <?= number_format($config['denda_telat'] ?? 0, 0, ',', '.') ?>/hari</strong>
                    </div>
                    <div>Rusak: <strong>Rp <?= number_format($config['denda_rusak'] ?? 0, 0, ',', '.') ?></strong></div>
                    <div>Hilang: <strong>Rp <?= number_format($config['denda_hilang'] ?? 0, 0, ',', '.') ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Denda Table -->
<div class="bg-white rounded p-4 shadow-sm">
    <h6 class="mb-3"><i class="fa-regular fa-list me-2"></i>Riwayat Pengembalian dengan Denda</h6>

    <?php if (empty($data)): ?>
        <div class="text-center py-5">
            <i class="fa-regular fa-check-circle fa-4x text-success mb-3"></i>
            <h5 class="text-muted">Tidak ada denda</h5>
            <p class="text-muted">Semua pengembalian berjalan lancar tanpa denda.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>ID Pengembalian</th>
                        <th>Anggota</th>
                        <th>Tanggal Kembali</th>
                        <th>Keterangan</th>
                        <th>Total Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><code><?= $item['id_pengembalian'] ?></code></td>
                            <td><?= $item['nama_anggota'] ?></td>
                            <td><?= formatTanggal($item['created_at']) ?></td>
                            <td>
                                <?php if ($item['keterangan'] == 'terlambat'): ?>
                                    <span class="badge bg-danger">Terlambat</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Kondisi Buku</span>
                                <?php endif ?>
                            </td>
                            <td class="fw-bold text-danger">Rp <?= number_format($item['total_denda'], 0, ',', '.') ?></td>
                            <td>
                                <a href="/admin/pengembalian/<?= $item['id_pengembalian'] ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fa-regular fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection(); ?>