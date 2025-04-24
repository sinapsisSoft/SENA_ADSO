<form id="my-formPermission" class="">
  <input type="hidden" class="form-control" id="PermissionsModules_id" name="PermissionsModules_id" value=null>
  <input type="hidden" class="form-control" id="RoleModules_id" name="RoleModules_id" value=null>
  <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
  <div class="form-floating mb-3 col-12">
    <select class="form-select edit-input" aria-label="Id Parent" id="Modules_id" name="Modules_id" disabled required>
      <option value=0 selected>Open this select Modules</option>
      <?php if ($modules) : ?>
        <?php foreach ($modules as $obj) : ?>
          <option value="<?= $obj['Modules_id'] ?>"><?= $obj['Modules_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-floating mb-3 col-12">
   <?php require_once('../app/Views/roleModule/tablePermission.php')?>
  </div>
</form>