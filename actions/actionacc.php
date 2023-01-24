<?php 
    session_start();
    include ("../koneksi.php");

    $izin_id = $_POST['izin_id'];
    $Acc = "UPDATE izin SET isAccepted = 2 WHERE izin_id = '$izin_id'";

    $isAdmin = $_SESSION['isAdmin'];
    if($isAdmin != 2) {
        header("location:../dashboard.php");
        $db->close();
    } else {
        $db->query($Acc);
        $db->close();
        header("location:../dashboard-admin.php");
    }