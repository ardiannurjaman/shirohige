<?php
include 'koneksi/koneksi.php';
if ($_SESSION['hak_akses'] != 'admin') {
  echo "
  <script>
      alert('Tidak Memiliki Akses, DILARANG MASUK!');
      document.location.href='index.php';
  </script>
  ";
}

$id = $_GET["id_user"];
//mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM user WHERE id_user='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='tables.php';</script>";
    }
    ?>