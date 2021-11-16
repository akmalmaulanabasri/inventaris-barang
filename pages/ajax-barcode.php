<?php
    include "../config.php";
    $barcode = $_POST["barcode"];
    $id = "86755";
    $result = mysqli_query($conn,"SELECT * FROM daftar_barang where id = '$barcode' ");
?>
<!-- <option value="">Pilih...</option> -->
<?php
    while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["nama_barang"];?>"><?php echo $row["nama_barang"];?></option>
<?php
    }
?>