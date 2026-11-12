<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include 'koneksi.php';

$pesan = "";
if(isset($_POST['simpan'])){
    $lama = $_POST['password_lama'];
    $baru = $_POST['password_baru'];
    $konfirmasi = $_POST['password_konfirmasi'];

    $username = $_SESSION['username'];
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($q);

    // Cek password lama - bisa baca yang polos dan yang hash
    $cek_lama = ($lama == $data['password'] || password_verify($lama, $data['password']));

    if(!$cek_lama){
        $pesan = "Password lama salah!";
    } elseif($baru != $konfirmasi){
        $pesan = "Password baru dan konfirmasi tidak sama!";
    } elseif(strlen($baru) < 4){
        $pesan = "Password baru minimal 4 karakter!";
    } else {
        $hash_baru = password_hash($baru, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$hash_baru' WHERE username='$username'");
        $pesan = "Password berhasil diubah! Silakan login ulang.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Ubah Password</title>
<style>
body{font-family:Arial;background:#f0f2f5;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
.box{background:white;padding:30px;border-radius:8px;width:320px;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
input{width:100%;padding:10px;margin:8px 0;box-sizing:border-box}
button{width:100%;padding:10px;background:#2c3e50;color:white;border:none;cursor:pointer}
.error{color:red;text-align:center}
.sukses{color:green;text-align:center}
a{font-size:13px}
</style>
</head>
<body>
<div class="box">
    <h2 style="text-align:center">Ubah Password</h2>
    <p style="text-align:center;font-size:13px;color:#888">User: <?= $_SESSION['username'] ?></p>
    <?php if($pesan) echo "<p class='".(strpos($pesan,'berhasil')!==false?'sukses':'error')."'>$pesan</p>"; ?>
    <form method="POST">
        <input name="password_lama" type="password" placeholder="Password Lama" required>
        <input name="password_baru" type="password" placeholder="Password Baru" required>
        <input name="password_konfirmasi" type="password" placeholder="Ulangi Password Baru" required>
        <button type="submit" name="simpan">Simpan Password Baru</button>
    </form>
    <p style="text-align:center"><a href="index.php">Kembali ke Data</a> | <a href="logout.php">Logout</a></p>
</div>
</body>
</html>