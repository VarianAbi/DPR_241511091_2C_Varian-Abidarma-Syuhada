<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggajianModel;

class PublicController extends BaseController
{
    public function index()
    {
        $model = new PenggajianModel();
        $data['rekap_gaji'] = $model->getRekapGajiPublik();
        return view('public/index', $data);
    }

    /**
     * FUNGSI BARU: Menampilkan detail gaji untuk satu anggota.
     */
    public function detail($id_anggota = null)
    {
        $model = new PenggajianModel();

        // Panggil method untuk mengambil detail gaji per anggota
        $data['detail_gaji'] = $model->getDetailGajiAnggota($id_anggota);

        // Jika tidak ada data, tampilkan error 404
        if (empty($data['detail_gaji'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Gaji untuk Anggota ini tidak ditemukan.');
        }

        return view('public/detail', $data);
    }
}