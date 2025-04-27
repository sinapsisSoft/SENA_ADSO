<?php

namespace App\Models\Role;

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
    protected $allowedFields    = ['Roles_name','Roles_description','updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}