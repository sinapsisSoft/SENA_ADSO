<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentStatusModel extends Model
{
    protected $table            = 'student_status';
    protected $primaryKey       = 'Student_status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Student_status_id','Student_status_name','Student_status_description','updated_at'];

    protected bool $allowEmptyInserts = false;

    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
