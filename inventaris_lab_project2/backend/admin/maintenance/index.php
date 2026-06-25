<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$query = mysqli_query($conn, "
    SELECT m.*, b.nama_barang
    FROM maintenance m
    JOIN barang b ON m.id_barang = b.id_barang
    ORDER BY m.id_maintenance DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Maintenance</title>
</head>
<body>

<h2>Data Maintenance</h2>

<a href="tambah.php">+ Tambah Maintenance</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($row = mysqli_fetch_assoc($query)) : ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_barang']; ?></td>
        <td><?= $row['tanggal_maintenance']; ?></td>
        <td><?= $row['deskripsi']; ?></td>
        <td><?= $row['status']; ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id_maintenance']; ?>">
                Edit
            </a>

            <a href="hapus.php?id=<?= $row['id_maintenance']; ?>"
               onclick="return confirm('Yakin ingin menghapus data?')">
                Hapus
            </a>
        </td>
    </tr>

    <?php endwhile; ?>

</table>

<br>

<a href="../../index.php">
    Kembali ke Dashboard
</a>

</body>
</html>