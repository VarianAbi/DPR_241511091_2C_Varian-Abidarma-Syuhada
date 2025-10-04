<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    /**
     * Menampilkan daftar semua komponen gaji dengan fitur pencarian.
     */
    public function index()
    {
        $model = new KomponenGajiModel();
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            // Jika ada keyword pencarian, panggil method search
            $data['komponen_gaji'] = $model->search($keyword);
        } else {
            // Jika tidak ada, tampilkan semua data
            $data['komponen_gaji'] = $model->findAll();
        }

        $data['keyword'] = $keyword;

        return view('admin/komponen_gaji/index', $data);
    }

    /**
     * Menampilkan form untuk menambah komponen gaji baru.
     */
    public function new()
    {
        return view('admin/komponen_gaji/create');
    }

    /**
     * Memproses data dari form tambah komponen gaji.
     */
    public function create()
    {
        $model = new KomponenGajiModel();

        // Aturan validasi
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