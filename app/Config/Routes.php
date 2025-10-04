<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index'); // Baris ini dihapus atau diberi komentar

// Rute untuk Login, Logout, dan Halaman Utama
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

// Rute placeholder untuk dashboard admin
$routes->get('admin/dashboard', function() {
    if (session()->get('logged_in') && session()->get('user_role') == 'Admin') {
        return '<h1>Selamat Datang, Admin!</h1><a href="'.base_url('logout').'">Logout</a>';
    }
    return redirect()->to('/login');
});