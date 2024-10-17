<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["error"])) {
  $_SESSION["error"] = [];
}
if (!isset($_SESSION["values"])) {
  $_SESSION["values"] = [];
}
require_once "functions/connect.php";
$result = $conn->query("SELECT * FROM user WHERE id = '$_SESSION[id_user]'");

$row = $result->fetch_assoc();
?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="functions/user/edit_user.php?id=<?= $_SESSION["id_user"] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="f_name" placeholder="First Name" value="<?= explode(" ", $row["username"])[0] ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="l_name" placeholder="Last Name" value="<?= explode(" ", $row["username"])[1] ?>">
                  </div>
                </div>
                <?php if (in_array("name", $_SESSION["error"])) { ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      your name is empty
                    </div>
                  </div>
                <?php } ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?= $row["email"] ?>">
                </div>
                <?php if (in_array("email", $_SESSION["error"])) { ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      your email is empty
                    </div>
                  </div>
                <?php } ?>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="pass_1" type="password" class="form-control form-control-user" name="pass" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input id="pass_2" type="password" class="form-control form-control-user" placeholder="Repeat Password">
                  </div>
                </div>
                <div class="form-group" style="display: flex;
                flex-direction: row-reverse;
                justify-content: center;
                align-items: center;
                background: #d5dae4;
                padding: 10px;
                border-radius: 10px;
                border: 1px solid #d7dced;">
                  <label for="exampleFormControlFile1" style="min-width: fit-content">Example file input</label>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                </div>
                <img src="img/<?= $row["image"] ?>" alt="" width="200" id=img class="d-block mb-3" style="box-shadow: 5px 5px 10px #c0c0c0;" />
                <script>
                  let img = document.querySelector("#img");
                  let inp = document.querySelector("input[type=file]");

                  inp.onchange = function() {
                    let fr = new FileReader();
                    fr.onload = function() {
                      img.src = fr.result;
                    }
                    fr.readAsDataURL(inp.files[0]);
                  }
                </script>
                <!-- الاخطاء الخاصه بالصور -->
                <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == 1) { ?>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        You haven't uploaded a picture
                      </div>
                    </div>

                  <?php } elseif ($_GET["error"] == 2) { ?>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        You'r image is too big
                      </div>
                    </div>

                <?php }
                } ?>
                <div id="error_same" class="alert alert-danger align-items-center mb-3 mt-3" style="display: none;" role="alert">
                  <i class="fas fa-exclamation-triangle mr-3"></i>
                  <div>
                    The password is different
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="address" placeholder="You'r Address (Opt)" value="<?= $row["address"] ?>">
                </div>
                <div class="form-group row content-space-between">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="tel" class="form-control form-control-user" name="phone" placeholder="You'r Phone (Opt)" value="<?= $row["phone"] ?>">
                  </div>
                  <fieldset class="mb-3">
                    <legend class="col-form-label pt-0">Gender</legend>
                    <div class="d-flex">
                      <div class="form-check mr-3">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0" <?= $row["gender"] == "0" ? "checked" : "" ?>>
                        <label class="form-check-label" for="gridRadios1">
                          Mail
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="1" <?= $row["gender"] == "1" ? "checked" : "" ?>>
                        <label class="form-check-label" for="gridRadios2">
                          Female
                        </label>
                      </div>
                  </fieldset>
                  <?php if (in_array("gender", $_SESSION["error"])) { ?>
                    <div class="alert alert-danger d-flex align-items-center ml-3" role="alert">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        you have to select you'r gender
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <select class="form-control form-select mb-3" aria-label="Default select example" name="priv">
                  <option <?= $row["priv"] == "1" ? "selected" : "" ?> value="1">User</option>
                  <option <?= $row["priv"] == "0" ? "selected" : "" ?> value="0">Admin</option>
                </select>
                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block" />
              </form>
              <script>
                let form = document.querySelector("form.user");
                let error_same = document.querySelector("#error_same");
                let inp_pass_1 = document.querySelector("#pass_1");
                let inp_pass_2 = document.querySelector("#pass_2");
                form.onsubmit = function() {
                  submit_pass();
                }
                inp_pass_2.onblur = function() {
                  submit_pass();
                }

                function submit_pass() {
                  let bool = false;
                  if (inp_pass_1.value == inp_pass_2.value) {
                    console.log("work");
                    bool = true;
                    error_same.style.display = "none";
                  } else {

                    error_same.style.display = "flex";
                  }

                  return bool;
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $_SESSION["error"] = [];
    ?>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>