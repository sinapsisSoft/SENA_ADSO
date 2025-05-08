<?php

namespace App\Models\Instructor;

use CodeIgniter\Model;
use Exception;
class InstructorModel extends Model
{
    protected $table            = 'instructors';
    protected $primaryKey       = 'Instructor_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Instructor_id','Instructor_document','Instructor_first_name','Instructor_last_name','Instructor_phone','Instructor_email','Instructor_address','Instructor_birth_date','Instructor_gender','User_fk','Document_type_fk','Specialty_fk','User_status_fk','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';

    public function sp_instructors()
    {
        try {
            $sql    = "CALL sp_instructors();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }

    public function sp_instructs_no_group($id)
    {
        try {
            $sql    = "CALL sp_instructs_no_group(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
    public function sp_instructs_group()
    {
        try {
            $sql    = "CALL sp_instructs_group();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
}
