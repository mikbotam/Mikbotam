<?php
 //=====================================================START====================//

/*Gunakan ini sebagai clear command 
 *jika bot mati kemungkinan terdapat trangsaksi yang tidak dapat terprosses untuk antisipasi adanya spam trangsaksi maka sebelum menrestart bot sebaiknya gunakan ini sebagai penghilang comman trangsaksi 
 *
 */

//=====================================================START SCRIPT====================//
date_default_timezone_set('Asia/Jakarta');
include 'src/FrameBot.php';
require_once '../config/system.conn.php';
$mkbot = new FrameBot($token, $usernamebot);
require_once '../config/system.byte.php';
require_once '../Api/routeros_api.class.php';

$mkbot->cmd('/start|/Start', function () {
     
    return Bot::sendMessage($text, $options);
});

$mkbot->run();


