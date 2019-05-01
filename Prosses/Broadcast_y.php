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
if (!isset($_SESSION["Mikbotamuser"])) {
    header("Location:../admin/login.php");
} else {

    include '../config/system.conn.php';
    include '../Api/routeros_api.class.php';

    if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['pass']) && !empty($_GET['pass']) && isset($_GET['profile']) && !empty($_GET['profile']) && isset($_GET['uptime']) && !empty($_GET['uptime'])) {
        $id      = $_GET['id'];
        $user    = $_GET['user'];
        $pass    = $_GET['pass'];
        $profile = $_GET['profile'];
        $limituptime  = $_GET['uptime'];

        $API = new routeros_api();
       if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password,$mikrotik_port)) {
            $add_user_api = $API->comm("/ip/hotspot/user/add", [
                "profile" => $profile,
                "name" => $user,
                "password" => $pass,
                "limit-uptime" => $limituptime,
                "comment" => $owner . "-Rp-$voucher-" . date('d-m-Y'),
            ]);

            $checkdata = json_encode($add_user_api);
            if (strpos(strtolower($checkdata), 'failure: already have user with this name for this server') !== false) {
                $gagal     = $add_user_api['!trap'][0]['message'];
                $maketable = '<div class="alert alert-success py-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p >
                        <b>INFORMATION   :</b><br>' . $gagal . '</p>
                        </div>';
            } elseif (strpos(strtolower($checkdata), 'ambiguous value of profile, more than one possible value matches input') !== false) {
                $gagal     = $add_user_api['!trap'][0]['message'];
                $maketable = '<div class="alert alert-success py-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                <b>INFORMATION   :</b><br>' . $gagal . '</p>
                        </div>';
            } elseif (strpos(strtolower($checkdata), 'invalid time value for argument limit-uptime') !== false) {
                $gagal     = $add_user_api['!trap'][0]['message'];
                $maketable = '<div class="alert alert-success py-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                <b>INFORMATION   :</b><br>' . $gagal . '</p>
                        </div>';
            } elseif (strpos(strtolower($checkdata), 'input does not match any value of profile') !== false) {
                $gagal     = $add_user_api['!trap'][0]['message'];
                $maketable = '<div class="alert alert-success py-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                <b>INFORMATION   :</b><br>' . $gagal . '</p>
                        </div>';
            } elseif (strpos(strtolower($checkdata), 'input does not match any value of profile') !== false) {
                $gagal     = $add_user_api['!trap'][0]['message'];
                $maketable = '<div class="alert alert-success py-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                <b>INFORMATION   :</b><br>' . $gagal . '</p>
                        </div>';
            } else {
                $caption .= "<code>=========================</code>\n";
                $caption .= "<code>  ID         : $add_user_api</code>\n";
                if (strpos(strtolower($limituptime), 'h') !== false) {
            $uptime = str_replace('h', ' Jam', $limituptime);
          } elseif (strpos(strtolower($limituptime), 'd') !== false) {
            $uptime = str_replace('d', ' Hari', $limituptime);
          }
                $caption .= "<code>  Expe       :</code> <code>$uptime</code>\n";
                $caption .= "<code>  Name       :</code> <code>$user</code>\n";
                $caption .= "<code>  Password   :</code> <code>$pass</code>\n";
                $caption .= "<code>=========================</code>\n";
                $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
                $caption .= "<code>=========================</code>\n";
                $qrcode = 'http://qrickit.com/api/qr.php?d=' . urlencode("$dnsname/login?username=$user&password=$pass") . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=000000&bgdcolor=FFFFFF&qrsize=500';
                $result = sendPhoto($id,$qrcode,$caption,$token);
                $wel = json_decode($result, true);
                if ($wel['ok']) {
                    $maketable = '
<div class="row">
    <div class="col-xl-5 ">
        <img class="card-img " src=' . $qrcode . ' alt="Image"></div>
    <div class="col-xl-7">
        <div class="alert alert-success " role="alert">
            <div class="d-flex align-items-center justify-content-start">
                <pre>Successful Send Voucher to<br>ID         : ' . $add_user_api . '<br>Expe       : ' . $uptime . '<br>Name       : ' . $user . '<br>Password   : ' . $pass . '</pre>
            </div>
        </div>
    </div>
</div>';
                } else {
                	         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password,$mikrotik_port)) {
              $add_user_apis = $API->comm("/ip/hotspot/user/remove", [
                "numbers" => $add_user_api,
              ]);
         }
                    $maketable = '<div class="alert alert-success py-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Send Voucher to ' . $iduser . '</p> Maybe bots are blocked by users <br>user '.$user.' is automatically deleted from the router </div>';
                }

                
            }
        }else{
        	$maketable = '<div class="alert alert-success py-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Conect Mikrotik </p> Please check the connection to  </div>';
        	
        }
        
        
        echo $maketable;
    } else {
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php' />";
    }
}
