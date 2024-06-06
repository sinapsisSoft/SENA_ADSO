<?php

namespace App\Models;

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
    protected $allowedFields    = ['User_user','User_password','Roles_fk','User_status_fk','update_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'update_at';
    protected $deletedField  = 'create_at';

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
}
