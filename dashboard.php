<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Hitung jumlah kategori
$qKategori = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM kategori");
$dataKategori = mysqli_fetch_assoc($qKategori);

// Hitung jumlah buku
$qBuku = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM buku");
$dataBuku = mysqli_fetch_assoc($qBuku);

// Hitung jumlah user
$qUser = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM user");
$dataUser = mysqli_fetch_assoc($qUser);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - SIMBS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .box-container {
            display: flex;
            gap: 20px;
        }
        .box {
            background: white;
            padding: 20px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 0 5px #aaa;
            text-align: center;
        }
        .box h3 {
            margin: 0;
            font-size: 28px;
            color: #3949ab;
        }
        .box p {
            margin: 5px 0 0 0;
            font-size: 18px;
        }
    </style>
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">
    <h1>Dashboard</h1>
    <p>Selamat datang di Sistem Informasi Manajemen Buku Sederhana (SIMBS).</p>

    <div class="box-container">

        <div class="box">
            <h3><?= $dataKategori['jml']; ?></h3>
            <p>Total Kategori</p>
        </div>

        <div class="box">
            <h3><?= $dataBuku['jml']; ?></h3>
            <p>Total Buku</p>
        </div>

        <div class="box">
            <h3><?= $dataUser['jml']; ?></h3>
            <p>Total User</p>
        </div>

    </div>
</div>

</body>
</html>
