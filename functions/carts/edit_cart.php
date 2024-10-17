<?php
require_once "../connect.php";

$products = $_POST;
foreach ($products as $key => $product) {
  if ((int)$product == false && (int)$product != 0) {
    $product = 1;
  }
  // echo $product;

  $id = explode(",", $key)[1];
  $query = $conn->query("UPDATE cart SET count='$product' WHERE id='$id'");
}
if ($query) {
  header("location: ../../checkout.php?header=checkout&page=active");
} else {
  echo $conn->error;
}
