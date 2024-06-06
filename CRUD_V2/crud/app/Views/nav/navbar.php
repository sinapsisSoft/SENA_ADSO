<?php
$session = session();
$getUser = $session->get(LOGGED_USER);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../assets/img/logos/logo.png" width="35px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex flex-row-reverse bd-highlight" id="navbarSupportedContent">
      <div class="btn-group dropstart">
        <button type="button" title="Profile" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="#"><i class="bi bi-person-bounding-bo"></i> <?= $getUser['User_user'] ?></a>
          </li>
          <li>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#my-profile"><i class="bi bi-person-lines-fill"></i> Profile</a>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item " href="#" onclick="signOff()"><i class="bi bi-box-arrow-left" style="color: red;"></i> Sign off</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="my-profile" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modalLabel">PROFILE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        <form id="my-modal_profile" class="">
          <input type="hidden" class="form-control" id="Profile_id" name="Profile_id" value=null>
          <input type="hidden" class="form-control" id="User_id_fk" name="User_id_fk" value=null>
          <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
          <div class="form-floating mb-3">
            <img src="<?= isset($profile['Profile_photo']) ? $profile['Profile_photo'] : '' ?>" class="img-thumbnail w-100" alt="...">
            <label for="Profile_photo">Photo </label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control " id="Profile_photo" name="Profile_photo" placeholder="Photo" value="<?= isset($profile['Profile_photo']) ? $profile['Profile_photo'] : '' ?>" required>
            <label for="Profile_photo">Photo </label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control " id="Profile_email" name="Profile_email" placeholder="Email Address" value="<?= isset($profile['Profile_email']) ? $profile['Profile_email'] : '' ?>" required>
            <label for="Profile_email">Email Address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control " id="Profile_name" name="Profile_name" placeholder="Name" value="<?= isset($profile['Profile_name']) ? $profile['Profile_name'] : '' ?>" required>
            <label for="Profile_name">Name </label>
          </div>
        </form>
        <!--End Form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="my-form" id="btnSubmit" class="btn btn-primary">Send Data</button>
      </div>
    </div>
  </div>
</div>