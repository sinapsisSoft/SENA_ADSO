<?php

namespace App\Models\Questionnaires;

use CodeIgniter\Model;
use Exception;
class QuestionnairesModel extends Model
{
    protected $table            = 'questionnaires';
    protected $primaryKey       = 'Questionnaire_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Questionnaire_id','Questionnaire_name','Questionnaire_description','Questionnaire_is_active','updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'created_at';

    
    public function sp_questions()
    {
        // try {
        //     $sql    = "CALL sp_questions();";
        //     $query  = $this->db->query($sql);
        //     $result = $query->getResultArray();
        // } catch (Exception $e) {
        //     $result = null;
        // }
        // return $result;
    }
    public function sp_question_id($id)
    {
        // try {
        //     $sql    = "CALL sp_question_id(?);";
        //     $query  = $this->db->query($sql,$id);
        //     $result = $query->getResultArray();
        // } catch (Exception $e) {
        //     $result = null;
        // }
        // return $result;
    }
}


