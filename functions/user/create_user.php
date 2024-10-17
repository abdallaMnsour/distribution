<?php
require_once "../connect.php";
session_start();
$name = trim($_POST["f_name"] . " " . $_POST["l_name"]);
$fname = trim($_POST["f_name"]);
$lname = trim($_POST["l_name"]);
$pass = trim($_POST["pass"]);
$email = trim($_POST["email"]);
$phone = $_POST["phone"];
$address_1 = $_POST["address_1"];
$address_2 = $_POST["address_2"];
$gender =  $_POST["gender"];
$priv = $_POST["priv"];
$country = $_POST["country"];
$county = $_POST["county"];
$city = $_POST["city"];

$errors = [];
$erLest = ["name", "pass", "gender", "email", "address_1", "phone", "priv", "country", "city", "county"];
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
check($pass);
check($gender);
check($email);
check($address_1);
check($phone);
check($priv);
check($country);
check($city);
check($county);

$_SESSION["error"] = $errors;
$_SESSION["values"] = [
  "f_name" => $fname,
  "l_name" => $lname,
  "email" => $email,
  "gender" => $gender,
  "phone" => $phone,
  "address_1" => $address_1,
  "address_2" => $address_2,
  "password" => $pass,
  "country" => $country,
  "county" => $county,
  "priv" => $priv,
  "city" => $city
];

if (empty($errors)) {
  $chickEmailExist = $conn->query("SELECT email FROM user WHERE email = '$email'");
  // موجود بالفعل email هل المستخدم سجل الدخول ب
  if ($chickEmailExist->num_rows == 0) {
    $newName = "undraw_profile.svg";
    $query = "INSERT INTO user (
      username, password, email, address_1, address_2, gender, priv, phone, image, city, country, county
    ) VALUES (
      '$name', md5('$pass'), '$email', '$address_1', '$address_2', '$gender', '$priv', '$phone', '$newName', '$city', '$country', '$county'
    )";

    $conn->query($query);
    $id = $conn->query("SELECT id FROM user WHERE email = '$email'")->fetch_assoc();
    $_SESSION["id_user"] = $id["id"];
    $_SESSION["values"] = [];
    $_SESSION["error_email"] = "";
    header("location: ../../index.php");
  } else {
    $_SESSION["error_email"] = "email_exist";
    header("location: ../../register.php");
  }
} else {
  $_SESSION["error_email"] = "";

  // echo "<pre>";
  // print_r($_SESSION);
  // print_r($_SESSION["values"]);
  // print_r($_SESSION["error"]);
  // print_r($_POST);
  header("location: ../../register.php");
}
