<?php

namespace App\Models\Specialty;

use CodeIgniter\Model;

class SpecialtyModel extends Model
{
    protected $table            = 'specialty';
    protected $primaryKey       = 'Specialty_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Specialty_id','Specialty_code','Specialty_name','Specialty_description','updated_at'];

    protected bool $allowEmptyInserts = false;

    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
