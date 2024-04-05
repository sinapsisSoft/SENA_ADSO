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
                <button type="button" class="btn btn-success" onclick="create()"><img src="<?= PATH_IMG_ICONS ?>person-fill-add.svg"></button>
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
                            foreach ($users as $user) {
                                echo ('<tr>');
                                echo ('<td>' . $cont . '</td>');
                                echo ('<td>' . $user['User_user'] . '</td>');
                                echo ('<td>' . $user['User_password'] . '</td>');
                                echo ('<td>' . $user['User_status_name'] . '</td>');
                                echo ('<td>' . $user['Role_name'] . '</td>');
                                echo ('<td><div class="btn-group" role="group" aria-label="Basic mixed styles example">');
                                echo ('<button type="button"  onclick="showId(' . $user['User_id'] . ')" class="btn btn-success"><img src="' . PATH_IMG_ICONS . 'eye-fill.svg"></button>');
                                echo ('<button type="button"  onclick="edit(' . $user['User_id'] . ')" class="btn btn-warning"><img src="' . PATH_IMG_ICONS . 'pencil-square.svg"></button>');
                                echo (' <button type="button" onclick="delete_(' . $user['User_id'] . ')" class="btn btn-danger"><img src="' . PATH_IMG_ICONS . 'trash3-fill.svg"></button>');
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
    <div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalAppLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAppLabel"><?= $title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form id="my-form">

                        <input type="hidden" id="User_id">
                        <div class="form-floating mb-3">
                            <input type="email" minlength="6" maxlength="30" title="Validate the data entered" class="form-control" id="User_user" name="User_user" placeholder="Enter User" required>
                            <label for="User_user">User</label>
                        </div>
                        <label for="User_password">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" minlength="6" maxlength="12" title="Validate the data entered" class="form-control" name="User_password" id="User_password" data-type="password" placeholder="Enter Password" required>
                            <button class="btn btn-secondary" type="button" id="btn-password"><img src="<?= PATH_IMG_ICONS ?>eye-slash-fill.svg" alt></button>
                        </div>
                        <label for="repeatPassword">Repeat Password</label>
                        <div class="input-group mb-3">
                            <input type="password" minlength="6" maxlength="12" title="Validate the data entered" class="form-control" id="repeatPassword" data-type="password" placeholder="Repeat Password" required>
                            <button class="btn btn-secondary" type="button" id="btn-passwordRP"><img src="<?= PATH_IMG_ICONS ?>eye-slash-fill.svg" alt></button>
                        </div>
                        <div class="mb-3">
                            <label for="user_role" class="form-label">Rol</label>
                            <select class="form-select" aria-label="Default select example" name="Role_id" id="Role_id">
                                <option selected>Open this select
                                    menu</option>
                                <?php
                                foreach ($roles as $role) {
                                    echo ('<option value="' . $role['Role_id'] . '">' . $role['Role_name'] . '</option>');
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_state" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="User_status_id" id="User_status_id">
                                <option selected>Open this select
                                    menu</option>
                                <?php
                                foreach ($userStatus as $status) {
                                    echo ('<option value="' . $status['User_status_id'] . '">' . $status['User_status_name'] . '</option>');
                                }
                                ?>
                            </select>
                        </div>

                    </form>
                    <!-- End Form -->
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmit" form="my-form">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Container modal-->

    <!---Container javascript-->
    <?php include_once(PATH_VIEWS . PATH_JS . 'scriptJs.php') ?>
    <!---Container javascript view-->
    <script src="<?= PATH_CLASS_JS ?>Form.js"></script>
    <!---Container javascript class-->
    <script src="<?= PATH_CONTROLLERS_JS ?>user/userController.js"></script>

</body>

</html>