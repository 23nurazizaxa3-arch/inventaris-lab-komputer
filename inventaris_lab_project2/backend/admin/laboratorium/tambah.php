<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama_lab = mysqli_real_escape_string(
        $conn,
        $_POST['nama_lab']
    );

    $lokasi = mysqli_real_escape_string(
        $conn,
        $_POST['lokasi']
    );

    $penanggung_jawab = mysqli_real_escape_string(
        $conn,
        $_POST['penanggung_jawab']
    );

    mysqli_query(
        $conn,
        "INSERT INTO laboratorium (
            nama_lab,
            lokasi,
            penanggung_jawab
        ) VALUES (
            '$nama_lab',
            '$lokasi',
            '$penanggung_jawab'
        )"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Laboratorium</title>
</head>

<body>

<h2>Tambah Laboratorium</h2>

<form method="POST">

    <label>Nama Laboratorium</label><br>
    <input type="text" name="nama_lab" required>

    <br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi" required>

    <br><br>

    <label>Penanggung Jawab</label><br>
    <input type="text" name="penanggung_jawab" required>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>