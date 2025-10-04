<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */

// --- RUTE OTENTIKASI (Bisa diakses tanpa login) ---
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

// --- SEMUA RUTE LAINNYA WAJIB LOGIN ---
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    $routes->get('transparansi', 'PublicController::index');
    $routes->get('transparansi/detail/(:segment)', 'PublicController::detail/$1');

    $routes->group('admin', static function ($routes) {
        
        $routes->get('dashboard', static function () {
            return view('admin/dashboard'); // Diubah untuk memanggil view baru
        });

        // Anggota
        $routes->get('anggota', 'Admin\AnggotaController::index');
        $routes->get('anggota/new', 'Admin\AnggotaController::new');
        $routes->post('anggota/create', 'Admin\AnggotaController::create');
        $routes->get('anggota/edit/(:segment)', 'Admin\AnggotaController::edit/$1');
        $routes->put('anggota/update/(:segment)', 'Admin\AnggotaController::update/$1');
        $routes->delete('anggota/delete/(:segment)', 'Admin\AnggotaController::delete/$1');
        
        // Komponen Gaji
        $routes->get('komponen-gaji', 'Admin\KomponenGajiController::index');
        $routes->get('komponen-gaji/new', 'Admin\KomponenGajiController::new');
        $routes->post('komponen-gaji/create', 'Admin\KomponenGajiController::create');
        $routes->get('komponen-gaji/edit/(:segment)', 'Admin\KomponenGajiController::edit/$1');
        $routes->put('komponen-gaji/update/(:segment)', 'Admin\KomponenGajiController::update/$1');
        $routes->delete('komponen-gaji/delete/(:segment)', 'Admin\KomponenGajiController::delete/$1');
        
        // Penggajian
        $routes->get('penggajian', 'Admin\PenggajianController::index');
        $routes->get('penggajian/new', 'Admin\PenggajianController::new');
        $routes->post('penggajian/create', 'Admin\PenggajianController::create');
        $routes->delete('penggajian/delete/(:segment)/(:segment)', 'Admin\PenggajianController::delete/$1/$2');
    });
});