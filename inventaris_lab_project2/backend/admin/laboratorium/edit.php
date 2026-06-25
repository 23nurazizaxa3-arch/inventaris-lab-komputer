<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = (int) $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM laboratorium
     WHERE id_lab = $id"
);

$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

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
        "UPDATE laboratorium SET
            nama_lab = '$nama_lab',
            lokasi = '$lokasi',
            penanggung_jawab = '$penanggung_jawab'
         WHERE id_lab = $id"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Laboratorium</title>
</head>

<body>

<h2>Edit Laboratorium</h2>

<form method="POST">

    <label>Nama Laboratorium</label><br>
    <input
        type="text"
        name="nama_lab"
        value="<?= $row['nama_lab']; ?>"
        required
    >

    <br><br>

    <label>Lokasi</label><br>
    <input
        type="text"
        name="lokasi"
        value="<?= $row['lokasi']; ?>"
        required
    >

    <br><br>

    <label>Penanggung Jawab</label><br>
    <input
        type="text"
        name="penanggung_jawab"
        value="<?= $row['penanggung_jawab']; ?>"
        required
    >

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>