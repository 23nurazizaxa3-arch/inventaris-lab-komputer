<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = (int) $_GET['id'];

$data = mysqli_query($conn, "
    SELECT * FROM barang
    WHERE id_barang = $id
");

$row = mysqli_fetch_assoc($data);

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$laboratorium = mysqli_query($conn, "SELECT * FROM laboratorium");

if (isset($_POST['update'])) {

    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_lab = $_POST['id_lab'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $tahun_pengadaan = $_POST['tahun_pengadaan'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE barang SET
            kode_barang = '$kode_barang',
            nama_barang = '$nama_barang',
            id_kategori = '$id_kategori',
            id_lab = '$id_lab',
            jumlah = '$jumlah',
            kondisi = '$kondisi',
            tahun_pengadaan = '$tahun_pengadaan',
            status = '$status'
        WHERE id_barang = $id
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
</head>
<body>

<h2>Edit Barang</h2>

<form method="POST">

    <label>Kode Barang</label><br>
    <input type="text" name="kode_barang"
           value="<?= $row['kode_barang']; ?>" required>

    <br><br>

    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang"
           value="<?= $row['nama_barang']; ?>" required>

    <br><br>

    <label>Kategori</label><br>
    <select name="id_kategori" required>

        <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>

        <option value="<?= $k['id_kategori']; ?>"
            <?= ($k['id_kategori'] == $row['id_kategori']) ? 'selected' : ''; ?>>

            <?= $k['nama_kategori']; ?>

        </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <label>Laboratorium</label><br>
    <select name="id_lab" required>

        <?php while ($l = mysqli_fetch_assoc($laboratorium)) : ?>

        <option value="<?= $l['id_lab']; ?>"
            <?= ($l['id_lab'] == $row['id_lab']) ? 'selected' : ''; ?>>

            <?= $l['nama_lab']; ?>

        </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <label>Jumlah</label><br>
    <input type="number" name="jumlah"
           value="<?= $row['jumlah']; ?>" required>

    <br><br>

    <label>Kondisi</label><br>
    <select name="kondisi">

        <option value="Baik"
            <?= $row['kondisi'] == 'Baik' ? 'selected' : ''; ?>>
            Baik
        </option>

        <option value="Rusak Ringan"
            <?= $row['kondisi'] == 'Rusak Ringan' ? 'selected' : ''; ?>>
            Rusak Ringan
        </option>

        <option value="Rusak Berat"
            <?= $row['kondisi'] == 'Rusak Berat' ? 'selected' : ''; ?>>
            Rusak Berat
        </option>

    </select>

    <br><br>

    <label>Tahun Pengadaan</label><br>

<input
    type="number"
    name="tahun_pengadaan"
    value="<?= $row['tahun_pengadaan']; ?>"
    min="2000"
    max="2100"
    required
>

<br><br>

    <label>Status</label><br>
    <select name="status">

        <option value="Tersedia"
            <?= $row['status'] == 'Tersedia' ? 'selected' : ''; ?>>
            Tersedia
        </option>

        <option value="Dipinjam"
            <?= $row['status'] == 'Dipinjam' ? 'selected' : ''; ?>>
            Dipinjam
        </option>

        <option value="Maintenance"
            <?= $row['status'] == 'Maintenance' ? 'selected' : ''; ?>>
            Maintenance
        </option>

    </select>

    <br><br>

    <button type="submit" name="update">Update</button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>