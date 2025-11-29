<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (isset($_POST['submit'])) {

    $judul    = $_POST['judul'];
    $penulis  = $_POST['penulis'];
    $kategori = $_POST['kategori'];

    $namaFile = $_FILES['sampul']['name'];
    $tmp      = $_FILES['sampul']['tmp_name'];

    // Jika user mengganti gambar
    if ($namaFile != "") {
        move_uploaded_file($tmp, "uploads/" . $namaFile);
        $update = "UPDATE buku SET 
            judul='$judul',
            penulis='$penulis',
            kategori_id='$kategori',
            sampul='$namaFile'
            WHERE id='$id'";
    } else {
        // Tidak ganti gambar
        $update = "UPDATE buku SET 
            judul='$judul',
            penulis='$penulis',
            kategori_id='$kategori'
            WHERE id='$id'";
    }

    $sql = mysqli_query($koneksi, $update);

    if ($sql) {
        echo "<script>alert('Buku berhasil diperbarui!'); 
              window.location='buku.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">
<h2>Edit Buku</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Judul Buku</label>
    <input type="text" name="judul" value="<?= $data['judul']; ?>" required>

    <label>Penulis</label>
    <input type="text" name="penulis" value="<?= $data['penulis']; ?>" required>

    <label>Kategori</label>
    <select name="kategori" required>
        <?php
        $kat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
        while ($row = mysqli_fetch_assoc($kat)) {
            $sel = $row['id'] == $data['kategori_id'] ? "selected" : "";
            echo "<option value='".$row['id']."' $sel>".$row['nama_kategori']."</option>";
        }
        ?>
    </select>

    <label>Sampul (biarkan kosong jika tidak ganti)</label>
    <input type="file" name="sampul">

    <br><br>
    <img src="uploads/<?= $data['sampul']; ?>" width="120">

    <button type="submit" name="submit">Update Buku</button>

</form>

</div>
</body>
</html>
