<?php

namespace App\Models\Programs;

use CodeIgniter\Model;
use Exception;
class ProgramsModel extends Model
{
    protected $table            = 'programs';
    protected $primaryKey       = 'Programs_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Programs_id','Programs_code','Programs_name','Programs_description','Programs_hours','Programs_duration','Programs_modality','Programs_start_date','Programs_end_date','Programs_status','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';


}


