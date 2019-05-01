<?php

	session_start();
	error_reporting(0);
   $_SESSION['MikbotamUrl'] = $_SERVER['REQUEST_URI'];
	if (!isset($_SESSION["Mikbotamuser"])) {
		header("Location:admin/login.php");
	} else {
		
			echo "<script>window.location='pages/index.php'</script>";
	}

?>

