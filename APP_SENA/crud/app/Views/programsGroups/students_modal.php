<div class="modal fade" id="students-modal" tabindex="-1" aria-labelledby="students-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="students-modalLabel">ADD STUDENTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        <form id="students-form" class="">
          <!--Table-->
          <?php require_once('../app/Views/programsGroups/students_table.php') ?>
          <!--End Table-->
        </form>
        <!--End Form-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="students-form" id="btn_students_form" class="btn btn-primary" disabled>Send Data</button>
      </div>
    </div>
  </div>
</div>