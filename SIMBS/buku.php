<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$batas = 5;
$halaman = isset($_GET['hal']) ? $_GET['hal'] : 1;
$posisi = ($halaman - 1) * $batas;

$q = mysqli_query($koneksi,
"SELECT buku.*, kategori.nama_kategori 
 FROM buku 
 LEFT JOIN kategori ON buku.kategori_id = kategori.id
 ORDER BY tanggal_input DESC
 LIMIT $posisi,$batas");

$total = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM buku"));
$jumlahHal = ceil($total / $batas);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Buku - SIMBS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">
<h2>Data Buku</h2>

<a href="buku_tambah.php" class="btn">+ Tambah Buku</a>

<table class="table">
    <tr>
        <th>No</th>
        <th>Sampul</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Kategori</th>
        <th>Tanggal Input</th>
        <th>Aksi</th>
    </tr>

<?php
$no = $posisi+1;
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><img src="uploads/<?= $row['sampul']; ?>" width="60"></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['penulis']; ?></td>
    <td><?= $row['nama_kategori']; ?></td>
    <td><?= $row['tanggal_input']; ?></td>
    <td>
        <a href="buku_edit.php?id=<?= $row['id']; ?>">Edit</a> | 
        <a href="buku_hapus.php?id=<?= $row['id']; ?>" 
           onclick="return confirm('Hapus buku ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<div class="pagination">
<?php for ($i = 1; $i <= $jumlahHal; $i++): ?>
    <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
</div>

</div>

</body>
</html>
