<?php 

    session_start();
    include("koneksi.php");

    if ($_SESSION['status'] != "login"){
        header("location:index.php?");
    }

    $user_id = $_SESSION['user_id'];

    $sqlGetUser = "SELECT * FROM users WHERE user_id = '$user_id'";
    $getCurrentUser = $db->query($sqlGetUser);
    $currentUser = $getCurrentUser->fetch_assoc();

    if($currentUser['isAdmin'] != 2) {
        header("Location:dashboard.php");
        exit;
    }

    $sqlShowizin = "SELECT * FROM izin LEFT JOIN users ON izin.user_id = users.user_id";
    $showizin = $db->query($sqlShowizin);

    $sqlshowAbsen = "SELECT * FROM users JOIN absensi ON users.user_id = absensi.user_id";
    $showAbsensi = $db->query($sqlshowAbsen);

    $res = $showAbsensi->fetch_row();

?>

<!DOCTYPE html>
<html lang="id-id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Area</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        
        <!-- CSS -->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

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
                            <a class="nav-link" href="" id="admin-link">
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
                        <h1 class="mt-4 mb-4 text-center fw-bolder">ADMIN</h1>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Daftar Absensi User
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Lengkap</th>
                                                <th>Tanggal</th>
                                                <th>Clock In</th>
                                                <th>Clock Out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <?php $i = 1; foreach($showAbsensi as $index=>$value): ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $value['nama_lengkap'] ?></td>
                                                        <td><?= $value['tanggal'] ?></td>
                                                        <td><?= $value['jam_masuk']?></td>
                                                        <td><?= $value['jam_keluar']?></td>
                                                        <td>
                                                                <a href="editabsen.php?id=<?= $value['id'] ?>">
                                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                                </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-xl-12 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Daftar Izin User
                                        <a href="alluser.php"><button class="btn btn-primary" style="float: right;">Lihat Daftar User</button></a>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>UID</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>UID</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    foreach($showizin as $index => $value): ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?= $value['user_id'] ?></td>
                                                        <td><?= $value['nama_lengkap'] ?></td>
                                                        <td><?= $value['keperluan'] ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_keluar'])) ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_masuk'])) ?></td>
                                                        <td>
                                                            <?php if($value['isAccepted'] != 2){ ?>
                                                                <div class="text-center">
                                                                    <a href="actions/actionacc.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-success btn-sm mt-1 mb-1"><i class="fas fa-check"></i></button>         
                                                                    </a>
                                                                    <a href="actions/hapusizin.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fas fa-trash-alt"></i></button>
                                                                    </a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="text-center">
                                                                    <a href="actions/hapusizin.php?izin_id=<?= $value['izin_id'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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
            if($currentUser["isAdmin"] != 2) {
                echo "<script type=\"text/javascript\">
                document.getElementById(\"admin-link\").style.display = \"none\";
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
