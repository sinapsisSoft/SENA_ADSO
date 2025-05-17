<form id="programs-form" class="">
  <input type="hidden" class="form-control" id="Programs_id" name="Programs_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Programs_code" name="Programs_code" placeholder="Program Code" required>
    <label for="Programs_code">Program Code  </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Programs_name" name="Programs_name" placeholder="Program Name" required>
    <label for="Programs_name">Program Name </label>
  </div>
  <div class="form-floating mb-3">
    <textarea class="form-control " id="Programs_description" name="Programs_description" placeholder="Program description" required></textarea>
    <label for="Programs_description">Program Description </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Programs_start_date" name="Programs_start_date" placeholder="Start Date" required>
    <label for="Programs_start_date">Start Date </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Programs_end_date" name="Programs_end_date" placeholder="End Date" required>
    <label for="Programs_end_date">End Date </label>
  </div>
  <div class="form-floating mb-3">
    <input type="number" max="4500" min="10" class="form-control " id="Programs_hours" name="Programs_hours" placeholder="Program Hours" required>
    <label for="Programs_hours">Program Hours </label>
  </div>
  <div class="form-floating mb-3">
    <input type="number" max="60" min="1" class="form-control " id="Programs_duration" name="Programs_duration" placeholder="Programs Duration" required>
    <label for="Programs_duration">Programs Duration </label>
  </div>
 
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Programs_modality" name="Programs_modality" disabled>
      <option value=NULL selected>Open this select Modality </option>
      <option value="in-person" >In-person </option>
      <option value="virtual" >Virtual </option>
      <option value="distance" >Distance </option>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Programs_status" name="Programs_status" disabled>
      <option value=NULL selected>Open this select Status </option>
      <option value="active" >Active </option>
      <option value="inactive" >Inactive </option>
      <option value="closed" >Closed </option>
      <option value="completed" >Completed </option>
    </select>
  </div>
</form>