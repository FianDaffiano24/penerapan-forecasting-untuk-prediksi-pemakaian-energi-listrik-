<?php 

session_start();

require_once ("../sambung.php");

if (isset($_POST['register'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = md5($_POST['password']);

  $sql_register = "INSERT INTO pengguna (username, email, password) VALUES ('$username', '$email', '$password')";
  mysqli_query ($konek, $sql_register);

  header("Location: login.php");
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="stylesheet" type="text/css" href="../css/style2.css">
  </head>
  <body class="body">
    <div class="register">
      <h1>Register</h1>
      <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" class="button" name="register" value="register">
      </form>
    </div>
  </body>
</html>
