<?php
session_start();
include "koneksi.php";

// Pastikan user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Proses tambah buku
if (isset($_POST['submit'])) {
    
    $judul    = $_POST['judul'];
    $penulis  = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $tgl      = date("Y-m-d H:i:s");

    // Upload file sampul
    $namaFile = $_FILES['sampul']['name'];
    $tmp      = $_FILES['sampul']['tmp_name'];

    // Pastikan folder uploads ada
    if (!is_dir('uploads')) {
        mkdir('uploads');
    }

    $tujuan = "uploads/" . $namaFile;
    move_uploaded_file($tmp, $tujuan);

    // Insert ke database
    $sql = mysqli_query($koneksi,
    "INSERT INTO buku (judul, penulis, kategori_id, sampul, tanggal_input)
     VALUES ('$judul', '$penulis', '$kategori', '$namaFile', '$tgl')");

    if ($sql) {
        echo "<script>alert('Buku berhasil ditambahkan!');
              window.location='buku.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku!');</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku - SIMBS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php"; ?>

<div class="content">

    <h2>Tambah Buku Baru</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Judul Buku</label>
        <input type="text" name="judul" required>

        <label>Penulis</label>
        <input type="text" name="penulis" required>

        <label>Kategori Buku</label>
        <select name="kategori" required>
            <option value="">-- Pilih Kategori --</option>

            <?php
            // Ambil kategori dari database
            $kat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
            while ($row = mysqli_fetch_assoc($kat)) {
                echo "<option value='".$row['id']."'>".$row['nama_kategori']."</option>";
            }
            ?>

        </select>

        <label>Sampul Buku</label>
        <input type="file" name="sampul" accept="image/*" required>

        <button type="submit" name="submit">Simpan Buku</button>

    </form>

</div>

</body>
</html>
