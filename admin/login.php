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
    if (!isset($_SESSION["Mikbotamid"])) {
        require "function.php";
    } else {
        echo '<script>';
        echo 'window.location.replace("../pages/index.php");';
        echo '</script>';
    }

?>

<!DOCTYPE html>
<html lang="id">
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
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="assets/images/press/site.webmanifest">
        <link rel="mask-icon" href="assets/images/press/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="manifest" href="../img/favicon/manifest.json">
        <meta name="msapplication-TileImage" content="../img/favicon/ms-icon-144x144.png">
        <meta name="msapplication-TileColor" content="#008080">
        <meta name="theme-color" content="#008080">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Premium Govoucher Mikrotik">
         <meta name="author" content="Mikbotam">
        <title>MIKBOTAM</title>
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Mikbotam.min.css">
        <link rel="stylesheet" href="../lib/alert/alertify.min.css">

  </head>
<body>

    <div class="d-flex align-items-center justify-content-center  ht-100v">

<form action="Autentifikasi.php" method="post">
<div class="login-wrapper  wd-xs-350 pd-20 bg-white" style="border-radius: 3px;border: 1px solid teal;">
        
        
        <div class="signin-logo">
            <center><img src="../img/logoM.svg" alt="Mikbotam" class="img-fluid center" style="width: 60%;padding-top: 0;">
          <h5><p class="mg-b-0" style="
    font-size: 30px;
    /* align-items: center; */
    letter-spacing: -1px;
">MIKBOTAM</p></h5></center></div>

        <div class="input-group mg-t-10">
  <span class="input-group-addon"><i class="fa fa-user tx-primary "></i></span>
  <input type="text" class="form-control" placeholder="Username" name="username" id="username">
</div>
<div class="input-group mg-t-10">
  <span class="input-group-addon "><i class="fa fa-lock tx-primary"></i></span>
  <input type="password" class="form-control" id="password" placeholder="password" name="password">

</div>

   <button type="submit" class="btn btn-success btn-block mg-t-20 lh-10" title="Sign In">Sign In</button>
   <a href='../admin/forgot_id.php ' class='btn btn-success btn-block mg-t-10 lh-10'>Forgot password?</a>

      </div>

      </form>

    </div>

<script src="../lib/alert/alertify.min.js"></script>
    <script src="../lib/jquery/jquery.js"></script>
<script>

$(document).ready(function(){
    <?php
        echo_validasi();
    ?>
});

</script>
  </body>
</html>

