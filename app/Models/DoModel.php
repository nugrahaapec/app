<?php

namespace App\Models;

use CodeIgniter\Model;

class DoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_proses';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'code_permintaan',
        'code_store',
        'nik_user',
        'nama_store',
        'nama_user',
        'code_perangkat',
        'tgl_proses',
        'merk',
        'sn',
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
        $builder = $this->db->table('tbl_proses');
        $builder->select('*');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getRow()
    {
        // $this->db->table('tbl_proses')->getWhere(['sn' => $sn])->getNumRows();
        $builder = $this->db->table('tbl_permintaan')->getwhere(['sn' => $_GET['sn']])->getNumRows();
        return $builder;
    }
}
