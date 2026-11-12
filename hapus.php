<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kendaraan_operasional WHERE id='$id'");
header("Location: index.php");
?>