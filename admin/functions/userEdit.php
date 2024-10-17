<?php
include_once "class/database.php";
// echo "test";


$user = new Database("user");
$user->update($_POST, $_GET["id"], "../img/");

// // old project without """oop"""
// print_r($_GET);
// print_r($_POST);
// session_start();
// require_once "connect.php";
// $id = $_GET["id"];
// $name = trim($_POST["name"]);
// $email = trim($_POST["email"]);
// $address1 = trim($_POST["address_1"]);
// $address2 = trim($_POST["address_2"]);
// $gender = trim($_POST["gender"]);
// $priv = $_POST["priv"];
// $country = $_POST["country"];
// $county = $_POST["county"];
// $city = $_POST["city"];
// $phone = trim($_POST["phone"]);
// $password = trim($_POST["pass"]);

// $imageName = $_FILES["image"]["name"];
// $temp = $_FILES["image"]["tmp_name"];

// $errors = [];
// $erLest = ["name", "email", "address_1", "address_2", "gender", "priv", "country", "county", "city"];
// $i = 0;

// function check($val)
// {
//   global $errors;
//   global $erLest;
//   global $i;
//   if ($val == "") {
//     array_push($errors, $erLest[$i]);
//   };
//   $i++;
// }

// check($name);
// check($email);
// check($address1);
// check($address2);
// check($gender);
// check($priv);
// check($country);
// check($county);
// check($city);

// $_SESSION["error"] = $errors;

// if (empty($errors)) {
//   if (!empty($password)) {
//     $pass = md5($password);
//     $conn->query("UPDATE user SET password='$pass' WHERE id='$id'");
//   }
//   if ($_FILES["image"]["error"] == 0) {
//     $extensions = ["jpg", "gif", "png", "jpeg"];
//     $ext = pathinfo($imageName, PATHINFO_EXTENSION);
//     if (in_array($ext, $extensions)) {
//       if ($_FILES["image"]["size"] < 2 * 1024 * 1024) {
//         $newName = md5(uniqid()) . "." . $ext;
//         move_uploaded_file($temp, "../img/".$newName);
//         $conn->query("UPDATE user SET image='$newName' WHERE id='$id'");
//       } else {
//         header("location: ../user.php?action=edit&id=$id&error=2");
//         exit();
//       }
//     } else {
//       header("location: ../user.php?action=edit&id=$id&error=1");
//       exit();
//     }
//   }

//   $conn->query(
//     "UPDATE user set 
//     username='$name',
//     email='$email',
//     address_1='$address1',
//     address_1='$address2',
//     gender='$gender',
//     priv='$priv',
//     country='$country',
//     county='$county',
//     city='$city',
//     phone='$phone' WHERE  id = '$id'"
//   );
//   header("location: ../user.php");
// } else {
//   header("location: ../user.php?id=$id&action=edit");
// }
