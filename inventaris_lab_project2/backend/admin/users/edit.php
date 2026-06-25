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

$id = (int)$_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM users
    WHERE id_user='$id'
"));

if (!$data) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {

        $password = password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );

        mysqli_query($conn, "
            UPDATE users SET
                nama='$nama',
                username='$username',
                password='$password',
                role='$role'
            WHERE id_user='$id'
        ");

    } else {

        mysqli_query($conn, "
            UPDATE users SET
                nama='$nama',
                username='$username',
                role='$role'
            WHERE id_user='$id'
        ");
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">

    <p>Nama</p>
    <input
        type="text"
        name="nama"
        value="<?= htmlspecialchars($data['nama']); ?>"
        required
    >

    <p>Username</p>
    <input
        type="text"
        name="username"
        value="<?= htmlspecialchars($data['username']); ?>"
        required
    >

    <p>Password Baru (Kosongkan jika tidak diubah)</p>
    <input type="password" name="password">

    <p>Role</p>

    <select name="role">

        <option value="admin"
            <?= $data['role'] == 'admin' ? 'selected' : ''; ?>>
            Admin
        </option>

        <option value="petugas"
            <?= $data['role'] == 'petugas' ? 'selected' : ''; ?>>
            Petugas
        </option>

    </select>

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

<br>

<a href="index.php">Kembali</a>

</body>
</html>