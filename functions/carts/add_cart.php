<?php
require_once "../connect.php";
session_start();
if (!isset($_SESSION["id_user"])) {
  $_SESSION["login_error"] = "user_undefined";
  header("location: ../../index.php");
  exit();
}

$productId = $_GET["cart"];
if (!isset($_POST["count"])) {
  $count = 1;
} else {
  //                         تحقق اذا كانت القيمه نص او لا
  if ($_POST["count"] < 1 || (int)$_POST["count"] == false) {
    $count = 1;
  } else {
    $count = $_POST["count"];
  }
}
$query = $conn->query("INSERT INTO cart (pro_id, user_id, count) VALUES ('$productId', '$_SESSION[id_user]', '$count')");
if ($query) {
  header("location: ../../cart.php?header=cart&page=active");
} else {
  echo $conn->error;
}
