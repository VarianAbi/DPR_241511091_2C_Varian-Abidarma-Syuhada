<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Anggota DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Data Anggota DPR</h1>
            <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Anggota DPR</li>
            </ol>
        </nav>
        <hr>

        <div class="d-flex justify-content-between mb-3">
            <a href="<?= base_url('admin/anggota/new') ?>" class="btn btn-primary">Tambah Anggota Baru</a>
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
                Daftar Anggota
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID Anggota</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>Status Pernikahan</th>
                                <th>Jumlah Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($anggota) && is_array($anggota)): ?>
                                <?php foreach($anggota as $row): ?>
                                    <tr>
                                        <td><?= esc($row['id_anggota']) ?></td>
                                        <td><?= trim(esc($row['gelar_depan']) . ' ' . esc($row['nama_depan']) . ' ' . esc($row['nama_belakang']) . ', ' . esc($row['gelar_belakang']), ' ,') ?></td>
                                        <td><?= esc($row['jabatan']) ?></td>
                                        <td><?= esc($row['status_pernikahan']) ?></td>
                                        <td><?= esc($row['jumlah_anak']) ?></td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('admin/anggota/edit/' . $row['id_anggota']) ?>" class="btn btn-sm btn-warning me-1">Ubah</a>

                                            <form action="<?= base_url('admin/anggota/delete/' . $row['id_anggota']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data anggota.</td>
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