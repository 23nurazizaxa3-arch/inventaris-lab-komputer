<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM barang WHERE id_barang='$id'"
);

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $status = $_POST['status'];

    mysqli_query($conn,"
        UPDATE barang SET
        kode_barang='$kode_barang',
        nama_barang='$nama_barang',
        jumlah='$jumlah',
        kondisi='$kondisi',
        status='$status'
        WHERE id_barang='$id'
    ");

    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='barang.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>

<h2>Edit Barang</h2>

<form method="POST">

    <input
        type="text"
        name="kode_barang"
        value="<?= $row['kode_barang']; ?>"
        required
    >
    <br><br>

    <input
        type="text"
        name="nama_barang"
        value="<?= $row['nama_barang']; ?>"
        required
    >
    <br><br>

    <input
        type="number"
        name="jumlah"
        value="<?= $row['jumlah']; ?>"
        required
    >
    <br><br>

    <select name="kondisi">

        <option value="Baik"
        <?= $row['kondisi']=='Baik'?'selected':'' ?>>
        Baik
        </option>

        <option value="Rusak Ringan"
        <?= $row['kondisi']=='Rusak Ringan'?'selected':'' ?>>
        Rusak Ringan
        </option>

        <option value="Rusak Berat"
        <?= $row['kondisi']=='Rusak Berat'?'selected':'' ?>>
        Rusak Berat
        </option>

    </select>

    <br><br>

    <select name="status">

        <option value="Tersedia"
        <?= $row['status']=='Tersedia'?'selected':'' ?>>
        Tersedia
        </option>

        <option value="Dipinjam"
        <?= $row['status']=='Dipinjam'?'selected':'' ?>>
        Dipinjam
        </option>

        <option value="Maintenance"
        <?= $row['status']=='Maintenance'?'selected':'' ?>>
        Maintenance
        </option>

    </select>

    <br><br>

    <button type="submit" name="update">
        Update Data
    </button>

</form>

</body>
</html>