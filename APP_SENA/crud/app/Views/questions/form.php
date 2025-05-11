<form id="questions-form" class="">
  <input type="hidden" class="form-control hidden-input" id="Program_group_id" name="Program_group_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Program_group_code" name="Program_group_code" placeholder="Program Code" required>
    <label for="Program_group_code">Program Group Code  </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Program_group_start_date" name="Program_group_start_date" placeholder="Start Date" required>
    <label for="Program_group_start_date">Start Date </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control block-input" id="Program_group_end_date" name="Program_group_end_date" placeholder="End Date" required>
    <label for="Program_group_end_date">End Date </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Program_group_status" name="Program_group_status" disabled>
      <option value=NULL selected disabled>Open this select Status </option>
      <option value="active" >Active </option>
      <option value="inactive" >Inactive </option>
      <option value="closed" >Closed </option>
      <option value="cancel" >Cancel </option>
    </select>
  </div>

 

</form>