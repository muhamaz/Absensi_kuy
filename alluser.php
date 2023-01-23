<?php 

    session_start();
    include ("koneksi.php");

    if($_SESSION['status'] != "login") { // Jika user belum login maka tidak bisa mengakses halaman ini
        header("Location:index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $sqlUser = "SELECT * FROM users WHERE user_id = '$user_id'";
    $getCurrentUser = $db->query($sqlUser);
    $currentUser = $getCurrentUser->fetch_assoc();

    if($currentUser['isAdmin'] != 2) {
        header("Location:dashboard.php");
        exit;
    }

    $sqlshowAllUser = "SELECT * FROM users";
    $showAllUser = $db->query($sqlshowAllUser);

?>

<!DOCTYPE html>
<html lang="id-id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>All User</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <h1 class="mt-4 mb-4 text-center fw-bolder">SEMUA USER</h1>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Daftar Pegawai
                                        <a href="dashboard-admin.php"><button class="btn btn-primary" style="float: right;">Kembali</button></a>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th width="5">No.</th>
                                                    <th>UID</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>UID</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    foreach($showAllUser as $index => $value): ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?= $value['user_id'] ?></td>
                                                        <td>
                                                            <?= $value['nama_lengkap'] ?>
                                                        </td>
                                                        <td>
                                                            <?php if($user_id == $value['user_id']) { ?>
                                                                <p>&nbsp;</p>
                                                            <?php } else if($value['isAdmin'] != 2) { ?>
                                                                <a href="actions/actionpromote.php?user_id=<?= $value['user_id'] ?>">
                                                                    <div class="text-center">
                                                                        <button type="button" class="btn btn-success btn-sm btn-">Jadikan Admin</button>
                                                                    </div>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="actions/actiondemote.php?user_id=<?= $value['user_id'] ?>">
                                                                    <div class="text-center"><button type="button" class="btn btn-danger btn-sm btn-block">Cabut Admin</button></div>
                                                                </a>
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>