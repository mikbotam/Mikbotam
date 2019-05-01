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
session_start();

 error_reporting(0); 
if (!isset($_SESSION["Mikbotamuser"])) {
    header("Location:../admin/login.php");
    echo 'Silahkan Login kembali';
} else {
    include '../config/system.conn.php';

    if (isset($_GET['Username']) && !empty($_GET['Username']) && isset($_GET['IDUser']) && !empty($_GET['IDUser']) && isset($_GET['notelfun']) && !empty($_GET['notelfun']) && isset($_GET['Saldo']) && !empty($_GET['Saldo'])) {
        $id    = $_GET['IDUser'];
        $notlp = str_replace('-', '', $_GET['notelfun']);

        $saldo  = $_GET['Saldo'];
        $jumlah = str_replace('.', '', $saldo);
        $name   = $_GET['Username'];
        $make   = adduser($id, $name, $notlp, $jumlah);

        if ($make == 'done') {
            $maketable = '
              <div class="card-body">
              <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <div class="d-flex align-items-center justify-content-start">
              <pre>Successful Save User<br>ID         : ' . $id . "<br>Username   : " . $name . "<br>Saldo      : " . $jumlah . "<br>Nomer Tlp  : " . $notlp . '"<br></pre></div></div></div>';
            echo $maketable;
        } else {
            $maketable = ' <div class="card-body"><div class="alert alert-success py-2  mg-t-10" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Save User ' . $id . '</p>User id already exists  </div></div>';
            echo $maketable;
        }
    } else {
        echo "<meta http-equiv='refresh' content='0;url=../pages/index.php' />";
    }
}
