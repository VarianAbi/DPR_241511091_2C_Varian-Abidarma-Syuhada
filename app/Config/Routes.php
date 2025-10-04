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
        return '<h1>Selamat Datang di Dashboard, ' . session()->get('user_username') . '!</h1><a href="' . base_url('logout') . '">Logout</a>';
    });

    // Rute untuk fitur Anggota
    $routes->get('anggota', 'Admin\AnggotaController::index');
    $routes->get('anggota/new', 'Admin\AnggotaController::new');
    $routes->post('anggota/create', 'Admin\AnggotaController::create');
    $routes->get('anggota/edit/(:segment)', 'Admin\AnggotaController::edit/$1'); // RUTE BARU
    $routes->put('anggota/update/(:segment)', 'Admin\AnggotaController::update/$1'); // RUTE BARU
});