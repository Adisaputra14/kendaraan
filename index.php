<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Kendaraan</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #2c3e50; color: white; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; }
        .tambah { background: #27ae60; }
        .edit { background: #f39c12; }
        .hapus { background: #e74c3c; }
    </style>
</head>
<body>
    <h2>Data Kendaraan Operasional</h2>
    <p>Halo, <?= $_SESSION['nama'] ?> | <a href="ubah_password.php">Ubah Password</a> | <a href="logout.php">Logout</a></p>
    <a href="tambah.php" class="btn tambah">+ Tambah Kendaraan</a>
    <table>
        <tr><th>No Pol</th><th>Jenis</th><th>Merk</th><th>Tahun</th><th>Pemegang</th><th>Perangkat Daerah</th><th>Aksi</th></tr>
        <?php
        $sql = "SELECT k.*, p.nama as nama_pegawai, pd.nama_pd 
                FROM kendaraan_operasional k
                LEFT JOIN pegawai p ON k.pegawai_id = p.id
                LEFT JOIN perangkat_daerah pd ON k.perangkat_daerah_id = pd.id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                <td>".$row['nopol']."</td>
                <td>".$row['jenis']."</td>
                <td>".$row['merk']."</td>
                <td>".$row['tahun']."</td>
                <td>".$row['nama_pegawai']."</td>
                <td>".$row['nama_pd']."</td>
                <td>
                    <a href='edit.php?id=".$row['id']."' class='btn edit'>Edit</a>
                    <a href='hapus.php?id=".$row['id']."' onclick=\"return confirm('Yakin hapus?')\" class='btn hapus'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>