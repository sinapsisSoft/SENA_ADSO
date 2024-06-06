<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table            = 'permissions';
    protected $primaryKey       = 'Permissions_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Permissions_name','Permissions_description','Permissions_icon','update_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
}
