<?php
session_start();

include '../config/koneksi.php';

$username = mysqli_real_escape_string(
    $conn,
    $_POST['username']
);

$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE username='$username'
     AND password='$password'
     LIMIT 1"
);

if(mysqli_num_rows($query) > 0){

    $user = mysqli_fetch_assoc($query);

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    header("Location: ../../frontend/pages/dashboard.php");
    exit;
}

header("Location: ../../frontend/login.php?error=1");
exit;
?>