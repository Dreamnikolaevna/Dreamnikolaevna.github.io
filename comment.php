<?php

// CREATE TABLE `credentials`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `text` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$link = mysqli_connect("localhost", "root", "", "credentials");
$action = $_POST['action'];
session_start();


function fetch_comment($link) {
  $query = mysqli_query($link, "SELECT * FROM comments");
  return json_encode(mysqli_fetch_all($query));
}


function send_comment($link) {
  $text = $_POST['text'];
  if (!isset($_SESSION['login']))
    return "Ошибка, не удалось проверить авторизацию";
  $login = $_SESSION['login'];
  $query = mysqli_query($link, "INSERT INTO comments SET login='" . $login . "', text='" . mysqli_real_escape_string($link, $text) . "'");
  if (!$query)
    return "Ошибка, не удалось записать комментарий";
  return "Комментарий добавлен!";
}


// DELETE FROM `comments` WHERE `comments`.`id` = 0

function delete_comment($link) {
  $id = $_POST['id'];
  if ($_SESSION['admin']) {
    if (!mysqli_query($link, "DELETE FROM comments WHERE id = " . strval($id)))
      return "Не удалось удалить комментарий";
    return "Комментарий удален!";
  }
  return "Ошибка проверки админской сессии";
}


switch ($action) {
  case "fetch":
      echo fetch_comment($link);
    break;
  case "send":
      echo send_comment($link);
    break;
  case "delete":
      echo delete_comment($link);
    break;
  default:
      echo "Ошибка в запросе к комментариям";
    break;
}

?>
