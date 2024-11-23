<footer class="py-3 my-4">
  <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    <?php foreach ($roleModules as $module): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_CONTROLLER ?>/<?= $module['module_route'] ?>"><?= $module['role_module'] ?></a>
      </li>
    <?php endforeach ?>
  </ul>
  <p class="text-center text-muted">© 2022 Company, Inc</p>
</footer>