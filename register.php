<?php 
    
    include("koneksi.php");

    if(isset($_POST["reg"])) {
        $user_id = strtolower(stripslashes($_POST["user_id"]));
        $nama_lengkap = $_POST['nama'];
        $password = mysqli_real_escape_string($db, $_POST["password"]);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sqldaftar = "INSERT INTO users VALUES(NULL, '$user_id','$hashed_password', '$nama_lengkap',1)";
        $isExist = $db->query("SELECT user_id FROM users WHERE user_id = '$user_id'")->fetch_assoc();

        if($isExist) {
            echo "<div align='center' class='alert alert-warning'> User sudah ada !</div>";
        } else {
            if($db->query($sqldaftar)===TRUE) {
                $db->close();
                header("location:index.php");
                exit;
            }
            else {
                echo"Error:".$sql."<br>".$db->error;
                $db->close();
                exit;
            }
        }
    }
?>


<html>
    <head>
        <title>Registrasi Akun</title>
        <!-- Bootstrap v5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style1.css">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    
    </head>
    <body>
    <div class="container">
            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-sm-8 col-md-6 col-lg-4 bg-white rounded p-4 shadow">
                        <!-- Logo -->
                    <div class="d-flex justify-content-center" style="display: block;">
                        <img src="assets/img/logo-1.jpg" alt="" width="150px">
                    </div>
                    <div class="my-3 mt-2 text-center font-monospace">
                        <h4 class="fw-bold">Sistem Absensi Sederhana</h4>
                    </div>
                        <!-- End of Logo -->

                        <!-- Form Login -->
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" placeholder="User ID" aria-label="USER ID"  name="user_id" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"  name="password" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="Nama" aria-label="Nama"  name="nama" required>
                    </div>

                    <a href="index.php">
                        <div class="d-grid gap-2">
                            <button type="submit" name="reg" class="btn btn-primary">Daftar</button>
                        </div>
                    </a>
                </form>
                <!-- End of Form Login -->
                </div>
            </div>
        </div>
    </body>
</html>