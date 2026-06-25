<?php
include '../config/koneksi.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $result = mysqli_query($conn, "SELECT * FROM barang");
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
}

if ($method == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    mysqli_query($conn, "INSERT INTO barang (nama, stok) VALUES (
        '{$input['nama']}',
        '{$input['stok']}'
    )");

    echo json_encode(["message" => "success"]);
}

if ($method == "DELETE") {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM barang WHERE id=$id");

    echo json_encode(["message" => "deleted"]);
}