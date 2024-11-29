<?php
//=====================================================START====================//

//=====================================================START SCRIPT====================//  
date_default_timezone_set('Asia/Jakarta');
include 'src/FrameBot.php';
require_once '../config/system.conn.php';
$mkbot = new FrameBot($token, $usernamebot);
require_once '../config/system.byte.php';
require_once '../Api/routeros_api.class.php';
//Any commands akan di cegah dengan ini jika  perlu silahakan dihapus /* dan  */
/*
$mkbot->cmd('*', 'Maaf commands tidak tersedia');
*/
$mkbot->cmd('/start|/Start', function () {
   include('../config/system.conn.php');
   $info         = bot::message();
   $ids          = $info['chat']['id'];
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   if (has($idtelegram) == false) {
      $text = "👋 <b>Selamat Datang di Layanan Kami!</b>\n\n";
      $text .= "┏━━━━ ℹ️ Status Akun ━━━━\n";
      $text .= "┃ Anda belum terdaftar sebagai pengguna\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ Silakan daftar untuk mulai menggunakan\n";
      $text .= "┃ layanan kami\n";
      $text .= "┣━━━━ 🔍 Cara Mendaftar ━━━━\n";
      $text .= "┃ • Ketik /daftar\n";
      $text .= "┃ • Atau tekan tombol di bawah ini\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";

      $options = [
         'parse_mode' => 'html',
         'reply_markup' => json_encode([
            'inline_keyboard' => [
               [['text' => '📝 Daftar Sekarang', 'callback_data' => '/daftar']],
               [['text' => '❓ Informasi Layanan', 'callback_data' => '/voucher']],
            ],
         ]),
      ];
      return Bot::sendMessage($text, $options);
   } else {
      $text = "👋 <b>Hai @$nametelegram!</b>\n\n";
      $text .= "┏━━━━ 🌟 Selamat Datang Kembali ━━━━\n";
      $text .= "┃ Senang melihat Anda lagi di layanan kami\n";
      $text .= "┣━━━━ 🔍 Bantuan ━━━━\n";
      $text .= "┃ Ketik /help untuk melihat daftar bantuan\n";
      $text .= "┣━━━━ 📌 Menu Cepat ━━━━\n";
      $text .= "┃ Pilih menu di bawah untuk akses cepat:\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";

      $options = [
         'parse_mode' => 'html',
         'reply_markup' => json_encode([
            'inline_keyboard' => [
               [['text' => '💰 Cek Saldo', 'callback_data' => '/ceksaldo']],
               [['text' => '📦 Beli Paket', 'callback_data' => '/voucher']],
               [['text' => '📞 Hubungi Admin', 'url' => 'https://t.me/ahmadcircleid']],
               [['text' => '❓ Bantuan', 'callback_data' => '/help']],
            ],
         ]),
      ];
   }

   return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/resource|/Resource', function () {

   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      $API = new routeros_api();

      if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
         $jambu         = $API->comm("/system/health/print");
         $dhealth       = $jambu['0'];
         $ARRAY         = $API->comm("/system/resource/print");
         $jeruk         = $ARRAY['0'];
         $memperc       = ($jeruk['free-memory'] / $jeruk['total-memory']);
         $hddperc       = ($jeruk['free-hdd-space'] / $jeruk['total-hdd-space']);
         $mem           = ($memperc * 100);
         $hdd           = ($hddperc * 100);
         $sehat         = $dhealth['temperature'];
         $platform      = $jeruk['platform'];
         $board         = $jeruk['board-name'];
         $version       = $jeruk['version'];
         $architecture  = $jeruk['architecture-name'];
         $cpu           = $jeruk['cpu'];
         $cpuload       = $jeruk['cpu-load'];
         $uptime        = $jeruk['uptime'];
         $cpufreq       = $jeruk['cpu-frequency'];
         $cpucount      = $jeruk['cpu-count'];
         $memory        = formatBytes($jeruk['total-memory']);
         $fremem        = formatBytes($jeruk['free-memory']);
         $mempersen     = number_format($mem, 3);
         $hdd           = formatBytes($jeruk['total-hdd-space']);
         $frehdd        = formatBytes($jeruk['free-hdd-space']);
         $hddpersen     = number_format($hdd, 3);
         $sector        = $jeruk['write-sect-total'];
         $setelahreboot = $jeruk['write-sect-since-reboot'];
         $kerusakan     = $jeruk['bad-blocks'];
         $text .= "";
         $text .= "📡 <b>Resource Router</b>\n\n";
         $text .= "┏━━━━ 🖥️ Informasi Sistem ━━━━\n";
         $text .= "┃ 🏷️ Boardname : $board\n";
         $text .= "┃ 🖥️ Platform  : $platform\n";
         $text .= "┃ ⏱️ Uptime    : " . formatDTM($uptime) . "\n";
         $text .= "┃ 🌡️ Suhu      : $sehat°C\n";
         $text .= "┣━━━━ 💻 CPU ━━━━\n";
         $text .= "┃ 📊 Load      : $cpuload%\n";
         $text .= "┃ 🔧 Tipe      : $cpu\n";
         $text .= "┃ ⚡ Frekuensi : $cpufreq MHz\n";
         $text .= "┃ 🧠 Core      : $cpucount\n";
         $text .= "┣━━━━ 🧠 Memori ━━━━\n";
         $text .= "┃ 💾 Total     : $memory\n";
         $text .= "┃ 🆓 Bebas     : $fremem\n";
         $text .= "┃ 📊 Persentase: $mempersen%\n";
         $text .= "┣━━━━ 💽 Penyimpanan ━━━━\n";
         $text .= "┃ 💾 Total     : $hdd\n";
         $text .= "┃ 🆓 Bebas     : $frehdd\n";
         $text .= "┃ 📊 Persentase: $hddpersen%\n";
         $text .= "┣━━━━ 🔄 Statistik Reboot ━━━━\n";
         $text .= "┃ 📊 Bad Blocks: $kerusakan%\n";
         $text .= "┃ 🔢 Sektor    : $sector\n";
         $text .= "┃ 🔄 Setelah Reboot: $setelahreboot\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      }
   } else {
      $text = "⚠️ <b>Akses Terbatas</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf, Anda tidak memiliki akses\n";
      $text .= "┃ untuk menggunakan fitur ini\n";
      $text .= "┣━━━━ 🔒 Hak Akses ━━━━\n";
      $text .= "┃ Fitur ini hanya tersedia untuk\n";
      $text .= "┃ Administrator sistem\n";
      $text .= "┣━━━━ 💡 Saran ━━━━\n";
      $text .= "┃ Silakan hubungi Administrator\n";
      $text .= "┃ jika Anda memerlukan bantuan\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
   }

   $options = ['parse_mode' => 'html',];
   Bot::sendMessage($text, $options);
});
//Hotspot commands khusus Adminstator
$mkbot->cmd('!Hotspot|?hotspot|/hotspot|/Hotspot|!Hotspot', function ($user, $telo) {

   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      $API = new routeros_api();

      if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
         if ($user == 'aktif') {
            if ($telo != "") {
               $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => "" . $telo . ""]);
               $anggur = count($pepaya);
               $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "", "?server" => "" . $telo . ""]);
            } else {
               $pepaya = $API->comm("/ip/hotspot/active/print");
               $anggur = count($pepaya);
               $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "",]);
            }

            $text .= "User Aktif $apel item\n\n";

            for ($i = 0; $i < $anggur; $i++) {
               $mangga    = $pepaya[$i];
               $id        = $mangga['.id'];
               $server    = $mangga['server'];
               $user      = $mangga['user'];
               $address   = $mangga['address'];
               $mac       = $mangga['mac-address'];
               $uptime    = $mangga['uptime'];
               $usesstime = $mangga['session-time-left'];
               $bytesi    = formatBytes($mangga['bytes-in'], 2);
               $byteso    = formatBytes($mangga['bytes-out'], 2);
               $loginby   = $mangga['login-by'];
               $comment   = $mangga['comment'];
               $text .= "";
               $text .= "👤 <b>User Aktif</b>\n\n";
               $text .= "┏━━━━ 📋 Informasi User ━━━━\n";
               $text .= "┃ 🆔 ID       : $id\n";
               $text .= "┃ 👤 Username : $user\n";
               $text .= "┃ 🌐 IP       : $address\n";
               $text .= "┣━━━━ ⏱️ Statistik Waktu ━━━━\n";
               $text .= "┃ 🕒 Uptime   : $uptime\n";
               $text .= "┃ ⏳ Sesi     : $usesstime\n";
               $text .= "┣━━━━ 📊 Penggunaan Data ━━━━\n";
               $text .= "┃ ⬇️ Byte IN  : $bytesi\n";
               $text .= "┃ ⬆️ Byte OUT : $byteso\n";
               $text .= "┣━━━━ 🔐 Informasi Login ━━━━\n";
               $text .= "┃ 🔑 Login by : $loginby\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
               $text .= "🔍 Lihat detail server: /see_$server\n\n";
            }

            $arr2       = str_split($text, 4000);
            $amount_gen = count($arr2);

            for ($i = 0; $i < $amount_gen; $i++) {
               $texta = $arr2[$i];
               Bot::sendMessage($texta);
            }
         } elseif ($user == 'user') {
            $ARRAY = $API->comm("/ip/hotspot/user/print");
            $num   = count($ARRAY);
            $text  = "Total $num User\n\n";

            for ($i = 0; $i < $num; $i++) {
               $no     = $i;
               $data   = $ARRAY[$i]['.id'];
               $dataid = str_replace('*', 'id', $data);
               $server = $ARRAY[$i]['server'];
               $name   = $ARRAY[$i]['name'];
               $data3  = $ARRAY[$i]['password'];
               $data4  = $ARRAY[$i]['mac-address'];
               $data5  = $ARRAY[$i]['profile'];
               $data6  = $ARRAY[$i]['limit-uptime'];
               $text .= "";
               $text .= "👥 <b>Informasi User</b> (ID: $dataid)\n\n";
               $text .= "┏━━━━ 📋 Detail Akun ━━━━\n";
               $text .= "┃ 👤 Nama     : $name\n";
               $text .= "┃ 🔑 Password : $data3\n";
               $text .= "┃ 📱 MAC      : $data4\n";
               $text .= "┃ 👥 Profil   : $data5\n";
               $text .= "┣━━━━ 🔧 Tindakan ━━━━\n";
               $text .= "┃ ❌ Hapus User: /rEm0v$dataid\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
            }

            $arr2       = str_split($text, 4000);
            $amount_gen = count($arr2);

            for ($i = 0; $i < $amount_gen; $i++) {
               $texta = $arr2[$i];

               Bot::sendMessage($texta);
            }
         } else {
            $text .= "";
            $text = "User list or aktif\n";
            $text .= "Filter by server\n";
            $serverhot = $API->comm('/ip/hotspot/print');

            foreach ($serverhot as $index => $jambu) {
               $sapubasah      = str_replace('-', '0', $jambu['name']);
               $sapubasahbasah = str_replace(' ', '11', $sapubasah);

               $text .= "/see_" . $sapubasahbasah . "\n";
            }

            $keyboard    = [['!Hotspot user', '!Hotspot aktif'], ['!Menu', '!Help'], ['!Hide'],];
            $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true];
            $options     = [
               'reply' => true,
               'reply_markup' => json_encode($replyMarkup),
            ];
            Bot::sendMessage($text, $options);
         }
      } else {
         $text = "❌ <b>Koneksi Gagal</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Tidak dapat terhubung dengan Mikrotik\n";
         $text .= "┣━━━━ 🔧 Saran ━━━━\n";
         $text .= "┃ • Periksa koneksi jaringan Anda\n";
         $text .= "┃ • Pastikan Mikrotik dalam keadaan aktif\n";
         $text .= "┃ • Coba lagi dalam beberapa saat\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━";

         $options = [
            'parse_mode' => 'html',
            'reply' => true,
         ];
         Bot::sendMessage($text, $options);
      }
   } else {
      $text = "⚠️ <b>Akses Terbatas</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf, Anda tidak memiliki akses\n";
      $text .= "┃ untuk menggunakan fitur ini\n";
      $text .= "┣━━━━ 🔒 Hak Akses ━━━━\n";
      $text .= "┃ Fitur ini hanya tersedia untuk\n";
      $text .= "┃ Administrator sistem\n";
      $text .= "┣━━━━ 💡 Saran ━━━━\n";
      $text .= "┃ Silakan hubungi Administrator\n";
      $text .= "┃ jika Anda memerlukan bantuan\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";

      $options = [
         'parse_mode' => 'html',
      ];
      Bot::sendMessage($text, $options);
   }
});
//User commands khusus Administator
$mkbot->cmd('?hs|!User|?user|!user|', function ($name) {

   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      $API = new routeros_api();

      if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
         $ARRAY = $API->comm("/ip/hotspot/user/print", ["?name" => $name,]);
         $get   = $API->comm("/system/scheduler/print", ["?name" => $name,]);

         if (empty($ARRAY)) {
            $texta = "User tidak ditemukan...";
         } else {
            $text = "";
            foreach ($ARRAY as $baris) {
               $text .= "┏━━━━ 👤 Hotspot Client ━━━━\n";
               $text .= "┃ 🏷️ Nama     : " . $baris['name'] . "\n";
               $text .= "┃ 🔑 Password : " . $baris['password'] . "\n";
               $text .= "┃ ⏳ Limit    : " . $baris['limit-uptime'] . "\n";
               $text .= "┃ ⏱️ Uptime   : " . formatDTM($baris['uptime']) . "\n";
               $text .= "┃ ⬆️ Upload   : " . formatBytes($baris['bytes-in']) . "\n";
               $text .= "┃ ⬇️ Download : " . formatBytes($baris['bytes-out']) . "\n";
               $text .= "┃ 👥 Profil   : " . $baris['profile'] . "\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $dataid = str_replace('*', 'id', $baris['.id']);
            }

            $experid = "┏━━━━ ⏰ Informasi Waktu ━━━━\n";
            foreach ($get as $baris) {
               $experid .= "┃ 🕒 Start-time : <b>" . $baris['start-date'] . " " . $baris['start-time'] . "</b>\n";
               $experid .= "┃ 🔄 Interval   : <b>" . $baris['interval'] . "</b>\n";
               $experid .= "┃ ⌛ Expired    : <b>" . $baris['next-run'] . "</b>\n";
            }
            $experid .= "┗━━━━━━━━━━━━━━━━━━━━\n";

            $texta = "<code>" . $text . "</code>" . $experid . "\n🗑️ Hapus User: /rEm0v$dataid\n";
         }
      }

      $options = ['parse_mode' => 'html',];
      Bot::sendMessage($texta, $options);
   } else {
      $denid = "⚠️ <b>Akses Terbatas</b>\n\n";
      $denid .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $denid .= "┃ Maaf, Anda tidak memiliki akses\n";
      $denid .= "┃ untuk menggunakan fitur ini\n";
      $denid .= "┣━━━━ 🔒 Hak Akses ━━━━\n";
      $denid .= "┃ Fitur ini hanya tersedia untuk\n";
      $denid .= "┃ Administrator sistem\n";
      $denid .= "┣━━━━ 💡 Saran ━━━━\n";
      $denid .= "┃ Silakan hubungi Administrator\n";
      $denid .= "┃ jika Anda memerlukan bantuan\n";
      $denid .= "┗━━━━━━━━━━━━━━━━━━━━";
      Bot::sendMessage($denid);
   }
});
//report commands khusus Administator
$mkbot->cmd('/report', function ($name) {
   $info   = bot::message();
   $id     = $info['chat']['id'];
   $iduser = $info['from']['id'];
   $msgid  = $info['message_id'];
   Bot::sendChatAction('typing');

   if ($idtelegram == $id_own) {
      $text = "📊 <b>Laporan Bulanan</b>\n\n";
      $text .= "📅 <code>" . date('d-m-Y') . "</code>\n";
      $text .= "┏━━━━ 🎟️ Voucher ━━━━\n";
      $text .= "┃ Total: " . countvoucher() . " Voucher\n";
      $text .= "┣━━━━ 💳 Top Up ━━━━\n";
      $text .= "┃ Debit: " . rupiah(getcounttopup()) . "\n";
      $text .= "┣━━━━ 📈 Mutasi ━━━━\n";
      $text .= "┃ Voucher: " . rupiah(estimasidata()) . "\n";
      $text .= "┣━━━━ 👥 Pengguna ━━━━\n";
      $text .= "┃ Baru: +" . countuser() . " User\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
   } else {
      $text = "⚠️ <b>Akses Terbatas</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf, Anda tidak memiliki akses\n";
      $text .= "┃ untuk melihat laporan ini\n";
      $text .= "┣━━━━ 🔒 Hak Akses ━━━━\n";
      $text .= "┃ Fitur ini hanya tersedia untuk\n";
      $text .= "┃ Administrator sistem\n";
      $text .= "┣━━━━ 💡 Saran ━━━━\n";
      $text .= "┃ Silakan hubungi Administrator\n";
      $text .= "┃ jika Anda memerlukan bantuan\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
   }

   $options = [
      'parse_mode' => 'html',
   ];
   Bot::sendMessage($text, $options);
});
//netwatch commands khusus Administator
$mkbot->cmd('/netwatch|/Netwatch', function () {
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      $API = new routeros_api();

      if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
         $ARRAY = $API->comm("/tool/netwatch/print");
         $num   = count($ARRAY);
         $text = "📡 <b>Daftar Host Netwatch</b> ($num)\n\n";

         for ($i = 0; $i < $num; $i++) {
            $no       = $i + 1;
            $host     = $ARRAY[$i]['host'];
            $interval = $ARRAY[$i]['interval'];
            $timeout  = $ARRAY[$i]['timeout'];
            $status   = $ARRAY[$i]['status'];
            $since    = $ARRAY[$i]['since'];

            $text .= "┏━━━━ 🖥️ Netwatch #$no ━━━━\n";
            $text .= "┃ 🌐 Host   : $host\n";
            $text .= "┃ 🔄 Interval: $interval\n";
            $text .= "┃ ⏱️ Timeout : $timeout\n";
            $text .= "┃ 🚦 Status : " . ($status == "up" ? "✅ UP" : "⚠️ Down") . "\n";
            $text .= "┃ 🕒 Since  : $since\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
         }
      } else {
         $text = "❌ <b>Koneksi Gagal</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Tidak dapat terhubung dengan Mikrotik\n";
         $text .= "┣━━━━ 🔧 Saran ━━━━\n";
         $text .= "┃ • Periksa koneksi jaringan Anda\n";
         $text .= "┃ • Pastikan Mikrotik dalam keadaan aktif\n";
         $text .= "┃ • Coba lagi dalam beberapa saat\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━";
      }

      $arr2       = str_split($text, 4000);
      $amount_gen = count($arr2);

      for ($i = 0; $i < $amount_gen; $i++) {
         $texta   = $arr2[$i];
         $options = ['parse_mode' => 'html'];
         Bot::sendMessage($arr2[$i], $options);
      }
   } else {
      $text = "⚠️ <b>Akses Terbatas</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf, Anda tidak memiliki akses\n";
      $text .= "┃ untuk menggunakan fitur ini\n";
      $text .= "┣━━━━ 🔒 Hak Akses ━━━━\n";
      $text .= "┃ Fitur ini hanya tersedia untuk\n";
      $text .= "┃ Administrator sistem\n";
      $text .= "┣━━━━ 💡 Saran ━━━━\n";
      $text .= "┃ Silakan hubungi Administrator\n";
      $text .= "┃ jika Anda memerlukan bantuan\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
      Bot::sendMessage($text);
   }
});
$mkbot->cmd('!voucher|!Voucher|/voucher|/Voucher', function () {
   $info              = bot::message();
   $usernamepelanggan = $info['from']['username'];
   $id                = $info['from']['id'];
   $nama              = $info['from']['first_name'];

   if (has($id)) {
      include('../config/system.conn.php');
      $data = json_decode($Voucher_nonsaldo, true);
      $text = "";
      $text .= "👋 <b>Selamat Datang di Layanan Kami!</b>\n\n";
      $text .= "┏━━━━ 👤 Informasi Pengguna ━━━━\n";
      $text .= "┃ Nama: <i>$nama</i>\n";
      $text .= "┃ Username: @$usernamepelanggan\n";
      $text .= "┣━━━━ 🎫 Daftar Voucher ━━━━\n";
      $text .= "┃ Silakan pilih voucher di bawah ini:\n";
      $text .= "┃\n";
      foreach ($data as $hargas) {
         $textlist = $hargas['Text_List'];
         $text .= "┃ <code>$textlist</code>\n";
      }
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";

      for ($i = 0; $i < count($data); $i++) {
         ${'database' . $i} = ['text' => $data[$i]['Voucher'], 'callback_data' => 'Vcrnos' . $data[$i]['id']];
      }

      $vouchernamea0 = array_filter([$database0, $database1]);
      $vouchernameb1 = array_filter([$database2, $database3]);
      $vouchernamec2 = array_filter([$database4, $database5]);

      $send = [];
      array_push($send, $vouchernamea0);
      array_push($send, $vouchernameb1);
      array_push($send, $vouchernamec2);

      $options = [
         'reply_markup' => json_encode(['inline_keyboard' => $send]),
         'parse_mode' => 'html'
      ];

      Bot::sendMessage($text, $options);
      unset($data, $voucher_1);
   } else {
      $text = "⚠️ <b>Akses Ditolak</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf $nama, Anda belum terdaftar\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ Silakan daftar terlebih dahulu\n";
      $text .= "┃ dengan menghubungi admin\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";

      $options = [
         'parse_mode' => 'html'
      ];

      Bot::sendMessage($text, $options);
   }
});
$mkbot->on('callback', function ($command) {
   $message           = Bot::message();
   $enkod             = json_encode($message);
   $id                = $message['from']['id'];
   $usernamepelanggan = $message['from']['username'];
   $namatele          = $message['from']['first_name'];
   $chatidtele        = $message["message"]['chat']['id'];
   $message_idtele    = $message["message"]["message_id"];

   include('../config/system.conn.php');

   if (has($id)) {
      if (strpos($command, 'Vcrnos') !== false) {

         $data  = json_decode($Voucher_nonsaldo, true);
         $cekid = "Vcrnos" . $data[0]['id'] . ",Vcrnos" . $data[1]['id'] . ",Vcrnos" . $data[2]['id'] . ",Vcrnos" . $data[3]['id'] . ",Vcrnos" . $data[4]['id'] . ",Vcrnos" . $data[5]['id'];

         if (preg_match('/' . $command . '/i', $cekid)) {
            $API = new routeros_api();
            foreach ($data as $datas => $getdata) {
               $getid2         = $getdata['id'];
               $profile        = $getdata['profile'];
               $length         = $getdata['length'];
               $vouchername    = $getdata['Voucher'];
               $server         = $getdata['server'];
               $type           = $getdata['type'];
               $typechar       = $getdata['typechar'];
               $Color          = $getdata['Color'];
               $limituptime    = $getdata['Limit'];
               $limit_download = toBytes($getdata['limit_download']);
               $limit_upload   = toBytes($getdata['limit_upload']);
               $limit_total    = toBytes($getdata['limit_total']);

               if ($command == 'Vcrnos' . $getid2) {
                  $sendupdate = "📋 <b>Status Pembuatan Voucher</b>\n\n";
                  $sendupdate .= "┏━━━━ ℹ️ Informasi Pengguna ━━━━\n";
                  $sendupdate .= "┃ 🆔 ID User  : <code>$id</code>\n";
                  $sendupdate .= "┃ 👤 Username : @$usernamepelanggan\n";
                  $sendupdate .= "┣━━━━ 🎟️ Detail Voucher ━━━━\n";
                  $sendupdate .= "┃ 🏷️ Voucher  : $vouchername\n";
                  $sendupdate .= "┣━━━━ 🕒 Status Proses ━━━━\n";
                  $sendupdate .= "┃ 🔄 Status   : <i>Pending</i>\n";
                  $sendupdate .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                  $sendupdate .= "⏳ Mohon tunggu sebentar...\n";
                  $sendupdate .= "Voucher Anda sedang dalam proses pembuatan.";

                  $options = [
                     'chat_id' => $chatidtele,
                     'message_id' => (int) $message['message']['message_id'],
                     'text' => $sendupdate,
                     'reply_markup' => json_encode([
                        'inline_keyboard' => [
                           [
                              ['text' => 'Back', 'callback_data' => 'Menu'],
                           ],
                        ]
                     ]),
                     'parse_mode' => 'html'

                  ];

                  Bot::editMessageText($options);


                  $delete = [
                     'chat_id' => $chatidtele,
                     'message_id' => (int) $message['message']['message_id'],
                  ];
                  sleep(1);
                  Bot::deleteMessage($delete);


                  if ($type == 'up') {
                     $usernamereal = make_string($length, $typechar);
                     $passwordreal = make_string($length, $typechar);
                  } else {
                     $usernamereal = make_string($length, $typechar);
                     $passwordreal = $usernamereal;
                  }

                  switch ($limituptime) {
                     case null:
                        $limituptimereal = '00:00:00';
                        break;
                     case '00:00:00':
                        $limituptimereal = '00:00:00';
                        break;
                     default:
                        $limituptimereal = $limituptime;

                        if (strpos(strtolower($limituptimereal), 'h') !== false) {
                           $uptime = str_replace('h', ' Jam', $limituptime);
                        } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                           $uptime = str_replace('d', ' Hari', $limituptime);
                        }

                        $echoexperid .= "<code>  Experid    :</code> <code>{$uptime}</code>\n";
                        break;
                  }

                  if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                     $add_user_api = $API->comm("/ip/hotspot/user/add", [
                        "server" => $server,
                        "profile" => $profile,
                        "name" => $usernamereal,
                        "limit-uptime" => $limituptimereal,
                        "limit-bytes-out" => $limit_upload,
                        "limit-bytes-in" => $limit_download,
                        "limit-bytes-total" => $limit_total,
                        "password" => $passwordreal,
                        "comment" => "vc-bot|$usernamepelanggan|nonsaldo|" . date('d-m-Y'),
                     ]);
                     if ($type == 'up') {
                        $caption = "┏━━━━ 🎟️ Voucher Hotspot ━━━━\n";
                        $caption .= "┃ 🆔 ID         : $add_user_api\n";
                        $caption .= "┃ 👤 Username   : <code>$usernamereal</code>\n";
                        $caption .= "┃ 🔑 Password   : <code>$passwordreal</code>\n";
                        $caption .= "┃ 📦 Paket      : <code>$profile</code>\n";
                        $caption .= $echoexperid;
                        $caption .= "┣━━━━ ⚠️ Peringatan ━━━━\n";
                        $caption .= "┃ GUNAKAN INTERNET DENGAN BIJAK\n";
                        $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     } else {
                        $caption = "┏━━━━ 🎟️ Voucher Hotspot ━━━━\n";
                        $caption .= "┃ 🆔 ID         : $add_user_api\n";
                        $caption .= "┃ 🎫 ID Voucher : <code>$usernamereal</code>\n";
                        $caption .= "┃ 📦 Paket      : <code>$profile</code>\n";
                        $caption .= $echoexperid;
                        $caption .= "┣━━━━ ⚠️ Peringatan ━━━━\n";
                        $caption .= "┃ GUNAKAN INTERNET DENGAN BIJAK\n";
                        $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     }
                     $cekvalidasiadd = json_encode($add_user_api);

                     if (strpos(strtolower($cekvalidasiadd), '!trap')) {
                        //salah maka bot akan dianggap salah
                        $ganguan = true;
                     } else {

                        //benar maka bot akan send voucher

                        //cek dnsname sudah ada http belum?
                        if (strpos($dnsname, 'http://') !== false) {
                           $url = "$dnsname/login?username=$usernamereal&password=$passwordreal";
                        } else {
                           $url = "http://$dnsname/login?username=$usernamereal&password=$passwordreal";
                        }

                        $qrcode     = 'http://qrickit.com/api/qr.php?d=' . urlencode($url) . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=' . $Color . '&bgdcolor=FFFFFF&qrsize=500';
                        $keyboard[] = [
                           ['text' => 'Menuju Login Page', 'url' => $url],
                        ];

                        $options = [
                           'chat_id' => $chatidtele,
                           'caption' => $caption,
                           'reply_markup' => ['inline_keyboard' => $keyboard],
                           'parse_mode' => 'html'
                        ];
                        $succes = Bot::sendPhoto($qrcode, $options);
                     }
                     $success = json_decode($succes, true);
                     if ($success['ok'] !== true) {
                        $errorprint = true;
                     }
                  } else {
                     $ganguan = true;
                  }

                  break;
               }
            }
            if (!empty($ganguan)) {
               //remove User jika terjadi error
               if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                  $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api,]);
               }

               $gagal = "❌ <b>Pembuatan Voucher Gagal</b>\n\n";
               $gagal .= "┏━━━━ ℹ️ Informasi ━━━━\n";
               $gagal .= "┃ 🆔 ID User  : <code>$id</code>\n";
               $gagal .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagal .= "┃ 🚫 Status   : Gagal Terhubung ke Server\n";
               $gagal .= "┣━━━━ 🔧 Saran ━━━━\n";
               $gagal .= "┃ Maaf, server sedang mengalami gangguan.\n";
               $gagal .= "┃ Silakan hubungi admin untuk bantuan.\n";
               $gagal .= "┗━━━━━━━━━━━━━━━━━\n";
               $options = [
                  'chat_id' => $chatidtele,
                  'parse_mode' => 'html'

               ];
               $keterangan = 'gagalNonSaldo';
               Bot::sendMessage($gagal, $options);

               $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
            } elseif (!empty($errorprint)) {
               //remove User jika terjadi error
               if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                  $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api,]);
               }

               $gagalprint = "❌ <b>Gagal Mencetak Voucher</b>\n\n";
               $gagalprint .= "┏━━━━ ℹ️ Informasi ━━━━\n";
               $gagalprint .= "┃ 🆔 ID User  : <code>$id</code>\n";
               $gagalprint .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagalprint .= "┃ 🚫 Status   : Gagal Mencetak Voucher\n";
               $gagalprint .= "┣━━━━ 🔧 Saran ━━━━\n";
               $gagalprint .= "┃ Maaf, terjadi kesalahan saat mencetak voucher.\n";
               $gagalprint .= "┃ Silakan hubungi admin untuk bantuan.\n";
               $gagalprint .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options    = ['chat_id' => $chatidtele, 'parse_mode' => 'html'];
               $keterangan = 'gagalprintNonSaldo';
               Bot::sendMessage($gagalprint, $options);

               $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
            } else if (!empty($succes)) {

               $Success = "✅ <b>Voucher Berhasil Dibuat</b>\n\n";
               $Success .= "┏━━━━ ℹ️ Informasi ━━━━\n";
               $Success .= "┃ 🆔 ID User  : <code>$id</code>\n";
               $Success .= "┃ 👤 Username : @$usernamepelanggan\n";
               $Success .= "┃ 🎫 Status   : Berhasil\n";
               $Success .= "┣━━━━ 📝 Catatan ━━━━\n";
               $Success .= "┃ Voucher telah berhasil dibuat dan dikirim.\n";
               $Success .= "┃ Silakan cek pesan sebelumnya untuk detail voucher.\n";
               $Success .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options = [
                  'chat_id' => $chatidtele,
                  'reply_markup' => json_encode([
                     'inline_keyboard' => [
                        [
                           ['text' => '🔙 Kembali ke Menu', 'callback_data' => 'Menu'],
                        ],
                     ]
                  ]),
                  'parse_mode' => 'html'

               ];

               Bot::sendMessage($Success, $options);
               if (isset($Success)) {
                  $keterangan  = 'SuccessNonSaldo';
                  $set          = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
               }
            }
         } else {
            $Success = "⚠️ <b>Voucher Tidak Tersedia</b>\n\n";
            $Success .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $Success .= "┃ Maaf, voucher yang Anda pilih\n";
            $Success .= "┃ sudah tidak tersedia lagi.\n";
            $Success .= "┣━━━━ 💡 Saran ━━━━\n";
            $Success .= "┃ • Silakan pilih voucher lain\n";
            $Success .= "┃ • Cek kembali daftar voucher terbaru\n";
            $Success .= "┃ • Hubungi admin untuk informasi lebih lanjut\n";
            $Success .= "┗━━━━━━━━━━━━━━━━━━━━\n";

            $options = [
               'chat_id' => $chatidtele,
               'parse_mode' => 'html'

            ];

            Bot::sendMessage($Success, $options);
         }
      } elseif ($command == 'Voucher') {
         $data = json_decode($Voucher_nonsaldo, true);
         $text = "";
         $text .= "👋 <b>Selamat Datang di Layanan Kami!</b>\n\n";
         $text .= "┏━━━━ 👤 Informasi Pengguna ━━━━\n";
         $text .= "┃ Nama: <i>$namatele</i>\n";
         $text .= "┣━━━━ 🎫 Daftar Voucher ━━━━\n";
         $text .= "┃ Silakan pilih voucher di bawah ini:\n";
         $text .= "┃\n";
         foreach ($data as $hargas) {
            $textlist = $hargas['Text_List'];
            $text .= "┃ <code>$textlist</code>\n";
         }
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         for ($i = 0; $i < count($data); $i++) {
            ${'database' . $i} = ['text' => $data[$i]['Voucher'] . '', 'callback_data' => 'Vcrnos' . $data[$i]['id'] . ''];
         }

         $vouchernamea0 = array_filter(
            [
               $database0,
               $database1

            ]
         );

         $vouchernameb1 = array_filter(
            [
               $database2,
               $database3

            ]
         );

         $vouchernamec2 = array_filter(
            [
               $database4,
               $database5

            ]
         );

         $send = [];
         array_push($send, $vouchernamea0);
         array_push($send, $vouchernameb1);
         array_push($send, $vouchernamec2);

         $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
            'reply_markup' => json_encode(['inline_keyboard' => $send]),
            'parse_mode' => 'html'

         ];

         Bot::editMessageText($options);
      } elseif ($command == 'informasi') {
         $text = "ℹ️ <b>Informasi Terkini</b>\n\n";
         $text .= "┏━━━━ 📢 Pengumuman ━━━━\n";
         $text .= "┃ Saat ini tidak ada informasi terbaru.\n";
         $text .= "┣━━━━ 💡 Saran ━━━━\n";
         $text .= "┃ • Cek kembali nanti untuk pembaruan\n";
         $text .= "┃ • Pantau channel resmi kami\n";
         $text .= "┃ • Hubungi admin jika ada pertanyaan\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
            'reply_markup' => json_encode([
               'inline_keyboard' => [
                  [
                     ['text' => 'Back', 'callback_data' => 'Menu'],
                  ],
               ]
            ]),
            'parse_mode' => 'html'

         ];

         Bot::editMessageText($options);
      }
   } else {
      $text = "⚠️ <b>Akses Ditolak</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf $namatele, Anda belum terdaftar\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ Silakan daftar terlebih dahulu\n";
      $text .= "┃ dengan menghubungi admin\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
      $options = [
         'chat_id' => $chatidtele,
         'message_id' => (int) $message['message']['message_id'],
         'text' => $text,
      ];
      Bot::editMessageText($options);
   }
});
$mkbot->run();