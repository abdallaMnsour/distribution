<?php
$id = $_GET["id"];
$query = $conn->query("SELECT * FROM products WHERE id = '$id' ")->fetch_assoc();
$proImg = $conn->query("SELECT name FROM images WHERE pro_id = '$id' ")->fetch_assoc();
?>

<form action="functions/products/edit_product.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="name" class="form-label">name product</label>
    <input type="text" class="form-control" id="name" name=name value="<?= $query["name"] ?>">
  </div>
  <?php if (!isset($_SESSION["error"])) {
    $_SESSION["error"] = [];
  }
  if (in_array("name", $_SESSION["error"])) { ?>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <i class="fas fa-exclamation-triangle mr-3"></i>
      <div>
        you'r name is empty
      </div>
    </div>

  <?php } ?>

  <div class="mb-3">
    <label for="price" class="form-label">price</label>
    <input type="number" class="form-control" id="price" name=price value="<?= $query["price"] ?>">
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
    <input type="number" class="form-control" id="sale" name=sale value="<?= $query["sale"] ?>">
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
    <textarea class="form-control" id="desc" rows="3" name=desc><?= $query["description"] ?></textarea>
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
    <input multiple type="file" class="form-control-file" id="exampleFormControlFile1" name=image[]>
  </div>
  <img id="img" class="d-flex mb-3 mt-3" width="200" src="img/<?= explode(",", $proImg["name"])[0] ?>" title="image_product" style="box-shadow: 5px 5px 10px #c0c0c0;">

  <script>
    let inp = document.querySelector("input[type=file]");
    let img = document.querySelector("#img");
    inp.onchange = function () {
      let fr = new FileReader();
      fr.onload = function () {
        img.src = fr.result;
      };
      fr.readAsDataURL(inp.files[0])
    }
  </script>
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


  <select class="form-control form-select mb-3" aria-label="Default select example" name=category value="<?= $query["cat_id"] ?>">
    <?php
    $categories = $conn->query("SELECT * FROM category");
    foreach ($categories as $category) :
    ?>
      <option value="<?= $category["id"] ?>" <?= $category["id"] == $query["cat_id"] ? "selected" : "" ?>><?= $category["name"] ?></option>
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
  $_SESSION["error"] = [] ?>
  <input type="submit" value="edit" class="btn btn-primary">
  <a href="?" class="btn btn-secondary">scape</a>
</form>