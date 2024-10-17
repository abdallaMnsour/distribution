<?php
include_once "class/database.php";
$user = new Database("user");
print_r(json_encode($user->read("id", $_GET["id"])));

?>