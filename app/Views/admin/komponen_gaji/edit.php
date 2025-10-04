<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Komponen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Ubah Komponen Gaji</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/komponen-gaji') ?>">Komponen Gaji</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
            </ol>
        </nav>
        <hr>

        <div class="card">
            <div class="card-header">
                Formulir Perubahan Komponen Gaji
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>
                <?php if ($validation->getErrors()): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/komponen-gaji/update/' . $komponen['id_komponen_gaji']) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">

                    <div class="mb-3">
                        <label for="id_komponen_gaji" class="form-label">ID Komponen (Tidak dapat diubah)</label>
                        <input type="text" class="form-control" id="id_komponen_gaji" value="<?= esc($komponen['id_komponen_gaji']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_komponen" class="form-label">Nama Komponen</label>
                        <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="Gaji Pokok" <?= $komponen['kategori'] == 'Gaji Pokok' ? 'selected' : '' ?>>Gaji Pokok</option>
                                <option value="Tunjangan Melekat" <?= $komponen['kategori'] == 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                                <option value="Tunjangan Lain" <?= $komponen['kategori'] == 'Tunjangan Lain' ? 'selected' : '' ?>>Tunjangan Lain</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                            <select class="form-select" id="jabatan" name="jabatan">
                                <option value="Semua" <?= $komponen['jabatan'] == 'Semua' ? 'selected' : '' ?>>Semua</option>
                                <option value="Ketua" <?= $komponen['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                                <option value="Wakil Ketua" <?= $komponen['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                                <option value="Anggota" <?= $komponen['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nominal" class="form-label">Nominal (Rp)</label>
                            <input type="number" step="0.01" class="form-control" id="nominal" name="nominal" value="<?= esc($komponen['nominal']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="satuan" name="satuan">
                                <option value="Bulan" <?= $komponen['satuan'] == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                                <option value="Periode" <?= $komponen['satuan'] == 'Periode' ? 'selected' : '' ?>>Periode</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Komponen</button>
                        <a href="<?= base_url('admin/komponen-gaji') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>