<?php

namespace App\Models\ManagementGroups;

use CodeIgniter\Model;
use Exception;

class ManagementGroupsModel extends Model
{
    protected $table            = 'management_group';
    protected $primaryKey       = 'Management_group_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Management_group_id', 'Management_group_start_date', 'Management_group_end_date', 'Program_group_fk', 'Management_group_status', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';
    // Get all students not in program group 
    
    public function sp_management_group($id)
    {
        try {
            $sql    = "CALL sp_management_group(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
}
