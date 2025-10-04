<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Data Anggota DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Ubah Data Anggota DPR</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/anggota') ?>">Anggota DPR</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
            </ol>
        </nav>
        <hr>

        <div class="card">
            <div class="card-header">
                Formulir Perubahan Data
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>
                <?php if ($validation->getErrors()): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/anggota/update/' . $anggota['id_anggota']) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT"> <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_anggota" class="form-label">ID Anggota (Tidak dapat diubah)</label>
                            <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?= esc($anggota['id_anggota']) ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select" id="jabatan" name="jabatan">
                                <option value="Ketua" <?= $anggota['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                                <option value="Wakil Ketua" <?= $anggota['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                                <option value="Anggota" <?= $anggota['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-md-2 mb-3">
                            <label for="gelar_depan" class="form-label">Gelar Depan</label>
                            <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= esc($anggota['gelar_depan']) ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>">
                        </div>
                         <div class="col-md-2 mb-3">
                            <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                            <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?= esc($anggota['gelar_belakang']) ?>">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                                <option value="Kawin" <?= $anggota['status_pernikahan'] == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                                <option value="Belum Kawin" <?= $anggota['status_pernikahan'] == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                                <option value="Cerai Hidup" <?= $anggota['status_pernikahan'] == 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                                <option value="Cerai Mati" <?= $anggota['status_pernikahan'] == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="<?= esc($anggota['jumlah_anak']) ?>" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="<?= base_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>