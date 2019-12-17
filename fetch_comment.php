<?php

// CREATE TABLE `credentials`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `login` TEXT NOT NULL , `text` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$link = mysqli_connect("localhost", "root", "", "credentials");

function fetch_comment($link) {
  $query = mysqli_query($link, "SELECT * FROM comments");
  return json_encode(mysqli_fetch_all($query));
}

echo fetch_comment($link);

?>
