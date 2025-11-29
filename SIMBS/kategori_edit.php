<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];

    $update = mysqli_query($koneksi,
    "UPDATE kategori SET nama_kategori='$nama' WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Kategori berhasil diperbarui'); 
              window.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori - SIMBS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">

<h2>Edit Kategori</h2>

<form method="POST">
    <label>Nama Kategori</label>
    <input type="text" name="nama" value="<?= $data['nama_kategori']; ?>" required>

    <button type="submit" name="submit">Update</button>
</form>

</div>

</body>
</html>
