<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");

echo "<script>alert('Buku berhasil dihapus!'); 
      window.location='buku.php';</script>";
?>
