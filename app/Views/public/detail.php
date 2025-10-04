<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Gaji: <?= esc($detail_gaji['info']['nama_depan']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('transparansi') ?>">Transparansi Gaji</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Anggota</li>
                </ol>
            </nav>
            <div>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h3>
                    <?= trim(esc($detail_gaji['info']['gelar_depan']) . ' ' . esc($detail_gaji['info']['nama_depan']) . ' ' . esc($detail_gaji['info']['nama_belakang']) . ', ' . esc($detail_gaji['info']['gelar_belakang']), ' ,') ?>
                </h3>
                <p class="mb-0 text-muted"><?= esc($detail_gaji['info']['jabatan']) ?> - ID: <?= esc($detail_gaji['info']['id_anggota']) ?></p>
            </div>
            <div class="card-body">
                <h4>Rincian Penerimaan (Per Bulan)</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Komponen</th>
                            <th>Kategori</th>
                            <th class="text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail_gaji['komponen'] as $komp): ?>
                            <tr>
                                <td><?= esc($komp['nama_komponen']) ?></td>
                                <td><?= esc($komp['kategori']) ?></td>
                                <td class="text-end">Rp <?= number_format($komp['nominal'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th colspan="2" class="text-end">Total Penerimaan Kotor</th>
                            <th class="text-end">Rp <?= number_format($detail_gaji['total_penerimaan'], 2, ',', '.') ?></th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Potongan PPh (<?= $detail_gaji['info']['jabatan'] == 'Ketua' ? '5%' : '15%' ?>)</td>
                            <td class="text-end text-danger">- Rp <?= number_format($detail_gaji['pph'], 2, ',', '.') ?></td>
                        </tr>
                        <tr class="table-dark">
                            <th colspan="2" class="text-end">Take Home Pay</th>
                            <th class="text-end">Rp <?= number_format($detail_gaji['take_home_pay'], 2, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="alert alert-info mt-3">
                    <strong>Catatan:</strong> Tunjangan anak berlaku untuk maksimal 2 anak.
                </div>
            </div>
        </div>
        <footer class="my-4 text-center text-muted">
            <p>&copy; 2025 Aplikasi Gaji DPR</p>
        </footer>
    </div>
</body>
</html>