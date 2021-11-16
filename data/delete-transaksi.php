<?php

require '../config.php';

$sql = "DELETE FROM transaksi WHERE id = '$_GET[id]'";

if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/daftar-transaksi.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>