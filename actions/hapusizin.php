<?php 
    session_start();
    include ("../koneksi.php");

    $izin_id = $_POST['izin_id'];
    $Acc = "DELETE FROM izin WHERE izin_id = '$izin_id'";

    $isAdmin = $_SESSION['isAdmin'];
    if($isAdmin != 2) {
        header("Location:../dashboard-admin.php");
        $db->close();
    } else {
        $db->query($Acc);
        $db->close();
        header("Location:../dashboard-admin.php");
    }