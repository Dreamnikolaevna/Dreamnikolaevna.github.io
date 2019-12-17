<?php

// admin:admin
// CREATE TABLE `credentials`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `pwd` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");
$link = mysqli_connect("localhost", "root", "", "credentials");

session_start();
$_SESSION['login'] = NULL;
$_SESSION['admin'] = false;

function set_user($login) {
  $_SESSION['login'] = $login;
  $_SESSION['admin'] = ($login == "admin");
  setcookie("login", $login, 0, "/");
  return "<script> location.reload(true); </script>"; // перезагрузить с новым куки
}


function login($link, $login, $pwd) {
  $query = mysqli_query($link, "SELECT pwd FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "' LIMIT 1");
  $data = mysqli_fetch_assoc($query);
  if ($pwd == $data['pwd'])
    return set_user($login);
  else
    return "Неверный логин или пароль";
}


function register($link, $login, $pwd) {
  $query = mysqli_query($link, "SELECT id FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "'");
  if (mysqli_num_rows($query) > 0)
    return "Пользователь " . $login . " уже зарегестрирован";
  if (!mysqli_query($link, "INSERT INTO users SET login='" . $login . "', pwd='" . $pwd . "'"))
    return "Создать пользователя " . $login . " не удалось";
  else
    return set_user($login);
}


if ($_POST['register'] == "true")
  echo register($link, $login, $pwd);
else
  echo login($link, $login, $pwd);
?>
