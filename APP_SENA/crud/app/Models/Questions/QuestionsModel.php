<?php

namespace App\Models\Questions;

use CodeIgniter\Model;
use Exception;
class QuestionsModel extends Model
{
    protected $table            = 'questions';
    protected $primaryKey       = 'Question_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Question_id','Questionnaire_id','Question_text','Question_answer_type','Question_weight','Question_display_order','Qis_active','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';


}


