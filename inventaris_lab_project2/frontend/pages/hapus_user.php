<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM users WHERE id_user='$id'"
);

echo "
<script>
alert('User berhasil dihapus');
window.location='users.php';
</script>
";
?>