<?php

require '../config.php';

$sql = "DELETE FROM daftar_barang WHERE id = '$_GET[id]'";

if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/data-item.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>