<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table            = 'data_aset';
    protected $primaryKey       = 'id_data';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [];
    // protected $insertID         = 0;
    // protected $DBGroup          = 'default';
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


    public function group_by()
    {
        $builder = $this->db->table('data_aset');
        $builder->select('code_store, nama_store, nama_user, status');
        $builder->where('nik_user', session('nik_user'));
        $builder->groupBy('code_store');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function order_by()
    {
        $builder = $this->db->table('data_aset');
        $builder->select('*');
        $builder->where('nik_user', session('nik_user'));
        $builder->orwhere('nama_user', session('nama_user'));
        $builder->orderBy('kategori');
        $board = $builder->get()->getResultArray();
        return $board;
    }

    public function DataAset()
    {
        $builder = $this->db->table('master_perangkat');
        $builder->select('*');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function status()
    {
        $builder = $this->db->table('data_aset');
        $query = $builder->get()->getResult();
        return $query;
    }
}
