<?php
include_once 'includes/db_connect.php';

session_start();
$error = "";
if (isset($_POST['login'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $error = "Fill in email and password";
  } else {
    $username=$_POST['email'];
    $password=$_POST['password'];
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    $password = md5($password);
    $query = $mysqli->query("SELECT * FROM users_table WHERE email='$username' AND password='$password'");
    $values = $query->fetch_array();
    $user_id = $values['id'];
    $firstname = $values['firstname'];
    $lastname = $values['lastname'];
    $rows = $query->num_rows;
    if ($rows == 1) {
      $_SESSION['user'] = $username;
      header("location: dashboard.php");
    }
    else {
      $error = "Email or password is invalid";
      $now = time();
      $query = $mysqli->query("SELECT id FROM users_table WHERE email='$username'");
      $values = $query->fetch_array();
      $user_id = $values['id'];
      $mysqli->query("INSERT INTO login_attempts(user_id, time) VALUES ('$user_id', '$now')");
    }
  }
}

?>
