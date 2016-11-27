<?php
include_once "../../includes/config.php";

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

if (!$mysqli)
  {
    die("Connection error: " . mysqli_connect_error());
  }

?>
