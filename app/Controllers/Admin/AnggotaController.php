<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    /**
     * Menampilkan daftar semua anggota.
     * Akan kita lengkapi di commit berikutnya.
     */
    public function index()
    {
        // TODO: Tulis logika untuk menampilkan data di sini
        echo "<h1>Halaman Daftar Anggota (Akan dibuat)</h1>";
        echo '<a href="' . base_url('admin/anggota/new') . '">Tambah Anggota Baru</a>';
    }

    /**
     * Menampilkan form untuk menambah data anggota baru.
     */
    public function new()
    {
        return view('admin/anggota/create');
    }

    /**
     * Memproses data dari form tambah anggota.
     */
    public function create()
    {
        $model = new AnggotaModel();

        // Aturan validasi untuk form
        $rules = [
            'id_anggota'    => 'required|is_unique[anggota.id_anggota]|max_length[10]',
            'nama_depan'    => 'required|alpha_space|max_length[50]',
            'nama_belakang' => 'permit_empty|alpha_space|max_length[50]',
            'jabatan'       => 'required',
            'jumlah_anak'   => 'required|numeric'
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan pesan error
            // Pesan error akan otomatis ditampilkan oleh view
            return redirect()->back()->withInput();
        }

        // Jika validasi berhasil, kumpulkan data dan simpan
        $data = [
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak'       => $this->request->getPost('jumlah_anak'),
        ];

        $model->save($data);

        // Arahkan kembali ke halaman daftar anggota dengan pesan sukses
        return redirect()->to('/admin/anggota')->with('message', 'Data anggota berhasil ditambahkan!');
    }
}