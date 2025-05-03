<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index-students">
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
      <?php if ($students) : ?>
        <?php foreach ($students  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Student_id']; ?></td>
            <td><?php echo $obj['Student_first_name']; ?></td>
            <td><?php echo $obj['Student_last_name']; ?></td>
            <td><?php echo $obj['Student_phone']; ?></td>
            <td><?php echo $obj['Student_email']; ?></td>
            <td><?php echo $obj['Student_address']; ?></td>
            <td><?php echo $obj['Document_type_fk']; ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" style="width: 50%;margin: 0 auto;padding-top: 20px;" onchange="add_student_group(<?php echo $obj['Student_id']; ?>,this)" type="checkbox" role="switch" id="Check_<?php echo $obj['Student_id']; ?>" >
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