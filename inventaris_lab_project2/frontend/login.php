<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: pages/dashboard.php");
    exit;
}

$error = '';

if(isset($_GET['error'])){
    $error = "Username atau Password Salah!";
}
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Inventaris Lab</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

    background:linear-gradient(
    135deg,
    #2563eb,
    #4f46e5,
    #7c3aed
    );

}

.container{

    width:1000px;
    max-width:95%;

    background:#fff;

    border-radius:25px;

    overflow:hidden;

    display:flex;

    box-shadow:
    0 20px 50px rgba(0,0,0,0.25);

}

.left{

    width:50%;

    background:linear-gradient(
    135deg,
    #1e3a8a,
    #2563eb
    );

    color:white;

    padding:60px;

    display:flex;
    flex-direction:column;
    justify-content:center;

}

.left h1{

    font-size:42px;
    margin-bottom:20px;

}

.left p{

    line-height:1.8;
    font-size:18px;

}

.feature{

    margin-top:35px;

}

.feature div{

    margin-bottom:18px;
    font-size:18px;

}

.right{

    width:50%;
    padding:60px;

}

.logo{

    text-align:center;
    margin-bottom:25px;

}

.logo i{

    font-size:60px;
    color:#2563eb;

}

.logo h2{

    margin-top:15px;
    color:#111827;

}

.form-group{

    margin-bottom:18px;

}

.form-group label{

    display:block;
    margin-bottom:8px;

}

.form-group input{

    width:100%;

    padding:14px;

    border:1px solid #ddd;

    border-radius:12px;

    outline:none;

}

.form-group input:focus{

    border-color:#2563eb;

}

.password-box{

    position:relative;

}

.password-box i{

    position:absolute;

    right:15px;
    top:15px;

    cursor:pointer;
    color:#666;

}

.btn{

    width:100%;

    padding:15px;

    border:none;

    border-radius:12px;

    background:#2563eb;

    color:white;

    font-size:16px;

    cursor:pointer;

    transition:0.3s;

}

.btn:hover{

    background:#1d4ed8;

    transform:translateY(-2px);

}

.error{

    background:#fee2e2;

    color:#dc2626;

    padding:12px;

    border-radius:10px;

    margin-bottom:15px;

}

.footer{

    text-align:center;

    margin-top:20px;

    color:#888;

    font-size:13px;

}

@media(max-width:768px){

    .container{

        flex-direction:column;

    }

    .left,
    .right{

        width:100%;

    }

    .left{

        padding:35px;

    }

    .right{

        padding:35px;

    }

}

</style>

</head>

<body>

<div class="container">

```
<div class="left">

    <h1>Inventaris Lab Komputer</h1>

    <p>

        Sistem Informasi Inventaris Laboratorium Komputer
        untuk mengelola barang, laboratorium,
        peminjaman dan maintenance.

    </p>

    <div class="feature">

        <div>📦 Kelola Inventaris Barang</div>

        <div>🖥️ Kelola Laboratorium</div>

        <div>📋 Monitoring Peminjaman</div>

        <div>🔧 Monitoring Maintenance</div>

    </div>

</div>

<div class="right">

    <div class="logo">

        <i class="fas fa-laptop-code"></i>

        <h2>Login Administrator</h2>

    </div>

    <?php if(isset($error)){ ?>

        <div class="error">

            <?= $error ?>

        </div>

    <?php } ?>

   <form action="../backend/auth/proses_login.php" method="POST">

        <div class="form-group">

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required>

        </div>

        <div class="form-group">

            <label>Password</label>

            <div class="password-box">

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan Password"
                    required>

                <i class="fas fa-eye"
                   onclick="showPassword()"></i>

            </div>

        </div>

        <button
            type="submit"
            name="login"
            class="btn">

            Login

        </button>

    </form>

    <div class="footer">

        Inventaris Lab Komputer © 2026

    </div>

</div>
```

</div>

<script>

function showPassword(){

    let x =
    document.getElementById("password");

    if(x.type === "password"){

        x.type = "text";

    }else{

        x.type = "password";

    }

}

</script>

</body>

</html>
