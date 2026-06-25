<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

include 'config/koneksi.php';

// Hitung data dashboard
$total_barang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang"));
$total_kategori = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori"));
$total_lab = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laboratorium"));
$total_peminjaman = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM peminjaman"));
$total_maintenance = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM maintenance"));
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris Laboratorium Komputer</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            display:flex;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#1e293b;
            color:#fff;
            padding:20px;
        }

        .sidebar h2{
            text-align:center;
            margin-bottom:30px;
            font-size:22px;
        }

        .user-info{
            background:#334155;
            padding:15px;
            border-radius:8px;
            margin-bottom:25px;
        }

        .user-info p{
            margin-bottom:5px;
            font-size:14px;
        }

        .sidebar a{
            display:block;
            color:#fff;
            text-decoration:none;
            padding:12px 15px;
            margin-bottom:10px;
            border-radius:8px;
            transition:0.3s;
        }

        .sidebar a:hover{
            background:#2563eb;
        }

        .logout{
            background:#dc2626;
        }

        .logout:hover{
            background:#b91c1c !important;
        }

        .content{
            flex:1;
            padding:30px;
        }

        .header{
            background:#fff;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            margin-bottom:25px;
        }

        .header h1{
            margin-bottom:10px;
            color:#1e293b;
        }

        .header p{
            color:#64748b;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
            gap:20px;
        }

        .card{
            background:#fff;
            border-radius:10px;
            padding:25px;
            text-align:center;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .card h3{
            font-size:36px;
            color:#2563eb;
            margin-bottom:10px;
        }

        .card p{
            color:#64748b;
            font-size:16px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <h2>Inventaris Lab</h2>

        <div class="user-info">
            <p><strong><?= $_SESSION['nama']; ?></strong></p>
            <p><?= ucfirst($_SESSION['role']); ?></p>
        </div>

        <a href="index.php">🏠 Dashboard</a>

        <a href="admin/barang/index.php">📦 Barang</a>

        <a href="admin/kategori/index.php">📂 Kategori</a>

        <a href="admin/laboratorium/index.php">🏢 Laboratorium</a>

        <a href="admin/peminjaman/index.php">📝 Peminjaman</a>

        <a href="admin/maintenance/index.php">🛠️ Maintenance</a>

        <a href="admin/laporan/index.php">📄 Laporan</a>

        <?php if ($_SESSION['role'] == 'admin') : ?>

        <a href="admin/users/index.php">👤 Users</a>

    <?php endif; ?>

    <a href="auth/logout.php" class="logout">🚪 Logout</a>

</div>

    <div class="content">

        <div class="header">
            <h1>Selamat Datang, <?= $_SESSION['nama']; ?> 👋</h1>

            <p>
                Sistem Inventaris Laboratorium Komputer digunakan untuk
                mengelola data barang, laboratorium, peminjaman,
                maintenance, dan pengguna.
            </p>
        </div>

        <div class="cards">

            <div class="card">
                <h3><?= $total_barang; ?></h3>
                <p>Total Barang</p>
            </div>

            <div class="card">
                <h3><?= $total_kategori; ?></h3>
                <p>Total Kategori</p>
            </div>

            <div class="card">
                <h3><?= $total_lab; ?></h3>
                <p>Total Laboratorium</p>
            </div>

            <div class="card">
                <h3><?= $total_peminjaman; ?></h3>
                <p>Total Peminjaman</p>
            </div>

            <div class="card">
                <h3><?= $total_maintenance; ?></h3>
                <p>Total Maintenance</p>
            </div>

            <div class="card">
                <h3><?= $total_users; ?></h3>
                <p>Total Users</p>
            </div>

        </div>

    </div>

</body>
</html>