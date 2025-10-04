<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> | Admin Gaji DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card.border-left-primary { border-left: .25rem solid #4e73df !important; }
        .card.border-left-success { border-left: .25rem solid #1cc88a !important; }
        .card.border-left-info { border-left: .25rem solid #36b9cc !important; }
        .text-gray-300 { color: #dddfeb !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">ADMIN PANEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/anggota') ?>">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/komponen-gaji') ?>">Komponen Gaji</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/penggajian') ?>">Penggajian</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('transparansi') ?>" target="_blank">Lihat Halaman Publik</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                     <li class="nav-item">
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout <i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $this->renderSection('content') ?>
    </div>

    <footer class="container text-center mt-5 mb-3 text-muted">
        <hr>
        &copy; 2025 Aplikasi Gaji DPR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>