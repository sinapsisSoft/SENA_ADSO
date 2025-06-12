<?php

namespace App\Models\User;

use CodeIgniter\Model;
use Exception;
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'User_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['User_user','User_email','User_password','Roles_fk','User_status_fk','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';
/**
 * Author:  Diego Casallas
 * Date:   01/10/2025   
 * Description:  Model for user table
 * file:  RoleModulesModel.php
*/
    // Queries custom
    // Get all users 
    public function sp_users()
    {
        try {
            $sql    = "CALL sp_users();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
    // Get all users by id
    public function sp_users_students_instructors()
    {
        try {
            $sql    = "CALL sp_users_students_instructors();";
            $query  = $this->db->query($sql);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
    // Get all users by id
    public function findByName($name)
    {
        try {
            $sql    = "SELECT * FROM users WHERE User_user=?";
            $query  = $this->db->query($sql,$name);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
      public function findByEmail($email)
    {
        try {
            $sql    = "SELECT * FROM users WHERE User_email=?";
            $query  = $this->db->query($sql,$email);
            $result = $query->getResultArray();
        } catch (Exception $e) {
            $result = null;
        }
        return $result;
    }
}
