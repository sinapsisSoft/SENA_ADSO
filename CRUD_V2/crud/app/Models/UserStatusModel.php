<?php

namespace App\Models;

use CodeIgniter\Model;

class UserStatusModel extends Model
{
    protected $table            = 'user_status';
    protected $primaryKey       = 'User_status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['User_status_id','User_status_name','User_status_description','update_at'];

    protected bool $allowEmptyInserts = false;

    
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';

}
