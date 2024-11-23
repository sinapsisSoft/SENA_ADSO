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
    <h3><?= $title ?></h3>

    <div class="row">

    <form action="<?= URL_CONTROLLER ?>/user/create" method="POST">
        <div class="form-floating mb-3">
          <input type="email" class="form-control form-control-sm" id="user" name="user" placeholder="name@example.com" required>
          <label for="user">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        <select class="form-select form-select-sm mt-2" aria-label=".form-select-sm example" id="role" name="role" required>
          <option disabled selected value>Open this select role</option>
          <?php for ($i = 0; $i < count($roles); $i++): ?>
            <option value="<?= $roles[$i]['role_id'] ?>"><?= $roles[$i]['role_name'] ?></option>
          <?php endfor ?>
        </select>
        <select class="form-select form-select-sm mt-2" aria-label=".form-select-sm example" id="status" name="status" required>
          <option disabled selected value>Open this select user status</option>
          <?php for ($i = 0; $i < count($status); $i++): ?>
            <option value="<?= $status[$i]['userStatus_id'] ?>"><?= $status[$i]['userStatus_name'] ?></option>
          <?php endfor ?>
        </select>
        <button type="submit" class="btn btn-success mt-2 w-100">Success</button>
      </form>
    </div>


  </div>
  <?php include_once FOLDER_VIEWS_ASSETS . 'footer/footer.php'; ?>
  <?php include_once FOLDER_VIEWS_JS . 'js.php'; ?>
</body>

</html>