<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once FOLDER_VIEWS_CSS . 'style.php'; ?>
  <title><?= $title ?></title>
</head>

<body>
  <?php include_once FOLDER_VIEWS_ASSETS . 'nav/navBar.php'; ?>
  <div class="container">

  <h3>Table Roles</h3>

    <a href="<?= URL_CONTROLLER ?>/role/viewCreate" class="btn btn-primary btnFloating"><i class="bi bi-people-fill"></i></a>

 
    </div>

    <div class="row mt-2">
    
      <hr>
      <div class="table-responsive col-10 mx-auto">
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php for ($i = 0; $i < count($roles); $i++): ?>
              <tr>
                <th scope="row" class="text-center"><?= $i + 1 ?></th>
                <td class="text-center"><?= $roles[$i]['role_name'] ?></td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a type="button" class="btn btn-success" href="<?= URL_CONTROLLER ?>/role/showId/<?= $roles[$i]['role_id'] ?>"><i class="bi bi-eye-fill"></i></a>
                    <a type="button" class="btn btn-warning" href="<?= URL_CONTROLLER ?>/role/edit/<?= $roles[$i]['role_id'] ?>"><i class="bi bi-pencil-square"></i></a>
                    <a type="button" class="btn btn-danger" href="<?= URL_CONTROLLER ?>/role/viewDelete/<?= $roles[$i]['role_id'] ?>"><i class="bi bi-trash-fill"></i></a>
                  </div>
                </td>
              </tr>
            <?php endfor ?>
          </tbody>
          <tfoot class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tfoot>
        </table>
      </div>
    </div>

  </div>
  <?php include_once FOLDER_VIEWS_ASSETS . 'footer/footer.php'; ?>
  <?php include_once FOLDER_VIEWS_JS . 'js.php'; ?>

</body>

</html>