<?php

namespace App\Models\DocumentTypes;

use CodeIgniter\Model;

class DocumentTypesModel extends Model
{
    protected $table            = 'document_types';
    protected $primaryKey       = 'Document_type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Document_type_id','Document_type_code','Document_type_name','Document_type_description','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
