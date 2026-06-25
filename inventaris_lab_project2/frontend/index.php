<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Inventaris Lab</title>

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container">

    <div class="sidebar">
        <h2 class="logo">Inventaris Lab</h2>

        <ul class="menu">
            <li><a href="#">Dashboard</a></li>
            <li><a href="pages/barang.php">Barang</a></li>
            <li><a href="pages/kategori.php">Kategori</a></li>
            <li><a href="pages/peminjaman.php">Peminjaman</a></li>
            <li><a href="pages/maintenance.php">Maintenance</a></li>

            <li class="logout">
                <a href="../backend/auth/logout.php">Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">

        <h1>Dashboard</h1>

        <div class="cards">

            <div class="card">
                <h2>Barang</h2>
                <p id="barang">6</p>
            </div>

            <div class="card">
                <h2>Kategori</h2>
                <p id="kategori">4</p>
            </div>

            <div class="card">
                <h2>Laboratorium</h2>
                <p id="laboratorium">5</p>
            </div>

            <div class="card">
                <h2>Peminjaman</h2>
                <p id="peminjaman">6</p>
            </div>

            <div class="card">
                <h2>Maintenance</h2>
                <p id="maintenance">4</p>
            </div>

            <div class="card">
                <h2>Users</h2>
                <p id="users">1</p>
            </div>

        </div>

    </div>

</div>

<script src="assets/js/app.js"></script>
</body>
</html>