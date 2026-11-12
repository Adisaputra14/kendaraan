<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include 'koneksi.php';
if(isset($_POST['simpan'])){
    $nopol = $_POST['nopol']; $jenis = $_POST['jenis']; $merk = $_POST['merk'];
    $tahun = $_POST['tahun']; $warna = $_POST['warna']; $kondisi = $_POST['kondisi'];
    $status = $_POST['status']; $pd = $_POST['perangkat_daerah_id']; $peg = $_POST['pegawai_id'];
    $sql = "INSERT INTO kendaraan_operasional (nopol, jenis, merk, tahun, warna, kondisi, status, perangkat_daerah_id, pegawai_id) VALUES ('$nopol','$jenis','$merk','$tahun','$warna','$kondisi','$status','$pd','$peg')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html><head><title>Tambah</title><style>body{font-family:Arial;padding:20px} input,select{display:block;margin:8px 0;padding:8px;width:300px}</style></head>
<body>
<h2>Tambah Kendaraan</h2>
<form method="POST">
    <input name="nopol" placeholder="No Pol - B 1234 PQR" required>
    <input name="jenis" placeholder="Jenis - Mobil / Motor" required>
    <input name="merk" placeholder="Merk - Toyota Innova" required>
    <input name="tahun" type="number" placeholder="Tahun" required>
    <input name="warna" placeholder="Warna" required>
    <select name="kondisi"><option>Baik</option><option>Rusak Ringan</option><option>Rusak Berat</option></select>
    <select name="status"><option>Dipakai</option><option>Standby</option><option>Perbaikan</option></select>
    <label>Perangkat Daerah</label>
    <select name="perangkat_daerah_id">
        <?php $q=mysqli_query($conn,"SELECT * FROM perangkat_daerah"); while($d=mysqli_fetch_assoc($q)){ echo "<option value='".$d['id']."'>".$d['nama_pd']."</option>"; } ?>
    </select>
    <label>Pegawai Pemegang</label>
    <select name="pegawai_id">
        <?php $q=mysqli_query($conn,"SELECT * FROM pegawai"); while($d=mysqli_fetch_assoc($q)){ echo "<option value='".$d['id']."'>".$d['nama']."</option>"; } ?>
    </select>
    <button type="submit" name="simpan">Simpan</button>
    <a href="index.php">Batal</a>
</form>
</body></html>