<?php if (isset($_GET["errorUser_id"])) {
    if ($_GET["errorUser_id"] == "password") { ?>
        <div class="alert alert-danger d-flex align-items-center" id="errorPassword" role="alert">
            <i class="fas fa-lock mr-3"></i>
            <div>
                wrong password.
            </div>
        </div>
<?php }
} ?>
<script>
    setTimeout(() => {
        $("#errorPassword").removeClass("d-flex");
        $("#errorPassword").addClass("d-none");
    }, 2000);
</script>
<!-- Modal -->
<div class="modal-user modal fade" id="model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                are you sure you want to remove
                <span style="font-weight: bold"></span>
                <span class="text-danger"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger" id="deleteVal" onclick="deleteVal($(this).data('id'))" data-id="">Confirm</a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- add user modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-bottom: 0;">
                    <!-- <form action="functions/userDelete.php?id=<?= $user["id"] ?>&delete=true" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">enter you'r password :</label>
                            <input type="password" name=pass style="margin-bottom: 25px;" class="form-control" id="recipient-name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input value="Confirm" type="submit" class="btn btn-danger">
                        </div>
                    </form> -->
                    <?php require_once "design/add_user.php" ?>
                </div>
            </div>
        </div>
    </div>
    <!-- edit user modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-bottom: 0;">
                    <?php require_once "design/edit_user.php" ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary"><a href="?action=add" class="btn btn-primary">Add User</a></h6> -->
        <button type="button" class="btn btn-primary btn-sm mt-1 d-flex" style="justify-content: space-around;align-items:center" data-toggle="modal" data-target="#addUser" data-whatever="@mdo">Add user</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Address_1</th>
                        <th>Address_2</th>
                        <th>country</th>
                        <th>county</th>
                        <th>city</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Privileges</th>
                        <th>Gender</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Address_1</th>
                        <th>Address_2</th>
                        <th>country</th>
                        <th>county</th>
                        <th>city</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Privilege</th>
                        <th>Gender</th>
                        <th>Control</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $myId = 0;
                    require_once "functions/connect.php";
                    $users = $conn->query("SELECT * FROM user");

                    foreach ($users as $user) :
                    ?>
                        <tr id="<?= $user["id"] ?>">
                            <td><?= ++$myId ?></td>
                            <td><img src="img/<?= $user["image"] ?>" alt="user_image" style="width: 50px;height: 50px;border-radius: 50%;box-shadow: 0 0 2px #888"></td>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["address_1"] ?></td>
                            <td><?= $user["address_2"] ?></td>
                            <td><?= $user["country"] ?></td>
                            <td><?= $user["county"] ?></td>
                            <td><?= $user["city"] ?></td>
                            <td><?= $user["phone"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["priv"] == 0 ? "Admin" : "user" ?></td>
                            <td><?= $user["gender"] == 0 ? "mail" : "female" ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm w-100" data-toggle="modal" data-target="#modalEdit" onclick="funcEdit(<?= $user['id'] ?>)" data-whatever="@mdo">edit</button>
                                <?php if ($user["id"] == $_SESSION["user_id"]) { ?>
                                    <!-- special user modal -->
                                    <div class="modal fade" id="userModal<?= $user["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete <span style="font-weight: bold"> <?= $user["priv"] == 0 ? "Admin" : "user" ?></span> <span class="text-danger"> <?= $user["username"] ?> </span></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding-bottom: 0;">
                                                    <div class="text-danger col-form-label">warning :</div>
                                                    <div class="">you logged in with this user</div>
                                                    <div class="">if you want to continue, type the password.</div>
                                                    <hr>
                                                    <form action="functions/userDelete.php?id=<?= $user["id"] ?>&delete=true" method="post">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">enter you'r password :</label>
                                                            <input type="password" name=pass style="margin-bottom: 25px;" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <input value="Confirm" type="submit" class="btn btn-danger">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm w-100 mt-1 d-flex" style="justify-content: space-around;align-items:center" data-toggle="modal" data-target="#userModal<?= $user["id"] ?>" data-whatever="@mdo">delete <i class="fas fa-exclamation-triangle"></i></button>
                                <?php } else { ?>
                                    <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#model" onclick="funcDelete($(this).data('id'), $(this).data('name'), $(this).data('priv'))" data-id="<?= $user['id'] ?>" data-name="<?= $user['username'] ?>" data-priv="<?= $user['priv'] == 0 ? "Admin" : "user" ?>">
                                        delete
                                    </a>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>