<?php
define("HOST", "localhost");
define("NAME", "root");
define("PASSWORD", "");
define("DB", "project_tr");
$conn = new mysqli(HOST, NAME, PASSWORD, DB);

// حول الداتا لعربي
$conn->set_charset("utf8");

if (!$conn) {
  echo $conn->connect_error;
};
