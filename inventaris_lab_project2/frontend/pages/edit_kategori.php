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
    FROM kategori
    WHERE id_kategori='$id'
");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama_kategori = $_POST['nama_kategori'];

    mysqli_query($conn,"
        UPDATE kategori
        SET nama_kategori='$nama_kategori'
        WHERE id_kategori='$id'
    ");

    echo "
    <script>
        alert('Kategori berhasil diupdate');
        window.location='kategori.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>

<h2>Edit Kategori</h2>

<form method="POST">

<input
    type="text"
    name="nama_kategori"
    value="<?= $row['nama_kategori']; ?>"
    required
>

<br><br>

<button type="submit" name="update">
    Update
</button>

</form>

</body>
</html>