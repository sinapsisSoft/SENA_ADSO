<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profiles';
    protected $primaryKey       = 'Profile_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Profile_email','Profile_name','Profile_photo','User_id_fk','update_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';


}
