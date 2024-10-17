<?php
include_once "../class/database.php";
$user = new Database("message");
$user->delete("id", $_GET["id"]);