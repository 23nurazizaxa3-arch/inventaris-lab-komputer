<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM kategori
         WHERE id_kategori = $id"
    );
}

header("Location: index.php");
exit;
?>