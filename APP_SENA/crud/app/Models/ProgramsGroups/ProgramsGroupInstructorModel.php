<?php

namespace App\Models\ProgramsGroups;

use CodeIgniter\Model;
use Exception;
class ProgramsGroupInstructorModel extends Model
{
    protected $table            = 'program_group_instruct';
    protected $primaryKey       = 'Program_group_instruct_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Program_group_instruct_id','Program_group_fk','Instructor_fk','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';
    public function sp_remove_instructor_group($id)
    {
        try {
            $sql    = "CALL sp_remove_instructor_group(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }

}


