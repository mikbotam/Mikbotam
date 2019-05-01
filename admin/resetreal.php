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
    if (!isset($_SESSION["verifikasi"])) {
        echo '<script>window.location.href = "login.php";</script>';
    } else {

        if (isset($_POST['ajax']) && isset($_POST['confirmPassword'])) {
            include '../config/system.database.php';
            $send = resetdone($_POST['confirmPassword']);
            unset($_SESSION['verifikasi']);
            unset($_SESSION['step1']);

            exit;
        }
    }
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
            <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="../img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../img/favicon/manifest.json">
        <meta name="msapplication-TileImage" content="../img/favicon/ms-icon-144x144.png">
        <meta name="msapplication-TileColor" content="#008080">
        <meta name="theme-color" content="#008080">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Premium Govoucher Mikrotik">
         <meta name="author" content="Mikbotam">
        <title>MIKBOTAM</title>
        <link rel="stylesheet" href="../css/Mikbotam.min.css">
         <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
            <link rel="stylesheet" href="../lib/alert/alertify.min.css">
            <script src="../lib/alert/alertify.min.js"></script>
     <script src="../lib/jquery/jquery.js"></script>
<script>
var _0xe993=["\x76\x61\x6C","\x23\x6E\x65\x77\x70\x61\x73\x73\x77\x6F\x72\x64","\x23\x70\x61\x73\x73\x77\x6F\x72\x64\x63\x6F\x6D\x66\x72\x69\x6D","\x20\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x63\x61\x72\x64\x20\x70\x64\x2D\x73\x6D\x2D\x36\x20\x62\x67\x2D\x64\x61\x6E\x67\x65\x72\x20\x22\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x78\x2D\x77\x68\x69\x74\x65\x22\x3E\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x6E\x6F\x74\x20\x6D\x61\x74\x63\x68\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E","\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x63\x61\x72\x64\x20\x70\x64\x2D\x73\x6D\x2D\x36\x20\x62\x67\x2D\x70\x72\x69\x6D\x61\x72\x79\x20\x22\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x78\x2D\x77\x68\x69\x74\x65\x22\x3E\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x6D\x61\x74\x63\x68\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E","\x68\x74\x6D\x6C","\x23\x63\x6F\x6E\x66\x72\x69\x6D\x6D\x61\x74\x63\x68","\x6B\x65\x79\x75\x70","\x72\x65\x61\x64\x79","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x50\x61\x73\x73\x77\x6F\x72\x64","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x50\x61\x73\x73\x77\x6F\x72\x64\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x52\x65\x70\x65\x61\x74\x65","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x52\x65\x70\x65\x61\x74\x65\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x6E\x6F\x74\x20\x4D\x61\x74\x63\x68","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x6E\x6F\x74\x20\x4D\x61\x74\x63\x68\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x70\x6F\x73\x74","\x3C\x70\x20\x63\x6C\x61\x73\x73\x3D\x27\x6D\x67\x2D\x62\x2D\x31\x35\x27\x3E\x52\x65\x73\x65\x74\x20\x50\x61\x73\x73\x77\x6F\x72\x64\x20\x42\x45\x52\x48\x41\x53\x49\x4C\x20\x3C\x62\x72\x3E\x3C\x2F\x70\x3E\x3C\x61\x20\x68\x72\x65\x66\x3D\x27\x2E\x2E\x2F\x61\x64\x6D\x69\x6E\x2F\x6C\x6F\x67\x69\x6E\x2E\x70\x68\x70\x20\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x73\x75\x63\x63\x65\x73\x73\x20\x62\x74\x6E\x2D\x62\x6C\x6F\x63\x6B\x20\x6D\x67\x2D\x74\x2D\x31\x30\x20\x6C\x68\x2D\x31\x30\x27\x3E\x4C\x4F\x47\x49\x4E\x3C\x2F\x61\x3E","\x23\x66\x72\x6F\x6D\x64\x61\x74\x61","\x61\x6A\x61\x78"];function checkPasswordMatch(){var _0x6a94x2=$(_0xe993[1])[_0xe993[0]]();var _0x6a94x3=$(_0xe993[2])[_0xe993[0]]();var _0x6a94x4=_0xe993[3];var _0x6a94x5=_0xe993[4];if(_0x6a94x2!= _0x6a94x3){$(_0xe993[6])[_0xe993[5]](_0x6a94x4)}else {$(_0xe993[6])[_0xe993[5]](_0x6a94x5)}}$(document)[_0xe993[8]](function(){$(_0xe993[6])[_0xe993[7]](checkPasswordMatch)});function sendpass(){var _0x6a94x7=$(_0xe993[1])[_0xe993[0]]();var _0x6a94x3=$(_0xe993[2])[_0xe993[0]]();if(_0x6a94x7[_0xe993[9]]== 0){alertify[_0xe993[12]](_0xe993[10],_0xe993[11])}else {if(_0x6a94x7[_0xe993[9]]== 0){alertify[_0xe993[12]](_0xe993[13],_0xe993[14])}else {if(_0x6a94x7!= _0x6a94x3){alertify[_0xe993[12]](_0xe993[15],_0xe993[16])}else {$[_0xe993[20]]({type:_0xe993[17],data:{ajax:1,confirmPassword:_0x6a94x3},success:function(_0x6a94x8){$(_0xe993[19])[_0xe993[5]](_0xe993[18])}})}}}}
</script>
  </head>
 <body>

    <div class="d-flex align-items-center justify-content-center  ht-100v">

<form id="perverpin" action="" method="post">
<div class="login-wrapper  wd-xs-350  pd-20 bg-white border border-success" style="
    border-radius: 7px;
    padding: 13px;
">
        <div class="card mg-b-20  pd-20 pd-sm-20 bg-primary "><div class="signin-logo tx-center tx-40 tx-bold tx-white">MIKBOTAM </div>
        <div class="tx-center  tx-white">Professional Mikrotik Manager</div>
        </div>

        <p class="mg-b-15">Verifikasi PIN berhasil <br>Silahkan masukan password baru anda </p>
<div id="fromdata" >
        <div id="from" class="form-group">
          <input id="newpassword" type="password" name="passnew" class="form-control" placeholder="Enter your Password" onKeyup="checkPasswordMatch();">
        </div>
         <div id="fromcomfrim" class="form-group mg-b-10">
          <input id="passwordcomfrim" type="password" name="pasnewrepeate" class="form-control" placeholder="Repeate your Password" onKeyup="checkPasswordMatch();" >
        </div>
        <div id="confrimmatch">

        </div>


         <button onClick="sendpass();return false;" class="btn btn-success btn-block mg-t-10 lh-10">Verification</button>
  </div>
    </div>



      </form>
            <div id="done">

        </div>
    </div>



  </body>
</html>

