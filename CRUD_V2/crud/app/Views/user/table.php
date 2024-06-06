<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">User</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
        <th scope="col">User Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($users) : ?>
        <?php foreach ($users  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['User_id']; ?></td>
            <td><?php echo $obj['User_user']; ?></td>
            <td><input style="border: 0px;" type="password" value="<?php echo $obj['User_password']; ?>" disabled></td>
            <td><?php echo $obj['Roles_name']; ?></td>
            <td><?php echo $obj['User_status_name']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show User Status" 
                onclick="show(<?php echo $obj['User_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit User Status" 
                onclick="edit(<?php echo $obj['User_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete User Status" 
                onclick="delete_(<?php echo $obj['User_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
      <th scope="col">#</th>
        <th scope="col">User</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
        <th scope="col">User Status</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>