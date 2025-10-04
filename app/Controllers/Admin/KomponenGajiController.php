<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    public function index()
    {
        $model = new KomponenGajiModel();
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $data['komponen_gaji'] = $model->search($keyword);
        } else {
            $data['komponen_gaji'] = $model->findAll();
        }

        $data['keyword'] = $keyword;

        return view('admin/komponen_gaji/index', $data);
    }

    public function new()
    {
        return view('admin/komponen_gaji/create');
    }

    public function create()
    {
        $model = new KomponenGajiModel();
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

    public function edit($id = null)
    {
        $model = new KomponenGajiModel();
        $data['komponen'] = $model->find($id);

        if (empty($data['komponen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Komponen Gaji Tidak Ditemukan');
        }

        return view('admin/komponen_gaji/edit', $data);
    }

    public function update($id = null)
    {
        $model = new KomponenGajiModel();

        $rules = [
            'nama_komponen'  => 'required|max_length[100]',
            'kategori'       => 'required',
            'jabatan'        => 'required',
            'nominal'        => 'required|numeric',
            'satuan'         => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ];

        $model->update($id, $data);

        return redirect()->to('/admin/komponen-gaji')->with('message', 'Komponen gaji berhasil diperbarui!');
    }

    /**
     * FUNGSI BARU: Menghapus data komponen gaji.
     */
    public function delete($id = null)
    {
        $model = new KomponenGajiModel();
        $model->delete($id);

        return redirect()->to('/admin/komponen-gaji')->with('message', 'Komponen gaji berhasil dihapus!');
    }
}