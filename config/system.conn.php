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
	require_once ('system.database.php');
	$settings=getsettings();
	global $settings;
	$identitiy 			=$settings["Nama_router"];
	$mikrotik_ip 		=$settings["IP_router"];
	$mikrotik_username=$settings["Username_router"];
	$mikrotik_password=decrypturl($settings["Pass_router"]);
	$mikrotik_port 	=$settings["Port"];
   $dnsname				=$settings["dnsname"];	
	$Name_router 		=$settings["Nama_router"];
	$owner 				=$settings["Owner"];
	$id_own 				=$settings["Id_owner"];
	$token 				=$settings["Token_bot"];
	$usernamebot 		=$settings["Username_bot"];
	$voucher_1			=$settings["Voucher_1"];
	$Voucher_nonsaldo	=$settings["Voucher_nonsaldo"];
	$lastupdate       =$settings["Tanggal_diubah"];
	
	