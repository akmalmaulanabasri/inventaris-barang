<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include 'config.php';
include 'lib/header.php';

if (isset($_POST['submit'])) {
  $id = rand(10000, 99999);
  $user = $_SESSION['username'];
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
                      <div class="header">Barang Yang Anda Pinjam </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">
                        <?php
                         $sql = "SELECT SUM(`jumlah`) AS jumlah FROM `transaksi` WHERE user = '$user' AND status = 'Belum Dikembalikan'";
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
               <a href="" class="card" data-bs-toggle="modal" data-bs-target="#add-transaksi">
                  <div class="card button btn btn-success">
                    <div class=" align-items-center">
                      <div class="h2">Pinjam Barang</div>
                  </div>
                </div>
               </a>
              </div>
              <div class="col-sm-6 col-lg-3">
               <a href="" class="card"  data-bs-toggle="modal" data-bs-target="#kembalikan-transaksi">
                  <div class="card button btn btn-warning">
                    <div class=" align-items-center">
                      <div class="h2">Kembalikan Barang</div>
                  </div>
                </div>
               </a>
              </div>
              <div class="col-sm-6 col-lg-3">
               <a href="user/riwayat-transaksi.php" class="card">
                  <div class="card button btn btn-info">
                    <div class=" align-items-center">
                      <div class="h2">Riwayat Peminjaman</div>
                  </div>
                </div>
               </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Popup Transaksi baru-->
        <div class="modal modal-blur fade" id="add-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pinjam Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="" role="form" method="POST">
            <!-- tab pertama -->
          <div class="modal-body tabs" id="Pilih">
          <input type="text" name="metode" id="" value="dropdown" hidden>
            <div class="mb-3">
              <label for="tipe">Tipe Transaksi</label>
              <select name="tipe" id="tipe" readonly="readonly" class="form-control">
                <option value="Pinjam Barang">Pinjam Barang</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="">Barcode</label>
              <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
            </div>
            <div class="mb-3">
            <label for="CATEGORY-DROPDOWN">Kategori</label>
                <select class="form-control" id="category-dropdown" name="kategori">
              <option value="">Pilih Category</option>
              <?php
              include '../config.php';
              $sql = "SELECT * FROM kategori_barang";
              $result = mysqli_query($conn, $sql);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<option value='$data[kategori]'>$data[kategori]</option>";}
              ?>
              </select>
            </div>
            <div class="mb-3">
            <label for="SUBCATEGORY">Item</label>
            <select class="form-control" id="sub-category-dropdown" name="nama_barang">
              <option value="">Pilih Kategori Dulu...</option>
            </select>
            </div>
            <div class="mb-3">
              <label for="jumlah">Jumlah</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-danger link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="#" class="btn btn-warning">
              reset</button>
            <button type="submit" name="submit" class="btn btn-primary">
              Pinjam</button>
          </form>
          </div>
        </div>
      </div>
    </div>


    <!-- Popup Transaksi kembali-->
<div class="modal modal-blur fade" id="kembalikan-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kembalikan Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" role="form" method="POST">
            <!-- tab pertama -->
          <div class="modal-body tabs" id="Pilih">
          <input type="text" name="metode" id="" value="dropdown" hidden>
            <div class="mb-3">
              <label for="tipe">Tipe Transaksi</label>
              <select name="tipe" id="tipe" readonly="readonly" class="form-control">
                <option value="Kembalikan Barang">Kembalikan Barang</option>
              </select>
            </div>
            <div class="mb-3">
            <label for="SUBCATEGORY">Barang Yang Dipinjam</label>
            <select class="form-control" id="sub-category-dropdown" name="id_transaksi">
              <option value="">Pilih...</option>
              <?php
              $sql = "SELECT * FROM transaksi WHERE user = '$user' and status = 'Belum Dikembalikan'";
              $result = mysqli_query($conn, $sql);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<option value='$data[id]'>$data[nama_barang] ($data[keterangan])</option>";}
              ?>
            </select>
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-danger link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="#" class="btn btn-warning">
              reset</button>
            <button type="submit" name="submit" class="btn btn-primary">
             Kembalikan</button>
          </form>
          </div>
        </div>
      </div>
    </div>

        <footer class="footer footer-transparent d-print-none">
          <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
              </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- script dropdown -->
<script>
$(document).ready(function() {
$('#category-dropdown').on('change', function() {
var kategori = this.value;
$.ajax({
url: "pages/ajax-item.php",
type: "POST",
data: {
  kategori: kategori
},
cache: false,
success: function(result){
$("#sub-category-dropdown").html(result);
}
});
});
});
</script>

<!-- script auto fill nama barang-->
<script>
$(document).ready(function() {
$('#barcode').on('change', function() {
var barcode = this.value;
$.ajax({
url: "pages/ajax-barcode.php",
type: "POST",
data: {
    barcode: barcode
},
cache: false,
success: function(result){
$("#sub-category-dropdown").html(result);
}
});
});
});
</script>

<!-- script auto kategori barang-->
<script>
$(document).ready(function() {
$('#barcode').on('change', function() {
var barcode = this.value;
$.ajax({
url: "pages/ajax-kategori.php",
type: "POST",
data: {
    barcode: barcode
},
cache: false,
success: function(result){
$("#category-dropdown").html(result);
}
});
});
});
</script>

<?php
include 'lib/footer.php';
?>