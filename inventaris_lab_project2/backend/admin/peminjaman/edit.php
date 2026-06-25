<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM peminjaman
    WHERE id_peminjaman='$id'
"));

if (isset($_POST['update'])) {

    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE peminjaman
        SET status='$status'
        WHERE id_peminjaman='$id'
    ");

    if ($status == 'Dikembalikan') {

        mysqli_query($conn, "
            UPDATE barang
            SET status='Tersedia'
            WHERE id_barang='{$data['id_barang']}'
        ");
    }

    echo "
    <script>
        alert('Data berhasil diperbarui');
        window.location='index.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
</head>
<body>

<h2>Edit Peminjaman</h2>

<form method="POST">

    <p>Status</p>

    <select name="status">

        <option value="Dipinjam"
            <?= $data['status'] == 'Dipinjam' ? 'selected' : ''; ?>>
            Dipinjam
        </option>

        <option value="Dikembalikan"
            <?= $data['status'] == 'Dikembalikan' ? 'selected' : ''; ?>>
            Dikembalikan
        </option>

    </select>

    <br><br>

    <button type="submit" name="update">Update</button>

</form>

</body>
</html>