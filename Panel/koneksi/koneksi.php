<?php
$servername = "localhost";
$database = "db_sekolah_04";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi anda berhasil!!!";
mysqli_close($conn);
?>