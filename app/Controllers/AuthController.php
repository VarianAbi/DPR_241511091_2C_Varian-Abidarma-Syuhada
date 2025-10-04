<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Menampilkan halaman login
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Buat session data
                $sessionData = [
                    'user_id'       => $user['id_pengguna'],
                    'user_username' => $user['username'],
                    'user_role'     => $user['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($sessionData);

                // Arahkan ke dashboard admin jika rolenya 'Admin'
                if ($user['role'] == 'Admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    // Jika ada role lain, bisa diatur di sini
                    return redirect()->to('/login')->with('error', 'Hanya Admin yang dapat login');
                }
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}