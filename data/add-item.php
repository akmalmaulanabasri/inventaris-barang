<?php

require '../config.php';

$id = rand(11111, 99999);
$nama_barang = $_POST['nama_barang'];
$barcode = $_POST['kode_barang'];
$kategori = $_POST['kategori'];

if(!empty($barcode)) 
{
	$kode = $barcode;
}else{
	$kode = $id;
}

$sql = "INSERT INTO daftar_barang (id, nama_barang, kategori) VALUES ('$kode', '$nama_barang', '$kategori')";

if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/data-item.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>