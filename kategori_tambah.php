<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];

    $q = mysqli_query($koneksi, 
    "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");

    if ($q) {
        echo "<script>alert('Kategori berhasil ditambahkan'); 
              window.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah kategori');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori - SIMBS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">

<h2>Tambah Kategori</h2>

<form method="POST">
    <label>Nama Kategori</label>
    <input type="text" name="nama" required>

    <button type="submit" name="submit">Simpan</button>
</form>

</div>

</body>
</html>
