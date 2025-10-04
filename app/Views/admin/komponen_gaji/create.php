<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Komponen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Komponen Gaji Baru</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/komponen-gaji') ?>">Komponen Gaji</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <hr>

        <div class="card">
            <div class="card-header">
                Formulir Penambahan Komponen Gaji
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>
                <?php if ($validation->getErrors()): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/komponen-gaji/create') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="id_komponen_gaji" class="form-label">ID Komponen</label>
                        <input type="number" class="form-control" id="id_komponen_gaji" name="id_komponen_gaji" value="<?= old('id_komponen_gaji') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_komponen" class="form-label">Nama Komponen</label>
                        <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= old('nama_komponen') ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="Gaji Pokok" <?= old('kategori') == 'Gaji Pokok' ? 'selected' : '' ?>>Gaji Pokok</option>
                                <option value="Tunjangan Melekat" <?= old('kategori') == 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                                <option value="Tunjangan Lain" <?= old('kategori') == 'Tunjangan Lain' ? 'selected' : '' ?>>Tunjangan Lain</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                            <select class="form-select" id="jabatan" name="jabatan">
                                <option value="Semua" <?= old('jabatan') == 'Semua' ? 'selected' : '' ?>>Semua</option>
                                <option value="Ketua" <?= old('jabatan') == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                                <option value="Wakil Ketua" <?= old('jabatan') == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                                <option value="Anggota" <?= old('jabatan') == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nominal" class="form-label">Nominal (Rp)</label>
                            <input type="number" step="0.01" class="form-control" id="nominal" name="nominal" value="<?= old('nominal') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="satuan" name="satuan">
                                <option value="Bulan" <?= old('satuan') == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                                <option value="Periode" <?= old('satuan') == 'Periode' ? 'selected' : '' ?>>Periode</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Komponen</button>
                        <a href="<?= base_url('admin/komponen-gaji') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>