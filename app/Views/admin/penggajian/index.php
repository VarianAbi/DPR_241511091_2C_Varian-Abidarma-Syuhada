<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Penggajian Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Data Penggajian Anggota DPR</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penggajian</li>
            </ol>
        </nav>
        <hr>
        <a href="<?= base_url('admin/penggajian/new') ?>" class="btn btn-primary mb-3">Tambah Data Penggajian</a>
        <?php if(session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($penggajian)): ?>
            <?php foreach($penggajian as $id_anggota => $data): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <?= esc($data['info']['nama_depan'] . ' ' . $data['info']['nama_belakang']) ?> 
                        <small class="text-muted">(<?= esc($data['info']['id_anggota']) ?> - <?= esc($data['info']['jabatan']) ?>)</small>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Nama Komponen</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['komponen'] as $komponen): ?>
                            <tr>
                                <td><?= esc($komponen['nama_komponen']) ?></td>
                                <td><?= esc($komponen['kategori']) ?></td>
                                <td>Rp <?= number_format($komponen['nominal'], 2, ',', '.') ?></td>
                                <td>
                                    <form action="<?= base_url('admin/penggajian/delete/' . $komponen['id_anggota'] . '/' . $komponen['id_komponen_gaji']) ?>" method="post" onsubmit="return confirm('Anda yakin ingin menghapus komponen ini dari anggota tersebut?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                Belum ada data penggajian yang ditambahkan.
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>