<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Id Module</th>
        <th scope="col">Id Role</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($roleModules) : ?>
        <?php foreach ($roleModules  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['RoleModules_id']; ?></td>
            <td><?php echo $obj['Modules_name']; ?></td>
            <td><?php echo $obj['Roles_name']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Edit User Status" 
                onclick="editModules(<?php echo $obj['Roles_fk']; ?>,<?php echo $obj['RoleModules_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Show User Status" 
                onclick="editPermissions(<?php echo $obj['Modules_fk']; ?>,<?php echo $obj['RoleModules_id']; ?>)" class="btn btn-info btn-actions"><i class="bi bi-shield-lock-fill"></i></button>
                <button type="button" title="Button Delete User Status" 
                onclick="delete_(<?php echo $obj['RoleModules_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
      <th scope="col">#</th>
      <th scope="col">Id Module</th>
        <th scope="col">Id Role</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>