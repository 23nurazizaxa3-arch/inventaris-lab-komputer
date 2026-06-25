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
        "DELETE FROM laboratorium
         WHERE id_lab = $id"
    );
}

header("Location: index.php");
exit;
?>