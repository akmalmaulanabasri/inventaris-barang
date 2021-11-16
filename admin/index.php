<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include '../config.php';
include '../lib/header_admin.php';

if (isset($_POST['submit'])) {
  $id = rand(10000, 99999);
  // $user = $_SESSION['user'];
  $user = "admin";
  $tipe = $conn->real_escape_string(trim($_POST['tipe']));
  $keterangan = $conn->real_escape_string(trim($_POST['keterangan']));
  $tanggal = date("Y-m-d");
  $jam = date('H:i:s');


  $status_pinjam = "Belum Dikembalikan";
  $status_kembali = "Sudah Dikembalikan";

  if ($tipe == "Kembalikan Barang") {

  $id_transaksi = $conn->real_escape_string(trim($_POST['id_transaksi']));
  $sql = "SELECT * FROM transaksi WHERE id = '$id_transaksi'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nama_barang = $row['nama_barang'];
    $jumlah = $row['jumlah'];
    $kategori = $row['kategori'];

    $sql = "Select * from daftar_barang where nama_barang = '$nama_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tersedia = $row['tersedia'] + $jumlah;
    $dipinjam = $row['dipinjam'] - $jumlah;
    $conn->query("UPDATE daftar_barang SET dipinjam = '$dipinjam', tersedia = '$tersedia' WHERE nama_barang = '$nama_barang'");
    $conn->query("UPDATE transaksi SET status = '$status_kembali' WHERE id = '$id_transaksi'");
  }else if($tipe == "Pinjam Barang") {

  $tipe = $conn->real_escape_string(trim($_POST['tipe']));
  $kategori = $conn->real_escape_string(trim($_POST['kategori']));
  $nama_barang = $conn->real_escape_string(trim($_POST['nama_barang']));
  $jumlah = $conn->real_escape_string(trim($_POST['jumlah']));
  $keterangan = $conn->real_escape_string(trim($_POST['keterangan']));
  $tanggal = date("Y-m-d");
  $jam = date('H:i:s');

  if (empty ($keterangan)) {
    $keterangan = "Tidak ada keterangan";
  }else {
    $keterangan = $keterangan;
  }

    $sql = "Select * from daftar_barang where nama_barang = '$nama_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tersedia = $row['tersedia'] - $jumlah;
    $dipinjam = $row['dipinjam'] + $jumlah;
    $conn->query("UPDATE daftar_barang SET dipinjam = '$dipinjam', tersedia = '$tersedia' WHERE nama_barang = '$nama_barang'");
    $conn->query("INSERT INTO transaksi (id, user, tipe, kategori, nama_barang, jumlah, keterangan, status, tanggal, jam) VALUES ('$id', '$user', '$tipe', '$kategori', '$nama_barang', '$jumlah', '$keterangan', '$status_pinjam', '$tanggal', '$jam')");
  }
  else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>


<!-- body halaman -->
      <div class="page-wrapper">
        <div class="container-xl">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  <?php echo $tittle?>
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="header">Total Aset</div>
                    </div>
                    <br>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">
                        <?php
                         $sql = "SELECT SUM(`jumlah`) AS jumlah FROM `daftar_barang`";
                         $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $jumlah = $row['jumlah'];

                          if ($jumlah == "") {
                            echo "0";
                          }else{
                            echo $jumlah;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="header">Barang Yang Dipinjam</div>
                    </div>
                    <br>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">
                        <?php
                         $sql = "SELECT SUM(`jumlah`) AS jumlah FROM `transaksi` WHERE status = 'Belum Dikembalikan'";
                         $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $jumlah = $row['jumlah'];

                          if ($jumlah == "") {
                            echo "0";
                          }else{
                            echo $jumlah;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="header">Barang Tersedia</div>
                    </div>
                    <br>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">
                        <?php
                         $sql = "SELECT SUM(`tersedia`) AS tersedia FROM `daftar_barang`";
                         $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $jumlah = $row['tersedia'];

                          if ($jumlah == "") {
                            echo "0";
                          }else{
                            echo $jumlah;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="header">Total Pengguna</div>
                    </div>
                    <br>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">
                        <?php
                        $sql = "SELECT COUNT(*) AS `count` FROM `user`";
                         $result = mysqli_query($conn , $sql);
                          $row = mysqli_fetch_assoc($result);
                          $jumlah = $row['count'];

                          if ($jumlah == "") {
                            echo "0";
                          }else{
                            echo $jumlah;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


<?php
include '../lib/footer.php';
?>