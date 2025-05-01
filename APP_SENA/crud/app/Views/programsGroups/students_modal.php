<div class="modal fade" id="students-modal" tabindex="-1" aria-labelledby="students-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="students-modalLabel">STUDENTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        <form id="students-form" class="">
          <input type="hidden" class="form-control" id="Program_group_id" name="Program_group_id" value=null>
          <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
          <div class="form-floating mb-3">
            <input type="text" class="form-control " id="Program_group_code" name="Program_group_code" placeholder="Program Code" required>
            <label for="Program_group_code">Program Group Code </label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control " id="Program_group_start_date" name="Program_group_start_date" placeholder="Start Date" required>
            <label for="Program_group_start_date">Start Date </label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control " id="Program_group_end_date" name="Program_group_end_date" placeholder="End Date" required>
            <label for="Program_group_end_date">End Date </label>
          </div>
          <div class="form-floating mb-3 col-12">
            <select class="form-select" aria-label="Id Parent" id="Program_group_status" name="Program_group_status" disabled>
              <option value=NULL selected>Open this select Status </option>
              <option value="active">Active </option>
              <option value="inactive">Inactive </option>
              <option value="closed">Closed </option>
              <option value="cancel">Cancel </option>
            </select>
          </div>
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