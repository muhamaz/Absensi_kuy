<?php 
    session_start();
    include ("../koneksi.php");

    $izin_id = $_GET['izin_id'];
    $Del = "DELETE FROM izin WHERE izin_id = '$izin_id'";

    $sql = "SELECT * FROM izin WHERE izin_id = '$izin_id'";
    $checkUser = $db->query($sql);
    $checkCurrentuser = $checkUser->fetch_assoc();

    if($_SESSION['user_id'] != $checkCurrentuser['user_id'] ) {
        header("Location:../dashboard.php");
        $db->close();
        exit;
    } else {
        $db->query($Del);
        $db->close();
        header("Location:../dashboard.php");
    }