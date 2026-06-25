<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$query = mysqli_query($conn, "
    SELECT p.*, b.nama_barang
    FROM peminjaman p
    JOIN barang b ON p.id_barang = b.id_barang
    ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
</head>
<body>

<h2>Data Peminjaman</h2>

<a href="tambah.php">+ Tambah Peminjaman</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama_barang']; ?></td>
            <td><?= $data['nama_peminjam']; ?></td>
            <td><?= $data['tanggal_pinjam']; ?></td>
            <td><?= $data['tanggal_kembali']; ?></td>
            <td><?= $data['status']; ?></td>
            <td>
                <a href="edit.php?id=<?= $data['id_peminjaman']; ?>">Edit</a>

                <a href="hapus.php?id=<?= $data['id_peminjaman']; ?>"
                   onclick="return confirm('Yakin hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>

<a href="../../index.php">Kembali ke Dashboard</a>

</body>
</html>