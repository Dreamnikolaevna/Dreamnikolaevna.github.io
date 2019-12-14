<?php
$login = $_POST['login'];
$pwd = $_POST['pwd'];
$msg = "Здравствуйте, " . $login . "! Ваш пароль: " . $pwd;
echo $msg;
?>
