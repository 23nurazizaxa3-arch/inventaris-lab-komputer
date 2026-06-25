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

if (isset($_POST['simpan'])) {

    $nama = mysqli_real_escape_string(
        $conn,
        $_POST['nama']
    );

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $role = $_POST['role'];

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE username='$username'"
    );

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
                alert('Username sudah digunakan!');
              </script>";

    } else {

        mysqli_query(
            $conn,
            "INSERT INTO users (
                nama,
                username,
                password,
                role
            ) VALUES (
                '$nama',
                '$username',
                '$password',
                '$role'
            )"
        );

        echo "<script>
                alert('User berhasil ditambahkan');
                window.location='index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>

    <style>
        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:500px;
            margin:auto;
            background:#fff;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        h2{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:5px;
        }

        input, select{
            width:100%;
            padding:10px;
            border:1px solid #ddd;
            border-radius:5px;
        }

        button{
            margin-top:20px;
            padding:12px 20px;
            background:#2563eb;
            color:#fff;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#1d4ed8;
        }

        a{
            display:inline-block;
            margin-top:15px;
            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Tambah User</h2>

    <form method="POST">

        <label>Nama</label>
        <input
            type="text"
            name="nama"
            placeholder="Contoh: Budi Santoso"
            required
        >

        <label>Username</label>
        <input
            type="text"
            name="username"
            placeholder="Contoh: budi"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            placeholder="Contoh: budi123"
            required
        >

        <label>Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>

        <button type="submit" name="simpan">
            Simpan
        </button>

    </form>

    <a href="index.php">← Kembali</a>

</div>

</body>
</html>