<?php
    session_start();
    include("koneksi.php");
    include("classes/User.php");
    
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date('Y-m-d');
    $time = date('H:i:s');

    $user = new Users;

    $user_id = $_SESSION['user_id'];
    $nama_lengkap = $_SESSION['nama_lengkap'];
    $isAdmin = $_SESSION['isAdmin'];
    $status = $_SESSION['status'];

    if ($status != "login"){
        header("location:index.php?");
    }

    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    
    $getCurrentUser = $db->query($sql);
    $currentUser = $getCurrentUser->fetch_assoc();

    if(isset($_POST['kirim'])) {
        $user_id = $currentUser['user_id'];
        $tglKeluar = $_POST['tglKeluar'];
        $tglMasuk = $_POST['tglMasuk'];
        $keperluan = $_POST['keperluan'];

        $user->setIzinSaya($user_id, $tglKeluar, $tglMasuk, $keperluan);
    }

    $showizin = $user->getIzinSaya();

    

    $qAbsensi = "SELECT * FROM absensi WHERE user_id='$user_id'";
    $showAbsensi = $db->query($qAbsensi);

    $data = $showAbsensi->fetch_assoc();

    

?>



<!DOCTYPE html>
<html lang="id-id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Sistem Absensi Sederhana</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="assets/css/styles1.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .table-responsive{
                height: 250px;
                overflow: auto;
            }
        </style>
    </head>

    <body class="sb-nav">
        <nav class="sb-topnav navbar navbar-expand">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 mt-5 pt-5" href="dashboard.php">
                <div class="d-flex justify-content-center"><img src="assets/img/logo-1.jpg" width="90px" alt=""></div>
                <p class="fs-6 text-center">Sistem Absensi Sederhana</p>
            </a>
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="ubahpass.php">Ubah Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Sidenav -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading mt-5"></div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="dashboard-admin.php" id="admin-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                                    Admin
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <p><?= $currentUser['nama_lengkap'] ?></p>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4 text-center fw-bolder">DASHBOARD</h1>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <span class="fs-5">
                                            <i class="fas fa-table me-1"></i>
                                            Riwayat Absensi Anda
                                        </span>
                                        <form action="actions/absenOut.php" method="POST">
                                            <a><button type="submit" class="btn btn-danger ms-3" style="float: right;">Absen Out</button></a>
                                        </form>
                                        <form action="actions/absenIn.php" method="POST">
                                        <input type="hidden" name="nama_lengkap" value="<?= $currentUser['nama_lengkap'] ?>">
                                            <a><button type="submit" class="btn btn-success ms-3" style="float: right;">Absen In </button></a>
                                        </form>
                                        <form action="actions/cetakAbsen.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?= $currentUser['user_id'] ?>">
                                            <button type="submit" class="btn btn-primary" style="float: right;"><i class="fas fa-print"></i></button>
                                        </form>                             
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive text-center">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Clock In</th>
                                                        <th>Clock Out</th>
                                                        <th>Performa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($showAbsensi as $index=>$value): ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $value['tanggal'] ?></td>
                                                            <td><?= $value['jam_masuk']?></td>
                                                            <td><?= $value['jam_keluar']?></td>
                                                            <td>
                                                                <?php                                        
                                                                    if(!empty($value['jam_masuk']) && !empty($value['jam_keluar'])){
                                                                        echo "✔️";
                                                                    }else{
                                                                        echo "❌";
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-input me-1"></i>
                                        Input Izin Baru
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control text-center" placeholder="<?= $currentUser['user_id'] ?>" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control text-center"  placeholder="<?= $currentUser['nama_lengkap'] ?>" disabled>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="tglKeluar" class="form-control" onfocus="(this.type='date')" id="date" placeholder="Tanggal Keluar" required>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="tglMasuk" class="form-control" onfocus="(this.type='date')" id="date" placeholder="Tanggal Masuk" required>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                    <textarea class="form-control" name="keperluan" placeholder="Keperluan" rows="5" required></textarea>
                                            </div>
                                            <a href="dashboard.php"><button type="submit" name="kirim" class="btn btn-primary d-flex fa-pull-right">Kirim</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Permintaan izin Anda
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal masuk</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $i = 1; foreach($showizin as $index=>$value): ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $value['keperluan'] ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_keluar'])) ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_masuk'])) ?></td>
                                                        <td>
                                                            <?php if($value['isAccepted'] == 2) { ?>
                                                                    <div class='text-center'>
                                                                        <a href="actions/cetak.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-primary btn-sm mt-1 mb-1"><i class="fas fa-print"></i></button>
                                                                        </a>
                                                                        <a href="actions/hapusizinsaya.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fas fa-trash-alt"></i></button>
                                                                        </a>
                                                                    </div>
                                                            <?php } else { ?>
                                                                    <div class='text-center'>
                                                                        <button class='btn btn-warning btn-sm mt-1 mb-1' disabled><i class="fas fa-clock"></i></button>
                                                                        <a href="actions/hapusizinsaya.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fas fa-trash-alt"></i></button>
                                                                        </a>
                                                                    </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy Tugas Deacourse 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php 
            // Jika parameter isAdmin = 2 maka menandakan user ini terdaftar sebagai Admin dan tombol Admin muncul
            if($_SESSION["isAdmin"] != 2) {
                echo "<script type=\"text/javascript\">
                    document.getElementById(\"admin-link\").href = '#';
                    document.getElementById(\"admin-link\").style.color='grey';
                </script>";
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
    </body>
</html>