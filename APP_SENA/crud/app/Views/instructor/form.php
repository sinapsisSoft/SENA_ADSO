<form id="my-form" class="">
  <input type="hidden" class="form-control" id="Instructor_id" name="Instructor_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Instructor_first_name" name="Instructor_first_name" placeholder="First Name" required>
    <label for="Instructor_first_name">First Name </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Instructor_last_name" name="Instructor_last_name" placeholder="Last Name" required>
    <label for="Instructor_last_name">Last Name </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Document_type_fk" name="Document_type_fk" disabled>
      <option value=NULL selected>Open this select Document Type </option>
      <?php if ($documentType) : ?>
        <?php foreach ($documentType as $obj) : ?>
          <option value="<?= $obj['Document_type_id'] ?>"><?= $obj['Document_type_code'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Instructor_document" name="Instructor_document" placeholder="Document Number" required>
    <label for="Instructor_document">Document </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Instructor_phone" name="Instructor_phone" placeholder="Phone Number" required>
    <label for="Instructor_phone">Phone </label>
  </div>
  <div class="form-floating mb-3">
    <input type="email" class="form-control " id="Instructor_email" name="Instructor_email" placeholder="Email" required>
    <label for="Instructor_email">Email </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Instructor_address" name="Instructor_address" placeholder="Address" required>
    <label for="Instructor_address">Address </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Instructor_birth_date" name="Instructor_birth_date" placeholder="Birth Date" required>
    <label for="Instructor_birth_date">Birth Date </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Instructor_gender" name="Instructor_gender" disabled>
      <option value=NULL selected>Open this select Gender </option>
      <option value="male" >male </option>
      <option value="female" >female </option>
      <option value="other" >other </option>
      <option value="prefer_not_to_say" >Prefer not to say</option>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="User_fk" name="User_fk" disabled>
      <option value=NULL selected>Open this select User </option>
      <?php if ($users) : ?>
        <?php foreach ($users as $obj) : ?>
          <option value="<?= $obj['User_id'] ?>"><?= $obj['User_user'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Specialty_fk" name="Specialty_fk" disabled>
      <option value=NULL selected>Open this select Specialty </option>
      <?php if ($specialties) : ?>
        <?php foreach ($specialties as $obj) : ?>
          <option value="<?= $obj['Specialty_id'] ?>"><?= $obj['Specialty_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="User_status_fk" name="User_status_fk" disabled>
      <option value=NULL selected>Open this select Status </option>
      <?php if ($userStatus) : ?>
        <?php foreach ($userStatus as $obj) : ?>
          <option value="<?= $obj['User_status_id'] ?>"><?= $obj['User_status_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
</form>