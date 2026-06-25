<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = (int) $_GET['id'];

$data = mysqli_query($conn, "
    SELECT * FROM maintenance
    WHERE id_maintenance = $id
");

$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE maintenance
        SET status = '$status'
        WHERE id_maintenance = $id
    ");

    if ($status == 'Selesai') {

        mysqli_query($conn, "
            UPDATE barang
            SET status = 'Tersedia'
            WHERE id_barang = '{$row['id_barang']}'
        ");
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Maintenance</title>
</head>
<body>

<h2>Edit Maintenance</h2>

<form method="POST">

    <label>Status</label><br>

    <select name="status">

        <option value="Proses"
            <?= $row['status'] == 'Proses' ? 'selected' : ''; ?>>
            Proses
        </option>

        <option value="Selesai"
            <?= $row['status'] == 'Selesai' ? 'selected' : ''; ?>>
            Selesai
        </option>

    </select>

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

</body>
</html>