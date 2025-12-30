<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Anggota - <?= isset($anggota) ? $anggota['nama'] : 'Bulk' ?></title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
            padding: 20px;
        }

        .print-controls {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .print-controls button {
            padding: 10px 30px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin: 0 5px;
        }

        .btn-print {
            background: #6366f1;
            color: white;
        }

        .btn-back {
            background: #6b7280;
            color: white;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card-wrapper {
            page-break-inside: avoid;
        }

        .member-card {
            width: 85.6mm;
            height: 53.98mm;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 12px;
            padding: 12px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-logo {
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #6366f1;
            font-weight: bold;
        }

        .card-title {
            font-size: 12px;
            font-weight: 600;
        }

        .card-subtitle {
            font-size: 8px;
            opacity: 0.8;
        }

        .card-body {
            display: flex;
            gap: 12px;
        }

        .card-photo {
            width: 60px;
            height: 75px;
            background: white;
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .card-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-name {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .card-id {
            font-size: 10px;
            background: rgba(255, 255, 255, 0.2);
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 6px;
            font-family: monospace;
        }

        .card-detail {
            font-size: 8px;
            opacity: 0.9;
            line-height: 1.4;
        }

        .card-footer {
            position: absolute;
            bottom: 8px;
            left: 12px;
            right: 12px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .card-qr {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6px;
            color: #333;
        }

        .card-valid {
            font-size: 7px;
            text-align: right;
            opacity: 0.8;
        }

        .card-decoration {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .card-decoration-2 {
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .print-controls {
                display: none;
            }

            .cards-container {
                gap: 15px;
            }

            .member-card {
                box-shadow: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="print-controls">
        <button class="btn-print" onclick="window.print()">
            🖨️ Cetak Kartu
        </button>
        <button class="btn-back" onclick="window.close()">
            ← Tutup
        </button>
    </div>

    <div class="cards-container">
        <?php
        $members = isset($anggota) ? [$anggota] : $data;
        foreach ($members as $member):
            ?>
            <div class="card-wrapper">
                <div class="member-card">
                    <div class="card-decoration"></div>
                    <div class="card-decoration-2"></div>

                    <div class="card-header">
                        <div class="card-logo">📚</div>
                        <div>
                            <div class="card-title">PERPUSTAKAANKU</div>
                            <div class="card-subtitle">Kartu Anggota Perpustakaan</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-photo">
                            <img src="/upload/anggota/<?= $member['foto'] ?? 'default.png' ?>" alt="Foto">
                        </div>
                        <div class="card-info">
                            <div class="card-name"><?= strtoupper($member['nama']) ?></div>
                            <div class="card-id"><?= $member['id_anggota'] ?></div>
                            <div class="card-detail">
                                <?= $member['jenis_kelamin'] ?? '-' ?><br>
                                <?= $member['nomor_telepon'] ?? '-' ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="card-qr">
                            <div style="text-align:center;">
                                <div style="font-size:18px;">📱</div>
                                <div>QR</div>
                            </div>
                        </div>
                        <div class="card-valid">
                            Berlaku sejak<br>
                            <strong><?= date('d M Y', strtotime($member['created_at'] ?? 'now')) ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>