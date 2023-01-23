<?php

require_once dirname( __DIR__ ).'../koneksi.php';

Class Users{


    public function setIzinSaya($user_id, $tglKeluar, $tglMasuk, $keperluan) {
        global $db;
        $kirimIzin = "
            INSERT INTO izin
            VALUES (
                NULL,
                '$user_id',
                '$tglKeluar',
                '$tglMasuk',
                1,
                '$keperluan'
            );
        ";
    
        $db->query($kirimIzin);
    }
    
    public function getIzinSaya() {
        global $db;
        $showizin = "SELECT * FROM izin WHERE user_id = ".$_SESSION['user_id'];
        return $db->query($showizin);
    }

}


?>