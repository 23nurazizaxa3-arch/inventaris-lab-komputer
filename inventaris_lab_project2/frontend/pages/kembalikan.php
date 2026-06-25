<?php

include "../../backend/config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"
SELECT *
FROM peminjaman
WHERE id_peminjaman='$id'
");

$row = mysqli_fetch_assoc($data);

$id_barang = $row['id_barang'];

mysqli_query($conn,"
UPDATE peminjaman
SET status='Dikembalikan'
WHERE id_peminjaman='$id'
");

mysqli_query($conn,"
UPDATE barang
SET status='Tersedia'
WHERE id_barang='$id_barang'
");

echo "
<script>
alert('Barang berhasil dikembalikan');
window.location='peminjaman.php';
</script>
";
?>