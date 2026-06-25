<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM laboratorium");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laboratorium</title>
</head>

<body>

<h2>Data Laboratorium</h2>

<a href="tambah.php">+ Tambah Laboratorium</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>No</th>
        <th>Nama Laboratorium</th>
        <th>Lokasi</th>
        <th>Penanggung Jawab</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($row = mysqli_fetch_assoc($data)) : ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_lab']; ?></td>
        <td><?= $row['lokasi']; ?></td>
        <td><?= $row['penanggung_jawab']; ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id_lab']; ?>">
                Edit
            </a>

            <a href="hapus.php?id=<?= $row['id_lab']; ?>"
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