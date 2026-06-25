<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";

/* SIMPAN DATA */
if(isset($_POST['simpan'])){

    $id_barang = $_POST['id_barang'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    mysqli_query($conn,"
        INSERT INTO peminjaman
        (
            id_barang,
            nama_peminjam,
            tanggal_pinjam,
            tanggal_kembali,
            status
        )
        VALUES
        (
            '$id_barang',
            '$nama_peminjam',
            '$tanggal_pinjam',
            '$tanggal_kembali',
            'Dipinjam'
        )
    ");

    mysqli_query($conn,"
        UPDATE barang
        SET status='Dipinjam'
        WHERE id_barang='$id_barang'
    ");

    echo "
    <script>
        alert('Data peminjaman berhasil ditambahkan');
        window.location='peminjaman.php';
    </script>
    ";
}

/* DATA PEMINJAMAN */
$data = mysqli_query($conn,"
SELECT
    peminjaman.*,
    barang.nama_barang
FROM peminjaman
LEFT JOIN barang
ON peminjaman.id_barang = barang.id_barang
ORDER BY peminjaman.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Peminjaman</title>

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
    border-radius:10px;
    margin-bottom:20px;
}

input,
select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    box-sizing:border-box;
}

button{
    background:#0d6efd;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
}

button:hover{
    background:#0b5ed7;
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

a{
    text-decoration:none;
}

</style>
</head>

<body>

<h1>Data Peminjaman</h1>

<form method="POST">

<select name="id_barang" required>

<option value="">-- Pilih Barang --</option>

<?php
$barang = mysqli_query($conn,"
SELECT *
FROM barang
WHERE status='Tersedia'
ORDER BY nama_barang ASC
");

while($b=mysqli_fetch_assoc($barang)){
?>

<option value="<?= $b['id_barang']; ?>">
    <?= $b['nama_barang']; ?>
</option>

<?php } ?>

</select>

<input
type="text"
name="nama_peminjam"
placeholder="Nama Peminjam"
required
>

<input
type="date"
name="tanggal_pinjam"
required
>

<input
type="date"
name="tanggal_kembali"
required
>

<button type="submit" name="simpan">
Simpan Peminjaman
</button>

</form>

<table>

<tr>
    <th>ID</th>
    <th>Barang</th>
    <th>Nama Peminjam</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

    <td><?= $row['id_peminjaman']; ?></td>
    <td><?= $row['nama_barang']; ?></td>
    <td><?= $row['nama_peminjam']; ?></td>
    <td><?= $row['tanggal_pinjam']; ?></td>
    <td><?= $row['tanggal_kembali']; ?></td>
    <td><?= $row['status']; ?></td>

    <td>

    <?php if($row['status']=="Dipinjam"){ ?>

        <a
        href="kembalikan.php?id=<?= $row['id_peminjaman']; ?>"
        onclick="return confirm('Barang sudah dikembalikan?')">
        Kembalikan
        </a> |

    <?php } else { ?>

        Selesai |

    <?php } ?>

    <a href="edit_peminjaman.php?id=<?= $row['id_peminjaman']; ?>">
        Edit
    </a> |

    <a
    href="hapus_peminjaman.php?id=<?= $row['id_peminjaman']; ?>"
    onclick="return confirm('Yakin ingin menghapus data?')">
        Hapus
    </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>