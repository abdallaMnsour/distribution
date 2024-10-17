<?php
$id = $_GET["id"];

include_once "../connect.php";
$conn->query("DELETE FROM cart WHERE id = '$id'");
header("location: ../../cart.php?header=cart&page=active");
exit();
