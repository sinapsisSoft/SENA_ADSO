<div class="modal fade" id="questions-modal" tabindex="-1" aria-labelledby="questions-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="questions-modalLabel"><?= $title ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        <?php require_once('../app/Views/questions/form.php') ?>
        <!--End Form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="questions-form" id="btn_questions_form" class="btn btn-primary" disabled>Send Data</button>
      </div>
    </div>
  </div>
</div>