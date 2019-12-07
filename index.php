<!DOCTYPE html>

<?php
 if (isset($_POST['submit_button'])) {
   $login = $_POST['login'];
   $pwd = $_POST['pwd'];
   $msg = "Здравствуйте, " . $login . "! Ваш пароль:" . $pwd;
 }
?>

<html>

<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
  <title>ИУ4-12Б супер крутой сайт 2000</title>
</head>

<body>
  <form action="?" method="post">
    <p>Логин: <input type="text" name="login"></p>
    <p>Пароль: <input type="password" name="pwd"></p>
    <p><input type="submit" name="submit_button"></p>
  </form>
  <?php echo $msg; ?>
</body>

</html>
