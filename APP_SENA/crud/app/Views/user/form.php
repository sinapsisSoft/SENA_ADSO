<form id="my-form" class="">
  <input type="hidden" class="form-control" id="User_id" name="User_id" value=null>
  <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
  <div class="form-floating mb-3">
    <input type="email" class="form-control " id="User_user" name="User_user" placeholder="User Email" required>
    <label for="User_user">User Email </label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control " id="User_password" name="User_password" placeholder="Password" required>
    <label for="User_password">Password </label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control " id="Repeat_password" name="Repeat_password" placeholder="Repeat Password" required>
    <label for="Repeat_password">Repeat Password </label>
  </div> 
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Roles_fk" name="Roles_fk" disabled>
      <option value=NULL selected>Open this select Role</option>
      <?php if ($roles) : ?>
        <?php foreach ($roles as $obj) : ?>
          <option value="<?= $obj['Roles_id'] ?>"><?= $obj['Roles_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="User_status_fk" name="User_status_fk" disabled>
      <option value=NULL selected>Open this select User Status</option>
      <?php if ($userStatus) : ?>
        <?php foreach ($userStatus as $obj) : ?>
          <option value="<?= $obj['User_status_id'] ?>"><?= $obj['User_status_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
</form>