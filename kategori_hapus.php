<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM kategori WHERE id='$id'");

echo "<script>alert('Kategori berhasil dihapus'); 
      window.location='kategori.php';</script>";
?>
