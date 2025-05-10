<?php

namespace App\Models\ProgramsGroups;

use CodeIgniter\Model;
use Exception;
class ProgramsGroupStudentModel extends Model
{
    protected $table            = 'program_group_student';
    protected $primaryKey       = 'program_group_student_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['program_group_student_id','Program_group_fk','Student_fk','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';

    public function sp_remove_student_group($id)
    {
        try {
            $sql    = "CALL sp_remove_student_group(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }

}


