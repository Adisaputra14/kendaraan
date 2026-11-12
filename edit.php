<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include 'koneksi.php';

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM kendaraan_operasional WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if(isset($_POST['simpan'])){
    $nopol = $_POST['nopol'];
    $jenis = $_POST['jenis'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];
    $warna = $_POST['warna'];
    $kondisi = $_POST['kondisi'];
    $status = $_POST['status'];
    $pemegang = $_POST['pemegang'];
    $perangkat_daerah_id = $_POST['perangkat_daerah_id'];

    mysqli_query($conn, "UPDATE kendaraan_operasional SET 
        nopol='$nopol',
        jenis='$jenis',
        merk='$merk',
        tahun='$tahun',
        warna='$warna',
        kondisi='$kondisi',
        status='$status',
        pemegang='$pemegang',
        perangkat_daerah_id='$perangkat_daerah_id'
        WHERE id='$id'");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Edit Kendaraan</title>
<style>body{font-family:Arial;padding:20px} input,select{width:100%;padding:10px;margin:8px 0;box-sizing:border-box} button{padding:10px 20px;background:#2c3e50;color:white;border:none} .box{max-width:500px}</style>
</head><body>
<div class="box">
<h2>Edit Kendaraan</h2>
<form method="POST">
    <label>Nopol</label>
    <input name="nopol" value="<?= $data['nopol'] ?>" required>
    <label>Jenis</label>
    <input name="jenis" value="<?= $data['jenis'] ?>">
    <label>Merk</label>
    <input name="merk" value="<?= $data['merk'] ?>">
    <label>Tahun</label>
    <input name="tahun" value="<?= $data['tahun'] ?>">
    <label>Warna</label>
    <input name="warna" value="<?= $data['warna'] ?>">
    <label>Kondisi</label>
    <input name="kondisi" value="<?= $data['kondisi'] ?>">
    <label>Status</label>
    <input name="status" value="<?= $data['status'] ?>">

    <label>Nama Pemegang</label>
    <input name="pemegang" value="<?= $data['pemegang'] ?>" placeholder="Contoh: Budi Santoso" required>

    <label>Perangkat Daerah</label>
    <select name="perangkat_daerah_id" required>
        <option value="">-- Pilih Perangkat Daerah --</option>
        <?php $pd = mysqli_query($conn, "SELECT * FROM perangkat_daerah ORDER BY id ASC");
        while($p = mysqli_fetch_assoc($pd)){
            $sel = ($p['id'] == $data['perangkat_daerah_id']) ? 'selected' : '';
        ?>
        <option value="<?= $p['id'] ?>" <?= $sel ?>><?= $p['nama'] ?> (<?= $p['singkatan'] ?>)</option>
        <?php } ?>
    </select>

    <button name="simpan">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>
</div>
</body></html>