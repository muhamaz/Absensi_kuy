<?php 
    session_start();
    include("koneksi.php");
    
    if(isset($_SESSION['status']) && $_SESSION['status'] == "login") {
        header("location:dashboard.php");
    }

    if(isset($_POST['masuk'])) { // Jika tombol masuk ditekan

        $user_id = strtolower(stripslashes($_POST["user_id"]));
		$password = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
		$result = $db->query($sql);
        
        // if($result->num_rows > 0){
        //     while($data = $result->fetch_assoc()){
        //         $_SESSION['user_id'] = $data['user_id'];
        //         $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        //         $_SESSION['isAdmin'] = $data['isAdmin'];
        //         $_SESSION['status'] = "login";
        //         header("location:dashboard.php");
        //     }
        // }

        $data = $result->fetch_assoc();
        if($result->num_rows > 0){
            if(password_verify($password, $data['password'])){
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                $_SESSION['isAdmin'] = $data['isAdmin'];
                $_SESSION['status'] = "login";

                header("location:dashboard.php");
            }
        }

    }

    
?>

<html>
    <head>

        <title>Sistem Absensi Sederhana</title>

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
                    <div class="my-3 text-center font-monospace">
                        <h4 class="fw-bold">Sistem Absensi Sederhana</h4>
                    </div>
                        <!-- End of Logo -->

                        <!-- Form Login -->
                <form action="" method="POST" class="mb-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" placeholder="UID" aria-label="user_id"  name="user_id" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"  name="password" required>
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" name="masuk" class="btn btn-primary">Masuk</button>
                    </div>

                    <p class="text-center">Don't have any account? <a href="register.php">Click Here</a></p>
                    
                </form>
                <!-- End of Form Login -->
                </div>
            </div>

        </div>
    </body>
</html>