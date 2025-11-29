<?php if(!isset($_SESSION))session_start(); ?>
<nav class='navbar'><h2>SIMBS</h2>
<div>👤 <?=$_SESSION['username']?> | <a href='logout.php' class='logout'>Logout</a></div></nav>
<div class='sidebar'>
<a href='dashboard.php'>Dashboard</a>
<a href='buku.php'>Data Buku</a>
<a href='kategori.php'>Kategori Buku</a>
<a href='buku_tambah.php'>➕ Tambah Buku</a>
</div>
