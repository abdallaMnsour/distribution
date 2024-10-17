<?php
session_start();
require_once "../connect.php";
$name = trim($_POST["name"]);
$price = trim($_POST["price"]);
$sale = trim($_POST["sale"]);
$desc = trim($_POST["desc"]);
$category = trim($_POST["category"]);
$imageName = $_FILES["image"]["name"][0];

$errors = [];
$erLest = ["name", "price", "sale", "category", "image"];
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
// القيم فارغه ام لا
check($name);
check($price);
check($sale);
check($category);
check($imageName);

$_SESSION["error"] = $errors;
$_SESSION["values"] = [
  "name" => $name,
  "price" => $price,
  "sale" => $sale,
  "desc" => $desc,
  "category" => $category
];

if (empty($errors)) {
  $arrayImages = [];
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
          $arrayImages[] .= $newName;
        } else {
          header("location: ../../product.php?action=add&error=2");
          exit();
        }
      } else {
        header("location: ../../product.php?action=add&error=1");
        exit();
      }
    } else {
      header("location: ../../product.php?action=add&error=0");
      exit();
    }
  }
} else {
  header("location: ../../product.php?action=add&error=0");
  exit();
}

$query = "INSERT INTO products (
  name, price, sale, cat_id, description
) VALUES (
  '$name', '$price', '$sale', '$category', '$desc'
)";

$conn->query($query);

$products = $conn->query("SELECT * FROM products");
foreach ($products as $product) {
  $result = $product["id"];
};
foreach ($arrayImages as $arrayImage) {
  $query = "INSERT INTO images (name, pro_id) VALUES ('$arrayImage', '$result')";
  $conn->query($query);
}

$_SESSION["values"] = [];
header("location: ../../product.php");
