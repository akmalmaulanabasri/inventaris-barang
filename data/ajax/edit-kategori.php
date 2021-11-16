<?php
session_start();
require '../../config.php';
$id = $_POST['id'];
	$cek_pesanan = $conn->query("SELECT * FROM kategori_barang WHERE id = '$id'");
    while($data_pesanan = $cek_pesanan->fetch_assoc()) {
?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-box">
<tr>
<th class="table-detail">Kategori</th>
<td class="table-detail"><?php echo $data_pesanan['kategori']; ?></td>
</tr>
<tr>
<th class="table-detail">Kode Kategori</th>
<td class="table-detail"><?php echo $data_pesanan['kode_kategori']; ?></td>
</tr>
</table>
</div>
<?php
}