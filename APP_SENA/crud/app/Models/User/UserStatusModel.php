<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserStatusModel extends Model
{
    protected $table            = 'user_status';
    protected $primaryKey       = 'User_status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['User_status_id','User_status_name','User_status_description','updated_at'];

    protected bool $allowEmptyInserts = false;

    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
