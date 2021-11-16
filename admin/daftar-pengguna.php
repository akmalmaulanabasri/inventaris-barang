<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php
include '../config.php';
include '../lib/header_admin.php';


if (isset($_POST['ubah'])) {
  $nama = $conn->real_escape_string(trim($_POST['nama']));
  $email = $conn->real_escape_string(trim($_POST['email']));
  $role = $conn->real_escape_string(trim($_POST['role']));
  $password = $conn->real_escape_string(trim($_POST['password']));
  $id = $_GET['id'];

  $cek_id = $conn->query("SELECT * FROM user WHERE id = '$id'");    
  $data = $cek_id->fetch_assoc();
  $password_old = $data['password'];

  if ($password == null) {
    $password_new = $password_old;
  } else {
    $password_new = md5($password);
  }

  if ($cek_id->num_rows == 0) {
      $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Data Tidak Di Temukan.');                                   
  } else {

      if ($conn->query("UPDATE user SET nama = '$nama', email = '$email', role = '$role'  , password = '$password_new'  WHERE id = '$id'") == true) {
          $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip, Kategori Telah Berhasil Di Ubah.');
      } else {
          $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');
      }
  }

}

if (isset($_POST['add'])){
  $username = $conn->real_escape_string(trim($_POST['username']));
  $password = $conn->real_escape_string(trim($_POST['password']));
  $nama = $conn->real_escape_string(trim($_POST['nama']));
  $email = $conn->real_escape_string(trim($_POST['email']));
  $role = $conn->real_escape_string(trim($_POST['role']));
  $phone = $conn->real_escape_string(trim($_POST['phone']));

  $password = md5($password);

  // cek username
  $cek_username = $conn->query("SELECT * FROM user WHERE username = '$username'");
  if ($cek_username->num_rows > 0) {
    echo "<script>swal('Ups!', 'Gagal! Username Sudah Digunakan.', 'error');</script>";
  } else {
    if ($conn->query("INSERT INTO user (username, password, nama, email, role, no_wa) VALUES ('$username', '$password', '$nama', '$email', '$role', '$phone')") == true) {
      echo "<script>swal('Berhasil!', 'Data Telah Berhasil Di Tambahkan.', 'success');</script>";
    } else {
      echo "<script>swal('Ups!', 'Gagal! Sistem Kami Sedang Mengalami Gangguan.', 'error');</script>";
    }
  }
}

if (isset($_POST['delete'])) {
  $id = $_GET['id'];
  if ($conn->query("DELETE FROM user WHERE id = '$id'") == true) {
    echo "<script>swal('Berhasil!', 'Data Telah Berhasil Di Hapus.', 'success');</script>";
  } else {
    echo "<script>swal('Ups!', 'Gagal! Sistem Kami Sedang Mengalami Gangguan.', 'error');</script>";
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
                  Daftar Pengguna
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-sm-inline-block"  data-bs-toggle="modal" data-bs-target="#add-member">
                    <i class="fas fa-plus"></i> 
                    Tambah Pengguna
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
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role </th>
                        <th scope="col">Password</th>
                        <th scope="col"></th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($conn, $sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data['id']; ?>" role="form" method="POST">
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>"></td>
                            <td><input type="text" name="email" class="form-control" value="<?= $data['email'] ?>"></td>
                            <td>
                              <select name="role" id="role" class="form-control">
                                <option value="<?= $data['role'] ?>">(<?= $data['role'] ?>)</option>
                                <option value="member">Member</option>
                                <option value="admin">Admin</option>
                              </select>
                            </td>
                            <td><input type="text" name="password" class="form-control" value="" placeholder="kosongkan jika tidak diubah"></td>
                            <td>
                                <button data-toggle="tooltip" title="Ubah" type="submit" name="ubah" class="btn btn-primary"><i class="fas fa-pen" title="Ubah"></i></button>
                                <button data-toggle="tooltip" title="Hapus" type="submit" name="delete" class="btn btn-danger"><i class="fas fa-trash" title="Hapus"></i></button>
                            </td>
                        </tr>
                        </form>
                    <?php } ?>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="add-member" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username" placeholder="username tanpa spasi">
            </div>
            <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
            </div>
            <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
              <input type="number" class="form-control" name="phone" placeholder="Nomor Telepon">
            </div>
            <div class="mb-3">
            <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
            <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="mb-3">
            <label class="form-label">Role</label>
              <select name="role" id="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                    </select>
              </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button href="#" name="add" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
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