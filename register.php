<?php

// admin:admin
// CREATE TABLE `credentials`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `pwd` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
// INSERT INTO `users` (`id`, `login`, `pwd`) VALUES ('0', 'admin', 'asjpY1/u/ny4Q')

$msg = "";

$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");

$link = mysqli_connect("localhost", "root", "", "credentials");
$query = mysqli_query($link, "SELECT id FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "'");
if (mysqli_num_rows($query) > 0) {
  $msg = "Пользователь " . $login . " уже зарегестрирован";
} else {
  if (!mysqli_query($link, "INSERT INTO users SET login='" . $login . "', pwd='" . $pwd . "'")) {
    $msg = "Создать пользователя " . $login . " не удалось";
  } else {
    setcookie("login", $login, 0, "/");
    $msg = "<script> location.reload(true); </script>";
  }
}
echo $msg
?>
