<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

/* HANYA ADMIN YANG BOLEH AKSES */
if($_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit;
}

include "../../backend/config/koneksi.php";
?>
/* ==========================
   TAMBAH USER
========================== */

if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    mysqli_query($conn,"
        INSERT INTO users
        (
            nama,
            username,
            password,
            role
        )
        VALUES
        (
            '$nama',
            '$username',
            '$password',
            '$role'
        )
    ");

    echo "
    <script>
        alert('User berhasil ditambahkan');
        window.location='users.php';
    </script>
    ";
}

$data = mysqli_query(
    $conn,
    "SELECT * FROM users ORDER BY id_user DESC"
);
?>

<!DOCTYPE html>

<html>
<head>

<title>Data User</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

<?php include "../templates/sidebar.php"; ?>

<div class="content">

<h1 class="page-title">
Data User
</h1>

<div class="card-form">

<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama Lengkap"
required

>

<input
type="text"
name="username"
placeholder="Username"
required

>

<input
type="password"
name="password"
placeholder="Password"
required

>

<select name="role" required>

<option value="">
-- Pilih Role --
</option>

<option value="admin">
Admin
</option>

<option value="laboran">
Laboran
</option>

</select>
<button
type="submit"
name="simpan"
class="btn-primary"

>

Tambah User </button>

</form>

</div>

<div class="table-container">

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Username</th>
<th>Role</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['id_user']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['username']; ?></td>

<td><?= ucfirst($row['role']); ?></td>

<td>

<a href="edit_user.php?id=<?= $row['id_user']; ?>">
Edit
</a>

|

<a
href="hapus_user.php?id=<?= $row['id_user']; ?>"
onclick="return confirm('Yakin ingin menghapus user?')"

>

Hapus </a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>
