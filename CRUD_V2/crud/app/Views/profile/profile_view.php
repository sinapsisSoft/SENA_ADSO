<div class="modal fade" id="my-profile" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel">PROFILE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--Form-->
          <?php require_once('../app/Views/profile/form.php') ?>
          <!--End Form-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" id="btnSubmit" class="btn btn-primary">Send Data</button>
        </div>
      </div>
    </div>
  </div>
