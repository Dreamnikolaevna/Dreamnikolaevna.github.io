<?php

// admin:admin
// CREATE TABLE `credentials`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `pwd` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");
$link = mysqli_connect("localhost", "root", "", "credentials");

function register($link, $login, $pwd) {
  $query = mysqli_query($link, "SELECT id FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "'");
  if (mysqli_num_rows($query) > 0)
    return "Пользователь " . $login . " уже зарегестрирован";
  if (!mysqli_query($link, "INSERT INTO users SET login='" . $login . "', pwd='" . $pwd . "'")) {
      return "Создать пользователя " . $login . " не удалось";
  } else {
    setcookie("login", $login, 0, "/");
    return "<script> location.reload(true); </script>"; // перезагрузить страницу с новым куки
  }
}

echo register($link, $login, $pwd);
?>
