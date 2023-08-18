<?php

$sql_host = "localhost";
$sql_user = "root";
$sql_pass = "root";
$sql_db = "inventory";

$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);


$url = "http://192.168.1.6/inv";
$tittle = "Aplikasi Inventaris Kelas X2";
$date = date("Y-m-d");
$time = date('H:i:s');

?>