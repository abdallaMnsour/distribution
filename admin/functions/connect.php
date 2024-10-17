<?php
define("HOST", "localhost");
define("NAME", "root");
define("PASS", "");
define("DB", "project_tr");
$conn = new mysqli(HOST, NAME, PASS, DB);

// حول الداتا لعربي
$conn->set_charset("utf8");

if (!$conn) {
  echo $conn->connect_error;
};
