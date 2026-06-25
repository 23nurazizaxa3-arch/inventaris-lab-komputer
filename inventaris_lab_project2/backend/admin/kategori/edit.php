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
    "SELECT * FROM kategori
     WHERE id_kategori = $id"
);

$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string(
        $conn,
        $_POST['nama_kategori']
    );

    mysqli_query(
        $conn,
        "UPDATE kategori
         SET nama_kategori = '$nama'
         WHERE id_kategori = $id"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>

<h2>Edit Kategori</h2>

<form method="POST">

    <label>Nama Kategori</label><br>

    <input
        type="text"
        name="nama_kategori"
        value="<?= $row['nama_kategori']; ?>"
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