<?php
    session_start();
    include("../koneksi.php");

    $user_id = $_SESSION['user_id'];
    $nama_lengkap = $_POST['nama_lengkap'];

    date_default_timezone_set("Asia/Jakarta");

    $tanggal = date('Y-m-d');
    $time = date('H:i:s');

    $check_absen = "SELECT * FROM absensi WHERE user_id = '$user_id' AND tanggal = '$tanggal'";
    $check = $db->query($check_absen);

    if($check->num_rows>0){
        header("location:../dashboard.php?message= anda sudah absen masuk");
    }else{

        $sql = " 
        INSERT INTO absensi 
        VALUES (
            NULL, 
            '$user_id',
            '$nama_lengkap', 
            '$tanggal', 
            '$time', 
            NULL)";
        $result = $db->query($sql);

        if($result === TRUE){
            header("location:../dashboard.php?message= anda berhasil absen");
        }else{
            header("location:../dashboard.php?message= anda gagal absen");
        }
    }
?>