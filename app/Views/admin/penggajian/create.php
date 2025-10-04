<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Penggajian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Data Penggajian</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/penggajian') ?>">Penggajian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <hr>

        <div class="card">
            <div class="card-header">
                Formulir Penambahan Data Penggajian
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('admin/penggajian/create') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="id_anggota" class="form-label">Pilih Anggota DPR</label>
                        <select class="form-select" id="id_anggota" name="id_anggota" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach($anggota as $row): ?>
                                <option value="<?= $row['id_anggota'] ?>">
                                    <?= esc($row['nama_depan']) . ' ' . esc($row['nama_belakang']) ?> (<?= esc($row['jabatan']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <hr>
                    <h5>Pilih Komponen Gaji yang Akan Ditambahkan</h5>
                    <p class="text-muted">Pilih satu atau lebih komponen. Sistem akan otomatis menolak jika komponen sudah pernah ditambahkan ke anggota ini.</p>

                    <div class="row">
                        <?php foreach($komponen_gaji as $komponen): ?>
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="id_komponen[]" value="<?= $komponen['id_komponen_gaji'] ?>" id="komponen-<?= $komponen['id_komponen_gaji'] ?>">
                                <label class="form-check-label" for="komponen-<?= $komponen['id_komponen_gaji'] ?>">
                                    <?= esc($komponen['nama_komponen']) ?> (Rp <?= number_format($komponen['nominal']) ?>)
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Penggajian</button>
                        <a href="<?= base_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>