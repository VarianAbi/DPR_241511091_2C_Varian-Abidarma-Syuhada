<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
Dashboard Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Anggota DPR</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10 Anggota</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Komponen Gaji</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">22 Komponen</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-card-list fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Admin
                            </div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1 Pengguna</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-lock fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Admin Panel</h6>
                </div>
                <div class="card-body">
                    <p>Ini adalah pusat kendali untuk Aplikasi Perhitungan & Transparansi Gaji DPR. Dari sini, Anda dapat mengelola semua data penting.</p>
                    <p class="mb-0">Gunakan menu navigasi di atas untuk mulai mengelola data.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>