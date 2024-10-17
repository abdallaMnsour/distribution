<?php

include_once "../class/database.php";
$message = new Database("message");
$message->readMessage($_GET["id"]);