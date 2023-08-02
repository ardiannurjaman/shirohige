<?php
session_start();
if(isset($_SESSION['username'])) {
// ----------------------------------CONTENT HERE---------------------------------- //
    echo '<center> <h1>cieee berhasil login ;) </h1><br/><a href="./cek.php">Logout</a> </center>';
// ----------------------------------CONTENT HERE---------------------------------- //
} else {
    echo '<script>window.location.replace("./cek.php");</script>';
}
?>