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

              <form action="<?= URL_CONTROLLER ?>/user/create" method="POST">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control form-control-sm" id="user" name="user" placeholder="name@example.com" required>
                  <label for="user">Email address</label>
                </div>
               
                <button type="submit" class="btn btn-primary mt-2 w-100">Send</button>
              </form>
              <div class="text-center">
              <a class="btn btn-secondary mt-2 w-100" href="<?= URL_CONTROLLER ?>/login/index">LogIn</a>

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