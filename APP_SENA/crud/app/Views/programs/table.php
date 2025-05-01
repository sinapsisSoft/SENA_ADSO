<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Start Date </th>
        <th scope="col">End Date </th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($programs) : ?>
        <?php foreach ($programs  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Programs_id']; ?></td>
            <td><?php echo $obj['Programs_code']; ?></td>
            <td><?php echo $obj['Programs_name']; ?></td>
            <td><?php echo $obj['Programs_description']; ?></td>
            <td><?php echo $obj['Programs_status']; ?></td>
            <td><?php echo $obj['Programs_start_date']; ?></td>
            <td><?php echo $obj['Programs_end_date']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show Courses"
                  onclick="show(<?php echo $obj['Programs_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Courses"
                  onclick="edit(<?php echo $obj['Programs_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete Courses"
                  onclick="delete_(<?php echo $obj['Programs_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
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
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Start Date </th>
        <th scope="col">End Date </th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>