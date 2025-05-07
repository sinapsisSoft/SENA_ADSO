<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-index-students">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Document</th>
        <th scope="col">Type Document</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>

      <?php if ($programGroups) : ?>
        <?php foreach ($programGroups  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Student_id']; ?></td>
            <td><?php echo $obj['Student_document']; ?></td>
            <td><?php echo $obj['Document_type_code']; ?></td>
            <td><?php echo $obj['Student_first_name']; ?></td>
            <td><?php echo $obj['Student_last_name']; ?></td>
            <td><?php echo $obj['Student_phone']; ?></td>
            <td><?php echo $obj['Student_email']; ?></td>
            <td><?php echo $obj['Student_status_name']; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show Programs group"
                  onclick="show(<?php echo $obj['Student_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                
                <button type="button" title="Button Delete Programs group"
                  onclick="delete_(<?php echo $obj['Student_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Document</th>
        <th scope="col">Type Document</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>