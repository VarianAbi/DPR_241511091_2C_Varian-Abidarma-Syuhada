<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_anggota', 'gelar_depan', 'nama_depan', 'nama_belakang',
        'gelar_belakang', 'jabatan', 'status_pernikahan', 'jumlah_anak'
    ];

    /**
     * Fungsi untuk mencari data berdasarkan keyword di beberapa kolom.
     */
    public function search($keyword)
    {
        return $this->table('anggota')
                    ->like('nama_depan', $keyword)
                    ->orLike('nama_belakang', $keyword)
                    ->orLike('jabatan', $keyword)
                    ->orLike('id_anggota', $keyword)
                    ->get()
                    ->getResultArray();
    }
}