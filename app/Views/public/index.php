<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transparansi Gaji Anggota DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center p-3 mb-4 bg-light rounded-3">
            <div>
                <h1 class="display-5 fw-bold">Transparansi Gaji DPR RI</h1>
                <p class="col-md-8 fs-4">Rekapitulasi Take Home Pay (THP) bulanan setiap anggota dewan.</p>
            </div>
            <div>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Rekapitulasi Gaji dan Tunjangan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>Take Home Pay (Per Bulan)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($rekap_gaji) && is_array($rekap_gaji)): ?>
                                <?php $no = 1; ?>
                                <?php foreach($rekap_gaji as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= trim(esc($row['gelar_depan']) . ' ' . esc($row['nama_depan']) . ' ' . esc($row['nama_belakang']) . ', ' . esc($row['gelar_belakang']), ' ,') ?></td>
                                        <td><?= esc($row['jabatan']) ?></td>
                                        <td><strong>Rp <?= number_format($row['take_home_pay'], 2, ',', '.') ?></strong></td>
                                        <td>
                                            <a href="<?= base_url('transparansi/detail/' . $row['id_anggota']) ?>" class="btn btn-sm btn-info">Lihat Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data untuk ditampilkan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="my-4 text-center text-muted">
            <p>&copy; 2025 Aplikasi Gaji DPR</p>
        </footer>
    </div>
</body>
</html>