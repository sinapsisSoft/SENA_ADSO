<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
class LoginModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'User_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['User_user','User_password'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'update_at';
    protected $deletedField  = 'create_at';

}
