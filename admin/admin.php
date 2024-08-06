<?php

session_start();

require_once("../sambung.php");

$sql_read1 = "SELECT * FROM moving_average";
$sql_db1 = mysqli_query($konek, $sql_read1);

$result1 = [];

while ($row1 = mysqli_fetch_assoc($sql_db1)) {
  $result1[] = $row1;
}

$sql_read2 = "SELECT * FROM exponential_smoothing";
$sql_db2 = mysqli_query($konek, $sql_read2);

$result2 = [];

while ($row2 = mysqli_fetch_assoc($sql_db2)) {
  $result2[] = $row2;
} 

$sql_read3 = "SELECT * FROM pengujian";
$sql_db3 = mysqli_query($konek, $sql_read3);

$result3 = [];

while ($row3 = mysqli_fetch_assoc($sql_db3)) {
   $result3[] = $row3;
 } 

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Halaman Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="icon" type="image/x-icon" href="img/logo.jpg">
  	<link rel="stylesheet" type="text/css" href="../css/style3.css">
  </head>
  <body class="badan">
    <header>
      <?php 
      echo "<h1>Selamat Datang, ".$_SESSION['username_admin']."<br>";
      echo "<h1>di halaman admin Implementasi Single Moving Average dan Single Exponential Smoothing</h1>"; 
      ?>
    </header>
    <main>
      <center>
        <h2> Implementasi Single Moving Average dan Single Exponential Smoothing Untuk Prediksi Penentuan Energi Listrik Berdasarkan Meteran Prabayar </h2> 
      </center>
    </main>
    <script>
      function forecasting(exp, prediksi) {
        var i, kontentab, menutab;
  			kontentab = document.getElementsByClassName("kontentab");
  			for (i = 0; i < kontentab.length; i++) {
          kontentab[i].style.display = "none";
  			}
  			menutab = document.getElementsByClassName("menutab");
  			for (i = 0; i < menutab.length; i++) {
    			menutab[i].className = menutab[i].className.replace(" active", "");
  			}
  			document.getElementById(prediksi).style.display = "block";
  			exp.currentTarget.className += " active";
		  }
    </script>
    <div class="tab">
  		<button class="menutab" onclick="forecasting(event, 'MA')">Moving Average</button>
  		<button class="menutab" onclick="forecasting(event, 'ES')">Exponential Smoothing</button>
  		<button class="menutab" onclick="forecasting(event, 'uji')">Pengujian</button>
	</div>
  <div id="MA" class="kontentab">
    <h3>Moving Average</h3>
    <table border="2">
      <tr>
        <td>No</td>
        <td>id User</td>
        <td>Nama User</td>
        <td>Waktu</td>
        <td>Kapasitas MPB (VA)</td>
        <td>total pemakaian listrik (waat) bulan sebelumnya 1</td>
        <td>total pemakaian listrik (waat) bulan sebelumnya 2</td>
       	<td>total pemakaian listrik (waat) bulan sebelumnya 3</td>
        <td>Hasil Prediksi (waat) bulan berikutnya</td>
        <td>Porsi token listrik untuk bulan berikutnya (Rp)</td>
      </tr>
      <?php
      $no = 1;
      foreach ($result1 as $result1): 
      ?>
      <tr>
        <td> <?= $no; ?> </td>
        <td> <?= $result1['id_ma'] ?> </td>
        <td> <?= $result1['nama_user_ma'] ?> </td>
        <td> <?= $result1['waktu_ma'] ?> </td>
        <td> <?= $result1['mpb_ma'] ?> </td>
        <td> <?= $result1['waat1'] ?> </td>
        <td> <?= $result1['waat2'] ?> </td>
        <td> <?= $result1['waat3'] ?> </td>
        <td> <?= $result1['hasil_ma'] ?> </td>
        <td> <?= $result1['token_ma'] ?> </td>
      </tr>
      <?php 
      $no++;
      endforeach;
      ?>
    </table>
	</div>

	<div id="ES" class="kontentab">
    <h3>Exponential Smoothing</h3>
    <table border="5">
      <tr>
        <td>No</td>
        <td>id</td>
        <td>Nama User</td>
        <td>Waktu</td>
        <td>Kapasitas MPB (VA)</td>
        <td>Total pemakaian listrik 1 bulan sebelumnya (waat)</td>
        <td>Hasil prediksi pemakaian listrik 1 bulan sebelumnya (waat)</td>
        <td>Hasil Prediksi (waat) bulan berikutnya</td>
        <td>Porsi token listrik bulan berikutnya (Rp)</td>
      </tr>
      <?php 
      $no = 1;
      foreach ($result2 as $result2): 
      ?>
      <tr>
        <td> <?= $no; ?> </td>
        <td> <?= $result2['id_es'] ?> </td>
        <td> <?= $result2['nama_user_es'] ?> </td>
        <td> <?= $result2['waktu_es'] ?> </td>
        <td> <?= $result2['mpb_es'] ?> </td>
        <td> <?= $result2['waat_real_es'] ?> </td>
        <td> <?= $result2['waat_fore_es'] ?> </td>
        <td> <?= $result2['hasil_es'] ?> </td>
        <td> <?= $result2['token_es'] ?> </td>
      </tr>
      <?php 
      $no++;
      endforeach;
      ?>
    </table>
	</div>

  <div id="uji" class="kontentab">
    <h3>Pengujian</h3>
    <table border="5">
      <tr>
        <td>No</td>
        <td>id User</td>
        <td>Nama User</td>
        <td>Metode forecasting/prediksi</td>
        <td>Waktu</td>
        <td>Total pemakaian listrik 3 bulan sebelumnya (waat)</td>
        <td>Hasil prediski 3 bulan sebelumnya (waat)</td>
        <td>Total pemakaian listrik 2 bulan sebelumnya (waat)</td>
        <td>Hasil prediksi 2 bulan sebelunya (waat)</td>
        <td>Total pemakaian listrik 1 bulan sebelumnya (waat)</td>
        <td>Hasil prediksi 1 bulan sebelumnya</td>
        <td>Hasi pengujian MAD</td>
        <td>Hasil pengujian MSE</td>
        <td>Hasil pengujian MAPE</td>
        <td>Keterangan</td>
      </tr>
      <?php 
      $no = 1;
      foreach ($result3 as $result3): 
      ?>
      <tr>
        <td> <?= $no; ?> </td>
        <td> <?= $result3['id_uji'] ?> </td>
        <td> <?= $result3['nama_uji'] ?> </td>
        <td> <?= $result3['nama_fore'] ?> </td>
        <td> <?= $result3['waktu_uji'] ?> </td>
        <td> <?= $result3['real1'] ?> </td>
        <td> <?= $result3['fore1'] ?> </td>
        <td> <?= $result3['real2'] ?> </td>
        <td> <?= $result3['fore2'] ?> </td>
        <td> <?= $result3['real3'] ?> </td>
        <td> <?= $result3['fore3'] ?> </td>
        <td> <?= $result3['hasil_mad'] ?> </td>
        <td> <?= $result3['hasil_mse'] ?> </td>
        <td> <?= $result3['hasil_mape'] ?> </td>
        <td> <?= $result3['def_mape'] ?> </td>
      </tr>
      <?php 
      $no++;
      endforeach;
      ?>
    </table>
  </div>
  <a href="logout.php" class="button"> <button class="logout">Log out</button> </a>
</body>
</html>