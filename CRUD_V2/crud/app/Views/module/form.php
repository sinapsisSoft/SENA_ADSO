<form id="my-form" class="">
  <input type="hidden" class="form-control" id="Modules_id" name="Modules_id" value=null>
  <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Modules_name" name="Modules_name" placeholder="Name" required>
    <label for="Modules_name">Name </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Modules_description" name="Modules_description" placeholder="Description" required>
    <label for="Modules_description">Description </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Modules_route" name="Modules_route" placeholder="Route" required>
    <label for="Modules_route">Route </label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control " id="Modules_icon" name="Modules_icon" placeholder="Icon" required>
    <label for="Modules_icon">Icon </label>
  </div>
  <div class="form-floating mb-3 col-12">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="Modules_submodule" name="Modules_submodule">
      <label class="form-check-label" for="Modules_submodule">Submodule</label>
    </div>
  </div>
  <div class="form-floating mb-3 col-12">
    <select class="form-select" aria-label="Id Parent" id="Modules_parent_module" name="Modules_parent_module" disabled>
      <option value=NULL selected>Open this select Module</option>
      <?php if ($modulesParent) : ?>
        <?php foreach ($modulesParent as $moduleParent) : ?>
          <option value="<?= $moduleParent['Modules_id'] ?>"><?= $moduleParent['Modules_name'] ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
</form>