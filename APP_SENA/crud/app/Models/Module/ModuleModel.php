<?php

namespace App\Models\Module;

use CodeIgniter\Model;
use Exception;

class ModuleModel extends Model
{
    protected $table            = 'modules';
    protected $primaryKey       = 'Modules_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Modules_name','Modules_description','Modules_route','Modules_icon','Modules_submodule','Modules_parent_module','updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

   
}
