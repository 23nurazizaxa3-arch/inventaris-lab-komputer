<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";

if(isset($_POST['simpan'])){

    $id_barang = $_POST['id_barang'];
    $tanggal_maintenance = $_POST['tanggal_maintenance'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $biaya = $_POST['biaya'];
    $status = $_POST['status'];

    mysqli_query($conn,"
    INSERT INTO maintenance
    (
        id_barang,
        tanggal_maintenance,
        deskripsi,
        tanggal,
        keterangan,
        biaya,
        status
    )
    VALUES
    (
        '$id_barang',
        '$tanggal_maintenance',
        '$deskripsi',
        '$tanggal',
        '$keterangan',
        '$biaya',
        '$status'
    )
    ");

    mysqli_query($conn,"
    UPDATE barang
    SET status='Maintenance'
    WHERE id_barang='$id_barang'
    ");

    echo "
    <script>
    alert('Data maintenance berhasil disimpan');
    window.location='maintenance.php';
    </script>
    ";
}

$data = mysqli_query($conn,"
SELECT
maintenance.*,
barang.nama_barang
FROM maintenance
LEFT JOIN barang
ON maintenance.id_barang = barang.id_barang
ORDER BY id_maintenance DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Maintenance</title>

<style>

body{
    font-family:Arial;
    background:#f4f6f9;
    padding:20px;
}

h1{
    color:#333;
}

form{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
}

input,
textarea,
select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
}

button{
    background:#0d6efd;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    border:1px solid #ddd;
    padding:10px;
}

th{
    background:#0d6efd;
    color:white;
}

</style>

</head>

<body>

<h1>Data Maintenance</h1>

<form method="POST">

<select name="id_barang" required>

<option value="">
-- Pilih Barang --
</option>

<?php
$barang = mysqli_query($conn,"
SELECT *
FROM barang
");

while($b=mysqli_fetch_assoc($barang)){
?>

<option value="<?= $b['id_barang']; ?>">
<?= $b['nama_barang']; ?>
</option>

<?php } ?>

</select>

<input
type="date"
name="tanggal_maintenance"
required
>

<textarea
name="deskripsi"
placeholder="Deskripsi Kerusakan"
required
></textarea>

<input
type="date"
name="tanggal"
required
>

<textarea
name="keterangan"
placeholder="Keterangan"
></textarea>

<input
type="number"
step="0.01"
name="biaya"
placeholder="Biaya Maintenance"
>

<select name="status">

<option value="Proses">
Proses
</option>

<option value="Selesai">
Selesai
</option>

</select>

<button type="submit" name="simpan">
Simpan Maintenance
</button>

</form>

<table>

<th>ID</th>
<th>Barang</th>
<th>Tanggal Maintenance</th>
<th>Deskripsi</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Biaya</th>
<th>Status</th>
<th>Aksi</th>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['id_maintenance']; ?></td>
<td><?= $row['nama_barang']; ?></td>
<td><?= $row['tanggal_maintenance']; ?></td>
<td><?= $row['deskripsi']; ?></td>
<td><?= $row['tanggal']; ?></td>
<td><?= $row['keterangan']; ?></td>
<td>Rp <?= number_format($row['biaya'],0,',','.'); ?></td>
<td><?= $row['status']; ?></td>

<td>
<a href="edit_maintenance.php?id=<?= $row['id_maintenance']; ?>">
Edit
</a>
|
<a href="hapus_maintenance.php?id=<?= $row['id_maintenance']; ?>"
onclick="return confirm('Yakin hapus data?')">
Hapus
</a>
</td>
</tr>

<?php } ?>

</table>

</body>
</html>