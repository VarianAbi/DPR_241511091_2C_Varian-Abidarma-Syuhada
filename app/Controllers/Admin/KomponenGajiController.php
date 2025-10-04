<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    public function index()
    {
        echo "<h1>Halaman Daftar Komponen Gaji (Akan dibuat)</h1>";
        echo '<a href="' . base_url('admin/komponen-gaji/new') . '">Tambah Komponen Gaji</a>';
    }

    public function new()
    {
        return view('admin/komponen_gaji/create');
    }

    public function create()
    {
        $model = new KomponenGajiModel();

        // Aturan validasi DIPERBARUI di sini
        $rules = [
            'id_komponen_gaji' => 'required|is_unique[komponen_gaji.id_komponen_gaji]|numeric',
            'nama_komponen'    => 'required|max_length[100]',
            'kategori'         => 'required',
            'jabatan'          => 'required',
            'nominal'          => 'required|numeric',
            'satuan'           => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        // Pengambilan data DIPERBARUI di sini
        $data = [
            'id_komponen_gaji' => $this->request->getPost('id_komponen_gaji'),
            'nama_komponen'    => $this->request->getPost('nama_komponen'),
            'kategori'         => $this->request->getPost('kategori'),
            'jabatan'          => $this->request->getPost('jabatan'),
            'nominal'          => $this->request->getPost('nominal'),
            'satuan'           => $this->request->getPost('satuan'),
        ];

        $model->save($data);

        return redirect()->to('/admin/komponen-gaji')->with('message', 'Komponen gaji berhasil ditambahkan!');
    }
}