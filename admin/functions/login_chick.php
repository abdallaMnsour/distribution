<?php
include "connect.php";


$email = $_POST["email"];
$password = md5($_POST["password"]);

$query = $conn->query("SELECT * FROM user WHERE email='$email'");

$user = $query->fetch_assoc();

$id = $user["id"];

if ($user['email'] != "$email") {
  header("location: ../login.php?error=email");
  exit();
}

if ($user['password'] == $password) {
  session_start();
  $_SESSION["user_id"] = $id;
  header("location: ../index.php");
  exit();
} else {
  header("location: ../login.php?error=password");
};
