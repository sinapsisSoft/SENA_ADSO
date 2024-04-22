<?php

/**
 * Author:DIEGO CASALLAS
 * Date:17/04/2024
 * Update Date:
 * Descriptions: this is view login
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!---Title Page -->
  <title><?= $title ?></title>
  <!---Style -->
  <?php include_once(PATH_VIEWS . PATH_CSS . 'style.php') ?>
</head>

<body>
  <!---Container preload-->
  <div class="preload" id="preload">
    <div class="text-center" style="margin-top: 25%;">
      <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
  <!---End Container preload-->
  <!---Container form-->
  <div class="container-fluid">
    <div class="row">
      <form id="my-form">
        <div class="form-floating mb-3">
          <input type="email" class="form-control"  id="User_user" name="User_user" placeholder="name@example.com"  required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="User_password" name="User_password" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <div>
          <input type="submit" class="btn btn-primary w-100 mt-1" value="SEND DATA">
        </div>
      </form>
    </div>
  </div>

  <!---End Container table-->
  <!--Container form-->


  <!---Container javascript-->
  <?php include_once(PATH_VIEWS . PATH_JS . 'scriptJs.php') ?>
  <!---Container javascript view-->
  <script src="<?= PATH_CLASS_JS ?>Form.js"></script>
  <!---Container javascript class-->
  <script src="<?= PATH_CONTROLLERS_JS ?>login/loginController.js"></script>

</body>

</html>