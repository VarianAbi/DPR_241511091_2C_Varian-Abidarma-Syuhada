<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';
    protected $primaryKey       = ''; // Biarkan kosong
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_anggota', 'id_komponen_gaji'];

    public function getPenggajianData()
    {
        return $this->db->table('penggajian')
            ->select('
                anggota.id_anggota, 
                anggota.nama_depan, 
                anggota.nama_belakang, 
                anggota.jabatan,
                komponen_gaji.id_komponen_gaji,
                komponen_gaji.nama_komponen,
                komponen_gaji.kategori,
                komponen_gaji.nominal
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
}