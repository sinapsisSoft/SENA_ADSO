<div class="modal fade" id="management-modal" tabindex="-1" aria-labelledby="assessment-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assessment-modalLabel">ASSESSMENT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        
        <form id="management-form" class="">
          <input type="hidden" class="form-control" id="Management_group_id" name="Management_group_id" value=null>
          <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
          <input type="hidden" class="form-control" id="Program_group_fk" name="Program_group_fk"  value="">
          <div class="form-floating mb-3">
            <input type="text" class="form-control " id="Management_group_name" name="Management_group_name" placeholder="Management Name" required>
            <label for="Management_group_name">Management Name </label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control " id="Management_group_position" name="Management_group_position" placeholder="Position" required>
            <label for="Management_group_position">Management Position </label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control " id="Management_group_start_date" name="Management_group_start_date" placeholder="Date" required>
            <label for="Management_group_start_date">Management Start Date </label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control " id="Management_group_end_date" name="Management_group_end_date" placeholder="Date" required>
            <label for="Management_group_end_date">Management End Date </label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control block-input hidden-input" value="<?=$programGroup['Program_group_code']?>" id="Program_group_code" name="Program_group_code" placeholder="Code Group" required disabled>
            <label for="Program_group_code">Code Group </label>
          </div>
          
          <div class="form-floating mb-3 col-12">
            <select class="form-select" aria-label="Id Parent" id="Management_group_status" name="Management_group_status" disabled>
              <option value=NULL selected>Open this select Status </option>
              <option value="active">Active </option>
              <option value="inactive">Inactive </option>
              <option value="blocked">Blocked </option>
              <option value="delete">Delete </option>
            </select>
          </div>
        </form>
        <!--End Form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="management-form" id="btn_management_form" class="btn btn-primary" disabled>Send Data</button>
      </div>
    </div>
  </div>
</div>