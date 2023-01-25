<?php

require_once dirname( __DIR__ ).'../koneksi.php';

Class Users{
    /*

    User Role (pada field isAdmin):
    1 -> User Biasa, hanya dapat membuat izin dan melihat daftar izin sendiri
    2 -> Superuser, memiliki akses admin

    */

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