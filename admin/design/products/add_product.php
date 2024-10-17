<?php
if (!isset($_SESSION["values"])) {
  $_SESSION["values"] = [];
}
if (!isset($_SESSION["error"])) {
  $_SESSION["error"] = [];
};
?>
<form action="functions/products/create_product.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="name" class="form-label">name product</label>
    <input type="text" class="form-control" id="name" name=name value="<?= isset($_SESSION["values"]["name"]) ? $_SESSION["values"]["name"] : ""; ?>">
  </div>
  <?php if (in_array("name", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r name is empty
      </div>
    </div>
  <?php } ?>

  <div class="mb-3">
    <label for="price" class="form-label">price</label>
    <input type="number" class="form-control" id="price" name=price value="<?php echo isset($_SESSION["values"]["price"]) ? $_SESSION["values"]["price"] : ""; ?>">
  </div>
  <?php if (in_array("price", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r price is empty
      </div>
    </div>
  <?php } ?>

  <div class="mb-3">
    <label for="sale" class="form-label">sale</label>
    <input type="number" class="form-control" id="sale" name=sale value="<?php echo isset($_SESSION["values"]["sale"]) ? $_SESSION["values"]["sale"] : ""; ?>">
  </div>
  <?php if (in_array("sale", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r sale is empty
      </div>
    </div>
  <?php } ?>

  <div class="mb-3">
    <label for="desc" class="form-label">description</label>
    <textarea class="form-control" id="desc" rows="3" name=desc><?= isset($_SESSION["values"]["desc"]) ? $_SESSION["values"]["desc"] : ""; ?></textarea>
  </div>

  <div class="form-group" style="display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
    background: #d5dae4;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #d7dced;">
    <label for="exampleFormControlFile1" style="min-width: fit-content;cursor: pointer">Example file input</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name=image[] multiple>
  </div>
  <img src="" id="img" alt="" width="200" class="d-block mb-3" style="box-shadow: 5px 5px 10px #c0c0c0;">
  <script>
    let img = document.querySelector("#img");
    let inp = document.querySelector("input[type=file]");
    inp.onchange = function () {
      let fr = new FileReader();
      fr.onload = function () {
        img.src = fr.result;
      };
      fr.readAsDataURL(inp.files[0]);
    }
  </script>
  <!-- الاخطاء الخاصه بالصور -->
  <?php
  if (in_array("image", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r image is empty
      </div>
    </div>
    <?php }
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

    <?php } elseif ($_GET["error"] == 0) { ?>

      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle mr-3"></i>
        <div>
          no image selected
        </div>
      </div>

  <?php }
  } ?>

  <select class="form-control form-select mb-3" aria-label="Default select example" name=category>
    <?php
    $categories = $conn->query("SELECT * FROM category");
    foreach ($categories as $category) :
    ?>
      <option <?php echo isset($_SESSION["values"]["category"]) ? $category["id"] == $_SESSION["values"]["category"] ? "selected" : "" : ""; ?> value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
    <?php endforeach; ?>
  </select>
  <?php if (in_array("category", $_SESSION["error"])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r category is empty
      </div>
    </div>
  <?php };
  $_SESSION["error"] = [];
  $_SESSION["values"] = []; ?>

  <input type="submit" value="add" class="btn btn-primary">
  <a href="?" class="btn btn-secondary">scape</a>
</form>