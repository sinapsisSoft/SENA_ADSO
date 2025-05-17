<form id="questions-form" class="">
  <input type="hidden" class="form-control" id="Question_id" name="Question_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Questionnaire_fk" name="Questionnaire_fk" disabled>
      <option value=NULL selected disabled>Open this select Questionnaire</option>
      <?php if (isset($questionnaires) && !empty($questionnaires)) : ?>
      <?php foreach ($questionnaires as $row) : ?>
        <option value="<?= $row['Questionnaire_id'] ?>"><?= $row['Questionnaire_name'] ?></option>  
      <?php endforeach; ?>  
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3">
    <textarea type="text" class="form-control " id="Question_text" name="Question_text" placeholder="Program Code" required></textarea>
    <label for="Question_text">Description </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Question_answer_type" name="Question_answer_type" disabled>
      <option value=NULL selected disabled>Open this select Question Answer Type </option>
      <option value="scale_1to5">Scale 1 to 5</option>
      <option value="yes_no">Yes No </option>
      <option value="open">open </option>
    </select>
  </div>
  <div class="input-group mb-3">
    <label for="Question_weight" class="form-label">Question Weight</label>
    <input type="range" class="form-range" value="0" min="0" max="5" step="0.01" id="Question_weight" name="Question_weight" oninput="this.nextElementSibling.value = this.value">
    <output class="form-control " for="Question_weight">0</output>
  </div>
  <div class="form-floating mb-3">
    <input type="number" min="1" max="20" class="form-control " id="Question_display_order" name="Question_display_order" placeholder="Question Display Order" required>
    <label for="Question_display_order">Question Display Order </label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="Qis_active" name="Qis_active" checked>
    <label class="form-check-label" for="Qis_active">Active</label>
  </div>
</form>
