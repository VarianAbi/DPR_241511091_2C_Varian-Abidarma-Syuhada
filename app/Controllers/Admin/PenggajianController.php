<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggajianModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;

class PenggajianController extends BaseController
{
    public function index()
    {
        $model = new PenggajianModel();
        $data['penggajian'] = $model->getPenggajianGrouped();
        return view('admin/penggajian/index', $data);
    }

    public function new()
    {
        $anggotaModel = new AnggotaModel();
        $komponenModel = new KomponenGajiModel();
        $data['anggota'] = $anggotaModel->findAll();
        $data['komponen_gaji'] = $komponenModel->findAll();
        return view('admin/penggajian/create', $data);
    }

    public function create()
    {
        $db = \Config\Database::connect(); // Panggil koneksi database
        
        $idAnggota = $this->request->getPost('id_anggota');
        $idKomponenArray = $this->request->getPost('id_komponen');
        
        if (empty($idAnggota) || empty($idKomponenArray)) {
            return redirect()->back()->withInput()->with('error', 'Anggota dan minimal satu komponen gaji harus dipilih.');
        }

        $berhasil = 0;
        $gagal = 0;

        foreach ($idKomponenArray as $idKomponen) {
            // Cek duplikasi langsung ke database
            $isDuplicate = $db->table('penggajian')->where([
                'id_anggota' => $idAnggota, 
                'id_komponen_gaji' => $idKomponen
            ])->get()->getRow();

            if ($isDuplicate) {
                $gagal++;
                continue;
            }

            // Perintah INSERT langsung ke database
            $db->table('penggajian')->insert([
                'id_anggota' => $idAnggota,
                'id_komponen_gaji' => $idKomponen
            ]);
            $berhasil++;
        }

        $message = "Berhasil menambahkan {$berhasil} komponen gaji.";
        if ($gagal > 0) {
            $message .= " Gagal menambahkan {$gagal} komponen karena sudah ada sebelumnya.";
        }
        return redirect()->to('/admin/penggajian')->with('message', $message);
    }

    public function delete($id_anggota = null, $id_komponen_gaji = null)
    {
        $db = \Config\Database::connect(); // Panggil koneksi database

        // Perintah DELETE langsung ke database
        $db->table('penggajian')->where([
            'id_anggota' => $id_anggota,
            'id_komponen_gaji' => $id_komponen_gaji
        ])->delete();

        return redirect()->to('/admin/penggajian')->with('message', 'Satu komponen gaji berhasil dihapus.');
    }
}