<?php
session_start();
require_once "../connect.php";
$id = $_GET["id"];
$name = trim($_POST["f_name"]. " " .$_POST["l_name"]);
$fname = trim($_POST["f_name"]);
$lname = trim($_POST["l_name"]);
$email = trim($_POST["email"]);
$address = trim($_POST["address"]);
$gender = trim($_POST["gender"]);
$priv = $_POST["priv"];
$phone = trim($_POST["phone"]);
$password = trim($_POST["pass"]);

$imageName = $_FILES["image"]["name"];
$temp = $_FILES["image"]["tmp_name"];

$errors = [];
$erLest = ["name", "email", "gender", "priv"];
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
check($email);
check($gender);
check($priv);

$_SESSION["error"] = $errors;
$_SESSION["values"] = [
  "f_name" => $fname,
  "l_name" => $lname,
  "email" => $email,
  "pass" => $password,
  "address" => $address,
  "phone" => $phone,
  "gender" => $gender,
  "priv" => $priv,
];

if (empty($errors)) {
  if (!empty($password)) {
    $pass = md5($password);
    $conn->query("UPDATE user SET password='$pass' WHERE id='$id'");
  }
  if ($_FILES["image"]["error"] == 0) {
    $extensions = ["jpg", "gif", "png", "jpeg"];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    if (in_array($ext, $extensions)) {
      if ($_FILES["image"]["size"] < 2 * 1024 * 1024) {
        $newName = md5(uniqid()) . "." . $ext;
        move_uploaded_file($temp, "../img/".$newName);
        $conn->query("UPDATE user SET image='$newName' WHERE id='$id'");
      } else {
        header("location: ../../edit_user.php?id=$id&error=2");
        exit();
      }
    } else {
      header("location: ../../edit_user.php?id=$id&error=1");
      exit();
    }
  }

  $conn->query(
    "UPDATE user set 
    username='$name',
    email='$email',
    address='$address',
    gender='$gender',
    priv='$priv',
    phone='$phone' WHERE  id = '$id'"
  );
  $_SESSION["error"] = [];
  $_SESSION["values"] = [];
  header("location: ../../index.php");
} else {
  header("location: ../../edit_user.php?id=$id");
}
