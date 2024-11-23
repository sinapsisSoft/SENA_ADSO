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
    <div class="row">
      <?php foreach ($roleModules as $module): ?>

        <div class="card mx-auto" style="width: 18rem;margin:5px">
          <div class="card-body">
            <h5 class="card-title"><?= $module['module_icon'] ?> <?= $module['role_module'] ?></h5>
            <p class="card-text"><?= $module['module_description'] ?></p>
            <a href="<?= URL_CONTROLLER ?>/<?= $module['module_route'] ?>" class="btn btn-primary w-100"><?= $module['role_module'] ?></a>
          </div>
        </div>
      <?php endforeach ?>

    </div>

  </div>
  <?php include_once FOLDER_VIEWS_ASSETS . 'footer/footer.php'; ?>
    <?php include_once FOLDER_VIEWS_JS . 'js.php'; ?>
</body>

</html>