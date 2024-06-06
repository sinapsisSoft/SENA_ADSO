<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-permissions">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Icon</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($permissions) : ?>
        <?php foreach ($permissions  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Permissions_id']; ?></td>
            <td><?php echo $obj['Permissions_name']; ?></td>
            <td><?php echo $obj['Permissions_description']; ?></td>
            <td><i class="bi <?php echo $obj['Permissions_icon']; ?>"></i></td>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="permission_<?=$obj['Permissions_id']; ?>">
                <label class="form-check-label" for="permission_<?=$obj['Permissions_id']; ?>">
                Select Permissions
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
        <th scope="col">Icon</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>