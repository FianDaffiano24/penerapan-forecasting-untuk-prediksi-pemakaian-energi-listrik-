<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tutorial</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="icon" type="image/x-icon" href="img/logo.jpg">
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body class="badan">
    <header>
      <?php echo "<h1>Selamat Datang, ".$_SESSION['username']."<br>";
      echo "<h1>di Implementasi Moving Average dan Exponential Smoothing</h1>"; 
      ?>
    </header>
    <div class="menu">
      <ul>
        <li> <a href="home.php">Home</a> </li>
        <li> <a href="tutorial.php">Tutorial</a></li>
        <li class="dropdown"><a href="#">Forecasting/Prediksi</a>
          <ul class="isi-dropdown">
            <li> <a href="ma.php">Moving Average</a> </li>
            <li> <a href="es.php">Exponential Smoothing</a> </li>
          </ul>
        </li>
        <li><a href="uji.php">Pengujian Forecasting</a></li>
        <li><a href="">Kontak</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
    <div class="halaman">
  <h2>Tutorial penggunaan website</h2>
  <hr>
  <pre>
    <?php
      $myfile = fopen('../README.md', 'r') or die("Unable to open file!");
      echo fread($myfile, filesize('../README.md'));
      fclose($myfile);
    ?>
  </pre>

</div>
<br><br>
<center><footer>copyright</footer></center>
<center><footer>Muhammad Daffiano Rahmatullah-1900018081</footer></center>
<center><footer>est 2023</footer></center>
</html>