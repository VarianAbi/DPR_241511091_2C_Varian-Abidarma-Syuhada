<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';
    protected $primaryKey       = '';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_anggota', 'id_komponen_gaji'];

    public function getPenggajianData()
    {
        return $this->db->table('penggajian')
            ->select('
                anggota.id_anggota, anggota.nama_depan, anggota.nama_belakang, anggota.jabatan,
                anggota.gelar_depan, anggota.gelar_belakang, anggota.status_pernikahan, anggota.jumlah_anak,
                komponen_gaji.id_komponen_gaji, komponen_gaji.nama_komponen,
                komponen_gaji.kategori, komponen_gaji.nominal
            ')
            ->join('anggota', 'anggota.id_anggota = penggajian.id_anggota')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->get()
            ->getResultArray();
    }

    public function getPenggajianGrouped()
    {
        $rawData = $this->getPenggajianData();
        $groupedData = [];
        foreach ($rawData as $row) {
            if (!isset($groupedData[$row['id_anggota']])) {
                 $groupedData[$row['id_anggota']]['info'] = $row;
            }
            $groupedData[$row['id_anggota']]['komponen'][] = $row;
        }
        return $groupedData;
    }

    public function getRekapGajiPublik()
    {
        $builder = $this->db->table('anggota');
        $builder->select('
            anggota.id_anggota, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_depan,
            anggota.gelar_belakang, anggota.jabatan,
            (SELECT SUM(kg.nominal) 
             FROM penggajian p
             JOIN komponen_gaji kg ON p.id_komponen_gaji = kg.id_komponen_gaji
             WHERE p.id_anggota = anggota.id_anggota AND kg.nama_komponen != "Tunjangan Anak") as total_penerimaan,
            (SELECT kg.nominal 
             FROM komponen_gaji kg 
             WHERE kg.nama_komponen = "Tunjangan Anak" LIMIT 1) as tunjangan_anak_nominal,
            anggota.jumlah_anak
        ');
        $results = $builder->get()->getResultArray();
        $finalRekap = [];
        foreach ($results as $row) {
            $penerimaan = $row['total_penerimaan'] ?? 0;
            if ($row['jumlah_anak'] > 0) {
                $jumlahAnakDihitung = min($row['jumlah_anak'], 2);
                $penerimaan += $jumlahAnakDihitung * $row['tunjangan_anak_nominal'];
            }
            $pph = ($row['jabatan'] == 'Ketua') ? $penerimaan * 0.05 : $penerimaan * 0.15;
            $row['take_home_pay'] = $penerimaan - $pph;
            $finalRekap[] = $row;
        }
        return $finalRekap;
    }

    /**
     * FUNGSI BARU: Mengambil detail gaji dan menghitung total untuk satu anggota.
     */
    public function getDetailGajiAnggota($id_anggota)
    {
        $rawData = $this->db->table('penggajian')
            ->select('anggota.*, komponen_gaji.*')
            ->join('anggota', 'anggota.id_anggota = penggajian.id_anggota')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->where('penggajian.id_anggota', $id_anggota)
            ->get()->getResultArray();

        if (empty($rawData)) {
            return [];
        }

        $detail = [];
        $detail['info'] = $rawData[0]; // Ambil info anggota dari baris pertama
        $detail['komponen'] = $rawData;

        // Hitung ulang total dengan aturan
        $totalPenerimaan = 0;
        $tunjanganAnakNominal = $this->db->table('komponen_gaji')->where('nama_komponen', 'Tunjangan Anak')->get()->getRow('nominal') ?? 0;

        foreach ($detail['komponen'] as $komp) {
            if ($komp['nama_komponen'] != 'Tunjangan Anak') {
                $totalPenerimaan += $komp['nominal'];
            }
        }

        if ($detail['info']['jumlah_anak'] > 0) {
            $jumlahAnakDihitung = min($detail['info']['jumlah_anak'], 2);
            $totalPenerimaan += $jumlahAnakDihitung * $tunjanganAnakNominal;
        }

        $pph = ($detail['info']['jabatan'] == 'Ketua') ? $totalPenerimaan * 0.05 : $totalPenerimaan * 0.15;

        $detail['total_penerimaan'] = $totalPenerimaan;
        $detail['pph'] = $pph;
        $detail['take_home_pay'] = $totalPenerimaan - $pph;

        return $detail;
    }
}