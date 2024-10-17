<?php
require_once "../connect.php";
$id = $_GET["id"];
$conn->query("DELETE FROM images WHERE pro_id = '$id'");
$conn->query("DELETE FROM cart WHERE pro_id = '$id'");
$conn->query("DELETE FROM products WHERE id = '$id' ");

header("location: ../../product.php");
