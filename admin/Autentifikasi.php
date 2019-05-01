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
 *  Last Edited : 26 Desember 2018
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
 */

//=====================================================START SCRIPT====================//

session_start();
error_reporting(0);
require "function.php";
include '../config/system.conn.php';
function IP() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) {
		$ipaddress = getenv('HTTP_CLIENT_IP');
	} else if (getenv('HTTP_X_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	} else if (getenv('HTTP_X_FORWARDED')) {
		$ipaddress = getenv('HTTP_X_FORWARDED');
	} else if (getenv('HTTP_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	} else if (getenv('HTTP_FORWARDED')) {
		$ipaddress = getenv('HTTP_FORWARDED');
	} else if (getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	} else {
		$ipaddress = 'IP Tidak Dikenali';
	}

	return $ipaddress;
}

$ip = IP();
if (isset($_POST)) {
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if (empty($user) or empty($pass)) {
		create_validasi(
			"Autentifikasi Valid",
			"<img style='width:30%;' class='responsive-image center'; src='../img/loading.svg'/><br><center>Incorrect username or password.</center>",
			"index.php");
	} else {
		if (ceklogin($user, $pass)) {
			$_SESSION['Mikbotamuser'] = $user;
			$_SESSION['Mikbotamid']   = makesession($user);

			if (!empty(getid($_SESSION['Mikbotamid']))) {
				if (!empty($_SESSION['MikbotamUrl'])) {
					header("Location: " . $_SESSION['MikbotamUrl']);
				} else {

					echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";
				}
			} else {
				echo "<meta http-equiv='refresh' content='0;url=myservernew.php' />";
			}
			$status   = 'Success';
			$sendlast = lastlogin($ip, $user, $status);
			exit(0);
		} else {
			$status   = 'Valid';
			$sendlast = lastlogin($ip, $user, $status);
			create_validasi(
				"Autentifikasi Valid!",
				"<img style='width:30%;' class='responsive-image center'; src='../img/loading.svg'/><br><center>Incorrect username or password.</center>",
				"index.php"
			);
		}
	}
}
