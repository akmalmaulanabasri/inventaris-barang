<?php
include '../config.php';
include '../lib/header.php';
?>


<div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  <?php echo $tittle?>
                </div>
                <h2 class="page-title">
                  Riwayat Transaksi
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
              </div>
            </div>
          </div>
        </div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-vcenter card-table">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Tipe</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM transaksi Where user = '$user' ORDER by status asc ";
                    $result = mysqli_query($conn, $sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {

                      if ($data['status'] == 'Sudah Dikembalikan') {
                        $label = 'success';
                      } else  if ($data['status'] == 'Belum Dikembalikan') {
                        $label = 'danger';
                      }
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['user'] ?></td>
                            <td><?= $data['tipe'] ?></td>
                            <td><?= $data['nama_barang'] ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td><div class="btn btn-<?php echo $label ?>"><?= $data['status'] ?></div></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include '../lib/footer.php';
?>