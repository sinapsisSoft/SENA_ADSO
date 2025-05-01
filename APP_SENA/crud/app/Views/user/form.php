<form id="my-form" class="">
  <input type="hidden" class="form-control" id="Course_id" name="Course_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Course_code" name="Course_code" placeholder="Code Curse" required>
    <label for="Course_code">Code Curse </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Course_program_name" name="Course_program_name" placeholder="Program Name" required>
    <label for="Course_program_name">Program Name </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Course_start_date" name="Course_start_date" placeholder="Start date" required>
    <label for="Course_start_date">Start Date </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Course_end_date" name="Course_end_date" placeholder="End Date" required>
    <label for="Course_end_date">End Date </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Course_status" name="Course_status" disabled>
      <option value=NULL selected>Open this select Status </option>
      <option value="active" >Active </option>
      <option value="inactive" >Inactive </option>
      <option value="completed" >Completed </option>
    </select>
  </div>
 
 
 
</form>