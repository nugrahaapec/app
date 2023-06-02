<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    protected $table            = "store";
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'code_store',
        'nama_store',
        'nama_user',
        'nik_user',
        'lokasi',
        'status'
    ];

    public function getDataAll()
    {
        $builder = $this->db->table('store');
        $hasil = $builder->select('nik_user')->where(['nik_user' => session('nik_user'), 'lokasi' => 1])->countAllResults();
        return ($hasil);
    }

    public function getDataAdmin()
    {
        $builder = $this->db->table('store');
        $hasil = $builder->where(['lokasi' => 1])->countAllResults();
        return ($hasil);
    }

    public function getDataAdminL()
    {
        $builder = $this->db->table('store');
        $hasil = $builder->where(['lokasi' => 2])->countAllResults();
        return ($hasil);
    }

    public function getAdminStatus()
    {
        $builder = $this->db->table('store');
        $maintenance = $builder->where(['status' => 1, 'lokasi' => 1])->countAllResults();
        return ($maintenance);
    }
    public function getAdminStatus0()
    {
        $builder = $this->db->table('store');
        $maintenance = $builder->where(['status' => 0, 'lokasi' => 1])->countAllResults();
        return ($maintenance);
    }

    public function getStatus1()
    {
        $builder = $this->db->table('store');
        $maintenance = $builder->select('nama_user')->where(['nik_user' => session('nik_user'), 'status' => 1, 'lokasi' => 1])->countAllResults();
        return ($maintenance);
    }

    public function lokasi2()
    {
        $builder = $this->db->table('store');
        $maintenance = $builder->select('nama_user')->where(['nik_user' => session('nik_user'), 'lokasi' => 2])->countAllResults();
        return ($maintenance);
    }

    public function lokasi()
    {
        $builder = $this->db->table('store');
        $maintenance = $builder->select('nama_user')->where(['nik_user' => session('nik_user'), 'lokasi' => 1])->countAllResults();
        return ($maintenance);
    }

    public function getStatus0()
    {
        $builder = $this->db->table('store');
        $maintenance1 = $builder->select('nama_user')->where(['nik_user' => session('nik_user'), 'status' => 0, 'lokasi' => 1])->countAllResults();
        return ($maintenance1);
    }

    public function reset()
    {
        $reset = $this->db->table('store')->where(['status' => 1])->update(['status' => 0]);
        return $reset;
    }
}
