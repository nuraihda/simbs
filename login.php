<?php
session_start();
include 'koneksi.php';
if(isset($_POST['login'])){
 $u=$_POST['username']; $p=$_POST['password'];
 $q=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$u'");
 $d=mysqli_fetch_assoc($q);
 if(!$d){$e='Username salah!';}
 else if($p!=$d['password']){$e='Password salah!';}
 else{$_SESSION['username']=$d['username']; header('Location: dashboard.php'); exit;}
}
?>
<!DOCTYPE html><html><head><title>Login</title><link rel='stylesheet' href='style.css'></head>
<body><div class='form-login'><h2>Login</h2><?php if(isset($e))echo"<div class='alert'>$e</div>";?>
<form method='POST'>
<label>Username</label><input name='username' required>
<label>Password</label><input type='password' name='password' required>
<button name='login'>Login</button></form>
<p>Belum punya akun? <a href='register.php'>Register</a></p></div></body></html>
