<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'Roles_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Roles_name','Roles_description','update_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';

}