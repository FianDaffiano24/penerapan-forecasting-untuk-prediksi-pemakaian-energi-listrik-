<?php 

session_start();
include('../sambung.php');

if(isset($_POST['login'])) {
    $username_admin = $_POST['username_admin'];
    $password_admin = md5($_POST['password_admin']);

    $sql = "SELECT * FROM admin WHERE username_admin='$username_admin' AND pass_admin='$password_admin'";
    $result = mysqli_query($konek, $sql);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['username_admin'] = $username_admin;
        header('location: admin.php');
    } else {
        echo '<script>alert("username atau password salah!!!")</script>';
    }
}

 ?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Halaman Login Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="stylesheet" type="text/css" href="../css/style2.css">
  </head>
  <body class="body">
    <div class="login">
      <h1>login</h1>
      <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username_admin" name="username_admin" required>
        <label for="password">Password:</label>
        <input type="password" id="password_admin" name="password_admin" required>
        <input class="button" type="submit" name="login" value="masuk">
      </form>
    </div>
  </body>
</html>
