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
FROM peminjaman
WHERE id_peminjaman='$id'
");

$row = mysqli_fetch_assoc($data);

/* UPDATE */

if(isset($_POST['update'])){

    $nama_peminjam = $_POST['nama_peminjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    mysqli_query($conn,"
    UPDATE peminjaman
    SET
        nama_peminjam='$nama_peminjam',
        tanggal_pinjam='$tanggal_pinjam',
        tanggal_kembali='$tanggal_kembali',
        status='$status'
    WHERE id_peminjaman='$id'
    ");

    /* jika dikembalikan maka barang tersedia lagi */

    if($status=='Dikembalikan'){

        mysqli_query($conn,"
        UPDATE barang
        SET status='Tersedia'
        WHERE id_barang='".$row['id_barang']."'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE barang
        SET status='Dipinjam'
        WHERE id_barang='".$row['id_barang']."'
        ");

    }

    echo "
    <script>
    alert('Data berhasil diupdate');
    window.location='peminjaman.php';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Peminjaman</title>

<style>

body{
    font-family:Arial;
    padding:20px;
    background:#f4f6f9;
}

form{
    background:white;
    padding:20px;
    border-radius:10px;
}

input,select{
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

<h2>Edit Peminjaman</h2>

<form method="POST">

<input
type="text"
name="nama_peminjam"
value="<?= $row['nama_peminjam']; ?>"
required
>

<input
type="date"
name="tanggal_pinjam"
value="<?= $row['tanggal_pinjam']; ?>"
required
>

<input
type="date"
name="tanggal_kembali"
value="<?= $row['tanggal_kembali']; ?>"
required
>

<select name="status">

<option
value="Dipinjam"
<?= $row['status']=='Dipinjam'?'selected':''; ?>
>
Dipinjam
</option>

<option
value="Dikembalikan"
<?= $row['status']=='Dikembalikan'?'selected':''; ?>
>
Dikembalikan
</option>

</select>

<button type="submit" name="update">
Update Data
</button>

</form>

</body>
</html>