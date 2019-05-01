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
   $_SESSION['MikbotamUrl'] = $_SERVER['REQUEST_URI'];
	if (!isset($_SESSION["Mikbotamuser"])) {
		header("Location:login.php");
	} else {
		include '../include/header.php';
		include 'home.php';
		include '../config/system.conn.php';
		include '../config/system.byte.php';
		include '../Api/routeros_api.class.php';
		date_default_timezone_set('Asia/Jakarta');
		$API = new routeros_api();
		if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
			$IDENTITY   = $API->comm('/system/identity/getall');
			$routername = $IDENTITY['0']['name'];
		}
		$color = ['1' => 'bg-primary', 'bg-teal', 'bg-pink'];

		echo '<div class="sl-mainpanel">';

		if ($_GET["admin"] == "myserver") {
			include "myserver.php";
		} else

		if ($_GET["admin"] == "myprofile") {
			include "myprofile.php";
		} 
		else

		if ($_GET["admin"] == "sessionedit") {
			include "sessionedit.php";
		}else

		if ($_GET["admin"] == "logout") {
			session_destroy();
			unset($_SESSION['Mikbotamid']);
			echo "<script>sessionStorage.clear();</script>";
			echo "<script>window.location='login.php'</script>";
		} else {
			include "dashboard.php";
		}
	}

?>


<?php include '../include/footer.php';?>
