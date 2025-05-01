<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Code</th>
        <th scope="col">Start Date </th>
        <th scope="col">End Date </th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($programGroups) : ?>
        <?php foreach ($programGroups  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Program_group_id']; ?></td>
            <td><?php echo $obj['Program_group_code']; ?></td>
            <td><?php echo $obj['Program_group_start_date']; ?></td>
            <td><?php echo $obj['Program_group_end_date']; ?></td>
            <td><?php echo $obj['Program_group_status']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                
                  <button type="button" title="Button Delete Student Programs group"
                  onclick="show_student(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-info btn-actions"><i class="bi bi-person-badge-fill"></i></button>
                  <button type="button" title="Button manager  Management Programs group"
                  onclick="show_management(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-primary btn-actions"><i class="bi bi-activity"></i></button>
                  <button type="button" title="Button manager  Assessment Programs group"
                  onclick="show_assessment(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-light btn-actions"><i class="bi bi-bar-chart-steps"></i></button>
                  <button type="button" title="Button Show Programs group"
                  onclick="show(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Programs group"
                  onclick="edit(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" ></i> </button>
                <button type="button" title="Button Delete Programs group"
                  onclick="delete_(<?php echo $obj['Program_group_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Code</th>
        <th scope="col">Start Date </th>
        <th scope="col">End Date </th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>