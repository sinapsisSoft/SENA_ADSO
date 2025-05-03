<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($studentStatus) : ?>
        <?php foreach ($studentStatus  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Student_status_id']; ?></td>
            <td><?php echo $obj['Student_status_name']; ?></td>
            <td><?php echo $obj['Student_status_description']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button"  title="Button Show Student Status" onclick="show(<?php echo $obj['Student_status_id']; ?>)" 
                class="btn btn-success btn-actions" ><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Student Status" onclick="edit(<?php echo $obj['Student_status_id']; ?>)" 
                class="btn btn-warning btn-actions" ><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete Student Status" onclick="delete_(<?php echo $obj['Student_status_id']; ?>)" 
                class="btn btn-danger btn-actions" ><i class="bi bi-trash-fill"></i></button>
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
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>