<div class="container-fluid">

<header style="height: 60px;background: #009fff36;">
  <img style="width: 60px;position: absolute;" src="../../../public/assets/img/logo/logo.png" alt="">
  <ul class="nav justify-content-end">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="../home/home.php">HOME</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../user/user.php">USER</a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../../../public/assets/img/icons/person-circle.svg"></a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#"><?= $_SESSION["Id_User"] ?></a></li>
        <li><a class="dropdown-item" href="#">CERRAR</a></li>


      </ul>
    </li>
  </ul>
</header>
</div>