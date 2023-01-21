<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_absensikuy";

    // koneksi
    $db = new mysqli($hostname,$username,$password,$dbname);

    // Check Connection
    if($db->connect_error){
        die("Connection failed : ". $db->connect_error);
    }
?>