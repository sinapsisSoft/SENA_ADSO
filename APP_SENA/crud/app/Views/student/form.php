<form id="my-form" class="">
  <input type="hidden" class="form-control" id="Student_id" name="Student_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Student_first_name" name="Student_first_name" placeholder="First Name" required>
    <label for="Student_first_name">First Name </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Student_last_name" name="Student_last_name" placeholder="Last Name" required>
    <label for="Student_last_name">Last Name </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Document_type_fk" name="Document_type_fk" disabled>
      <option value=NULL selected disabled>Open this select Document Type </option>
      <?php if ($documentType) : ?>
        <?php foreach ($documentType as $obj) : ?>
          <option value="<?= $obj['Document_type_id'] ?>"><?= $obj['Document_type_code'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Student_document" name="Student_document" placeholder="Document Number" required>
    <label for="Student_document">Document </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Student_phone" name="Student_phone" placeholder="Phone Number" required>
    <label for="Student_phone">Phone </label>
  </div>
  <div class="form-floating mb-3">
    <input type="email" class="form-control " id="Student_email" name="Student_email" placeholder="Email" required>
    <label for="Student_email">Email </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Student_address" name="Student_address" placeholder="Address" required>
    <label for="Student_address">Address </label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control " id="Student_birth_date" name="Student_birth_date" placeholder="Birth Date" required>
    <label for="Student_birth_date">Birth Date </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Student_gender" name="Student_gender" disabled>
      <option value=NULL selected disabled>Open this select Gender </option>
      <option value="male" >male </option>
      <option value="female" >female </option>
      <option value="other" >other </option>
      <option value="prefer_not_to_say" >Prefer not to say</option>
    </select>
  </div>
  <div class="form-floating mb-3">
    <input type="email" class="form-control block-input hidden-input" id="User_user" name="User_user" placeholder="User" disabled>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select " aria-label="Id Parent" id="User_fk" name="User_fk" disabled>
      <option value=NULL selected disabled>Open this select User </option>
      <?php if ($users) : ?>
        <?php foreach ($users as $obj) : ?>
          <option value="<?= $obj['User_id'] ?>"><?= $obj['User_user'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
</form>