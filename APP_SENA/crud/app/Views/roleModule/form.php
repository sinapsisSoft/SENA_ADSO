<form id="my-form" class="">
  <input type="hidden" class="form-control" id="RoleModules_id" name="RoleModules_id" value=null>
  <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
  <div class="form-floating mb-3 col-12">
    <select class="form-select edit-input" onchange="getModels(this.value)" aria-label="Id Parent" id="Roles_id" name="Roles_id" disabled required>
      <option value=0 selected>Open this select Role</option>
      <?php if ($roles) : ?>
        <?php foreach ($roles as $obj) : ?>
          <option value="<?= $obj['Roles_id'] ?>"><?= $obj['Roles_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
   <?php require_once('../app/Views/roleModule/tableModules.php')?>
  </div>
</form>