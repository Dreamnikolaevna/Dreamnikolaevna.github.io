<?php

// DELETE FROM `comments` WHERE `comments`.`id` = 0

$link = mysqli_connect("localhost", "root", "", "credentials");
$id = $_POST['id'];
session_start();

function delete_comment($link, $id) {
  if ($_SESSION['admin']) {
    if (!mysqli_query($link, "DELETE FROM comments WHERE id = " . strval($id)))
      return "Не удалось удалить комментарий";
    return "Комментарий удален!";
  }
  return "Ошибка проверки админской сессии"
}

echo delete_comment($link, $id);

?>
