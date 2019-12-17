<?php
  header('Content-Type: application/json');
  session_start();

  function fetch() {
    echo json_encode($_SESSION);
  }

  function kill() {
    session_destroy();
  }

  if (isset($_POST['fetch'])) fetch();
  if (isset($_POST['kill'])) kill();
?>
