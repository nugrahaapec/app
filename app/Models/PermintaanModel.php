<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_permintaan';
    protected $primaryKey       = 'id_permintaan';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'code_permintaan',
        'code_store',
        'nik_user',
        'nama_store',
        'nama_user',
        'code_perangkat',
        'keterangan',
        'tanggal_permintaan',
        'status',
        'kategori',
        'merk',
        'sn',
        'tanggal_proses',
        'keterangan'
    ];
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    // protected $useSoftDeletes   = false;

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


    public function getData()
    {
        $builder = $this->db->table('tbl_permintaan');
        $hasil = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 1)->CountAllResults();
        return ($hasil);
    }


    public function getDataProses()
    {
        $builder = $this->db->table('tbl_permintaan');
        $hasil = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->CountAllResults();
        return ($hasil);
    }

    public function getDataKirim()
    {
        $builder = $this->db->table('tbl_permintaan');
        $hasil = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 3)->CountAllResults();
        return ($hasil);
    }

    public function getPermintaan()
    {
        $builder = $this->db->table('tbl_permintaan');
        $hasil = $builder->select('*')->where('status', 1)->orWhere('status', 2)->groupBy('code_permintaan')->orderBy('tanggal_permintaan DESC')->get()->getResultArray();
        return ($hasil);
    }

    public function Print()
    {
        $builder = $this->db->table('tbl_permintaan')->join('tbl_proses', 'tbl_permintaan.code_permintaan = tbl_proses.code_permintaan');
        $hasil = $builder->select('*')->where('tbl_permintaan.status', 3)->groupBy('tbl_permintaan.code_permintaan')->orderBy('tbl_proses.tgl_proses DESC')->get()->getResultArray();
        return ($hasil);
    }
}
