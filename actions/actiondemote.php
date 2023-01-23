<?php 
    session_start();
    include ("../koneksi.php");

    $user_id = $_GET['user_id'];
    $Acc = "UPDATE users SET isAdmin = 1 WHERE user_id = '$user_id'";

    $isAdmin = $_SESSION['isAdmin'];
    if($isAdmin != 2) {
        header("location:../alluser.php");
        $db->close();
    } else {
        $db->query($Acc);
        $db->close();
        header("location:../alluser.php");
    }