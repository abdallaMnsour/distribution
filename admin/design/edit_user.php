<?php
// require_once "functions/connect.php";

// $result = $conn->query("SELECT * FROM user WHERE id = '$_GET[id]'");

// $row = $result->fetch_assoc();
?>
<!-- <form data-id="" action="functions/userEdit.php?id=<?=  $_GET["id"] ?>" method="post" enctype="multipart/form-data"> -->
<form id="submit_user_edit">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name=username>
  </div>
  <!-- <?php if (!isset($_SESSION["error"])) {
    $_SESSION["error"] = [];
  }
  if (in_array("name", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r name is empty
      </div>
    </div>
  <?php } ?> -->

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name=password />
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name=email>
  </div>
  <!-- <?php if (in_array("email", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r email is empty
      </div>
    </div>
  <?php } ?> -->

  <div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="phone" class="form-control" id="phone" name=phone>
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
  <div class="img_error_div_edit text-danger"></div>
  <img src="" alt="user_img" width="200" id=img class="img d-block mb-3" style="box-shadow: 5px 5px 10px #c0c0c0;" />
  <script>
    let img = document.querySelector("#img.img");
    let inp = document.querySelector(".submit_user_edit input[type=file]");

    inp.onchange = function() {
      let fr = new FileReader();
      fr.onload = function() {
        img.src = fr.result;
      }
      fr.readAsDataURL(inp.files[0]);
    }
  </script>
  <div class="mb-3">
    <label for="address1" class="form-label">Address line 1</label>
    <textarea class="form-control" id="address1" rows="3" name=address_1></textarea>
  </div>
  <div class="mb-3">
    <label for="address2" class="form-label">Address line 2 (opt)</label>
    <textarea class="form-control" id="address2" rows="3" name=address_2></textarea>
  </div>
  <!-- <?php if (in_array("address", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r address is empty
      </div>
    </div>
  <?php } ?> -->

  <fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="radios1" value="0">
        <label class="form-check-label" for="radios1">
          Mail
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="radios2" value="1">
        <label class="form-check-label" for="radios2">
          Female
        </label>
      </div>
  </fieldset>
  <!-- <?php if (in_array("gender", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r gender is empty
      </div>
    </div>
  <?php } ?> -->

  <select class="form-control form-select mb-3" aria-label="Default select example" name=priv>
    <option value="1">User</option>
    <option value="0">Admin</option>
  </select>
  <div class="col-lg-12 form-group row">
    <label class="text-small text-uppercase" for="country">Country</label>
    <select class="selectpicker country m-0 w-100 d-block" style="
    padding: 10px;
    border-radius: 10px;
    border-color: #d0d0d0;
    color: #5c5c5c;
    " name="country" id="country" data-width="fit" data-style="form-control form-control-lg" data-title="Select your country">
        <option value="" class="test"></option>
    </select>
    <div class="col-lg-12 form-group p-0">
      <label class="text-small text-uppercase" for="state">State / County</label>
      <input class="form-control form-control-lg" name="county" id="state" type="text" style="border-radius: 100px;">
    </div>
    <!-- <?php if (in_array("county", $_SESSION["error"])) { ?>
      <div class="text-danger d-flex align-items-center mb-3">
        <i class="fas fa-exclamation-triangle mr-3"></i>
        <div>
          you'r county is empty
        </div>
      </div>
    <?php } ?> -->
    <div class="col-lg-12 form-group p-0">
      <label class="text-small text-uppercase" for="state">TOWN / CITY</label>
      <input class="form-control form-control-lg" name="city" id="state" type="text" style="border-radius: 100px;">
    </div>
    <!-- <?php if (in_array("city", $_SESSION["error"])) { ?>
      <div class="text-danger d-flex align-items-center mb-3">
        <i class="fas fa-exclamation-triangle mr-3"></i>
        <div>
          you have to select you'r state or city
        </div>
      </div>
    <?php } ?> -->
  </div>
  <!-- <?php $_SESSION["error"] = [] ?> -->

  <input type="submit" value="edit" class="btn btn-primary">
  <a href="?" class="btn btn-secondary">scape</a>
  <br><br>
</form>