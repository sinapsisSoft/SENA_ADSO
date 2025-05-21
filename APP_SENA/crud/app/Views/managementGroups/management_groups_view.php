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

        <button type="button" class="btn btn-primary btn-actions" title="Button new User Status" onclick="add(<?php echo $programGroup['Program_group_id']; ?>)" style="font-size: 0.5em;">
          <i class="bi bi-plus-circle-fill"></i> </button>
        <!--Container Table-->
        <?php require_once('../app/Views/managementGroups/table.php') ?>
        <!--End Container Table-->
      </div>
    </div>
  </div>
  <!--End Container-->
  <!--Footer-->
  <?php require_once('../app/Views/footer/footer.php') ?>
  <!--End Footer-->
  <!--Modal management-->
  <?php require_once('../app/Views/managementGroups/management_modal.php') ?>
  <!--End Modal management-->
    <!--Modal management-->
  <?php require_once('../app/Views/managementGroups/instructors_modal.php') ?>
  <!--End Modal management-->

  <!--JS-->
  <?php require_once('../app/Views/assets/js/js.php') ?>
  <?php require_once('../app/Views/assets/js/dataTable.php') ?>
  <!--JS Controller-->
  <script src="<?= base_url('controllers/managementGroups/managementGroups.js') ?>"></script>

</body>

</html>