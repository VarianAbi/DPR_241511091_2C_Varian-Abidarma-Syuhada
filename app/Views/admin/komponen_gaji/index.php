<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Komponen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Data Komponen Gaji</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Komponen Gaji</li>
            </ol>
        </nav>
        <hr>

        <div class="d-flex justify-content-between mb-3">
            <a href="<?= base_url('admin/komponen-gaji/new') ?>" class="btn btn-primary">Tambah Komponen Baru</a>
            <form action="" method="get" class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari data..." name="keyword" value="<?= $keyword ?? '' ?>">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
        </div>

        <?php if(session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                Daftar Komponen Gaji & Tunjangan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Komponen</th>
                                <th>Kategori</th>
                                <th>Jabatan</th>
                                <th>Nominal</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($komponen_gaji) && is_array($komponen_gaji)): ?>
                                <?php foreach($komponen_gaji as $row): ?>
                                    <tr>
                                        <td><?= esc($row['id_komponen_gaji']) ?></td>
                                        <td><?= esc($row['nama_komponen']) ?></td>
                                        <td><?= esc($row['kategori']) ?></td>
                                        <td><?= esc($row['jabatan']) ?></td>
                                        <td>Rp <?= number_format($row['nominal'], 2, ',', '.') ?></td>
                                        <td>Per-<?= esc($row['satuan']) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">Ubah</a>
                                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data komponen gaji.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>