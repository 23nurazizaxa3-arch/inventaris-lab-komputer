<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM peminjaman
    WHERE id_peminjaman='$id'
"));

mysqli_query($conn, "
    UPDATE barang
    SET status='Tersedia'
    WHERE id_barang='{$data['id_barang']}'
");

mysqli_query($conn, "
    DELETE FROM peminjaman
    WHERE id_peminjaman='$id'
");

header("Location: index.php");
exit;