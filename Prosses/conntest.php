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
 	if($_GET[cmd]=="testcon"){
 	
	$ip = $_POST[ip];
	$user = $_POST[user];
	$pass = $_POST[pass];
	$ports = $_POST[portapi];
    include '../Api/routeros_api.class.php';
$wait = 1; // wait Timeout In Seconds
$host = $ip;
$API = new routeros_api();

    $fp = @fsockopen($host, $ports, $errCode, $errStr, $wait);
    if ($fp) {
    	
    	 if ($API->connect($ip, $user, $pass,$ports)) {
    	 echo '        <div class="card pd-20 pd-sm-20 bg-primary "><div class="signin-logo tx-center tx-40 tx-bold tx-white">CONECTED </div>
        <div class="tx-center  tx-white">Mikbotam Conect Your Router</div>
        </div>';
    	 }else{
    	 echo '        <div class="card pd-20 pd-sm-20 bg-danger "><div class="signin-logo tx-center tx-40 tx-bold tx-white">DISCONECT </div>
        <div class="tx-center  tx-white">Please check again to make sure it is filled in correctly</div>
        <div class="tx-center  tx-white">ERROR :  Incorrect  Username Or Password </div>
        </div>';
    	 }
    	 	
    	 
	
       
        fclose($fp);
    } else {
       
       	
    
    	 		echo '        <div class="card pd-20 pd-sm-20 bg-danger "><div class="signin-logo tx-center tx-40 tx-bold tx-white">DISCONECT </div>
        <div class="tx-center  tx-white">Please check again to make sure it is filled in correctly</div>
        <div class="tx-center  tx-white">ERROR : '.$errCode.' '.$errStr.' </div>
         <div class="tx-center  tx-white">ERROR : Incorrect port Mikrotik </div>
        </div>';

    }


}
 ?>