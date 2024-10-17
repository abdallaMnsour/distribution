<?php
include_once "class/database.php";
$user = new Database("user");
$user->delete("id", $_GET["id"]);
// session_start();
// require_once "connect.php";
// $result = $conn->query("SELECT * FROM user WHERE id = '$_SESSION[user_id]'")->fetch_assoc();

// $id = $_GET["id"];

// if (isset($_POST["pass"])) {
//   $pass = $_POST["pass"];
//   if (md5($pass) == $result["password"]) {
//     $conn -> query("DELETE FROM user WHERE id = '$id' ");
//     session_unset();
//     session_destroy();
//     header("location: ../user.php");
//   } else {
//     header("location: ../user.php?errorUser_id=password");
//   }
// } else {
//   $conn -> query("DELETE FROM user WHERE id = '$id' ");
//   header("location: ../user.php");
// }

