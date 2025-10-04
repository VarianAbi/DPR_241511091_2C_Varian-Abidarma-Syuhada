<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk Login, Logout, dan Halaman Utama
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');


// Grup untuk semua halaman ADMIN yang wajib login
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {

    $routes->get('dashboard', static function () {
        return '<h1>Selamat Datang di Dashboard, ' . session()->get('user_username') . '!</h1>
                <p><a href="' . base_url('admin/anggota') . '">Kelola Anggota</a></p>
                <p><a href="' . base_url('admin/komponen-gaji') . '">Kelola Komponen Gaji</a></p>
                <p><a href="' . base_url('admin/penggajian') . '">Kelola Penggajian</a></p> <a href="' . base_url('logout') . '">Logout</a>';
    });

    // Rute untuk fitur Anggota
    $routes->get('anggota', 'Admin\AnggotaController::index');
    $routes->get('anggota/new', 'Admin\AnggotaController::new');
    $routes->post('anggota/create', 'Admin\AnggotaController::create');
    $routes->get('anggota/edit/(:segment)', 'Admin\AnggotaController::edit/$1');
    $routes->put('anggota/update/(:segment)', 'Admin\AnggotaController::update/$1');
    $routes->delete('anggota/delete/(:segment)', 'Admin\AnggotaController::delete/$1');

    // Rute untuk fitur Komponen Gaji
    $routes->get('komponen-gaji', 'Admin\KomponenGajiController::index');
    $routes->get('komponen-gaji/new', 'Admin\KomponenGajiController::new');
    $routes->post('komponen-gaji/create', 'Admin\KomponenGajiController::create');
    $routes->get('komponen-gaji/edit/(:segment)', 'Admin\KomponenGajiController::edit/$1');
    $routes->put('komponen-gaji/update/(:segment)', 'Admin\KomponenGajiController::update/$1');
    $routes->delete('komponen-gaji/delete/(:segment)', 'Admin\KomponenGajiController::delete/$1');

    // RUTE BARU: untuk fitur Penggajian
    $routes->get('penggajian', 'Admin\PenggajianController::index');
    $routes->get('penggajian/new', 'Admin\PenggajianController::new');
    $routes->post('penggajian/create', 'Admin\PenggajianController::create');
});