<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class RoleModulesModel extends Model
{
    protected $table            = 'role_modules';
    protected $primaryKey       = 'RoleModules_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Modules_fk', 'Roles_fk', 'update_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';

    public function sp_role_modules()
    {
        try {
            $sql    = "CALL sp_role_modules();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }
    public function sp_role_module_id($id)
    {
        try {
            $sql    = "CALL sp_role_module_id(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }
    public function sp_role_modules_id($id)
    {
        try {
            $sql    = "CALL sp_role_modules_id(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }
    public function sp_permissions_module_id($id)
    {
        try {
            $sql    = "CALL sp_permissions_module_id(?);";
            $query  = $this->db->query($sql,$id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }
   
}
