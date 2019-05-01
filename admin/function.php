<?php
//=====================================================START====================//

/*
 *  Base Code   : BangAchil
 *  Email       : kesumaerlangga@gmail.com
 *  Telegram    : @bangachil
 *
 *  Name        : Mikrotik bot telegram - php
 *  Function    : Mikortik api
 *  Manufacture : November 2018
 *  Last Edited : 26 Desember 2019
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
 */

//=====================================================START SCRIPT====================//


error_reporting(0);
function create_validasi($judul, $isi_pesan, $header = null) {
    //buat validation session
    $_SESSION['validation-title'] = $judul;
    $_SESSION['validation-isi']   = $isi_pesan;
    if (!is_null($header)) {
        header("location:login.php");
        exit();
    }
}

function echo_validasi() {
    if (isset($_SESSION['validation-title']) && isset($_SESSION['validation-isi'])) {
        $judul_alert = $_SESSION['validation-title'];
        $isi_alert   = $_SESSION['validation-isi'];
        unset($_SESSION['validation-title']);
        unset($_SESSION['validation-isi']);
        $Maukan = 'Mikbotam V1.2';
        echo 'alertify.alert("<b>' . $judul_alert . '</b>", "' . $isi_alert . '").set({onshow:null, onclose:function(){ alertify.success("' . $Maukan . '")}})';
    }
}
