<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../../backend/config/koneksi.php";


$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id_user='$id'"
);

$user = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    mysqli_query(
        $conn,
        "UPDATE users
        SET
            nama='$nama',
            username='$username',
            role='$role'
        WHERE id_user='$id'"
    );

    echo "
    <script>
        alert('User berhasil diupdate');
        window.location='users.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit User</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container">

    <?php include "../templates/sidebar.php"; ?>

    <div class="content">

        <h1 class="page-title">
            Edit User
        </h1>

        <div class="card-form">

            <form method="POST">

                <input
                    type="text"
                    name="nama"
                    value="<?= $user['nama']; ?>"
                    required
                >

                <input
                    type="text"
                    name="username"
                    value="<?= $user['username']; ?>"
                    required
                >

                <select name="role" required>

                    <option value="admin"
                        <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>
                        Admin
                    </option>

                    <option value="laboran"
                        <?= ($user['role'] == 'laboran') ? 'selected' : ''; ?>>
                        Laboran
                    </option>

                </select>

                <button
                    type="submit"
                    name="update"
                    class="btn-primary"
                >
                    Update User
                </button>

                <a
                    href="users.php"
                    class="btn-secondary"
                    style="margin-left:10px;"
                >
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>