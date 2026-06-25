<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";
$id = $_GET['id'];

$data = mysqli_query($conn,"
SELECT *
FROM maintenance
WHERE id_maintenance='$id'
");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $tanggal_maintenance = $_POST['tanggal_maintenance'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $biaya = $_POST['biaya'];
    $status = $_POST['status'];

    mysqli_query($conn,"
    UPDATE maintenance
    SET
    tanggal_maintenance='$tanggal_maintenance',
    deskripsi='$deskripsi',
    tanggal='$tanggal',
    keterangan='$keterangan',
    biaya='$biaya',
    status='$status'
    WHERE id_maintenance='$id'
    ");

    echo "
    <script>
    alert('Data berhasil diupdate');
    window.location='maintenance.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Maintenance</title>

<style>
body{
    font-family:Arial;
    padding:20px;
    background:#f4f6f9;
}
form{
    background:white;
    padding:20px;
}
input,textarea,select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
}
button{
    background:#0d6efd;
    color:white;
    border:none;
    padding:10px 20px;
}
</style>

</head>
<body>

<h2>Edit Maintenance</h2>

<form method="POST">

<input
type="date"
name="tanggal_maintenance"
value="<?= $row['tanggal_maintenance']; ?>"
required
>

<textarea
name="deskripsi"
required><?= $row['deskripsi']; ?></textarea>

<input
type="date"
name="tanggal"
value="<?= $row['tanggal']; ?>"
required
>

<textarea
name="keterangan"><?= $row['keterangan']; ?></textarea>

<input
type="number"
step="0.01"
name="biaya"
value="<?= $row['biaya']; ?>"
required
>

<select name="status">

<option value="Proses"
<?= $row['status']=='Proses' ? 'selected' : ''; ?>>
Proses
</option>

<option value="Selesai"
<?= $row['status']=='Selesai' ? 'selected' : ''; ?>>
Selesai
</option>

</select>

<button type="submit" name="update">
Update Data
</button>

</form>

</body>
</html>