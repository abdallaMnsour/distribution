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
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="functions/user/create_user.php" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="f_name" placeholder="First Name" value="<?= isset($_SESSION["values"]["f_name"]) ? $_SESSION["values"]["f_name"] : "" ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="l_name" placeholder="Last Name" value="<?= isset($_SESSION["values"]["l_name"]) ? $_SESSION["values"]["l_name"] : "" ?>">
                  </div>
                </div>
                <?php if (in_array("name", $_SESSION["error"])) { ?>
                  <div class="text-danger d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      your name is empty
                    </div>
                  </div>
                <?php } ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?= isset($_SESSION["values"]["email"]) ? $_SESSION["values"]["email"] : "" ?>">
                </div>
                <?php if (in_array("email", $_SESSION["error"])) { ?>
                  <div class="text-danger d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      your email is empty
                    </div>
                  </div>
                <?php } ?>
                <?php if (isset($_SESSION["error_email"])) {
                  if ($_SESSION["error_email"] == "email_exist") { ?>
                    <div class="text-danger d-flex align-items-center mb-3">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        your email is exist
                      </div>
                    </div>
                <?php }
                } ?>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="pass_1" type="password" class="form-control form-control-user" name="pass" placeholder="Password" value="<?= isset($_SESSION["values"]["password"]) ? $_SESSION["values"]["password"] : "" ?>">
                  </div>
                  <div class="col-sm-6">
                    <input id="pass_2" type="password" class="form-control form-control-user" placeholder="Repeat Password" value="<?= isset($_SESSION["values"]["password"]) ? $_SESSION["values"]["password"] : "" ?>">
                  </div>
                </div>
                <?php if (in_array("pass", $_SESSION["error"])) { ?>
                  <div class="text-danger d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      your password is empty
                    </div>
                  </div>
                <?php } ?>
                <div id="error_same" class="text-danger align-items-center mb-3 mt-3" style="display: none;" role="alert">
                  <i class="fas fa-exclamation-triangle mr-3"></i>
                  <div>
                    The password is different
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="address_1" placeholder="You'r Address line 1" value="<?= isset($_SESSION["values"]["address_1"]) ? $_SESSION["values"]["address_1"] : "" ?>">
                  <?php if (in_array("address_1", $_SESSION["error"])) { ?>
                    <div class="text-danger d-flex align-items-center mb-3">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        your address is empty
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="address_2" placeholder="You'r Address line 2 (Opt)" value="<?= isset($_SESSION["values"]["address_2"]) ? $_SESSION["values"]["address_2"] : "" ?>">
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="tel" class="form-control form-control-user" name="phone" placeholder="You'r Phone" value="<?= isset($_SESSION["values"]["phone"]) ? $_SESSION["values"]["phone"] : "" ?>">
                  </div>
                  <?php if (in_array("address_1", $_SESSION["error"])) { ?>
                    <div class="text-danger d-flex align-items-center mb-3">
                      <i class="fas fa-exclamation-triangle mr-3"></i>
                      <div>
                        your address is empty
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <fieldset class="mb-3">
                  <legend class="col-form-label pt-0">Gender</legend>
                  <div class="d-flex">
                    <div class="form-check mr-3">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0" <?= isset($_SESSION["values"]["gender"]) ? $_SESSION["values"]["gender"] == 0 ? "checked" : "" : "" ?>>
                      <label class="form-check-label" for="gridRadios1">
                        Mail
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="1" <?= isset($_SESSION["values"]["gender"]) ? $_SESSION["values"]["gender"] == 1 ? "checked" : "" : "" ?>>
                      <label class="form-check-label" for="gridRadios2">
                        Female
                      </label>
                    </div>
                    <?php if (in_array("gender", $_SESSION["error"])) { ?>
                      <div class="text-danger d-flex align-items-center mb-3">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        <div>
                          you have to select you'r gender
                        </div>
                      </div>
                    <?php } ?>
                </fieldset>
                <div class="col-lg-12 form-group p-0">
                  <label class="text-small text-uppercase" for="country">Country</label>
                  <select class="selectpicker country m-0 w-100 d-block" style="
                  padding: 10px;
                  border-radius: 10px;
                  border-color: #d0d0d0;
                  color: #5c5c5c;
                  " name="country" id="country" data-width="fit" data-style="form-control form-control-lg" data-title="Select your country">
                    <?php if (isset($_SESSION["values"]["country"])) { ?>
                      <option value="<?= $_SESSION["values"]["country"] ?>"><?= $_SESSION["values"]["country"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-lg-12 form-group p-0">
                  <label class="text-small text-uppercase" for="private">priv</label>
                  <select name="priv" class="form-control form-select mb-3" id="private">
                    <option value="1" <?= isset($_SESSION["values"]["priv"]) ? $_SESSION["values"]["priv"] == "1" ? "selected" : "" : "" ?>>User</option>
                    <option value="0" <?= isset($_SESSION["values"]["priv"]) ? $_SESSION["values"]["priv"] == "0" ? "selected" : "" : "" ?>>Admin</option>
                  </select>
                </div>
                <div class="col-lg-12 form-group p-0">
                  <label class="text-small text-uppercase" for="state">State / County</label>
                  <input class="form-control form-control-lg" name="county" id="state" type="text" style="border-radius: 100px;" value="<?= isset($_SESSION["values"]["county"]) ? $_SESSION["values"]["county"] : "" ?>">
                </div>
                <?php if (in_array("county", $_SESSION["error"])) { ?>
                  <div class="text-danger d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      you'r county is empty
                    </div>
                  </div>
                <?php } ?>
                <div class="col-lg-12 form-group p-0">
                  <label class="text-small text-uppercase" for="state">TOWN / CITY</label>
                  <input class="form-control form-control-lg" name="city" id="state" type="text" style="border-radius: 100px;" value="<?= isset($_SESSION["values"]["city"]) ? $_SESSION["values"]["city"] : "" ?>">
                </div>
                <?php if (in_array("city", $_SESSION["error"])) { ?>
                  <div class="text-danger d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                      you have to select you'r state or city
                    </div>
                  </div>
                <?php } ?>
                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block" />
                <hr>
                <a href="index.php" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
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
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
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
  <!-- <script src="js/sb-admin-2.min.js"></script> -->
  <script src="js/front.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</body>

</html>