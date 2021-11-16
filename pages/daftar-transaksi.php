<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include '../config.php';
include '../lib/header_admin.php';

if (isset($_POST['add_trx'])) {
  $id = rand(10000, 99999);
  // $user = $_SESSION['user'];
  $user = "admin";
  $tipe = $conn->real_escape_string(trim($_POST['tipe']));
  $kategori = $conn->real_escape_string(trim($_POST['kategori']));
  $nama_barang = $conn->real_escape_string(trim($_POST['nama_barang']));
  $jumlah = $conn->real_escape_string(trim($_POST['jumlah']));
  $keterangan = $conn->real_escape_string(trim($_POST['keterangan']));
  $status = "Sukses";
  $tanggal = date("Y-m-d");
  $jam = date('H:i:s');

  if ($tipe == "Transaksi Masuk") {
    $sql = "Select * from daftar_barang where nama_barang = '$nama_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stok = $row['jumlah'] + $jumlah;
    $tersedia = $row['tersedia'] + $jumlah;
    $conn->query("UPDATE daftar_barang SET jumlah = '$stok', tersedia = '$tersedia' WHERE nama_barang = '$nama_barang'");
    $conn->query("INSERT INTO transaksi (id, user, tipe, kategori, nama_barang, jumlah, keterangan, status, tanggal, jam) VALUES ('$id', '$user', '$tipe', '$kategori', '$nama_barang', '$jumlah', '$keterangan', '$status', '$tanggal', '$jam')");
  }else if($tipe == "Transaksi Keluar") {
    $sql = "Select * from daftar_barang where nama_barang = '$nama_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stok = $row['jumlah'] - $jumlah;
    $tersedia = $row['tersedia'] - $jumlah;
    $conn->query("UPDATE daftar_barang SET jumlah = '$stok', tersedia = '$tersedia' WHERE nama_barang = '$nama_barang'");
    $conn->query("INSERT INTO transaksi (id, user, tipe, kategori, nama_barang, jumlah, keterangan, ,status tanggal, jam) VALUES ('$id', '$user', '$tipe', '$kategori', '$nama_barang', '$jumlah', '$keterangan', '$status', '$tanggal', '$jam')");
  }
  else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
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
                  Daftar Transaksi
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#add-transaksi">
                    <i class="fas fa-plus"></i> 
                    Tambah Transaksi
                  </a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
        <div class="card-body">
            <!-- create a boostrap table -->
            <div class="table-responsive">
            <table class="table table-vcenter card-table">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">User</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM transaksi";
                    $result = mysqli_query($conn, $sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['user'] ?></td>
                            <td><?= $data['tipe'] ?></td>
                            <td><?= $data['nama_barang'] ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td>
                            <button data-id="<?= $data['id'] ?>" class="userinfo btn-success btn">Info</button>
                              <a href="../data/delete-transaksi.php?id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
        </div>
        </div>
    </div>
</div>


<!-- Popup Transaksi baru-->
<div class="modal modal-blur fade" id="add-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buat Transaksi Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" role="form" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label for="tipe">Tipe Transaksi</label>
              <select name="tipe" id="tipe"class="form-control">
                <option value="Transaksi Masuk">Transaksi Masuk</option>
                <option value="Transaksi Keluar">Transaksi Keluar</option>
              </select>
            </div>
            <div class="mb-3">
            <label for="CATEGORY-DROPDOWN">Kategori</label>
                <select class="form-control" id="category-dropdown" name="kategori">
              <option value="">Select Category</option>
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
              <option value="">Pilih Kategori</option>
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
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" name="add_trx" class="btn btn-primary">
              Tambah</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Transaksi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          
                        </div>
                        <div class="modal-body">
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                  
                </div>
            </div>
    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="<?php echo $url?>/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript">
            $(document).ready(function(){

                $('.userinfo').click(function(){
                   
                    var userid = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
                        }
                    });
                });
            });
            </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
$('#category-dropdown').on('change', function() {
var kategori = this.value;
$.ajax({
url: "ajax-item.php",
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
<?php
include '../lib/footer.php';
?>