<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM laboratorium WHERE id_lab='$id'"
);

$lab = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama_lab = $_POST['nama_lab'];
    $lokasi = $_POST['lokasi'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $kapasitas = $_POST['kapasitas'];

    mysqli_query($conn,"
        UPDATE laboratorium
        SET
        nama_lab='$nama_lab',
        lokasi='$lokasi',
        penanggung_jawab='$penanggung_jawab',
        kapasitas='$kapasitas'
        WHERE id_lab='$id'
    ");

    echo "
    <script>
    alert('Laboratorium berhasil diupdate');
    window.location='laboratorium.php';
    </script>
    ";
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Edit Laboratorium</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">

<?php include "../templates/sidebar.php"; ?>

<div class="content">

<h1 class="page-title">Edit Laboratorium</h1>

<div class="card-form">

<form method="POST">

<input
type="text"
name="nama_lab"
value="<?= $lab['nama_lab']; ?>"
required

>

<input
type="text"
name="lokasi"
value="<?= $lab['lokasi']; ?>"
required

>

<input
type="text"
name="penanggung_jawab"
value="<?= $lab['penanggung_jawab']; ?>"
required

>

<input
type="number"
name="kapasitas"
value="<?= $lab['kapasitas']; ?>"
required

>

<button
type="submit"
name="update"
class="btn-primary"

>

Update Data </button>

</form>

</div>

</div>

</div>

</body>
</html>
