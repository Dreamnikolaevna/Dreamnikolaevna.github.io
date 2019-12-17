<?php

// CREATE TABLE `credentials`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `text` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$text = $_POST['text'];
$link = mysqli_connect("localhost", "root", "", "credentials");

session_start();

function send_comment($link, $text) {
  if (!isset($_SESSION['login']))
    return "Ошибка, не удалось проверить авторизацию";
  $login = $_SESSION['login'];
  $query = mysqli_query($link, "INSERT INTO comments SET login='" . $login . "', text='" . mysqli_real_escape_string($link, $text) . "'");
  if (!$query)
    return "Ошибка, не удалось записать комментарий";
  return "Комментарий добавлен!";
}

echo send_comment($link, $text);

?>
