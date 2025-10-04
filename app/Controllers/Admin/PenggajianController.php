<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggajianModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;

class PenggajianController extends BaseController
{
    /**
     * Menampilkan daftar penggajian.
     * Akan kita buat di commit berikutnya.
     */
    public function index()
    {
        echo "<h1>Halaman Daftar Penggajian (Akan dibuat)</h1>";
        echo '<a href="' . base_url('admin/penggajian/new') . '">Tambah Data Penggajian</a>';
    }

    /**
     * Menampilkan form untuk menambah data penggajian baru.
     */
    public function new()
    {
        $anggotaModel = new AnggotaModel();
        $komponenModel = new KomponenGajiModel();

        // Ambil semua data anggota dan komponen untuk ditampilkan di form
        $data['anggota'] = $anggotaModel->findAll();
        $data['komponen_gaji'] = $komponenModel->findAll();

        return view('admin/penggajian/create', $data);
    }

    /**
     * Memproses data dari form tambah penggajian.
     */
    public function create()
    {
        $model = new PenggajianModel();

        $idAnggota = $this->request->getPost('id_anggota');
        $idKomponenArray = $this->request->getPost('id_komponen');

        // Validasi dasar
        if (empty($idAnggota) || empty($idKomponenArray)) {
            return redirect()->back()->withInput()->with('error', 'Anggota dan minimal satu komponen gaji harus dipilih.');
        }

        $berhasil = 0;
        $gagal = 0;

        // Loop sebanyak komponen gaji yang dipilih
        foreach ($idKomponenArray as $idKomponen) {
            // Cek duplikasi: apakah anggota ini sudah punya komponen yg sama?
            $isDuplicate = $model->where([
                'id_anggota' => $idAnggota,
                'id_komponen_gaji' => $idKomponen
            ])->first();

            if ($isDuplicate) {
                // Jika sudah ada, lewati dan hitung sebagai gagal
                $gagal++;
                continue; // Lanjut ke komponen berikutnya
            }

            // Jika tidak duplikat, simpan data
            $dataToSave = [
                'id_anggota' => $idAnggota,
                'id_komponen_gaji' => $idKomponen,
            ];
            $model->save($dataToSave);
            $berhasil++;
        }

        $message = "Berhasil menambahkan {$berhasil} komponen gaji.";
        if ($gagal > 0) {
            $message .= " Gagal menambahkan {$gagal} komponen karena sudah ada sebelumnya.";
        }

        return redirect()->to('/admin/penggajian')->with('message', $message);
    }
}