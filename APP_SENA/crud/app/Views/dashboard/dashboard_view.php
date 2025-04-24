<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS-->
  <?php require_once('../app/Views/assets/css/css.php') ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <!--Title-->
  <title><?= $title ?></title>
</head>

<body>
  <!--Preload -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!--End Preload -->
  <!--Navbar-->
  <?php require_once('../app/Views/nav/navbar.php') ?>
  <!--End Navbar-->
  <!--Container-->
  <div class="container-fluid">
    <div class="row">
      <!--Navbar Slider-->
      <?php require_once('../app/Views/navSlider/navSlider.php') ?>
      <!--End Navbar Slider-->
      <div class="col">
        <h3><?= $title ?></h3>

        <div class="row">
        <?php for($j=0;$j< count($userModules);$j++):?>
      
          <div class="col mt-2 mx-auto">
            <div class="card" style="text-align:center; width: 18em;height: auto; margin: 0 auto; padding: 10px; position: relative;">
              <i class="bi <?= $userModules[$j]['Modules_icon'] ?>" style="font-size: 5em;text-align: center;"> </i>

              <div class="card-body">
                <h5 class="card-title"><?= $userModules[$j]['Modules_name'] ?></h5>
                <p class="card-text"><?= $userModules[$j]['Modules_description'] ?></p>
                <div class="btn-group mx-auto w-100" role="group" aria-label="Basic mixed styles example">
                  <a href="<?= $userModules[$j]['Modules_route'] ?>/show" class="btn btn-warning"><i class="bi bi-clipboard-data-fill"></i></a>
                  <a href="<?= $userModules[$j]['Modules_route'] ?>" class="btn btn-success"><i class="bi <?= $userModules[$j]['Modules_icon'] ?>" > </i></a>
                </div>
              </div>
            </div>
          </div>

          <?php endfor;?>
        </div>
      </div>
    </div>
  </div>
  <!--End Container-->
  <!--Footer-->
  <?php require_once('../app/Views/footer/footer.php') ?>
  <!--End Footer-->


  <!--JS-->
  <?php require_once('../app/Views/assets/js/js.php') ?>
  <?php require_once('../app/Views/assets/js/dataTable.php') ?>
  <!--JS Controller-->
  <script src="../controllers/dashboard/dashboard.js"></script>
</body>

</html>