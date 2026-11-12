<?php
session_start();
include 'koneksi.php';
if(isset($_SESSION['login'])){ header("Location: index.php"); exit; }

$pesan = "";
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($q);
    if($data && ($password == $data['password'] || password_verify($password, $data['password']))){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Username / Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<style>
body{font-family:Arial;background:#f0f2f5;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
.box{background:white;padding:30px;border-radius:8px;width:300px;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
input{width:100%;padding:10px;margin:8px 0;box-sizing:border-box}
button{width:100%;padding:10px;background:#2c3e50;color:white;border:none;cursor:pointer}
.error{color:red;text-align:center}
</style>
</head>
<body>
<div class="box">
    <h2 style="text-align:center">Login Kendaraan</h2>
    <p style="text-align:center;font-size:13px;color:#888">BPAD DKI Jakarta</p>
    <?php if($pesan) echo "<p class='error'>$pesan</p>"; ?>
    <form method="POST">
        <input name="username" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
    <p style="font-size:12px;text-align:center;color:#888">admin / password</p>
</div>
</body>
</html>