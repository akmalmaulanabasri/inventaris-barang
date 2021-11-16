<!-- AKMAL MAULANA BASRI -->
<!-- Script ini Dibuat Oleh @bazzree -->
<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']=="member"){
		header("location:$url/auth/login.php?pesan=admin");
	}

  if($_SESSION['role']==""){
		header("location:$url/auth/login.php?pesan=login");
	}

  $user = $_SESSION['username'];
 
	?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo $tittle ?></title>
    <!-- CSS files -->
    <link href="<?php echo $url?>/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?php echo $url?>/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?php echo $url?>/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?php echo $url?>/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?php echo $url?>/dist/css/demo.min.css" rel="stylesheet"/>
    <link href="<?php echo $url?>/dist/css/custom.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  </head>
  <body class="antialiased">
    <div class="wrapper">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              <a href="<?php echo $url?>" class="navbar-brand"><?php echo $tittle?></a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?php echo $url?>/dist/img/0000.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div class="mt-1 small text-muted">Hai!, <?php echo $user?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?php echo $url?>/auth/logout.php" class="dropdown-item">Keluar</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $url?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="fas fa-home icon"></i> 
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-shopping-cart icon"></i> 
                  </span>
                    <span class="nav-link-title">
                      Transaksi
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="<?php echo $url?>/pages/data-item.php" >
                          Daftar Barang
                        </a>
                        <a class="dropdown-item" href="<?php echo $url?>/pages/data-kategori.php" >
                          Daftar Kategori
                        </a>
                        <a class="dropdown-item" href="<?php echo $url?>/pages/daftar-transaksi.php" >
                          Daftar Transaksi
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $url?>/pages/daftar-transaksi.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                    <i class="fas fa-history icon"></i>
                  </span>
                    <span class="nav-link-title">
                      Daftar Transaksi
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $url?>/admin/daftar-pengguna.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-user icon"></i>
                    </span>
                    <span class="nav-link-title">
                      Pengguna
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>