<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
?>

<?php
include "../../backend/config/koneksi.php";
/* =========================
   TAMBAH DATA BARANG
========================= */
if(isset($_POST['simpan'])){

    $kode_barang     = $_POST['kode_barang'];
    $nama_barang     = $_POST['nama_barang'];
    $id_kategori     = $_POST['id_kategori'];
    $id_lab          = $_POST['id_lab'];
    $jumlah          = $_POST['jumlah'];
    $kondisi         = $_POST['kondisi'];
    $tahun_pengadaan = $_POST['tahun_pengadaan'];
    $status          = $_POST['status'];

    mysqli_query($conn,"
        INSERT INTO barang
        (
            kode_barang,
            nama_barang,
            id_kategori,
            id_lab,
            jumlah,
            kondisi,
            tahun_pengadaan,
            status
        )
        VALUES
        (
            '$kode_barang',
            '$nama_barang',
            '$id_kategori',
            '$id_lab',
            '$jumlah',
            '$kondisi',
            '$tahun_pengadaan',
            '$status'
        )
    ");

    echo "
    <script>
        alert('Data Barang Berhasil Ditambahkan');
        window.location='barang.php';
    </script>
    ";
}

$data = mysqli_query($conn,"
SELECT
    barang.*,
    kategori.nama_kategori,
    laboratorium.nama_lab
FROM barang
LEFT JOIN kategori
ON barang.id_kategori = kategori.id_kategori
LEFT JOIN laboratorium
ON barang.id_lab = laboratorium.id_lab
ORDER BY barang.id_barang DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

.content{
    padding:30px;
}

h1{
    margin-bottom:20px;
}

.form-card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
    margin-bottom:20px;
}

input,
select{
    width:100%;
    padding:12px;
    margin-bottom:10px;
    border:1px solid #ddd;
    border-radius:8px;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

th{
    background:#2563eb;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border:1px solid #eee;
}

a{
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<div class="sidebar">

    <div class="logo">
        <h2>📑 Inventaris Lab</h2>
        <p>Laboratorium Komputer</p>
    </div>

    <ul class="menu">

        <li>
            <a href="dashboard.php">📊 Dashboard</a>
        </li>

        <li>
            <a href="barang.php">📦 Data Barang</a>
        </li>

        <li>
            <a href="kategori.php">📁 Kategori</a>
        </li>

        <li>
            <a href="laboratorium.php">🏢 Laboratorium</a>
        </li>

        <li>
            <a href="peminjaman.php">📋 Peminjaman</a>
        </li>

        <li>
            <a href="maintenance.php">🔧 Maintenance</a>
        </li>

        <li class="logout">
            <a href="../../backend/logout.php">🚪 Logout</a>
        </li>

    </ul>

</div>

<div class="content">

<h1>Data Barang</h1>

<div class="form-card">

<form method="POST">

<input
type="text"
name="kode_barang"
placeholder="Kode Barang"
required
>

<input
type="text"
name="nama_barang"
placeholder="Nama Barang"
required
>

<select name="id_kategori" required>

<option value="">-- Pilih Kategori --</option>

<?php
$kategori = mysqli_query($conn,"SELECT * FROM kategori");
while($k=mysqli_fetch_assoc($kategori)){
?>

<option value="<?= $k['id_kategori']; ?>">
<?= $k['nama_kategori']; ?>
</option>

<?php } ?>

</select>

<select name="id_lab" required>

<option value="">-- Pilih Laboratorium --</option>

<?php
$lab = mysqli_query($conn,"SELECT * FROM laboratorium");
while($l=mysqli_fetch_assoc($lab)){
?>

<option value="<?= $l['id_lab']; ?>">
<?= $l['nama_lab']; ?>
</option>

<?php } ?>

</select>

<input
type="number"
name="jumlah"
placeholder="Jumlah Barang"
required
>

<select name="kondisi" required>

<option value="">-- Pilih Kondisi --</option>
<option value="Baik">Baik</option>
<option value="Rusak Ringan">Rusak Ringan</option>
<option value="Rusak Berat">Rusak Berat</option>

</select>

<input
type="number"
name="tahun_pengadaan"
placeholder="Tahun Pengadaan"
required
>

<select name="status" required>

<option value="">-- Pilih Status --</option>
<option value="Tersedia">Tersedia</option>
<option value="Dipinjam">Dipinjam</option>
<option value="Maintenance">Maintenance</option>

</select>

<button type="submit" name="simpan">
Simpan Barang
</button>

</form>

</div>

<table>

<tr>
<th>ID</th>
<th>Kode Barang</th>
<th>Nama Barang</th>
<th>Kategori</th>
<th>Laboratorium</th>
<th>Jumlah</th>
<th>Kondisi</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['id_barang']; ?></td>
<td><?= $row['kode_barang']; ?></td>
<td><?= $row['nama_barang']; ?></td>
<td><?= $row['nama_kategori']; ?></td>
<td><?= $row['nama_lab']; ?></td>
<td><?= $row['jumlah']; ?></td>
<td><?= $row['kondisi']; ?></td>
<td><?= $row['status']; ?></td>

<td>

<a href="edit_barang.php?id=<?= $row['id_barang']; ?>">
Edit
</a>

|

<a
href="hapus_barang.php?id=<?= $row['id_barang']; ?>"
onclick="return confirm('Yakin ingin menghapus data ini?')"
>
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>
```
