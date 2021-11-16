<?php

require '../config.php';

$id = rand(1000, 9999);
$kategori = $_POST['nama-kategori'];
$kode_kategori = $_POST['kode-kategori'];

$sql = "INSERT INTO kategori_barang (id, kategori, kode_kategori) VALUES ('$id', '$kategori', '$kode_kategori')";

if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/data-kategori.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>