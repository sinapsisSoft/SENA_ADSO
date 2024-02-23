<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Title Page -->
    <title>USER</title>
    <!---Icon -->

    <?php include('../assets/css/css.php'); ?>
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
    <!--Container nav-->
    <?php include('../header/nav.php') ?>
    <!--End Container nav-->
    <!---Container table-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 mx-auto">
                <h3>List User</h3>
                <!---Btn Add -->
                <button type="button" class="btn btn-success" onclick="createUser('form_login')"><img src="../../../public/assets/img/icons/person-fill-add.svg"></button>
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

                        </tbody>
                        <tfoot>
                            <tr>
                                <td scope="col">#</td>
                                <td scope="col">User</td>
                                <td scope="col">Password</td>
                                <td scope="col">State</td>
                                <td scope="col">Role</td>
                                <td scope="col">Action</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!---End Table -->
            </div>
        </div>
    </div>

    <!---End Container table-->
    <!--Container footer-->
    <?php include('../footer/footer.php') ?>
    <!--End Conatinner footer-->
    <!--Container Modal-->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modalUser" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUserLabel">Modal User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form_login" action="../../Config/UserControllerCreate.php" method="POST" onsubmit="//getData(this.id,event)">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="User_user" class="form-label">Email
                                        address</label>
                                    <input type="email" class="form-control input_disabled" maxlength="50" minlength="10" name="User_user" id="User_user" aria-describedby="emailHelp">

                                </div>
                                <div class="mb-3 col-6">
                                    <label for="User_password" class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control input_disabled" id="User_password" name="User_password" maxlength="20" minlength="10">
                                        <button class="btn btn-primary" type="button" id="btnViewPass" onclick="viewPassword(this.id)"><img src="../../../public/assets/img/icons/eye-slash-fill.svg"></button>
                                    </div>

                                </div>
                                <div class="mb-3  col-6">
                                    <label for="user_password_repeat" class="form-label">Confirm
                                        Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control input_disabled" id="user_password_repeat" name="user_password_repeat" maxlength="20" minlength="10">
                                        <button class="btn btn-primary" type="button" id="btnViewPass2" onclick="viewPassword(this.id)"><img src="../../../public/assets/img/icons/eye-slash-fill.svg"></button>
                                    </div>

                                </div>
                                <div class="mb-3  col-3">
                                    <label for="Role_id" class="form-label">Rol</label>
                                    <select class="form-select" aria-label="Default select example" name="Role_id" id="Role_id">
                                        <option selected>Open this select
                                            menu</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Employed</option>
                                    </select>
                                </div>
                                <div class="mb-3  col-3">
                                    <label for="User_status_id" class="form-label">Estado</label>
                                    <select class="form-select" aria-label="Default select example" name="User_status_id" id="User_status_id">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="form_login">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!--Container Modal-->
    <!---Cnd  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!---Container javascript-->
    <script src="../../../public/assets/js/getDataServices.js"></script>
    <script src="../../../public/assets/js/main.js"></script>

</body>

</html>