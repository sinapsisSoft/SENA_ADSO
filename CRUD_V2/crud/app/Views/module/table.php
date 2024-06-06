<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Route</th>
        <th scope="col">Icon</th>
        <th scope="col">Submodule</th>
        <th scope="col">Parent Module</th>
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
            <td><?php echo $obj['Modules_route']; ?></td>
            <td><i class="bi <?php echo $obj['Modules_icon']; ?>"></i></td>
            <td><?php  $check=($obj['Modules_submodule'] == '0') ? 0 : 1; ?>
              <div class="form-check form-switch">
                <input class="form-check-input" style="width: 50%;margin: 0 auto;padding-top: 20px;" type="checkbox" 
                role="switch" id="flexSwitchCheckChecked" <?=($check==0)?"":"checked"?> disabled>
              </div>
            </td>
            <td><?php echo $obj['Modules_parent_module']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show User Status" 
                onclick="show(<?php echo $obj['Modules_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit User Status" 
                onclick="edit(<?php echo $obj['Modules_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete User Status" 
                onclick="delete_(<?php echo $obj['Modules_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
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
        <th scope="col">Route</th>
        <th scope="col">Icon</th>
        <th scope="col">Submodule</th>
        <th scope="col">Parent Module</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>