```php
<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

// Hitung total data
$total_barang = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM barang")
);

$total_peminjaman = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM peminjaman")
);

$total_maintenance = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM maintenance")
);

// Data peminjaman terbaru
$data_peminjaman = mysqli_query(
    $conn,
    "SELECT * FROM peminjaman
     ORDER BY id_peminjaman DESC
     LIMIT 10"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris Lab</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:1200px;
            margin:auto;
        }

        h2{
            margin-bottom:25px;
            color:#1e293b;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:#fff;
            padding:25px;
            border-radius:10px;
            text-align:center;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        .card h3{
            font-size:32px;
            color:#2563eb;
            margin-bottom:10px;
        }

        .card p{
            color:#64748b;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#fff;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        th, td{
            padding:12px;
            border:1px solid #ddd;
            text-align:left;
        }

        th{
            background:#1e293b;
            color:#fff;
        }

        tr:nth-child(even){
            background:#f9fafb;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:10px 15px;
            background:#2563eb;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
        }

    </style>
</head>
<body>

<div class="container">

    <h2>📄 Laporan Inventaris Laboratorium</h2>

    <div class="cards">

        <div class="card">
            <h3><?= $total_barang; ?></h3>
            <p>Total Barang</p>
        </div>

        <div class="card">
            <h3><?= $total_peminjaman; ?></h3>
            <p>Total Peminjaman</p>
        </div>

        <div class="card">
            <h3><?= $total_maintenance; ?></h3>
            <p>Total Maintenance</p>
        </div>

    </div>

    <h2>Data Peminjaman Terbaru</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
        </tr>

        <?php $no = 1; ?>

        <?php while ($row = mysqli_fetch_assoc($data_peminjaman)) : ?>

        <tr>
            <td><?= $no++; ?></td>

            <td><?= htmlspecialchars($row['nama_peminjam']); ?></td>

            <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>

            <td><?= htmlspecialchars($row['status']); ?></td>
        </tr>

        <?php endwhile; ?>

    </table>

    <a href="../../index.php" class="btn">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>
```
