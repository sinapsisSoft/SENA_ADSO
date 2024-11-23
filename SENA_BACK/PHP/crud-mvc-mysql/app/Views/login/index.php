<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once FOLDER_VIEWS_CSS . 'style.php'; ?>
  <title><?= $title ?></title>
</head>

<body>
  <div class="container">
    <div class="row">
      <h3> <img src="<?=FOLDER_PUBLIC_ASSETS?>/img/logos/logo.png" class="img img-fluid" width="100"></h3>
    </div>
    <div class="mt-2 mx-auto">
      <div class="card mb-3 ">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="<?= FOLDER_PUBLIC_ASSETS . '/img/background/login.webp' ?>" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $title ?></h5>
              <h6> <?=(isset($_SESSION["message"]))?$_SESSION["message"]:""?></h6>
              <form action="<?= URL_CONTROLLER ?>/login/logIn" method="POST">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control form-control-sm" id="user" name="user" placeholder="name@example.com" required>
                  <label for="user">Email address</label>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">LogIn</button>
              </form>
              <div class="text-center">
              <a href="<?= URL_CONTROLLER ?>/login/viewLostPassword">I forgot the password</a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once FOLDER_VIEWS_ASSETS . 'footer/footerLogin.php'; ?>
  <?php include_once FOLDER_VIEWS_JS . 'js.php'; ?>
</body>

</html>