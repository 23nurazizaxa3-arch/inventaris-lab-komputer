<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

mysqli_query($conn,"
DELETE FROM maintenance
WHERE id_maintenance='$id'
");

echo "
<script>
alert('Data berhasil dihapus');
window.location='maintenance.php';
</script>
";
?>