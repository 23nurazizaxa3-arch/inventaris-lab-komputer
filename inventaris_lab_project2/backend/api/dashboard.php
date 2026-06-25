<?php

include "../config/koneksi.php";

$barang = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM barang")
);

$kategori = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM kategori")
);

$laboratorium = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM laboratorium")
);

$peminjaman = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM peminjaman")
);

$maintenance = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM maintenance")
);

$users = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM users")
);

echo json_encode([
    "barang"=>$barang,
    "kategori"=>$kategori,
    "laboratorium"=>$laboratorium,
    "peminjaman"=>$peminjaman,
    "maintenance"=>$maintenance,
    "users"=>$users
]);