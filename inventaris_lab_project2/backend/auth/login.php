<?php
session_start();

include "../config/koneksi.php";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    $user = mysqli_fetch_assoc($query);

    if($user){

        if($password == $user['password']){

            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../../frontend/pages/dashboard.php");
            exit;
        }
    }

    header("Location: ../../frontend/login.php?error=1");
    exit;
}
?>