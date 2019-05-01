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
    $getpost = $_POST["Getcaptcha"];
    $getpin  = $_SESSION["getpin"];
    include '../config/system.database.php';
    if (isset($getpost)) {
        $captch  = $_SESSION["Captcha"];
        $ses     = $_POST["nilaiCaptcha"];
        $logname = $_POST["usernameid"];
        $cek     = login($data);
        if ($cek != $logname) {
            echo '<script language="javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'alertify.alert("Failed", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>failed username not found</center>")';
            echo '});';
            echo '</script>';
        } else

        if ($captch == $ses) {
            $send = sendreset($logname);
            $wel  = json_decode($send, true);
            if ($wel['ok']) {
                echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'alertify.alert("Successfully sending messages", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Please check your telegram we send PIN Verification</center>").set(\'onok\', function(closeEvent){ window.location.href = "verificationid.php";} );';
                echo '});';
                echo '</script>';
                $_SESSION["step1"] = true;
            } else {
                echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'alertify.alert("Failed sending messages", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Failed to send PIN verification to your telegram, never stop your bot</center>").set(\'onok\', function(closeEvent){ window.location.href = "login.php";} );';
                echo '});';
                echo '</script>';
            }
        } elseif (isset($getpost) && empty($ses) && empty($ses)) {

            echo '<script language="javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'alertify.alert("Failed", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Please fill in correctly, make sure you have completed the existing data form</center>")';
            echo '});';
            echo '</script>';
        } else {

            unset($getpost);
        }
    } else {
        unset($getpost);
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
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
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
        <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Starlight CSS -->
        <link rel="stylesheet" href="../css/Mikbotam.min.css">
        <link rel="stylesheet" href="../lib/alert/alertify.min.css">
    </head>

    <body>
        <div class="d-flex align-items-center justify-content-center  ht-100v">
            <?php
                if (empty(lihatowner())) {
                    echo '<div class="login-wrapper  wd-xs-350  pd-20 bg-white border border-success" style="
    border-radius: 7px;
    padding: 13px;
">
        <div class="card mg-b-20  pd-20 pd-sm-20 bg-primary "><div class="signin-logo tx-center tx-40 tx-bold tx-white">MIKBOTAM </div>
        <div class="tx-center  tx-white">Professional Mikrotik Manager</div>
        </div>

        <p class="mg-b-15">Maaf kami tidak bisa Membantu anda ID Telegram Owner tidak ditemukan </p>

         <a href="index.php" class="btn btn-success btn-block mg-t-10 lh-10">Close</a>
    </div>';
                } else {

                    echo '<form name="getpin" action="" method="post">
<div class="login-wrapper  wd-xs-350  pd-20 bg-white border border-success" style="
    border-radius: 7px;
    padding: 13px;
">
        <div class="card mg-b-20 pd-20 pd-sm-20 bg-primary "><div class="signin-logo tx-center tx-40 tx-bold tx-white">MIKBOTAM </div>
        <div class="tx-center  tx-white">Professional Mikrotik Manager</div>
        </div>

        <p class="mg-b-15">Masukan nama pengguna atau alamat email yang Anda gunakan saat Login akun Mikbotam Anda. <br>Kami akan mengirimi anda pesan telegram yang memungkinkan Anda mengatur ulang kata sandi Anda. </p>

        <div class="form-group">
          <input type="text" name="usernameid" class="form-control" placeholder="Enter your username login">
        </div>
   <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label"><img src="captcha.php" alt="Gagalmemuatcaptcha"></label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input name="nilaiCaptcha" type="text" class="form-control" placeholder="Enter the Captcha" onkeypress="return isNumber(event)">
                                </div>
                            </div>
         <button name="Getcaptcha" type="submit" class="btn btn-success btn-block mg-t-10 lh-10">Send Pin Verification</button>
           <a href="../admin/login.php " class="btn btn-success btn-block mg-t-10 lh-10">Close</a>
    </div>



      </form>';
            }?>
        </div>
        <script src="../lib/alert/alertify.min.js"></script>
        <script src="../lib/jquery/jquery.js"></script>
    </body>

    </html>
