<?php
include '../config.php';
include '../lib/header_base.php';

if (isset($_POST['reg'])){
  $username = $conn->real_escape_string(trim($_POST['username']));
  $password = $conn->real_escape_string(trim($_POST['password']));
  $nama = $conn->real_escape_string(trim($_POST['nama']));
  $email = $conn->real_escape_string(trim($_POST['email']));
  $role = "member";
  $phone = $conn->real_escape_string(trim($_POST['phone']));

  $password = md5($password);

  // cek username
  $cek_username = $conn->query("SELECT * FROM user WHERE username = '$username'");
  if ($cek_username->num_rows > 0) {
    echo "<script>swal('Ups!', 'Gagal! Username Sudah Digunakan.', 'error');</script>";
  } else {
    if ($conn->query("INSERT INTO user (username, password, nama, email, role, no_wa) VALUES ('$username', '$password', '$nama', '$email', '$role', '$phone')") == true) {
      header("Location: login.php?pesan=reg");
    } else {
      // echo "<script>swal('Ups!', 'Gagal! Sistem Kami Sedang Mengalami Gangguan.', 'error');</script>";
      // echo "<script>alert('Gagal! Sistem Kami Sedang Mengalami Gangguan.');</script>";
      alert("Gagal! Sistem Kami Sedang Mengalami Gangguan.");
    }
  }
}

?>
<body class="antialiased border-top-wide  d-flex flex-column" style = "background-image: url('../dist/img/bgimg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;">    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="" method="post">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Buat Akun Baru</h2>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="name" name="username" class="form-control" placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email">
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Telepon</label>
              <input type="number" name="phone" class="form-control" placeholder="Masukkan Telepon">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" name="reg" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-light mt-3">
          Sudah Punya Akun? <a href="login.php" tabindex="-1">Masuk</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
  </body>
</html>