<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
?>

<?php
include "../../backend/config/koneksi.php";
if(isset($_POST['simpan'])){

    $nama_lab = $_POST['nama_lab'];
    $lokasi = $_POST['lokasi'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $kapasitas = $_POST['kapasitas'];

    mysqli_query($conn,"
        INSERT INTO laboratorium
        (
            nama_lab,
            lokasi,
            penanggung_jawab,
            kapasitas
        )
        VALUES
        (
            '$nama_lab',
            '$lokasi',
            '$penanggung_jawab',
            '$kapasitas'
        )
    ");

    echo "
    <script>
    alert('Laboratorium berhasil ditambahkan');
    window.location='laboratorium.php';
    </script>
    ";
}

$data = mysqli_query(
    $conn,
    "SELECT * FROM laboratorium ORDER BY id_lab DESC"
);
?>

<!DOCTYPE html>

<html>
<head>

<title>Data Laboratorium</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

<?php include "../templates/sidebar.php"; ?>

<div class="content">

<h1 class="page-title">
Data Laboratorium
</h1>

<div class="card-form">

<form method="POST">

<input
type="text"
name="nama_lab"
placeholder="Nama Laboratorium"
required

>

<input
type="text"
name="lokasi"
placeholder="Lokasi"
required

>

<input
type="text"
name="penanggung_jawab"
placeholder="Penanggung Jawab"
required

>

<input
type="number"
name="kapasitas"
placeholder="Kapasitas"
required

>

<button
type="submit"
name="simpan"
class="btn-primary"

>

Tambah Laboratorium </button>

</form>

</div>

<div class="table-container">

<table>

<tr>
    <th>ID</th>
    <th>Nama Lab</th>
    <th>Lokasi</th>
    <th>Penanggung Jawab</th>
    <th>Kapasitas</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>

```
<td><?= $row['id_lab']; ?></td>
<td><?= $row['nama_lab']; ?></td>
<td><?= $row['lokasi']; ?></td>
<td><?= $row['penanggung_jawab']; ?></td>
<td><?= $row['kapasitas']; ?></td>

<td>

    <a href="edit_laboratorium.php?id=<?= $row['id_lab']; ?>">
        Edit
    </a>

</td>
```

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>
