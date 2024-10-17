<?php
if (!isset($_SESSION["values"])) {
  $_SESSION["values"] = [];
}
if (!isset($_SESSION["error"])) {
  $_SESSION["error"] = [];
};
?>

<form method="post" class="add_user_modal" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name=username value="<?= isset($_SESSION["values"]["name"]) ? $_SESSION["values"]["name"] : ""; ?>">
  </div>
  <!-- <?php if (in_array("name", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r name is empty
      </div>
    </div>
  <?php } ?> -->

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name=password>
  </div>
  <!-- <?php if (in_array("pass", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r password is empty
      </div>
    </div>
  <?php } ?> -->

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name=email value="<?= isset($_SESSION["values"]["email"]) ? $_SESSION["values"]["email"] : ""; ?>">
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
    <input type="phone" class="form-control" id="phone" name=phone <?= isset($_SESSION["values"]["phone"]) ? $_SESSION["values"]["phone"] : ""; ?>>
  </div>

  <!-- image -->
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
  <div class="img_error_div"></div>
  <img src="" alt="" id="imgV" width="200" style="box-shadow: 5px 5px 10px #c0c0c0;">
  <script>
    let inp = document.querySelector(".add_user_modal input[type=file]");
    let img = document.querySelector("#imgV");

    inp.onchange = function() {
      let fr = new FileReader();
      fr.onload = function() {
        img.src = fr.result;
      }
      fr.readAsDataURL(inp.files[0]);
    }
  </script>
  <!-- الاخطاء الخاصه بالصور -->
  <!-- <?php
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
  } ?> -->

  <!-- address 1 -->
  <div class="mb-3">
    <label for="address1" class="form-label">Address line 1</label>
    <textarea class="form-control" id="address1" rows="3" name=address_1></textarea>
  </div>
  <!-- address 2 -->
  <div class="mb-3">
    <label for="address2" class="form-label">Address line 2</label>
    <textarea class="form-control" id="address2" rows="3" name=address_2></textarea>
  </div>

  <fieldset class="row mb-3">
    <legend class="style_gender col-form-label col-sm-2 pt-0">Gender</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0">
        <label class="form-check-label" for="gridRadios1">
          Mail
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="1">
        <label class="form-check-label" for="gridRadios2">
          Female
        </label>
      </div>
  </fieldset>
  <!-- <?php if (in_array("gender", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you have to select your gender
      </div>
    </div>
  <?php } ?> -->

  <div class="col-lg-12 form-group p-0">
    <label class="text-small text-uppercase" for="country">Country</label>
    <select class="selectpicker country m-0 w-100 d-block" style="
    padding: 10px;
    border-radius: 5px;
    border-color: #d0d0d0;
    color: #5c5c5c;
    " name="country" id="country" data-width="fit" data-style="form-control form-control-lg" data-title="Select your country"></select>
  </div>

  <div class="col-lg-12 form-group p-0">
    <label class="text-small text-uppercase" for="state">State / County</label>
    <input class="form-control form-control-lg" name="county" id="state" type="text" style="border-radius: 5px;" value="<?= isset($_SESSION["values"]["county"]) ? $_SESSION["values"]["county"] : "" ?>">
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
    <label class="text-small text-uppercase" for="city">TOWN / CITY</label>
    <input class="form-control form-control-lg" name="city" id="city" type="text" style="border-radius: 5px;">
  </div>
  <!-- <?php if (in_array("city", $_SESSION["error"])) { ?>
    <div class="text-danger d-flex align-items-center mb-3">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you have to select you'r town or city
      </div>
    </div>
  <?php } ?> -->

  <select class="form-control form-select mb-3" aria-label="Default select example" name=priv>
    <option value="1">User</option>
    <option value="0">Admin</option>
  </select>
  <!-- <?php if (in_array("priv", $_SESSION["error"])) { ?> -->
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you have to select your privilege
      </div>
    </div>
  <?php }
  $_SESSION["error"] = [];
  ?>

  <!-- modal footer -->
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input value="Confirm" type="submit" class="btn btn-primary">
  </div>
</form>