<?php

$login = $_POST['login'];
$pwd = crypt($_POST['pwd'], "asfsfrwf");
$link = mysqli_connect("localhost", "root", "", "credentials");

function login($link, $login, $pwd) {
  $query = mysqli_query($link, "SELECT pwd FROM users WHERE login='" . mysqli_real_escape_string($link, $login) . "' LIMIT 1");
  $data = mysqli_fetch_assoc($query);

  if ($pwd == $data['pwd']) {
    setcookie("login", $login, 0, "/");
    return "<script> location.reload(true); </script>"; // перезагрузить с новым куки
  } else {
    return "Неверный логин или пароль";
  }
}

echo login($link, $login, $pwd);
?>
