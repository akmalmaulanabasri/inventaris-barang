<?php
require '../config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM transaksi WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

<div class="table-responsive">
<table class="table table-striped table-bordered table-box">
<tr>
<th class="table-detail" width="50%">Kode Pesanan</th>
<td class="table-detail"><?php echo $row['id']; ?></td>
</tr>
<tr>
<th class="table-detail">Layanan</th>
<td class="table-detail"><?php echo $row['user']; ?></td>
</tr>
<tr>
<th class="table-detail">Tujuan</th>
<td class="table-detail"><?php echo $row['tipe']; ?></td>
</tr>
<tr>
<th class="table-detail">Start Count</th>
<td class="table-detail"><?php echo $row['nama_barang']; ?></td>
</tr>
<tr>
<th class="table-detail">Remains</th>
<td class="table-detail"><?php echo $row['kategori']; ?></td>
</tr>
<tr>
<th class="table-detail">Tanggal & Waktu</th>
<td class="table-detail"><?php echo ($row['tanggal']).','.($row['jam']); ?></td>
</tr>
</table>
</div>

<?php
}

?>