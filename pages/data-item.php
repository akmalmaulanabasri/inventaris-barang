<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include '../config.php';
include '../lib/header_admin.php';

if (isset($_POST['ubah'])) {
  $nama = $conn->real_escape_string(trim($_POST['nama_barang']));
  $kategori = $conn->real_escape_string(trim($_POST['kategori']));
  $id = $_GET['id'];

  $cek_id = $conn->query("SELECT * FROM daftar_barang WHERE id = '$id'");       

  if ($cek_id->num_rows == 0) {
      $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Data Tidak Di Temukan.');                                   
  } else {

      if ($conn->query("UPDATE daftar_barang SET nama_barang = '$nama', kategori = '$kategori' WHERE id = '$id'") == true) {
          $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip, Kategori Telah Berhasil Di Ubah.');
      } else {
          $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');
      }
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
                  Daftar Item
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#add-barang">
                    <i class="fas fa-plus"></i> 
                    Tambah Item
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
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tersedia</th>
                        <th scope="col">Dipinjam</th>
                        <th scope="col">Rusak</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM daftar_barang";
                    $result = mysqli_query($conn, $sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data['id']; ?>" role="form" method="POST">
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>"></td>
                            <td>
                              
                            <select class="form-control" name="kategori">
                                            <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?> (Terpilih)</option>
                                            <?php
                                            $cek_kategori = $conn->query("SELECT * FROM kategori_barang");
                                            while ($data_kategori = $cek_kategori->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $data_kategori['kategori']; ?>"><?php echo $data_kategori['kategori']; ?></option>
                                            <?php } ?>
                            </select>

                            </td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['tersedia'] ?></td>
                            <td><?= $data['dipinjam'] ?></td>
                            <td><?= $data['kondisi_rusak'] ?></td>
                            <td>
                                <button data-toggle="tooltip" title="Ubah" type="submit" name="ubah" class="btn btn-primary"><i class="fas fa-pencil-alt" title="Ubah"></i></button>
                                <a href="../data/delete-item.php?id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        </form>
                    <?php } ?>
        </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="add-barang" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Item Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="../data/add-item.php" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang">
            </div>
            <div class="mb-3">
            <label class="form-label">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang" placeholder="Kode Barang">
            </div>
            <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-control" required>
                                <?php
                                
                                $sql = "SELECT * FROM kategori_barang";
                                if($result = mysqli_query($conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($rows = mysqli_fetch_array($result)){
                                            echo "<option value='$rows[kode_kategori]' >$rows[kategori]</option>";
                                        }
                                    }
                                }
                                
                                ?>
                                </select>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Tambah Barang Baru
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php
include '../lib/footer.php';
?>