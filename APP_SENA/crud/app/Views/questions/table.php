<div class="table-responsive mx-auto">
  <table class="table table-hover" id="table-questions">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Questionnaire</th>
        <th scope="col">Description</th>
        <th scope="col">Answer Type</th>
        <th scope="col">Weight</th>
        <th scope="col">Display Order </th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($questions) : ?>
        <?php foreach ($questions  as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj['Question_id']; ?></td>
            <td><?php echo $obj['Questionnaire_name']; ?></td>
            <td><?php echo $obj['Question_text']; ?></td>
            <td><?php echo $obj['Question_answer_type']; ?></td>
            <td><?php echo $obj['Question_weight']; ?></td>
            <td><?php echo $obj['Question_display_order']; ?></td>
            <td><?php echo ($obj['Qis_active']==1)?"Active":"Inactive"; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" title="Button Show Questions"
                  onclick="show(<?php echo $obj['Question_id']; ?>)" class="btn btn-success btn-actions"><i class="bi bi-eye-fill"></i></button>
                <button type="button" title="Button Edit Questions"
                  onclick="edit(<?php echo $obj['Question_id']; ?>)" class="btn btn-warning btn-actions"><i class="bi bi-pencil-square" style="color:white"></i> </button>
                <button type="button" title="Button Delete Questions"
                  onclick="delete_(<?php echo $obj['Question_id']; ?>)" class="btn btn-danger btn-actions"><i class="bi bi-trash-fill"></i></button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Questionnaire</th>
        <th scope="col">Description</th>
        <th scope="col">Answer Type</th>
        <th scope="col">Weight</th>
        <th scope="col">Display Order </th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>