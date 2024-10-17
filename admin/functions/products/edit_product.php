<?php
session_start();
require_once "../connect.php";
$id = $_GET["id"];
$name = trim($_POST["name"]);
$price = trim($_POST["price"]);
$sale = trim($_POST["sale"]);
$desc = trim($_POST["desc"]);
$category = trim($_POST["category"]);
$imageName = $_FILES["image"]["name"][0];

$errors = [];
$erLest = ["name", "price", "sale", "category"];
$i = 0;


function check($val)
{
  global $errors;
  global $erLest;
  global $i;
  if ($val == "") {
    array_push($errors, $erLest[$i]);
  };
  $i++;
}

check($name);
check($price);
check($sale);
check($category);

$_SESSION["error"] = $errors;
$bool = true;

if (empty($errors)) {
  $resultNameImage = "";
  $arrayNames = [];
  if ($_FILES["image"]["error"] == 0 || $_FILES["image"]["error"][0] == 0) {
    for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) {

      $imageName = $_FILES["image"]["name"][$i];
      $temp = $_FILES["image"]["tmp_name"][$i];

      if ($_FILES["image"]["error"][$i] == 0) {
        $extensions = ["jpg", "gif", "png", "jpeg"];
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);

        if (in_array($ext, $extensions)) {

          if ($_FILES["image"]["size"][$i] < 2 * 1024 * 1024) {
            $newName = md5(uniqid()) . "." . $ext;
            move_uploaded_file($temp, "../../img/" . $newName);
            if ($bool) {
              $conn->query("DELETE FROM images WHERE pro_id='$id'");
            }
            $conn->query("INSERT INTO images (
              name, pro_id
            ) VALUES (
              '$newName', '$id'
            )");
            $bool = false;
          } else {
            header("location: ../../product.php?action=edit&error=2&id=$id");
            exit();
          }
        } else {
          header("location: ../../product.php?action=edit&error=1&id=$id");
          exit();
        }
      } else {
        header("location: ../../product.php?action=edit&error=0&id=$id");
        exit();
      }
    }
  }
  $conn->query(
    "UPDATE products set 
    name='$name',
    price='$price',
    sale='$sale',
    description='$desc',
    cat_id='$category' WHERE id='$id'"
  );

  header("location: ../../product.php");
} else {
  header("location: ../../product.php?id=$id&action=edit");
}
