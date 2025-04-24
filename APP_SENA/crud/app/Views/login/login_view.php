<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS-->
  <?php require_once('../app/Views/assets/css/css.php') ?>
  <!--Title-->
  <title><?= $title ?></title>
</head>

<body>
  <!--Preload -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!--End Preload -->
  <!--Container-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-6 mt-5 mx-auto">
        <div class="card">
          <img src="../assets/img/logos/logo.png" class="card-img-top w-25 mx-auto" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $title ?></h5>
            <?php require_once('../app/Views/login/form.php') ?>
          </div>
        </div>
        <a href="#" class="text-info " onclick="showForget()">Forgot password</a>
      </div>

    </div>
  </div>
  <!--End Container-->
  <!--Footer-->
  <?php require_once('../app/Views/footer/footer.php') ?>
  <!--End Footer-->

  <!--Modal-->
  <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--Form-->
          <?php require_once('../app/Views/login/forgetPassword.php') ?>
          <!--End Form-->
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" id="btnSubmit" class="btn btn-primary">Send Data</button>
        </div>

      </div>
    </div>
  </div>
  <!--End Modal-->

  <!--JS-->
  <?php require_once('../app/Views/assets/js/js.php') ?>
  <!--JS Controller-->
  <script src="../controllers/login/login.js"></script>
</body>

</html>