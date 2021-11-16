<?php
include '../config.php';
include '../lib/header_base.php';

	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
      $msg = "<div class='alert alert-danger'>Username dan Password tidak sesuai !</div>";
		}else if ($_GET['pesan']=="login") {
      $msg = "<div class='alert alert-danger'>Anda Belum Login</div>";
    }else if ($_GET['pesan']=="admin") {
      $msg = "<div class='alert alert-danger'>Anda Bukan Admin</div>";
    }else if ($_GET['pesan']=="reg") {
      $msg = "<div class='alert alert-success'>Akun Berhasil Didaftarkan, Silahkan Login</div>";
    }
            
	}else{
    $msg ="";
  }
?>
    
  <body class="antialiased border-top-wide  d-flex flex-column" style = "background-image: url('../dist/img/bgimg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;">
    <div class="page page-center">
      <div class="container-tight py-4">
        <form class="card card-md" action="login_system.php" method="post" autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login <?php echo $tittle?></h2>
            <div class="mb-3">
              <?php echo $msg;?>
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name ="username" class="form-control" placeholder="Masukkan Username">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
                <span class="form-label-description">
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password"  placeholder="Password"  autocomplete="off">
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </div>
          </div>
        </form>
        <div class="text-center text-light mt-3">
          Belum Punya Akun? <a href="register.php" tabindex="-1">Daftar</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
  </body>
</html>