<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

/* ambil data peminjaman */

$data = mysqli_query($conn,"
SELECT *
FROM peminjaman
WHERE id_peminjaman='$id'
");

$row = mysqli_fetch_assoc($data);

$id_barang = $row['id_barang'];

/* ubah status barang jadi tersedia */

mysqli_query($conn,"
UPDATE barang
SET status='Tersedia'
WHERE id_barang='$id_barang'
");

/* hapus data peminjaman */

mysqli_query($conn,"
DELETE FROM peminjaman
WHERE id_peminjaman='$id'
");

echo "
<script>
alert('Data berhasil dihapus');
window.location='peminjaman.php';
</script>
";

?>