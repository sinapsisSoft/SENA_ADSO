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

  <h3>Table Users</h3>

    <a href="<?= URL_CONTROLLER ?>/user/viewCreate" class="btn btn-primary btnFloating"><i class="bi bi-person-add"></i></a>

    <!-- <div class="row">
      <form action="#" method="GET">
        <div class="input-group mb-3">

          <select class="form-select " aria-label=".form-select-sm example"  required>
            <option disabled selected value>Open this select </option>
            <option value="1">Email</option>
            <option value="2">Role</option>
            <option value="3">Status</option>
          </select>
          <input type="text" class="form-control"id="search" name="search" aria-label="Text input with segmented dropdown button" required>
          <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>

      </form> --> 
    </div>

    <div class="row mt-2">
    
      <hr>
      <div class="table-responsive col-10 mx-auto">
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Password</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php for ($i = 0; $i < count($users); $i++): ?>
              <tr>
                <th scope="row"><?= $i + 1 ?></th>
                <td><?= $users[$i]['user_user'] ?></td>
                <td><?= $users[$i]['user_password'] ?></td>
                <td><?= $users[$i]['role_fk'] ?></td>
                <td><?= $users[$i]['userStatus_fk'] ?></td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a type="button" class="btn btn-success" href="<?= URL_CONTROLLER ?>/user/showId/<?= $users[$i]['user_id'] ?>"><i class="bi bi-eye-fill"></i></a>
                    <a type="button" class="btn btn-warning" href="<?= URL_CONTROLLER ?>/user/edit/<?= $users[$i]['user_id'] ?>"><i class="bi bi-pencil-square"></i></a>
                    <a type="button" class="btn btn-danger" href="<?= URL_CONTROLLER ?>/user/viewDelete/<?= $users[$i]['user_id'] ?>"><i class="bi bi-trash-fill"></i></a>
                  </div>
                </td>
              </tr>
            <?php endfor ?>
          </tbody>
          <tfoot class="text-center">
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Password</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
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