<?php

namespace App\Models;

use CodeIgniter\Model;

class KomponenGajiModel extends Model
{
    protected $table            = 'komponen_gaji';
    protected $primaryKey       = 'id_komponen_gaji';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_komponen_gaji', 'nama_komponen', 'kategori', 'jabatan', 'nominal', 'satuan'
    ];

    /**
     * Fungsi untuk mencari data berdasarkan keyword di beberapa kolom.
     */
    public function search($keyword)
    {
        return $this->table('komponen_gaji')
                    ->like('nama_komponen', $keyword)
                    ->orLike('kategori', $keyword)
                    ->orLike('jabatan', $keyword)
                    ->orLike('id_komponen_gaji', $keyword)
                    ->get()
                    ->getResultArray();
    }
}