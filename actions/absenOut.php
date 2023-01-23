<?php
    session_start();
    include("../koneksi.php");

    $user_id = $_SESSION['user_id'];

    date_default_timezone_set("Asia/Jakarta");

    $tanggal = date('Y-m-d');
    $time = date('H:i:s');

    $check_absen = "SELECT * FROM absensi WHERE user_id = '$user_id' AND tanggal = '$tanggal'";
    $check = $db->query($check_absen);

    $data = $check->fetch_assoc();

    if(!empty($data['jam_keluar']) && !empty($data['jam_masuk']) && $data['tanggal'] == $tanggal){
        header("location:../dashboard.php?message= anda sudah absen keluar");
    }else{
        $clockout = "UPDATE absensi SET jam_keluar='$time' WHERE user_id='$user_id' AND tanggal='$tanggal'";
        $res = $db->query($clockout);
        if($res === TRUE){
            header("location:../dashboard.php?message=berhasil");
        }else{
            echo "terjadi error";
        }
    }
?>