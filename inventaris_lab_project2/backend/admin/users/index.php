<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit;
}

include '../../config/koneksi.php';

$query = mysqli_query($conn, "
    SELECT * FROM users
    ORDER BY id_user DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users</title>

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
            background:#fff;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        h2{
            margin-bottom:20px;
            color:#1e293b;
        }

        .btn-tambah{
            display:inline-block;
            padding:10px 15px;
            background:#2563eb;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }

        th{
            background:#1e293b;
            color:#fff;
        }

        tr:nth-child(even){
            background:#f9fafb;
        }

        .edit{
            color:#2563eb;
            text-decoration:none;
            margin-right:10px;
        }

        .hapus{
            color:#dc2626;
            text-decoration:none;
        }

        .kembali{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:#1e293b;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Data Users</h2>

    <a href="tambah.php" class="btn-tambah">
        + Tambah User
    </a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; ?>

        <?php while($row = mysqli_fetch_assoc($query)) : ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['username']); ?></td>
            <td><?= ucfirst($row['role']); ?></td>

            <td>
                <a class="edit"
                   href="edit.php?id=<?= $row['id_user']; ?>">
                    Edit
                </a>

                <a class="hapus"
                   href="hapus.php?id=<?= $row['id_user']; ?>"
                   onclick="return confirm('Yakin ingin menghapus user?')">
                    Hapus
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

    <a href="../../index.php" class="kembali">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>