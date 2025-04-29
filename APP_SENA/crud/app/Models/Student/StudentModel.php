<?php

namespace App\Models\Student;

use CodeIgniter\Model;
use Exception;
class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'Student_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Student_id','Student_document','Student_first_name','Student_last_name','Student_phone','Student_email','Student_address','Student_birth_date','Student_gender','User_fk','Document_type_fk','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';
/**
 * Author:  Diego Casallas
 * Date:   01/10/2025   
 * Description:  Model for students table
 * file:  RoleModulesModel.php
*/
    // Queries custom
    // Get all students 
    public function sp_students()
    {
        try {
            $sql    = "CALL sp_students();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
}
