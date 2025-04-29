<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Document Type</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($instructors) : ?>
        <?php foreach ($instructors  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Instructor_id']; ?></td>
            <td><?php echo $obj['Instructor_first_name']; ?></td>
            <td><?php echo $obj['Instructor_last_name']; ?></td>
            <td><?php echo $obj['Instructor_phone']; ?></td>
            <td><?php echo $obj['Instructor_email']; ?></td>
            <td><?php echo $obj['Instructor_address']; ?></td>
            <td><?php echo $obj['Document_type_fk']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show Instructor"
                  onclick="show(<?php echo $obj['Instructor_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Instructor"
                  onclick="edit(<?php echo $obj['Instructor_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete Instructor"
                  onclick="delete_(<?php echo $obj['Instructor_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
      <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">User</th>
        <th scope="col">Document Type</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>