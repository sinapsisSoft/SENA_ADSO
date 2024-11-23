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

      <form action="<?= URL_CONTROLLER ?>/user/update/<?=$user[0]['user_id']?>" method="POST">
        <div class="form-floating mb-3">
          <input type="email" class="form-control form-control-sm" id="user" name="user" placeholder="name@example.com" value="<?= $user[0]['user_user'] ?>" required disabled>
          <label for="user">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" style="text-overflow: ellipsis;" class="form-control form-control-sm" id="password" name="password" placeholder="Password" value="<?= $user[0]['user_password'] ?>" required disabled>
          <label for="password">Password</label>
        </div>
        <select class="form-select form-select-sm mt-2" aria-label=".form-select-sm example" id="role" name="role" required >
          <option disabled value>Open this select role</option>
          <?php for ($i = 0; $i < count($roles); $i++): ?>
            <?php if ($roles[$i]['role_id'] == $user[0]['role_fk']): ?>
              <option selected value="<?= $roles[$i]['role_id'] ?>"><?= $roles[$i]['role_name'] ?></option>
            <?php else: ?>
              <option value="<?= $roles[$i]['role_id'] ?>"><?= $roles[$i]['role_name'] ?></option>
            <?php endif ?>
          <?php endfor ?>
        </select>
        <select class="form-select form-select-sm mt-2" aria-label=".form-select-sm example" id="status" name="status" required >
          <option disabled value>Open this select user status</option>
          <?php for ($i = 0; $i < count($status); $i++): ?>
            <?php if ($status[$i]['userStatus_id'] == $user[0]['userStatus_fk']): ?>
              <option selected value="<?= $status[$i]['userStatus_id'] ?>"><?= $status[$i]['userStatus_name'] ?></option>
            <?php else: ?>
              <option value="<?= $status[$i]['userStatus_id'] ?>"><?= $status[$i]['userStatus_name'] ?></option>
            <?php endif ?>
          <?php endfor ?>
        </select>
        <button type="submit" class="btn btn-primary mt-2 w-100" title="Update">Update</button>
      </form>
    </div>


  </div>
  <?php include_once FOLDER_VIEWS_ASSETS . 'footer/footer.php'; ?>
  <?php include_once FOLDER_VIEWS_JS . 'js.php'; ?>
</body>

</html>