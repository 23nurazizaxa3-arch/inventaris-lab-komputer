<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
?>

<?php
include "../../backend/config/koneksi.php";

/* Tambah Kategori */
if(isset($_POST['simpan'])){

    $nama_kategori = $_POST['nama_kategori'];

    mysqli_query($conn,"
        INSERT INTO kategori(nama_kategori)
        VALUES('$nama_kategori')
    ");

    echo "
    <script>
        alert('Kategori berhasil ditambahkan');
        window.location='kategori.php';
    </script>
    ";
}

/* Tampil Data */
$data = mysqli_query($conn,"
    SELECT *
    FROM kategori
    ORDER BY id_kategori DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f6f9;
            padding:20px;
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

        form{
            background:white;
            padding:20px;
            margin-bottom:20px;
        }

        input{
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

<h1>Data Kategori</h1>

<form method="POST">

    <input
        type="text"
        name="nama_kategori"
        placeholder="Nama Kategori"
        required
    >

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<table>

<tr>
    <th>ID</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
    <td><?= $row['id_kategori']; ?></td>
    <td><?= $row['nama_kategori']; ?></td>

    <td>

        <a href="edit_kategori.php?id=<?= $row['id_kategori']; ?>">
            Edit
        </a>

        |

        <a
            href="hapus_kategori.php?id=<?= $row['id_kategori']; ?>"
            onclick="return confirm('Yakin hapus?')"
        >
            Hapus
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>