<?php 

session_start();

require_once ("../sambung.php");

if (isset($_POST['hitung_pengujian'])) {

	$nama_uji = $_SESSION['username'];
	$nama_fore = $_POST['nama_fore'];
	$real1 = $_POST['real1'];
	$fore1 = $_POST['fore1'];
	$real2 = $_POST['real2'];
	$fore2 = $_POST['fore2'];
	$real3 = $_POST['real3'];
	$fore3 = $_POST['fore3'];

	$mutlak1 = abs($real1 - $fore1);
	$mutlak2 = abs($real2 - $fore2);
	$mutlak3 = abs($real3 - $fore3);
	$totalmad = $mutlak1 + $mutlak2 + $mutlak3;
	$MAD = $totalmad / 3;

	$pangkat1 = pow($real1 - $fore1, 2);
	$pangkat2 = pow($real2 - $fore2, 2);
	$pangkat3 = pow($real3 - $fore3, 2);
	$totalmse = $pangkat1 + $pangkat2 + $pangkat3;
	$MSE = $totalmse / 3;

	$persen1 = $mutlak1 / $real1 * 100;
	$persen2 = $mutlak2 / $real2 * 100;
	$persen3 = $mutlak3 / $real3 * 100;
	$totalmape = $persen1 + $persen2 + $persen3;
	$MAPE = $totalmape / 3;

	if ($MAPE < 10) {
		$def_MAPE = "hasil prediksi sangat baik";
	} elseif ($MAPE > 10 && $MAPE < 20) {
		$def_MAPE = "hasil prediksi baik";
	} elseif ($MAPE > 20 && $MAPE < 50) {
		$def_MAPE = "hasil prediksi layak";
	} elseif ($MAPE > 50) {
		$def_MAPE = "hasil prediksi buruk";
	}

	$sql_uji = "INSERT INTO pengujian (nama_uji, nama_fore, real1, fore1, real2, fore2, real3, fore3, hasil_mad, hasil_mse, hasil_mape, def_mape) VALUES ('$nama_uji', '$nama_fore', '$real1', '$fore1', '$real2', '$fore2', '$real3', '$fore3', '$MAD', '$MSE', '$MAPE', '$def_MAPE')";
	mysqli_query ($konek, $sql_uji);

	header("Location: home.php");
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pengujian</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
	<link rel="icon" type="image/x-icon" href="img/logo.jpg">
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body class="badan">
	<header>
		<?php 
		echo "<h1>Hai, ".$_SESSION['username']."<br>";
		echo "<h1>Ini Halaman Pengujian Hasil Prediksi</h1>"; 
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
 	<main>
 		<center>
 			<h2>Pengujian menggunakan MAD (Mean Absolute Deviation), MSE (Mean Squared Error), dan MAPE (Mean Absolute Pencentage Error)</h2>
    </center>
  </main>
  <div class="center">
  	<h1>Pengujian Prediksi</h1>
  	<form action="" method="post">
  		<label>Metode forecasting/prediksi : </label>
    	<input type="radio" name="nama_fore" value="Moving Average"><label class="pilih">Moving Average</label>
    	<input type="radio" name="nama_fore" value="Exponential Smoothing"><label class="pilih">Exponential Smoothing</label><br>
    	<label>Total pemakaian listrik 3 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="real1" name="real1">
    	<label>Hasil prediksi 3 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="fore1" name="fore1">
    	<label>Total pemakaian listrik 2 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="real2" name="real2">
    	<label>Hasil prediksi 2 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="fore2" name="fore2">
    	<label>Total pemakaian listrik 1 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="real3" name="real3">
    	<label>Hasil prediksi 1 bulan sebelumnya (kWh) : </label>
    	<input type="decimal" id="fore3" name="fore3">
    	<input class="button" type="submit" name="hitung_pengujian" value="hitung pengujian">
    </form>
  </div>
</body>
<center><footer>copyright</footer></center>
<center><footer>Muhammad Daffiano Rahmatullah-1900018081</footer></center>
<center><footer>est 2023</footer></center>
</html>