<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($specialty) : ?>
        <?php foreach ($specialty  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Specialty_id']; ?></td>
            <td><?php echo $obj['Specialty_code']; ?></td>
            <td><?php echo $obj['Specialty_name']; ?></td>
            <td><?php echo $obj['Specialty_description']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button"  title="Button Show Specialty" onclick="show(<?php echo $obj['Specialty_id']; ?>)" 
                class="btn btn-success btn-actions" ><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Specialty" onclick="edit(<?php echo $obj['Specialty_id']; ?>)" 
                class="btn btn-warning btn-actions" ><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete Specialty" onclick="delete_(<?php echo $obj['Specialty_id']; ?>)" 
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
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>