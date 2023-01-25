<?php 
    session_start();
    include ("koneksi.php");

    if($_SESSION['status'] != "login") { // Jika user belum login maka tidak bisa mengakses halaman ini
        header("Location:index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $sqlUser = "SELECT * FROM users WHERE user_id = $user_id";
    $getCurrentUser = $db->query($sqlUser);
    $currentUser = $getCurrentUser->fetch_assoc();


    if(isset($_POST['change'])) {

        $password = $currentUser['password'];
        $oldPassword = mysqli_real_escape_string($db, $_POST['old_password']);
        $newPassword = mysqli_real_escape_string($db, $_POST['new_password']);
        $verifyPassword = mysqli_real_escape_string($db, $_POST['verify_password']);
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if(password_verify($oldPassword, $password)){
            if($newPassword == $verifyPassword) {
                $ChangePass = "UPDATE users SET password = '$hashedNewPassword' WHERE user_id = $user_id";
                $db->query($ChangePass);
                echo "<div align='center' class='alert alert-success'> Password berhasil diubah <a href='dashboard.php'><button class='btn btn-sm btn-success'>Kembali ke halaman utama</button></a> </div>";
                $db->close();
            }
            else {
                echo "<div align='center' class='alert alert-danger'> Password baru tidak sama! </div>";
            }
        }
        else {
            echo "<div align='center' class='alert alert-danger'> Password Lama salah </div>";
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


    <title>Ubah Password</title>
</head>
<body>
    <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formUbahPassword"></span>
        <br class="mb-5">

        <!-- form card change password -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0 text-center">Ubah Password</h3>
            </div>
            <div class="card-body">
                <p>Ubah Password untuk <b><?= $currentUser['nama_lengkap'] ?></b></p>
                <form action="" method="POST" class="form" role="form" autocomplete="off">
                    <div class="form-group">
                        <label for="inputPasswordOld">Password Sekarang</label>
                        <input type="password" class="form-control" id="inputPasswordOld" name="old_password" placeholder="Masukkan Password Lama" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordNew">Password Baru</label>
                        <input type="password" class="form-control" id="inputPasswordNew" name="new_password" placeholder="Masukkan Password Baru" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordNewVerify">Ulang Password Baru</label>
                        <input type="password" class="form-control" id="inputPasswordNewVerify" name="verify_password" placeholder="Ketik Ulang Password Baru" required>
                    </div>
                    <div class="form-group">
                        <a href=""><button name="change" type="submit" class="btn btn-success btn-lg btn-block">Simpan</button></a>
                    </div>
                    <a href="dashboard.php">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-lg btn-block">Batal</button>
                        </div>
                    </a>
                    
                </form>
            </div>
        </div>
        <!-- /form card change password -->

    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>