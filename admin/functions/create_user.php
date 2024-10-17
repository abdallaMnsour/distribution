<?php

include_once "class/database.php";

$user = new Database("user");
$user->insert($_POST, "../img/");
// require_once "connect.php";
// session_start();
// $name = trim(@$_POST["name"]);
// $pass = trim(@$_POST["pass"]);
// $email = trim(@$_POST["email"]);
// $address1 = trim(@$_POST["address_1"]);
// $address2 = trim(@$_POST["address_2"]);
// $gender = trim(@$_POST["gender"]);
// $priv = trim(@$_POST["priv"]);
// $phone = trim(@$_POST["phone"]);
// $country = trim(@$_POST["country"]);
// $county = trim(@$_POST["county"]);
// $city = trim(@$_POST["city"]);
// $imageName = $_FILES["image"]["name"];
// $temp = $_FILES["image"]["tmp_name"];
// // print_r($_POST);
// // print_r($_FILES);
// // // echo $newName;
// $errors = [];
// $erLest = ["name", "pass", "email", "gender", "priv", "phone", "address_1", "address_2", "country", "county", "city"];
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
// // القيم فارغه ام لا
// check($name);
// check($pass);
// check($email);
// check($gender);
// check($priv);
// check($phone);
// check($address1);
// check($address2);
// check($country);
// check($county);
// check($city);

// $_SESSION["error"] = $errors;
// $_SESSION["values"] = [
//   "name" => $name,
//   "pass" => $pass,
//   "email" => $email,
//   "gender" => $gender,
//   "priv" => $priv,
//   "phone" => $phone,
//   "address_1" => $address1,
//   "address_2" => $address2,
//   "country" => $country,
//   "county" => $county,
//   "city" => $city
// ];

// if (empty($errors)) {
//   if ($_FILES["image"]["error"] == 0) {
//     $extensions = ["jpg", "gif", "png", "jpeg"];
//     $ext = pathinfo($imageName, PATHINFO_EXTENSION);
//     if (in_array($ext, $extensions)) {
//       if ($_FILES["image"]["size"] < 2 * 1024 * 1024) {
//         $newName = md5(uniqid()) . "." . $ext;
//         move_uploaded_file($temp, "../img/" . $newName);
//       } else {
//         // header("location: ../user.php?action=add&error=2");
//         echo "error_image=2=you'r image is too big";
//         exit();
//       }
//     } else {
//       // header("location: ../user.php?action=add&error=1");
//       echo "error_image=1=you have to submit an image";
//       exit();
//     }
//   } else {
//     $newName = "undraw_profile.svg";
//   }


//   $users = $conn->query("SELECT * FROM user WHERE email = '$email'");
//   if ($users->num_rows > 0) {
//     echo "user_exists";
//     die();
//   } else {
//     $query = $conn->query("INSERT INTO user (
//       username, password, email, address_1, address_2, gender, priv, phone, image, country, county, city
//     ) VALUES (
//       '$name', md5('$pass'), '$email', '$address1', '$address2', '$gender', '$priv', '$phone', '$newName', '$country', '$county', '$city'
//     )");
//   }
//   if ($query) {
//     $user = $conn->query("SELECT * FROM user WHERE email = '$email'")->fetch_assoc();
//     echo "success=" . $user["id"] . "," . $user["username"] . "," . $user["priv"] . "," . $user["image"];
//     die();
//     // header("location: ../user.php");
//   } else {
//     $conn->error;
//   }
// } else {
//   echo "failed";
//   // header("location: ../user.php?action=add");
// }
