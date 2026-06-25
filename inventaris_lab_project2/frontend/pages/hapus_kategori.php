<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

mysqli_query($conn,"
    DELETE FROM kategori
    WHERE id_kategori='$id'
");

echo "
<script>
    alert('Kategori berhasil dihapus');
    window.location='kategori.php';
</script>
";
?>