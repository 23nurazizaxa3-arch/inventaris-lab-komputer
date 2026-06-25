<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$query = mysqli_query($conn, "
    SELECT b.*, k.nama_kategori, l.nama_lab
    FROM barang b
    JOIN kategori k ON b.id_kategori = k.id_kategori
    JOIN laboratorium l ON b.id_lab = l.id_lab
    ORDER BY b.id_barang DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body>

<h2>Data Barang</h2>

<a href="tambah.php">+ Tambah Barang</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Laboratorium</th>
        <th>Jumlah</th>
        <th>Kondisi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($row = mysqli_fetch_assoc($query)) : ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['kode_barang']; ?></td>
        <td><?= $row['nama_barang']; ?></td>
        <td><?= $row['nama_kategori']; ?></td>
        <td><?= $row['nama_lab']; ?></td>
        <td><?= $row['jumlah']; ?></td>
        <td><?= $row['kondisi']; ?></td>
        <td><?= $row['status']; ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id_barang']; ?>">Edit</a>

            <a href="hapus.php?id=<?= $row['id_barang']; ?>"
               onclick="return confirm('Yakin ingin menghapus data?')">
               Hapus
            </a>
        </td>
    </tr>

    <?php endwhile; ?>

</table>

<br>

<a href="../../index.php">Kembali ke Dashboard</a>

</body>
</html>