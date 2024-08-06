<?php 

session_start();
include('../sambung.php');

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
    $result = mysqli_query($konek, $sql);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
       header('location: home.php');
    } else {
        echo '<script>alert("username atau password salah!!!")</script>';
    }
} 

 ?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Halaman Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="stylesheet" type="text/css" href="../css/style2.css">
  </head>
  <body class="body">
    <div class="login">
      <h1>login</h1>
      <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input class="button" type="submit" name="login" value="masuk">
      </form>
    </div>
  </body>
</html>
