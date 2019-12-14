<?php
$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");
$msg = "Здравствуйте, " . $login . "! Ваш пароль: " . $pwd;
echo $msg;
?>
