<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

// Ambil data kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Ambil data laboratorium
$laboratorium = mysqli_query($conn, "SELECT * FROM laboratorium");

if (isset($_POST['simpan'])) {

    $kode_barang      = $_POST['kode_barang'];
    $nama_barang      = $_POST['nama_barang'];
    $id_kategori      = $_POST['id_kategori'];
    $id_lab           = $_POST['id_lab'];
    $jumlah           = $_POST['jumlah'];
    $kondisi          = $_POST['kondisi'];
    $tahun_pengadaan  = $_POST['tahun_pengadaan'];
    $status           = $_POST['status'];

    $cek = mysqli_query(
    $conn,
    "SELECT * FROM barang
     WHERE kode_barang = '$kode_barang'"
);

if(mysqli_num_rows($cek) > 0){

    echo "<script>
            alert('Kode Barang sudah digunakan!');
            window.history.back();
          </script>";
    exit;
}

    $query = mysqli_query($conn, "
        INSERT INTO barang (
            kode_barang,
            nama_barang,
            id_kategori,
            id_lab,
            jumlah,
            kondisi,
            tahun_pengadaan,
            status
        ) VALUES (
            '$kode_barang',
            '$nama_barang',
            '$id_kategori',
            '$id_lab',
            '$jumlah',
            '$kondisi',
            '$tahun_pengadaan',
            '$status'
        )
    ");

    if ($query) {
        echo "<script>
                alert('Data barang berhasil ditambahkan');
                window.location='index.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:700px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        h2{
            margin-bottom:25px;
            color:#1e293b;
        }

        label{
            display:block;
            margin-bottom:8px;
            margin-top:15px;
            font-weight:bold;
        }

        input,
        select{
            width:100%;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:6px;
        }

        .btn{
            margin-top:25px;
            padding:12px 20px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            color:white;
            background:#2563eb;
        }

        .btn:hover{
            background:#1d4ed8;
        }

        .btn-kembali{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:#1e293b;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Tambah Barang</h2>

    <form method="POST">

        <label>Kode Barang</label>
        <input
            type="text"
            name="kode_barang"
            required
        >

        <label>Nama Barang</label>
        <input
            type="text"
            name="nama_barang"
            required
        >

        <label>Kategori</label>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>

            <?php while($row = mysqli_fetch_assoc($kategori)) { ?>
                <option value="<?= $row['id_kategori']; ?>">
                    <?= $row['nama_kategori']; ?>
                </option>
            <?php } ?>

        </select>

        <label>Laboratorium</label>
        <select name="id_lab" required>
            <option value="">-- Pilih Laboratorium --</option>

            <?php while($lab = mysqli_fetch_assoc($laboratorium)) { ?>
                <option value="<?= $lab['id_lab']; ?>">
                    <?= $lab['nama_lab']; ?>
                </option>
            <?php } ?>

        </select>

        <label>Jumlah</label>
        <input
            type="number"
            name="jumlah"
            min="1"
            required
        >

        <label>Kondisi</label>
        <select name="kondisi" required>
            <option value="Baik">Baik</option>
            <option value="Rusak Ringan">Rusak Ringan</option>
            <option value="Rusak Berat">Rusak Berat</option>
        </select>

        <label>Tahun Pengadaan</label>
        <input
            type="number"
            name="tahun_pengadaan"
            min="2000"
            max="2100"
            value="<?= date('Y'); ?>"
            required
        >

        <label>Status</label>
        <select name="status" required>
            <option value="Tersedia">Tersedia</option>
            <option value="Dipinjam">Dipinjam</option>
            <option value="Maintenance">Maintenance</option>
        </select>

        <button type="submit" name="simpan" class="btn">
            Simpan
        </button>

    </form>

    <a href="index.php" class="btn-kembali">
        ← Kembali ke Data Barang
    </a>

</div>

</body>
</html>