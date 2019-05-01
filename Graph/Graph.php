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
include '../config/system.byte.php';
include '../Api/routeros_api.class.php';
$interface = $_GET['interface'];
$API       = new routeros_api();
if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
    $rows  = [];
    $rows2 = [];
    $API->write('/interface/monitor-traffic', false);
    $API->write('=interface=' . $interface, false);
    $API->write('=once=', true);
    $READ  = $API->read(false);
    $ARRAY = $API->parseResponse($READ);
    if (count($ARRAY) > 0) {
        $rx              = $ARRAY[0]['rx-bits-per-second'];
        $tx              = $ARRAY[0]['tx-bits-per-second'];
        $rows['name']    = 'Tx';
        $rows['data'][]  = $tx;
        $rows2['name']   = 'Rx';
        $rows2['data'][] = $rx;
    } else {
        echo $ARRAY['!trap'][0]['message'];
    }
} else {
}
$API->disconnect();

$result = [];
array_push($result, $rows);
array_push($result, $rows2);
print json_encode($result, JSON_NUMERIC_CHECK);

?>
