<?php
session_start();
include_once "../connect.php";
$name = trim($_POST["f_name"] . " " . $_POST["l_name"]);
$fname = trim($_POST["f_name"]);
$lname = trim($_POST["l_name"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$company = trim($_POST["company"]);
$country = trim($_POST["country"]);
$address_1 = trim($_POST["address_1"]);
$address_2 = trim($_POST["address_2"]);
$city = trim($_POST["city"]);
$county = trim($_POST["county"]);

$i = 0;
$error = [];
$error_array = [
  "name",
  "email",
  "phone",
  "country",
  "address_1",
  "city",
  "county"
];
function checkEmpty($v)
{
  global $i;
  global $error;
  global $error_array;
  if ($v == "") {
    array_push($error, $error_array[$i]);
  }
  $i++;
}

checkEmpty($name);
checkEmpty($email);
checkEmpty($phone);
checkEmpty($country);
checkEmpty($address_1);
checkEmpty($city);
checkEmpty($county);

$_SESSION["error"] = $error;
$_SESSION["values"] = [
  "f_name" => $fname,
  "l_name" => $lname,
  "email" => $email,
  "phone" => $phone,
  "company" => $company,
  "country" => $country,
  "address_1" => $address_1,
  "address_2" => $address_2,
  "city" => $city,
  "county" => $county
];

if (empty($error)) {
  $conn->query("INSERT INTO orders (
    user_id, phone, company, country, address_1, address_2, city, county, email
  ) VALUES (
    '$_SESSION[id_user]', '$phone', '$company', '$country', '$address_1', '$address_2', '$city', '$county', '$email'
  )");

  $carts = $conn->query("SELECT * FROM cart WHERE user_id = '$_SESSION[id_user]'");
  foreach ($carts as $cart) {
    $product = $conn->query("SELECT sale FROM products WHERE id = '$cart[pro_id]'")->fetch_assoc();
    $total = (int)$product["sale"] + (int)$cart["count"];
    $conn->query("UPDATE products SET sale = '$total' WHERE id = '$cart[pro_id]'");
  }
  $_SESSION["values"] = [];
  $_SESSION["error"] = [];
  header("location: ../../index.php");
} else {

  header("location: ../../checkout.php");
}
