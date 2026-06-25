<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$barang = mysqli_query($conn, "
    SELECT * FROM barang
    WHERE status='Tersedia'
");

if (isset($_POST['simpan'])) {

    $id_barang = $_POST['id_barang'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = mysqli_query($conn, "
        INSERT INTO peminjaman
        (id_barang, nama_peminjam, tanggal_pinjam, tanggal_kembali)

        VALUES
        ('$id_barang', '$nama_peminjam', '$tanggal_pinjam', '$tanggal_kembali')
    ");

    if ($query) {

        mysqli_query($conn, "
            UPDATE barang
            SET status='Dipinjam'
            WHERE id_barang='$id_barang'
        ");

        echo "
        <script>
            alert('Data peminjaman berhasil ditambahkan');
            window.location='index.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
</head>
<body>

<h2>Tambah Peminjaman</h2>

<form method="POST">

    <p>Barang</p>

    <select name="id_barang" required>
        <option value="">-- Pilih Barang --</option>

        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>

            <option value="<?= $b['id_barang']; ?>">
                <?= $b['nama_barang']; ?>
            </option>

        <?php } ?>
    </select>

    <p>Nama Peminjam</p>
    <input type="text" name="nama_peminjam" required>

    <p>Tanggal Pinjam</p>
    <input type="date" name="tanggal_pinjam" required>

    <p>Tanggal Kembali</p>
    <input type="date" name="tanggal_kembali" required>

    <br><br>

    <button type="submit" name="simpan">Simpan</button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>