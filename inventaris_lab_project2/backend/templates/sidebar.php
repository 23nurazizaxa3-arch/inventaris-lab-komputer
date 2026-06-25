<div class="sidebar">
    <h2>Inventaris Lab</h2>

    <ul>
        <li><a href="index.php">Dashboard</a></li>

        <li><a href="admin/barang/index.php">Data Barang</a></li>

        <li><a href="admin/kategori/index.php">Kategori</a></li>

        <li><a href="admin/laboratorium/index.php">Laboratorium</a></li>

        <li><a href="admin/peminjaman/index.php">Peminjaman</a></li>

        <li><a href="admin/maintenance/index.php">Maintenance</a></li>

        <a href="admin/laporan/index.php">📄 Laporan</a>

        <?php if ($_SESSION['role'] == 'admin') : ?>
            <li><a href="admin/users/index.php">Users</a></li>
        <?php endif; ?>

        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>