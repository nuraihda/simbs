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

// fitur search
$search = "";
if (isset($_GET['cari'])) {
    $key = $_GET['cari'];
    $search = "WHERE nama_kategori LIKE '%$key%'";
}

$q = mysqli_query($koneksi, 
"SELECT * FROM kategori $search ORDER BY id DESC LIMIT $posisi, $batas");

$totalData = mysqli_num_rows(mysqli_query($koneksi, 
"SELECT * FROM kategori $search"));

$jumlahHal = ceil($totalData / $batas);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori - SIMBS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">

<h2>Data Kategori</h2>

<form method="GET">
    <input type="text" name="cari" placeholder="Cari kategori..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
    <button>Cari</button>
</form>

<a href="kategori_tambah.php" class="btn">+ Tambah Kategori</a>

<table class="table">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

<?php 
$no = $posisi + 1;
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_kategori']; ?></td>
    <td>
        <a href="kategori_edit.php?id=<?= $row['id']; ?>">Edit</a> |
        <a href="kategori_hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus kategori?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<div class="pagination">
    <?php for ($i=1; $i <= $jumlahHal; $i++): ?>
        <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
    <?php endfor; ?>
</div>

</div>

</body>
</html>
