<?php

$msg = "";

$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");

$link = mysqli_connect("localhost", "root", "", "credentials");
$query = mysqli_query($link, "SELECT pwd FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "' LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($pwd == $data['pwd']) {
  setcookie("login", $login, 0, "/");
  $msg = "<script> location.reload(true); </script>";
} else {
  $msg = "Неверный логин или пароль";
}

echo $msg;
?>
