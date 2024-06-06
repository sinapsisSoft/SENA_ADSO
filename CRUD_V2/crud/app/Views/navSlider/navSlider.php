<div class="col-2" id="container-slider">
  <div class="accordion accordion-flush" id="accordionApp">
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $getModuleUrl = $getModuleUrl = substr($url, strpos($url, '/') + 1, strlen($url));
    $getModuleUrl = explode("/",  $getModuleUrl);
    $subModule = "";
    $modelsLength = count($userModules);
    $selectActive = "";
    $selectShow = "";
    foreach ($userModules as $module) :
      $getModuleId = $module['Modules_fk'];
      $selectShow = "";
      if ($module['Modules_submodule'] == 0) :
    ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $getModuleId ?>" aria-expanded="false" aria-controls="flush-collapse<?= $getModuleId ?>">
              <i class="bi <?= $module['Modules_icon'] ?>"> <?= $module['Modules_name'] ?></i>
            </button>
          </h2>
          <div id="flush-collapse<?= $getModuleId ?>" class="accordion-collapse collapse menu-slide <?= $module['Modules_route'] == $getModuleUrl[0] ? "show" : "" ?>" data-bs-parent="#accordionApp">
           
          <ul class="list-group">
              <?php
              $selectActive = "";
              if ($module['Modules_route'] == $getModuleUrl[0]) {
                $selectActive = "active";
              }
              $subModule = '<li class="list-group-item "><a class="list-group-item ' . $selectActive . ' list-group-item-action "  href="/' . $module['Modules_route'] . '" style="cursor: pointer; padding-left: 25px; font-size: 0.9em;"><i class="bi ' . $module['Modules_icon'] . '"> ' . $module['Modules_name'] . '</i></a></li>';
              for ($i = 0; $i < $modelsLength; $i++) :
                $elements = $userModules[$i];
                if (($getModuleId == $elements['Modules_parent_module']) && ($elements['Modules_submodule'] == 1)) {
                  $selectActive = "";

                  if ($elements['Modules_route'] == $getModuleUrl[0]) {
                    $selectActive = "active";
                  }
                  $subModule = $subModule . '<li class="list-group-item ' . $selectActive . '"><a class="list-group-item list-group-item-action" href="/' . $elements['Modules_route'] . '" style="cursor: pointer; padding-left: 25px; font-size: 0.9em;"><i class="bi ' . $elements['Modules_icon'] . '"> ' . $elements['Modules_name'] . '</i></a></li>';
                }
              endfor;
              echo ($subModule);
              $subModule = '';
              ?>
            </ul>

          </div>
        </div>

    <?php
      endif;
    endforeach; ?>
  </div>
</div>