<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    public function index()
    {
        $model = new AnggotaModel();
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $data['anggota'] = $model->search($keyword);
        } else {
            $data['anggota'] = $model->findAll();
        }

        $data['keyword'] = $keyword;

        return view('admin/anggota/index', $data);
    }

    public function new()
    {
        return view('admin/anggota/create');
    }

    public function create()
    {
        $model = new AnggotaModel();
        $rules = [
            'id_anggota'    => 'required|is_unique[anggota.id_anggota]|max_length[10]',
            'nama_depan'    => 'required|alpha_space|max_length[50]',
            'nama_belakang' => 'permit_empty|alpha_space|max_length[50]',
            'jabatan'       => 'required',
            'jumlah_anak'   => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

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

        return redirect()->to('/admin/anggota')->with('message', 'Data anggota berhasil ditambahkan!');
    }

    /**
     * FUNGSI BARU: Menampilkan form untuk mengedit data.
     */
    public function edit($id = null)
    {
        $model = new AnggotaModel();
        $data['anggota'] = $model->find($id);

        if (empty($data['anggota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Anggota Tidak Ditemukan');
        }

        return view('admin/anggota/edit', $data);
    }

    /**
     * FUNGSI BARU: Memproses pembaruan data anggota.
     */
    public function update($id = null)
    {
        $model = new AnggotaModel();

        // Aturan validasi bisa sedikit berbeda, misalnya ID tidak perlu is_unique lagi
        $rules = [
            'nama_depan'    => 'required|alpha_space|max_length[50]',
            'nama_belakang' => 'permit_empty|alpha_space|max_length[50]',
            'jabatan'       => 'required',
            'jumlah_anak'   => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak'       => $this->request->getPost('jumlah_anak'),
        ];

        $model->update($id, $data);

        return redirect()->to('/admin/anggota')->with('message', 'Data anggota berhasil diperbarui!');
    }
}