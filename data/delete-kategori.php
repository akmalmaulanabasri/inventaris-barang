<?php

require '../config.php';

$sql = "DELETE FROM kategori_barang WHERE id = '$_GET[id]'";

if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/data-kategori.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>