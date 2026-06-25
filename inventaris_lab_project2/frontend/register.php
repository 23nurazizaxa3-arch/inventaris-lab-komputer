<?php
include "../backend/config/koneksi.php";

if(isset($_POST['register'])){

    $nama     = mysqli_real_escape_string($conn,$_POST['nama']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    // PASSWORD TANPA MD5
    $password = $_POST['password'];

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Username sudah digunakan!');
        </script>
        ";

    }else{

        mysqli_query(
            $conn,
            "INSERT INTO users
            (nama,username,password,role)
            VALUES
            ('$nama','$username','$password','laboran')"
        );

        echo "
        <script>
            alert('Registrasi berhasil');
            window.location='login.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#2563eb,#7c3aed);
}

.container{
    width:1050px;
    background:white;
    border-radius:30px;
    overflow:hidden;
    display:flex;
    box-shadow:0 15px 40px rgba(0,0,0,.15);
}

.left{
    width:50%;
    background:linear-gradient(180deg,#1e40af,#2563eb);
    color:white;
    padding:60px;
}

.left h1{
    font-size:52px;
    margin-bottom:25px;
}

.left p{
    font-size:22px;
    line-height:1.8;
}

.menu{
    margin-top:40px;
}

.menu p{
    margin-bottom:20px;
}

.right{
    width:50%;
    padding:60px;
}

.icon{
    text-align:center;
    font-size:70px;
    margin-bottom:10px;
}

.right h2{
    text-align:center;
    margin-bottom:30px;
    font-size:38px;
}

input{
    width:100%;
    padding:15px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:16px;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:white;
    font-size:18px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.login-link{
    text-align:center;
    margin-top:20px;
}

.login-link a{
    color:#2563eb;
    text-decoration:none;
    font-weight:bold;
}

</style>
</head>

<body>

<div class="container">

    <div class="left">

        <h1>Registrasi Akun</h1>

        <p>
            Daftarkan akun untuk mengakses
            Sistem Inventaris Laboratorium Komputer.
        </p>

        <div class="menu">
            <p>📦 Kelola Inventaris Barang</p>
            <p>💻 Kelola Laboratorium</p>
            <p>📋 Monitoring Peminjaman</p>
            <p>🔧 Monitoring Maintenance</p>
        </div>

    </div>

    <div class="right">

        <div class="icon">👤</div>

        <h2>Register</h2>

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

            <button
                type="submit"
                name="register"
            >
                Register
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </div>

    </div>

</div>

</body>
</html>