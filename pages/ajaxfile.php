<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include "../config.php";

$userid = $_POST['userid'];

$sql = "select * from transaksi where id=".$userid;
$result = mysqli_query($conn,$sql);

while( $row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $user = $row['user'];
    $tipe = $row['tipe'];
    $nama_barang = $row['nama_barang'];
    $kategori = $row['kategori'];
    $keterangan = $row['keterangan'];
    $tanggal = $row['tanggal'];
    $jam = $row['jam'];
    $status = $row['status'];
    
    $response = "<div class='table-responsive'>
    <table class='table table-striped table-bordered table-box'>
    <tr>
    <th class='table-detail' width='50%'>Kode Transaksi</th>
    <td class='table-detail'>".$id."</td>
    </tr>
    <tr>
    <th class='table-detail'>User</th>
    <td class='table-detail'>".$user."</td>
    </tr>
    <tr>
    <th class='table-detail'>Tipe</th>
    <td class='table-detail'>".$tipe."</td>
    </tr>
    <tr>
    <th class='table-detail'>Nama Barang</th>
    <td class='table-detail'>".$nama_barang."</td>
    </tr>
    <tr>
    <th class='table-detail'>Kategori</th>
    <td class='table-detail'>".$kategori."</td>
    </tr>
    <tr>
    <th class='table-detail'>Status</th>
    <td class='table-detail'>".$status."</td>
    </tr>
    <tr>
    <th class='table-detail'>Keterangan</th>
    <td class='table-detail'>".$keterangan."</td>
    </tr>
    <tr>
    <th class='table-detail'>Tanggal & Waktu</th>
    <td class='table-detail'>".$tanggal." / ".$jam."</td>
    </tr>
    </table>
    </div>";
    $response .= "</tr>";

}
$response .= "</table>";

echo $response;
exit;