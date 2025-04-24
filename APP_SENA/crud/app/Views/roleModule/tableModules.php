<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-module">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Submodule</th>
        <th scope="col">Icon</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($modules) : ?>
        <?php foreach ($modules  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Modules_id']; ?></td>
            <td><?php echo $obj['Modules_name']; ?></td>
            <td><?php echo $obj['Modules_description']; ?></td>
            <td><?php $check = ($obj['Modules_submodule'] == '0') ? 0 : 1; ?>
              <div class="form-check form-switch" style="padding-left: 4.5em;">
                <input class="form-check-input edit-input" style="width: 50%;margin: 0 auto;padding-top: 20px;" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= ($check == 0) ? "" : "checked" ?> disabled>
              </div>
            </td>
            <td><i class="bi <?php echo $obj['Modules_icon']; ?>"></i></td>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="module_<?=$obj['Modules_id']; ?>">
                <label class="form-check-label" for="module_<?=$obj['Modules_id']; ?>">
                Select Module
                </label>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Submodule</th>
        <th scope="col">Icon</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>