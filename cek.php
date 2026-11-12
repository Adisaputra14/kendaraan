<?php
include 'koneksi.php';
$q = mysqli_query($conn, "SELECT * FROM users");
echo "Jumlah user: " . mysqli_num_rows($q) . "<br><br>";
while($d = mysqli_fetch_assoc($q)){
    echo "Username di DB: [" . $d['username'] . "]<br>";
    echo "Password hash: " . $d['password'] . "<br>";
    echo "Test password 'password' cocok? " . (password_verify('password', $d['password']) ? 'YA COCOK' : 'TIDAK COCOK') . "<br><hr>";
}
?>