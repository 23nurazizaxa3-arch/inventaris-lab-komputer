<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$barang = mysqli_query($conn, "
    SELECT * FROM barang
    WHERE status != 'Maintenance'
");

if (isset($_POST['simpan'])) {

    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal_maintenance'];
    $deskripsi = $_POST['deskripsi'];

    $query = mysqli_query($conn, "
        INSERT INTO maintenance (
            id_barang,
            tanggal_maintenance,
            deskripsi
        ) VALUES (
            '$id_barang',
            '$tanggal',
            '$deskripsi'
        )
    ");

    if ($query) {

        mysqli_query($conn, "
            UPDATE barang
            SET status='Maintenance'
            WHERE id_barang='$id_barang'
        ");

        echo "
        <script>
            alert('Data maintenance berhasil ditambahkan');
            window.location='index.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Maintenance</title>
</head>
<body>

<h2>Tambah Maintenance</h2>

<form method="POST">

    <label>Barang</label><br>

    <select name="id_barang" required>

        <option value="">-- Pilih Barang --</option>

        <?php while ($b = mysqli_fetch_assoc($barang)) : ?>

            <option value="<?= $b['id_barang']; ?>">
                <?= $b['nama_barang']; ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <label>Tanggal Maintenance</label><br>

    <input
        type="date"
        name="tanggal_maintenance"
        required
    >

    <br><br>

    <label>Deskripsi Kerusakan</label><br>

    <textarea
        name="deskripsi"
        rows="5"
        cols="40"
        required
    ></textarea>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>