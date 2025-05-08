<form id="my-form" class="">
  <input type="hidden" class="form-control" id="User_id" name="User_id" value=null>
  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
  <div class="form-floating mb-3">
    <input type="email" class="form-control " id="User_user" name="User_user" placeholder="User" required>
    <label for="User_user">User </label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" size="10" minlength="8" class="form-control " id="User_password" name="User_password" placeholder="Password" required>
    <label for="User_password">Password </label>
  </div>
 
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Roles_fk" name="Roles_fk">
      <option value=NULL selected disabled>Open this select Role </option>
      <?php if ($roles) : ?>
        <?php foreach ($roles as $obj) : ?>
          <option value="<?= $obj['Roles_id'] ?>"><?= $obj['Roles_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="User_status_fk" name="User_status_fk">
      <option value=NULL selected disabled>Open this select Status </option>
      <?php if ($userStatus) : ?>
        <?php foreach ($userStatus as $obj) : ?>
          <option value="<?= $obj['User_status_id'] ?>"><?= $obj['User_status_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
 
 
 
</form>