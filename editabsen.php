<?php
session_start();
include("koneksi.php");

if ($_SESSION['status'] != "login"){
    header("location:index.php?");
}

if($_SESSION['isAdmin'] != 2) {
    header("Location:dashboard.php");
}

date_default_timezone_set("Asia/Jakarta");

$id = $_POST['id'];

$qshowabsensi = "SELECT * FROM absensi WHERE id = '$id'";
$showabs = $db->query($qshowabsensi);
$showabsensi = $showabs->fetch_assoc();

if(isset($_POST['simpan'])){

    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];

    $qubahAbsen = "UPDATE absensi SET jam_masuk = '$jam_masuk', jam_keluar = '$jam_keluar' WHERE id='$id'";
    $ubahAbsen = $db->query($qubahAbsen);
    if($ubahAbsen === TRUE){
        header("location:dashboard-admin.php");
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Ubah Absensi <?= $showabsensi['nama_lengkap']?></title>

</head>
<body>
    <div class="row-md-8 d-flex justify-content-center mt-5">
        <div class="card" style="width: 40rem;">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="mb-0 text-center">Ubah Absensi</h3>
                </div>
                <div class="col-xl-12 col-md-12">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" value="<?= $showabsensi['nama_lengkap']?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="tgl" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="tgl" value="<?= $showabsensi['tanggal']?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jamMasuk" class="form-label">Jam Masuk</label>
                            <input type="text" class="form-control" id="jamMasuk" name="jam_masuk" value="<?= $showabsensi['jam_masuk']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jamKeluar" class="form-label">Jam Keluar</label>
                            <input type="text" class="form-control" id="jamKeluar" name="jam_keluar" value="<?= $showabsensi['jam_keluar']?>" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="mx-3">
                                <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                            </div>
                            <a href="dashboard-admin.php"><button type="button" class="btn btn-secondary">Batal</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>