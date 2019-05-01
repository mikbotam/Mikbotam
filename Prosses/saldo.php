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

    if (isset($_GET['IDUser']) && !empty($_GET['IDUser']) && isset($_GET['Saldo']) && !empty($_GET['Saldo']) && isset($_GET['up']) && !empty($_GET['up'])) {
        $id       = $_GET['IDUser'];
        $jumlahan = $_GET['Saldo'];
        $type     = $_GET['up'];

        if ($type == 'up') {
            $seebefore = lihatsaldo($id);
            $jumlah    = str_replace('.', '', $jumlahan);
            $seeafter  = updatesaldo($id, $jumlah);
            $seeuser   = lihatuser($id);
            $maketable = '
              <div class="card-body">
              <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <div class="d-flex align-items-center justify-content-start">
              <pre>Successful Top up saldo<br>ID              : ' . $id . "<br>Username        : " . $seeuser['nama_seller'] . "<br>Ending balance  : " . rupiah($seeuser['saldo']) . '<br></pre></div></div></div>';
            echo $maketable;

            sleep(2);
            if (!empty($seeafter)) {
                $text = "<code>  information TOP UP saldo</code>\n";
                $text .= "<code>========================</code>\n";
                $text .= "<code>ID User   :</code> <code>$id</code>\n";
                $text .= "<code>Username  :</code> @" . $seeuser['nama_seller'] . "\n";
                $text .= "<code>Status    : Berhasil </code>\n";
                $text .= "<code>Saldo awal: " . rupiah($seebefore) . " </code>\n";
                $text .= "<code>Saldo     : " . rupiah($seeuser['saldo']) . " </code>\n";
                $text .= "<code>Outletid  : " . $id_own . "</code>\n";
                $text .= "<code>========================</code>\n";
                if (sendMessage($id, $text, $token));
            }
        } elseif ($type == 'down') {
            $jumlah    = str_replace('.', '', $jumlahan);
            $seeafter  = topdown($id, $jumlah);
            echo $seeafter;
        } else {
            $maketable = '
              <div class="card-body">
              <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <div class="d-flex align-items-center justify-content-start">Kesalahan system Silahkan hubungi admin</div></div></div>';
            echo $maketable;
        }
    } else {
        echo "<meta http-equiv='refresh' content='0;url=../pages/index.php' />";
    }
}
