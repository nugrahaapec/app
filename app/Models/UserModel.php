<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nik_user', 'nama_user', 'email_user', 'pass_user', 'level_user'];


    public function allUser()
    {
        $builder = $this->db->table('user');
        $query = $builder->get()->getResult();
        return $query;
    }
}
