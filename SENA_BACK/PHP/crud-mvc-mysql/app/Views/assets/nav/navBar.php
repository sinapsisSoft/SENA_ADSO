<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <img src="<?= FOLDER_PUBLIC_ASSETS ?>/img/logos/logo.png" class="img img-fluid" width="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php foreach ($roleModules as $module): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=URL_CONTROLLER ?>/<?=$module['module_route']?>" ><?= $module['role_module'] ?></a>
          </li>
        <?php endforeach ?>
      </ul>
      <ul class="navbar-nav d-flex " style="padding-right:100px !important;">
        <li class="nav-item dropdown">
          <div class="btn-group dropstart">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><?= ($getUser[0]['user_user']) ?></a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li style="background: red;"><a style="color:gray;" class="dropdown-item" href="<?= URL_CONTROLLER ?>/login/logOut">Log Out</a></li>
            </ul>
          </div>
        </li>
      </ul>

    </div>
  </div>
</nav>