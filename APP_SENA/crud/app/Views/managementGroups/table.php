<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-management">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Code</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($managementGroup) : ?>
        <?php foreach ($managementGroup  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Management_group_id']; ?></td>
            <td><?php echo $obj['Management_group_start_date']; ?></td>
            <td><?php echo $obj['Management_group_end_date']; ?></td>
            <td><?php echo $obj['Program_group_code']; ?></td>
            <td><?php echo $obj['Management_group_status']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show Management group"
                  onclick="show(<?php echo $obj['Management_group_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Management group"
                  onclick="edit(<?php echo $obj['Management_group_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square"></i> </button>
                <button type="button" title="Button Delete Management group"
                  onclick="delete_(<?php echo $obj['Management_group_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Code</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>