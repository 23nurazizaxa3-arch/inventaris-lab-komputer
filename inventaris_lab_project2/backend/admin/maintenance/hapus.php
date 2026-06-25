<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = (int) $_GET['id'];

$data = mysqli_query($conn, "
    SELECT * FROM maintenance
    WHERE id_maintenance = $id
");

$row = mysqli_fetch_assoc($data);

mysqli_query($conn, "
    UPDATE barang
    SET status = 'Tersedia'
    WHERE id_barang = '{$row['id_barang']}'
");

mysqli_query($conn, "
    DELETE FROM maintenance
    WHERE id_maintenance = $id
");

header("Location: index.php");
exit;
?>