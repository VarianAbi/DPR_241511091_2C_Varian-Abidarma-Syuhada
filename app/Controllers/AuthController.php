<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Jika sudah login, jangan tampilkan halaman login lagi
        if (session()->get('logged_in')) {
            if (session()->get('user_role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/transparansi');
            }
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Buat session data
                $sessionData = [
                    'user_id'       => $user['id_pengguna'],
                    'user_username' => $user['username'],
                    'user_role'     => $user['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($sessionData);

                // LOGIKA BARU: Arahkan berdasarkan role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($user['role'] === 'public') {
                    return redirect()->to('/transparansi');
                } else {
                    // Jika role tidak dikenal, default ke halaman login
                    return redirect()->to('/login')->with('error', 'Role tidak dikenal.');
                }

            } else {
                return redirect()->to('/login')->with('error', 'Password salah.');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}