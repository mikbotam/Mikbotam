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
include '../config/system.conn.php';
include '../Api/routeros_api.class.php';

$API = new routeros_api();

if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
    if (isset($_GET['aponline'])) {
        $items = $API->comm("/ip/neighbor/print");
        echo "AP " . count($items) . " Online";
    } elseif (isset($_GET['cpu'])) {
        $items = $API->comm("/system/resource/print");
        echo ("Cpu load : " . $items['0']['cpu-load']) . " %";
    } elseif (isset($_GET['free-memory'])) {
        $items = $API->comm("/system/resource/print");
        echo round($items['0']['free-memory'] / 1048576) . " MB";
    } elseif (isset($_GET['uptime'])) {
        $datajson = $API->comm("/system/resource/print");
        $uptime   = $datajson['0']['uptime'];
        echo "Uptime : " . formatDTM($uptime);
    } elseif (isset($_GET['Online'])) {

        $items = $API->comm("/ip/hotspot/active/print");
        echo "User Login : " . count($items) . " Clients";
    } else {
        echo '<script>';
        echo 'window.location.replace("../pages/index.php");';
        echo '</script>';
    }
}
?>
