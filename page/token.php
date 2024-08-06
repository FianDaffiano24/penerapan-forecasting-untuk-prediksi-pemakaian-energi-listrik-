<?php  
require_once("sambung.php");

if (isset($_POST['hitung_prediksi'])) {
	$waat_prediksi = $_POST['waat_prediksi'];
	$mpb_prediksi = $_POST['mpb_prediksi'];

	$kwh = $waat_prediksi / 1000;
    if ($mpb_prediksi == 900) {
        $exp = $kwh * 1352;
    } elseif ($mpb_prediksi == 1300) {
        $exp = $kwh *1444;
    }
    $token = $exp * 30;

    $sql_prediksi = "INSERT INTO prediksi_token (waat_prediksi, mpb_prediksi, hasil_prediksi) VALUES ('$waat_prediksi', '$mpb_prediksi', '$token')";
    mysqli_query($konek, $sql_prediksi);

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penentuan Token Listrik</title>
    <link rel="stylesheet" type="text/css" href="coba2.css">
</head>
<body class="badan">
    <header>
    <h1>Implementasi Moving Average dan Exponential Smoothing Prediksi penentuan Token Listrik</h1>
</header>
    <div class="menu">
      <ul>
        <li><a href="#">Tentang kami</a></li>
        <li><a href="">Kontak</a></li>
      </ul>
    </div>
<div class="center">
    <h1>Prediksi Token Listrik</h1>
    <form method="post">
        <label>Masukan hasil prediksi pemakaian lisrik (waat) : </label>
        <input type="number" name="waat_prediksi" id="waat_prediksi">
        <label>Pilih Kapasitas MPB : </label>
        <input type="radio" name="mpb_prediksi" value="900"> <label>900 VA</label>
        <input type="radio" name="mpb_prediksi" value="1300"> <label>1300 VA</label>
        <?php  ?>
        <input type="submit" class="button" name="hitung_prediksi" id="hitung_prediksi" value="hitung"> <br><br>
        <?php
        if (isset($_POST['hitung_prediksi'])) {
             $waat_prediksi = $_POST['waat_prediksi'];
        $mpb_prediksi = $_POST['mpb_prediksi'];

        $kwh = $waat_prediksi / 1000;
        if ($mpb_prediksi == 900) {
            $exp = $kwh * 1352;
        } elseif ($mpb_prediksi == 1300) {
            $exp = $kwh *1444;
        }
        $token = $exp * 30;

        echo "<h4>Hasil prediksi token listrik bulan depan = </h4>".$token;

        // echo '<script type ="text/JavaScript">';  
        // echo 'alert("Hasil Prediksi token listrik bulan depan = ")'.$token;  
        // echo '</script>';  
         } 
        
         ?>
    </form>
    
</div>
<!-- <div class="center">
    <h1>Hasil Prediksi Token Listrik</h1>
    <form action="" method="get">
        <h4>Kapasitas Meteran Prabayar (MPB) :</h4>
        <label> <?php echo $_POST['mpb_prediksi']; ?> </label>
        <h4>Hasil Prediksi Token Listrik Untuk Bulan Depan : </h4>
        <label> <?php echo $_POST['token']; ?> </label>
    </form>
</div> -->
</body>
</html>                         