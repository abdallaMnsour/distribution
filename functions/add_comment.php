<?php
include_once "connect.php";
$comment = $_POST["review"];
$id = $_GET["id"];
$pro= $_GET["pro_id"];

if (empty($comment)) {
  header("location: ../detail.php?id=$id&error=comment");
  exit();
}

$conn->query("INSERT INTO comment (comment, user_id, pro_id) VALUES ('$comment', '$id', '$pro')");
header("location: ../detail.php?id=$pro");
exit();
?>