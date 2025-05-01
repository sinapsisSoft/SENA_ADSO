<?php

namespace App\Models\ProgramsGroups;

use CodeIgniter\Model;
use Exception;
class ProgramsGroupsModel extends Model
{
    protected $table            = 'program_group';
    protected $primaryKey       = 'Program_group_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Program_group_id','Program_group_code','Program_group_start_date','Program_group_end_date','Program_group_status','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';


}


