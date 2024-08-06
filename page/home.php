<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
}

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
  <!-- <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'> -->
  <link rel="stylesheet" type="text/css" href="../css/style2.css">
  </head>
  <body class="">
    <header>
      <?php echo "<h1>Selamat Datang, ".$_SESSION['username']."<br>";
      echo "<h1>di Implementasi Single Moving Average dan Single Exponential Smoothing</h1>"; 
      ?>
    </header>
    <div class="menu">
      <ul>
        <li> <a href="home.php">Home</a> </li>
        <li> <a href="tutorial.php">Tutorial</a></li>
        <li class="dropdown"><a href="#">Forecasting/Prediksi</a>
          <ul class="isi-dropdown">
            <li> <a href="ma.php">Single Moving Average</a> </li>
            <li> <a href="es.php">Single Exponential Smoothing</a> </li>
          </ul>
        </li>
        <li><a href="uji.php">Pengujian Forecasting</a></li>
        <li><a href="">Kontak</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
    <main>
      <center><h2>Forecasting Penerapan Single Moving Average dan Single Exponential Smoothing Untuk Prediksi Pemakaian Energi</h2> </center>
    </main>
    <hr> 
    <h3>Single Moving Average</h3>
    <table border="2" cellpadding="20">
      <thead>
        <th align="center">No</th> 
        <th>id User</th>
        <th>Nama User</th>
        <th>Waktu</th>
        <th>Kapasitas MPB (VA)</th>
        <th>Total pemakaian listrik 3 bulan sebelumnya (kWh)</th>
        <th>Total pemakaian listrik 2 bulan sebelumnya (kWh)</th>
        <th>Total pemakaian listrik 1 bulan sebelumnya (kWh)</th>
        <th>Hasil Prediksi untuk bulan berikutnya (kWh)</th>
        <th>Porsi token listrik untuk bulan berikutnya (Rp)</th>
        <th>Harga token listrik (Rp)</th>
      </thead>
      <?php 
      $no = 1;
      foreach ($result1 as $result1): 
      ?>
      <tbody>
        <td align="center"> <?= $no; ?> </td>
        <td align="center"> <?= $result1['id_ma'] ?> </td>
        <td align="center"> <?= $result1['nama_user_ma'] ?> </td>
        <td align="center"> <?= $result1['waktu_ma'] ?> </td>
        <td align="center"> <?= $result1['mpb_ma'] ?> </td>
        <td align="center"> <?= $result1['waat1'] ?> </td>
        <td align="center"> <?= $result1['waat2'] ?> </td>
        <td align="center"> <?= $result1['waat3'] ?> </td>
        <td align="center"> <?= $result1['hasil_ma'] ?> </td>
        <td align="center"> <?= $result1['token_ma'] ?> </td>
        <td align="center"> <?= $result1['beli_ma'] ?> </td>
      </tbody>
      <?php 
      $no++;
      endforeach;
      ?>
    </table>
    <br><br><br>
    <hr>
    <h3>Single Exponential Smoothing</h3>
    <table border="2" cellpadding="20">
      <thead align="center">
        <th>No</th>
        <th>id</th>
        <th>Nama User</th>
        <th>Waktu</th>
        <th>Kapasitas MPB (VA)</th>
        <th>Total pemakaian listrik 1 bulan sebelumnya (kWh)</th>
        <th>Hasil prediksi pemakaian listrik 1 bulan sebelumnya (kWh)</th>
        <th>Hasil Prediksi (kWh) bulan berikutnya</th>
        <th>Porsi token listrik bulan berikutnya (Rp)</th>
        <th>Harga token listrik (Rp)</th>
      </thead>
      <?php 
      $no = 1;
      foreach ($result2 as $result2): 
      ?>
      <tbody align="center">
        <td> <?= $no; ?> </td>
        <td> <?= $result2['id_es'] ?> </td>
        <td> <?= $result2['nama_user_es'] ?> </td>
        <td> <?= $result2['waktu_es'] ?> </td>
        <td> <?= $result2['mpb_es'] ?> </td>
        <td> <?= $result2['waat_real_es'] ?> </td>
        <td> <?= $result2['waat_fore_es'] ?> </td>
        <td> <?= $result2['hasil_es'] ?> </td>
        <td> <?= $result2['token_es'] ?> </td>
        <td> <?= $result2['beli_es'] ?> </td>
      </tbody>
      <?php 
      $no++;
      endforeach;
      ?>
    </table>
    <br><br><br>
    <hr>
    <h3>Pengujian</h3>
    <table border="2" cellpadding="20">
      <thead align="center">
        <th>No</th>
        <th>id User</th>
        <th>Nama User</th>
        <th>Metode forecasting/prediksi</th>
        <th>Waktu</th>
        <th>Total pemakaian listrik 3 bulan sebelumnya (kWh)</th>
        <th>Hasil prediski 3 bulan sebelumnya (kWh)</th>
        <th>Total pemakaian listrik 2 bulan sebelumnya (kWh)</th>
        <th>Hasil prediksi 2 bulan sebelunya (kWh)</th>
        <th>Total pemakaian listrik 1 bulan sebelumnya (kWh)</th>
        <th>Hasil prediksi 1 bulan sebelumnya (kWh)</th>
        <th>Hasi pengujian MAD</th>
        <th>Hasil pengujian MSE</th>
        <th>Hasil pengujian MAPE</th>
        <th>Keterangan</th>
      </thead>
      <?php 
      $no = 1;
      foreach ($result3 as $result3): 
      ?>
      <tbody align="center">
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
      </tbody>
      <?php 
      $no++;
      endforeach;
      ?>
    </table> <br><br><br>
  </div>
  </body>
  <a href="tel"></a>
<center><footer>copyright</footer></center>
<center><footer>Muhammad Daffiano Rahmatullah-1900018081</footer></center>
<center><footer>est 2023</footer></center>
</html>