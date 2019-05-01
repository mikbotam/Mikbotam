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
header("Content-type: image/png");

$_SESSION["Captcha"] = "";
$gbr                 = imagecreate(100, 38);

imagecolorallocate($gbr, 0, 128, 128);
$color = imagecolorallocate($gbr, 253, 252, 252);
$font  = "FallisComing.ttf";

$posisi = 25;
for ($i = 0; $i <= 5; $i++) {
    $angka = rand(1, 8);
    $_SESSION["Captcha"] .= $angka;
    $kemiringan  = rand(10, 20);
    $ukuran_font = rand(15, 20);
    imagettftext($gbr, $ukuran_font, $kemiringan, 8 + 15 * $i, $posisi, $color, $font, $angka);
}
imagepng($gbr);
imagedestroy($gbr);
?>
