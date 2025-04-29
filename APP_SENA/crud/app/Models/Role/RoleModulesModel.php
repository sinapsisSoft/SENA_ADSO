<?php

namespace App\Models\Role;

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
    protected $allowedFields    = ['Modules_fk', 'Roles_fk', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
/**
 * Author:  Diego Casallas
 * Date:   01/10/2025   
 * Description:  Model for role_modules table
 * file:  RoleModulesModel.php
*/
    // Queries custom
    // Get all role_modules 
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
    // Get all role_module by id
    public function sp_role_module_id($id)
    {
        try {
            $sql    = "CALL sp_role_module_id(?);";
            $query  = $this->db->query($sql, $id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
    // Get all role_modules by id
    public function sp_role_modules_id($id)
    {
        try {
            $sql    = "CALL sp_role_modules_id(?);";
            $query  = $this->db->query($sql, $id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
    // Get all permissions and role_modules by id
    public function sp_permissions_module_id($id)
    {
        try {
            $sql    = "CALL sp_permissions_module_id(?);";
            $query  = $this->db->query($sql, $id);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
}
