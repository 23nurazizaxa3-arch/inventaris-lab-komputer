<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit;
}

include '../../config/koneksi.php';

$id = (int)$_GET['id'];

if ($id == $_SESSION['id_user']) {

    echo "
    <script>
        alert('Anda tidak dapat menghapus akun sendiri!');
        window.location='index.php';
    </script>
    ";

    exit;
}

mysqli_query($conn, "
    DELETE FROM users
    WHERE id_user='$id'
");

header("Location: index.php");
exit;
?>