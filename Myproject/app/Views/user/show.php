<?php
/**
 * Author:DIEGO CASALLAS
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is view role
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Title Page -->
    <title><?= $title ?></title>
    <!---Style -->
    <?php include_once(PATH_VIEWS . PATH_CSS . 'style.php') ?>
</head>
<body>
    <!---Container preload-->
    <div class="preload" id="preload">
        <div class="text-center" style="margin-top: 25%;">
            <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!---End Container preload-->
    <!---Container table-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 mx-auto">
                <h3>List User</h3>
                <!---Btn Add -->
                <button type="button" class="btn btn-success" onclick="createUser('form_login')" ><img src="<?= PATH_IMG_ICONS ?>person-fill-add.svg"></button>
                <!---Btn Add -->
                <!---Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Password</th>
                                <th scope="col">State</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="idTbody">
                            <?php
                            $cont = 1;
                            foreach ($data as $user) {
                                echo ('<tr>');
                                echo ('<td>' . $cont . '</td>');
                                echo ('<td>' . $user['User_user'] . '</td>');
                                echo ('<td>' . $user['User_password'] . '</td>');
                                echo ('<td>' . $user['User_status_name'] . '</td>');
                                echo ('<td>' . $user['Role_name'] . '</td>');
                                echo ('<td><div class="btn-group" role="group" aria-label="Basic mixed styles example">');
                                echo ('<button type="button" class="btn btn-success"><img src="' . PATH_IMG_ICONS . 'eye-fill.svg"></button>');
                                echo ('<button type="button" class="btn btn-warning"><img src="' . PATH_IMG_ICONS . 'pencil-square.svg"></button>');
                                echo (' <button type="button" class="btn btn-danger"><img src="' . PATH_IMG_ICONS . 'trash3-fill.svg"></button>');
                                echo ('</div></td>');
                                echo ('</tr>');
                                $cont++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Password</th>
                                <th scope="col">State</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---End Table -->
            </div>
        </div>
    </div>

    <!---End Container table-->
    <!--Container Modal-->
       <!-- Modal -->
       <div class="modal fade" id="modalApp" tabindex="-1"
      aria-labelledby="modalAppLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAppLabel">USER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form -->
            <form id="my-form" >
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email
                                address</label>
                            <input type="email" class="form-control input_disabled" maxlength="50" minlength="10" name="user_email" id="user_email" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control input_disabled" id="user_password" name="user_password" maxlength="20" minlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="user_password_repeat" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control input_disabled" id="user_password_repeat" name="user_password_repeat" maxlength="20" minlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="user_role" class="form-label">Rol</label>
                            <select class="form-select" aria-label="Default select example" name="user_role" id="user_role">
                                <option selected>Open this select
                                    menu</option>
                                <?php
                                for ($i = 0; $i < $log; $i++) {
                                    echo ('<option value="' . $roles[$i]['Role_id'] . '">' . $roles[$i]['Role_name'] . '</option>');
                                }
                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_state" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="user_state" id="user_state">

                            </select>
                        </div>

                    </form>
            <!-- End Form -->
          </div>
          <div class="modal-footer">
          <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit"  form="form_login">Send</button>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!--Container modal-->

    <!---Container javascript-->
    <?php include_once(PATH_VIEWS . PATH_JS . 'scriptJs.php') ?>
    <!---Container javascript view-->
    <script src="<?=PATH_CONTROLLERS_JS?>user/userController.js"></script>
</body>

</html>