<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
</head>
<body>

<h2>Data Kategori</h2>

<a href="tambah.php">+ Tambah Kategori</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($row = mysqli_fetch_assoc($data)) : ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_kategori']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_kategori']; ?>">Edit</a>

            <a href="hapus.php?id=<?= $row['id_kategori']; ?>"
               onclick="return confirm('Yakin hapus data?')">
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