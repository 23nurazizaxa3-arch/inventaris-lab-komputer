<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";

$total_barang = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM barang")
);

$total_kategori = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM kategori")
);

$total_laboratorium = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM laboratorium")
);

$total_peminjaman = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM peminjaman")
);

$total_maintenance = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM maintenance")
);

$barang_tersedia = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM barang WHERE status='Tersedia'")
);

$barang_dipinjam = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM barang WHERE status='Dipinjam'")
);

$barang_maintenance = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM barang WHERE status='Maintenance'")
);

$aktivitas = mysqli_query(
    $conn,
    "SELECT
        peminjaman.id_peminjaman,
        peminjaman.nama_peminjam,
        barang.nama_barang
     FROM peminjaman
     LEFT JOIN barang
     ON peminjaman.id_barang = barang.id_barang
     ORDER BY peminjaman.id_peminjaman DESC
     LIMIT 5"
);

date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>

<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Inventaris Lab</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

.top-info{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

.quick-action{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-action{
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.btn-action:hover{
    background:#1d4ed8;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-top:25px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.card-blue{
    border-left:6px solid #2563eb;
}

.card-green{
    border-left:6px solid #22c55e;
}

.card-purple{
    border-left:6px solid #7c3aed;
}

.card-orange{
    border-left:6px solid #f59e0b;
}

.card-red{
    border-left:6px solid #ef4444;
}

.card h2{
    color:#2563eb;
    font-size:40px;
    margin-bottom:10px;
}

.card p{
    color:#555;
}

.section{
    background:white;
    margin-top:25px;
    padding:25px;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.status-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
}

.status-box{
    text-align:center;
    padding:20px;
    border-radius:10px;
    color:white;
}

.green{
    background:#22c55e;
}

.orange{
    background:#f59e0b;
}

.red{
    background:#ef4444;
}

.status-box h2{
    color:white;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#2563eb;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

.chart-container{
    height:400px;
    position:relative;
}

</style>

</head>

<body>

<div class="container">

<?php include "../templates/sidebar.php"; ?>

<div class="content">

<h1 class="page-title">
Dashboard Inventaris Laboratorium Komputer
</h1>

<div class="top-info">

<div>

<h3>
Selamat Datang,
<?= $_SESSION['nama']; ?>
</h3>

<p id="jam"></p>

</div>

<div class="quick-action">

<a href="barang.php" class="btn-action">
+ Barang
</a>

<a href="kategori.php" class="btn-action">
+ Kategori
</a>

<a href="peminjaman.php" class="btn-action">
+ Peminjaman
</a>

</div>

</div>

<div class="dashboard-grid">

<div class="card card-blue">
<h2><?= $total_barang ?></h2>
<p>Total Barang</p>
</div>

<div class="card card-green">
<h2><?= $total_kategori ?></h2>
<p>Total Kategori</p>
</div>

<div class="card card-purple">
<h2><?= $total_laboratorium ?></h2>
<p>Total Laboratorium</p>
</div>

<div class="card card-orange">
<h2><?= $total_peminjaman ?></h2>
<p>Total Peminjaman</p>
</div>

<div class="card card-red">
<h2><?= $total_maintenance ?></h2>
<p>Total Maintenance</p>
</div>

</div>

<div class="section">

<h3>Status Inventaris Barang</h3>

<div class="status-grid">

<div class="status-box green">
<h2><?= $barang_tersedia ?></h2>
<p>Barang Tersedia</p>
</div>

<div class="status-box orange">
<h2><?= $barang_dipinjam ?></h2>
<p>Barang Dipinjam</p>
</div>

<div class="status-box red">
<h2><?= $barang_maintenance ?></h2>
<p>Maintenance</p>
</div>

</div>

</div>

<div class="section">

<h3>Grafik Statistik Inventaris</h3>

<div class="chart-container">

<canvas id="inventarisChart"></canvas>

</div>

</div>

<div class="section">

<h3>Aktivitas Peminjaman Terbaru</h3>

<table>

<tr>
<th>ID Peminjaman</th>
<th>Nama Barang</th>
<th>Nama Peminjam</th>
</tr>

<?php while($row = mysqli_fetch_assoc($aktivitas)){ ?>

<tr>

<td><?= $row['id_peminjaman']; ?></td>
<td><?= $row['nama_barang']; ?></td>
<td><?= $row['nama_peminjam']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<div class="section">

<h3>Informasi Sistem</h3>

<p><b>Aplikasi :</b> Sistem Informasi Inventaris Laboratorium Komputer</p>
<p><b>Database :</b> MySQL</p>
<p><b>Server :</b> XAMPP</p>
<p><b>Bahasa :</b> PHP Native</p>
<p><b>Tahun :</b> 2026</p>

</div>

</div>

</div>

<script>

function updateJam(){

const sekarang = new Date();

const hari = sekarang.toLocaleDateString('id-ID',{
weekday:'long',
year:'numeric',
month:'long',
day:'numeric'
});

const jam = sekarang.toLocaleTimeString('id-ID');

document.getElementById('jam').innerHTML =
hari + ' | ' + jam + ' WIB';

}

setInterval(updateJam,1000);
updateJam();

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('inventarisChart');

new Chart(ctx,{

type:'bar',

data:{

labels:[
'Barang',
'Kategori',
'Laboratorium',
'Peminjaman',
'Maintenance'
],

datasets:[{

label:'Jumlah Data',

data:[
<?= $total_barang ?>,
<?= $total_kategori ?>,
<?= $total_laboratorium ?>,
<?= $total_peminjaman ?>,
<?= $total_maintenance ?>
],

backgroundColor:[
'#2563eb',
'#22c55e',
'#7c3aed',
'#f59e0b',
'#ef4444'
]

}]

},

options:{
responsive:true,
maintainAspectRatio:false,
scales:{
y:{
beginAtZero:true
}
}
}

});

</script>

</body>
</html>
