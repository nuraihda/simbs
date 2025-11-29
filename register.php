<?php
include 'koneksi.php';
if(isset($_POST['register'])){
 $u=$_POST['username']; $e=$_POST['email']; $p=$_POST['password'];
 $c=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$u' OR email='$e'");
 if(mysqli_num_rows($c)>0){$err='Username atau email sudah terdaftar!';}
 else if(strlen($p)<8){$err='Password minimal 8 karakter!';}
 else{
  mysqli_query($koneksi,"INSERT INTO user(username,email,password) VALUES('$u','$e','$p')");
  echo"<script>alert('Berhasil daftar');location='login.php';</script>";
 }
}
?>
<!DOCTYPE html><html><head><title>Register</title><link rel='stylesheet' href='style.css'></head>
<body><div class='form-login'><h2>Register</h2><?php if(isset($err))echo"<div class='alert'>$err</div>";?>
<form method='POST'>
<label>Username</label><input name='username' required>
<label>Email</label><input type='email' name='email' required>
<label>Password</label><input type='password' name='password' required>
<button name='register'>Register</button></form>
<p>Sudah punya akun? <a href='login.php'>Login</a></p></div></body></html>
