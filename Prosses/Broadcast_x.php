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
    echo 'Silahkan Login kembali';
} else {

    include '../config/system.conn.php';

    if (isset($_GET['text']) && !empty($_GET['text'])) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $text = $_GET['text'];
            $id   = $_GET['id'];

            if ($id == 'Alluser') {
                $dataid = lihatdata($datapiro);
                $num    = count($dataid);
                for ($i = 0; $i < $num; $i++) {
                    $ids        = $dataid[$i]['id_user'];
                    $textoutput = $_GET['text'];

                    $website = "https://api.telegram.org/bot" . $token;
                    $params  = [
                        'chat_id' => $ids,
                        'text' => $textoutput,
                        'parse_mode' => 'html',
                    ];
                    $ch = curl_init($website . '/sendMessage');
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $wel = json_decode($result, true);
                    if ($wel['ok']) {
                        $message_id = $wel['result']['message_id'];
                        $from_id    = $wel['result']['from']['id'];
                        $first_name = $wel['result']['from']['first_name'];
                        $username   = $wel['result']['from']['username'];

                        $chat_id         = $wel['result']['chat']['id'];
                        $chat_first_name = $wel['result']['chat']['first_name'];
                        $usernamea       = $wel['result']['chat']['username'];
                        $text            = $wel['result']['text'];

                        $maketable = '<div class="alert alert-success  mg-t-10" role="alert">
              <div class="d-flex align-items-center justify-content-start">
                <pre>Successful Send Message to<br>ID         : ' . $chat_id . "<br>Username   : " . $usernamea . "<br>Text       : " . $text . '</pre>
              </div><!-- d-flex -->
            </div>';

                        echo $maketable;
                    } else {

                        $maketable = '<div class="alert alert-success py-2  mg-t-10" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Send Message to ' . $ids . '<br><pre>ID         : ' . $ids . "<br>Username   : - <br>Text       : " . $text . '</pre></p> Maybe bots are blocked by users  </div>';
                        echo $maketable;
                    }
                }
            } else {

                $website = "https://api.telegram.org/bot" . $token;
                $params  = [
                    'chat_id' => $id,
                    'text' => $text,
                    'parse_mode' => 'html',
                ];
                $ch = curl_init($website . '/sendMessage');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $wel = json_decode($result, true);
                if ($wel['ok']) {
                    $message_id = $wel['result']['message_id'];
                    $from_id    = $wel['result']['from']['id'];
                    $first_name = $wel['result']['from']['first_name'];
                    $username   = $wel['result']['from']['username'];

                    $chat_id         = $wel['result']['chat']['id'];
                    $chat_first_name = $wel['result']['chat']['first_name'];
                    $username        = $wel['result']['chat']['username'];
                    $text            = $wel['result']['text'];

                    $maketable = '<div class="alert alert-success" role="alert">
              <div class="d-flex align-items-center justify-content-start">
                <pre>Successful Send Message to<br>ID         : ' . $chat_id . "<br>Username   : " . $username . "<br>Text       : " . $text . '</span></pre>
              </div><!-- d-flex -->
            </div>';

                    echo $maketable;
                } else {

                    $maketable = '<div class="alert alert-success py-2  mg-t-10" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Send Message to ' . $id . '<br><pre>ID         : ' . $id . "<br>Username   : - <br>Text       : " . $text . '</pre></p> Maybe bots are blocked by users  </div>';
                    echo $maketable;
                }
            }
        }} else {
        echo 'parametertidak terprosses';
    }
}
