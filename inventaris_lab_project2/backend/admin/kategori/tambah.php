<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = mysqli_real_escape_string(
        $conn,
        $_POST['nama_kategori']
    );

    mysqli_query(
        $conn,
        "INSERT INTO kategori (nama_kategori)
         VALUES ('$nama')"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>

<h2>Tambah Kategori</h2>

<form method="POST">

    <label>Nama Kategori</label><br>

    <input
        type="text"
        name="nama_kategori"
        required
    >

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>