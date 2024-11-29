						
<?php
//=====================================================START====================//

/*

SALDO DAN NON SALDO
 Edit hanya textnya saja
*/

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


//Start commands
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
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Anda belum terdaftar di sistem kami.\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ • Silakan hubungi admin untuk mendaftar\n";
      $text .= "┃ • Atau gunakan perintah /daftar\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
      $text .= "Terima kasih telah menggunakan layanan kami!";
   } else {
      $text = "👋 <b>Selamat Datang Kembali!</b>\n\n";
      $text .= "┏━━━━ 👤 Informasi Pengguna ━━━━\n";
      $text .= "┃ Nama: @$nametelegram\n";
      $text .= "┣━━━━ 🔍 Menu Bantuan ━━━━\n";
      $text .= "┃ Gunakan perintah /help untuk\n";
      $text .= "┃ melihat daftar bantuan tersedia\n";
      $text .= "┣━━━━ 💬 Butuh Bantuan? ━━━━\n";
      $text .= "┃ Silakan tanyakan kepada kami\n";
      $text .= "┃ jika ada yang bisa kami bantu\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━";
   }

   $options = [
      'parse_mode' => 'html'
   ];

   return Bot::sendMessage($text, $options);
});
//deposit commands
$mkbot->cmd('/deposit|/request', function ($jumlah) {
   include('../config/system.conn.php');
   $info         = bot::message();
   $ids          = $info['chat']['id'];
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];

   $text         = "";

   if (!empty($jumlah)) {
      if (has($idtelegram) == false) {
         //jika user belum terdaftar
         $text = "⚠️ <b>Akses Ditolak</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Anda belum terdaftar di sistem kami.\n";
         $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
         $text .= "┃ • Silakan daftar terlebih dahulu\n";
         $text .= "┃ • Hubungi admin atau gunakan /daftar\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         $text .= "Setelah terdaftar, Anda dapat request top up saldo.";
      } else {
         if (preg_match('/^[0-9]+$/', $jumlah)) {
            if (strlen($jumlah) < 7) {
               //jika user belum terdaftar
               $text = "✅ <b>Permintaan Deposit Diterima</b>\n\n";
               $text .= "┏━━━━ 💰 Detail Deposit ━━━━\n";
               $text .= "┃ 👤 User: @$usernamepelanggan\n";
               $text .= "┃ 💵 Jumlah: " . rupiah($cek) . "\n";
               $text .= "┣━━━━ 📝 Instruksi ━━━━\n";
               $text .= "┃ 1. Kirim bukti pembayaran\n";
               $text .= "┃ 2. Sertakan caption:\n";
               $text .= "┃    #konfirmasi deposit $cek\n";
               $text .= "┣━━━━ ⏰ Batas Waktu ━━━━\n";
               $text .= "┃ Konfirmasi maks. 2 jam setelah request\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";

               $textsend = "🔔 <b>Notifikasi Deposit</b>\n\n";
               $textsend .= "┏━━━━ 👤 Informasi User ━━━━\n";
               $textsend .= "┃ User: @$nametelegram\n";
               $textsend .= "┃ ID: <code>$idtelegram</code>\n";
               $textsend .= "┣━━━━ 💰 Detail Deposit ━━━━\n";
               $textsend .= "┃ Nominal: " . rupiah($jumlah) . "\n";
               $textsend .= "┣━━━━ 📝 Tindak Lanjut ━━━━\n";
               $textsend .= "┃ • Proses permintaan deposit\n";
               $textsend .= "┃ • Hubungi @$nametelegram jika perlu\n";
               $textsend .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
               $textsend .= "Gunakan tombol di bawah untuk top up otomatis:";

               //-===================rubah texnya saja ya
               $kirimpelangan = [
                  'chat_id' => $id_own,
                  'reply_markup' => json_encode([
                     'inline_keyboard' => [
                        [
                           ['text' => 'QUICK TOP UP', 'callback_data' => '12'],
                        ],
                        [
                           ['text' => '' . rupiah($jumlah) . '', 'callback_data' => 'tp|' . $jumlah . '|' . $idtelegram . '|' . $nametelegram . ''],
                        ],
                        [
                           ['text' => 'OR COSTUM', 'callback_data' => '12'],
                        ],
                        [
                           ['text' => '10000', 'callback_data' => 'tp|10000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '15000', 'callback_data' => 'tp|15000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '20000', 'callback_data' => 'tp|20000|' . $idtelegram . '|' . $nametelegram . ''],
                        ],
                        [

                           ['text' => '25000', 'callback_data' => 'tp|25000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '30000', 'callback_data' => 'tp|30000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '50000', 'callback_data' => 'tp|50000|' . $idtelegram . '|' . $nametelegram . ''],
                        ],
                        [

                           ['text' => '100000', 'callback_data' => 'tp|100000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '150000', 'callback_data' => 'tp|150000|' . $idtelegram . '|' . $nametelegram . ''],
                           ['text' => '200000', 'callback_data' => 'tp|200000|' . $idtelegram . '|' . $nametelegram . ''],
                        ],

                     ]
                  ]),
                  'parse_mode' => 'html'

               ];

               Bot::sendMessage($textsend, $kirimpelangan);
            } else {
               $text = "⚠️ <b>Deposit Melebihi Batas</b>\n\n";
               $text .= "Maaf, maksimal deposit top up adalah Rp 1.000.000,00";
            }
         } else {
            $text = "⚠️ <b>Input Tidak Valid</b>\n\n";
            $text .= "Maaf, input nominal saldo hanya berupa angka saja.";
         }
      }
   } else {
      $text = "💰 <b>Panduan Request Deposit Saldo</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Perintah ini digunakan untuk request\n";
      $text .= "┃ deposit saldo kepada Administrator.\n";
      $text .= "┣━━━━ 📝 Cara Penggunaan ━━━━\n";
      $text .= "┃ 1. Custom Request Deposit:\n";
      $text .= "┃    <code>/deposit (nominal)</code>\n";
      $text .= "┃\n";
      $text .= "┃ 2. Contoh Penggunaan:\n";
      $text .= "┃    <code>/deposit 1000</code>\n";
      $text .= "┃    <code>/deposit 70000</code>\n";
      $text .= "┣━━━━ 🔽 Opsi Cepat ━━━━\n";
      $text .= "┃ Atau gunakan tombol di bawah ini\n";
      $text .= "┃ untuk memilih nominal deposit:\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      $options = [
         'reply_markup' => json_encode([
            'inline_keyboard' => [
               [
                  ['text' => '⬇ REQUEST ⬇', 'callback_data' => '12'],
               ],
               [
                  ['text' => '10000', 'callback_data' => 'tps|10000'],
                  ['text' => '15000', 'callback_data' => 'tps|15000'],
                  ['text' => '20000', 'callback_data' => 'tps|20000'],
               ],
               [

                  ['text' => '25000', 'callback_data' => 'tps|25000'],
                  ['text' => '30000', 'callback_data' => 'tps|30000'],
                  ['text' => '50000', 'callback_data' => 'tps|50000'],
               ],
               [

                  ['text' => '100000', 'callback_data' => 'tps|100000'],
                  ['text' => '150000', 'callback_data' => 'tps|150000'],
                  ['text' => '200000', 'callback_data' => 'tps|200000'],
               ],

            ]
         ]),
         'parse_mode' => 'html'

      ];
   }

   return Bot::sendMessage($text, $options);
});
//cekid commands
$mkbot->cmd('/cekid|/Cekid', function ($jumlah) {
   include('../config/system.conn.php');
   $info   = bot::message();
   $iduser = $info['from']['id'];
   $msgid  = $info['message_id'];
   $name   = $info['from']['username'];
   $id     = $info['from']['id'];

   if (has($id) == false) {
      $text = "ℹ️ <b>Informasi ID Anda</b>\n\n";
      $text .= "┏━━━━ 👤 Detail Pengguna ━━━━\n";
      $text .= "┃ 🆔 ID User  : <code>$id</code>\n";
      $text .= "┃ 👤 Username : @$name\n";
      $text .= "┃ 🚫 Status   : Belum Terdaftar\n";
      $text .= "┣━━━━ ℹ️ Catatan ━━━━\n";
      $text .= "┃ Anda belum terdaftar di sistem.\n";
      $text .= "┃ Silakan daftar menggunakan /daftar\n";
      $text .= "┃ atau hubungi admin untuk bantuan.\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   } else {
      $text = "ℹ️ <b>Informasi ID Anda</b>\n\n";
      $text .= "┏━━━━ 👤 Detail Pengguna ━━━━\n";
      $text .= "┃ 🆔 ID User  : <code>$id</code>\n";
      $text .= "┃ 👤 Username : @$name\n";
      $text .= "┃ ✅ Status   : Terdaftar\n";
      $text .= "┣━━━━ ℹ️ Catatan ━━━━\n";
      $text .= "┃ Anda telah terdaftar di sistem.\n";
      $text .= "┃ Gunakan /help untuk melihat\n";
      $text .= "┃ daftar perintah yang tersedia.\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   }

   $options = [
      'parse_mode' => 'html'
   ];
   return Bot::sendMessage($text, $options);
});
//daftar commands
$mkbot->cmd('/daftar', function () {
   include('../config/system.conn.php');
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];

   Bot::sendChatAction('typing');
   $ids = $info['chat']['id'];

   if (empty($nametelegram)) {
      $text = "⚠️ <b>Perhatian</b>\n\n";
      $text .= "Maaf, akun Telegram Anda belum memiliki username.\n";
      $text .= "Silakan atur username Anda terlebih dahulu\n";
      $text .= "di pengaturan Telegram Anda.";
   } else {

      if (has($idtelegram) == false) {
         $cek = daftar($idtelegram, $nametelegram);

         if (empty($cek)) {
            $text = "❌ <b>Pendaftaran Gagal</b>\n\n";
            $text .= "Mohon maaf, sistem kami sedang mengalami gangguan.\n";
            $text .= "Silakan hubungi Administrator untuk bantuan\n";
            $text .= "dalam proses pendaftaran layanan ini.";
         } else {
            $text = "✅ <b>Pendaftaran Berhasil</b>\n\n";
            $text .= "┏━━━━ 👤 Informasi Pelanggan ━━━━\n";
            $text .= "┃ 🆔 ID User  : <code>$idtelegram</code>\n";
            $text .= "┃ 👤 Username : @$nametelegram\n";
            $text .= "┃ ✳️ Status   : Terdaftar\n";
            $text .= "┣━━━━ 💰 Langkah Selanjutnya ━━━━\n";
            $text .= "┃ Silakan isi saldo Anda di outlet kami\n";
            $text .= "┃ untuk mulai menggunakan layanan.\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
            $text .= "Terima kasih atas kepercayaan Anda\n";
            $text .= "dalam menggunakan layanan kami! 😊";
         }
      } else {
         $text = "ℹ️ <b>Informasi Akun</b>\n\n";
         $text .= "Maaf, Anda sudah terdaftar dalam layanan ini.\n\n";
         $text .= "┏━━━━ 👤 Detail Pengguna ━━━━\n";
         $text .= "┃ 🆔 ID User  : <code>$idtelegram</code>\n";
         $text .= "┃ 👤 Username : @$nametelegram\n";
         $text .= "┃ ✅ Status   : Terdaftar\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
         $text .= "Gunakan /menu untuk melihat daftar perintah yang tersedia.";
      }
   }

   $options = [
      'parse_mode' => 'html'
   ];
   return Bot::sendMessage($text, $options);
});
//help commands
$mkbot->cmd('/menu|!Menu', function ($id, $name, $notlp, $saldo) {
   include('../config/system.conn.php');
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   if ($idtelegram == $id_own) {
      $text .= "┏━━━━ 👤 Perintah Umum ━━━━\n";
      $text .= "┃ /menu - Menu Voucher\n";
      $text .= "┃ /daftar - Daftar layanan\n";
      $text .= "┃ /ceksaldo - Cek saldo layanan\n";
      $text .= "┃ /cekid - Status user\n";
      $text .= "┃ /qrcode - Terjemahkan QR Code\n";
      $text .= "┃ /deposit - Permintaan deposit\n";
      $text .= "┣━━━━ 🛠️ Perintah Admin ━━━━\n";
      $text .= "┃ /dbg - Debug message\n";
      $text .= "┃ /daftarid - Daftar user manual\n";
      $text .= "┃ /topdown - Kurangi saldo user\n";
      $text .= "┃ /topup - Top up saldo user\n";
      $text .= "┃ /hotspot - Hotspot monitor\n";
      $text .= "┃ /resource - Resource router\n";
      $text .= "┃ /netwatch - Netwatch router\n";
      $text .= "┃ /report - Report MikHBotAm\n";
      $text .= "┃ ?user - Cari user hotspot\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   } else {
      $text .= "┏━━━━ 👤 Perintah Tersedia ━━━━\n";
      $text .= "┃ /menu - Menu Voucher\n";
      $text .= "┃ /daftar - Daftar layanan\n";
      $text .= "┃ /ceksaldo - Cek saldo layanan\n";
      $text .= "┃ /cekid - Status user\n";
      $text .= "┃ /qrcode - Terjemahkan QR Code\n";
      $text .= "┃ /deposit - Permintaan deposit\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   }

   $text .= "\nGunakan perintah di atas untuk mengakses layanan kami. ";
   $text .= "Jika Anda memerlukan bantuan lebih lanjut, ";
   $text .= "silakan hubungi admin.";

   $optionss = ['parse_mode' => 'html',];
   Bot::sendMessage($text, $optionss);
});
//daftar manual khusus Administator
$mkbot->cmd('/daftarid', function ($id, $name, $notlp, $saldo) {
   include('../config/system.conn.php');
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   Bot::sendChatAction('typing');

   if ($idtelegram == $id_own) {
      if (empty($id) && empty($name) && empty($notlp) && empty($saldo)) {
         $text = "⚠️ <b>Format Tidak Valid</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Format yang Anda masukkan salah.\n";
         $text .= "┣━━━━ 📝 Format yang Benar ━━━━\n";
         $text .= "┃ /daftar [ID] [Nama] [No. Telp] [Saldo]\n";
         $text .= "┣━━━━ 💡 Contoh ━━━━\n";
         $text .= "┃ /daftar 123 JohnDoe 081234567890 50000\n";
         $text .= "┣━━━━ 📌 Catatan ━━━━\n";
         $text .= "┃ • ID: Nomor unik pengguna\n";
         $text .= "┃ • Nama: Nama lengkap pengguna\n";
         $text .= "┃ • No. Telp: Nomor telepon aktif\n";
         $text .= "┃ • Saldo: Jumlah saldo awal (dalam Rupiah)\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         $text .= "\nSilakan coba lagi dengan format yang benar.";

      } else {

         $lihat = lihatuser($id);

         if (empty($lihat)) {
            $text = daftarid($id, $name, $notlp, $saldo);
         } else {
            $text = "⚠️ <b>Pendaftaran Gagal</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ User sudah terdaftar dalam sistem.\n";
            $text .= "┣━━━━ 📝 Saran ━━━━\n";
            $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
            $text .= "┃ • Gunakan ID yang berbeda\n";
            $text .= "┃ • Hubungi admin jika ada kesalahan\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         }
      }
   } else {
      $text = "🚫 <b>Akses Ditolak</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
      $text .= "┣━━━━ 📝 Saran ━━━━\n";
      $text .= "┃ • Gunakan akun Administrator\n";
      $text .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   }

   $options = [
      'parse_mode' => 'html'
   ];
   return Bot::sendMessage($text, $options);
});
//topdown khusus Administator
$mkbot->cmd('/topdown', function ($id, $jumlahan) {
   $info       = bot::message();
   $msgid      = $info['message_id'];
   $name       = $info['from']['username'];
   $idtelegram = $info['from']['id'];
   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      if (!empty($id) && !empty($jumlahan)) {
         if (has($id) == false) {
            $text = "⚠️ <b>ID Tidak Terdaftar</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ ID yang Anda masukkan tidak terdaftar.\n";
            $text .= "┣━━━━ 📝 Saran ━━━━\n";
            $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
            $text .= "┃ • Pastikan ID tersebut sudah terdaftar\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         } else {
            if (preg_match('/^[0-9]+$/', $jumlahan)) {
               if (strlen($jumlahan) < 7) {
                  $topdown = topdown($id, $jumlahan);
                  $text = "✅ <b>Refund Berhasil</b>\n\n";
                  $text .= "┏━━━━ 💰 Informasi Refund ━━━━\n";
                  $text .= "┃ 🆔 ID User     : $id\n";
                  $text .= "┃ 💵 Saldo Akhir : " . rupiah(lihatsaldo($id)) . "\n";
                  $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                  $text .= "\nPenarikan saldo telah berhasil dilakukan.";
               } else {
                  $text = "⚠️ <b>Refund Melebihi Batas</b>\n\n";
                  $text .= "Maaf, maksimal refund adalah Rp 1.000.000,00.\n";
                  $text .= "Silakan masukkan jumlah yang lebih kecil.";
               }
            } else {
               $text = "⚠️ <b>Input Tidak Valid</b>\n\n";
               $text .= "Maaf, input saldo hanya boleh berupa angka.\n";
               $text .= "Silakan coba lagi dengan format yang benar.";
            }
         }
      } else {
         $text = "⚠️ <b>Format Tidak Valid</b>\n\n";
         $text .= "Format yang benar: /topdown (id) (jumlah)\n";
         $text .= "Contoh: /topdown 123456 50000";
      }
   } else {
      $text = "🚫 <b>Akses Ditolak</b>\n\n";
      $text .= "Maaf, akses ini hanya untuk Administrator.\n";
      $text .= "Silakan hubungi admin jika Anda memerlukan bantuan.";
   }

   $optionss = ['parse_mode' => 'html',];
   Bot::sendMessage($text, $optionss);
});
//topup khusus Administator
$mkbot->cmd('/topup', function ($id, $jumlah) {

   $info       = bot::message();
   $msgid      = $info['message_id'];
   $name       = $info['from']['username'];
   $idtelegram = $info['from']['id'];
   Bot::sendChatAction('typing');
   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      if (!empty($id) && !empty($jumlah)) {
         if (has($id) == false) {
            $text = "⚠️ <b>ID Tidak Terdaftar</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ ID yang Anda masukkan tidak terdaftar.\n";
            $text .= "┣━━━━ 📝 Saran ━━━━\n";
            $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
            $text .= "┃ • Pastikan ID tersebut sudah terdaftar\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         } else {

            if (preg_match('/^[0-9]+$/', $jumlah)) {
               if (strlen($jumlah) < 7) {
                  $text = topupresseller($id, $name, $jumlah, $id_own);

                  $kirimpelangan = [
                     'chat_id' => $id,
                     'reply_markup' => json_encode([
                        'inline_keyboard' => [
                           [
                              ['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'],
                              ['text' => '📛 Promo Hot', 'callback_data' => 'informasi'],
                           ],
                        ]
                     ]),
                     'parse_mode' => 'html'

                  ];
                  Bot::sendMessage($text, $kirimpelangan);
               } else {
                  $text = "⚠️ <b>Top Up Melebihi Batas</b>\n\n";
                  $text .= "Maaf, maksimal top up adalah Rp 1.000.000,00.\n";
                  $text .= "Silakan masukkan jumlah yang lebih kecil.";
               }
            } else {
               $text = "⚠️ <b>Input Tidak Valid</b>\n\n";
               $text .= "Maaf, input saldo hanya boleh berupa angka.\n";
               $text .= "Silakan coba lagi dengan format yang benar.";
            }
         }
      } else {
         $text = "⚠️ <b>Format Tidak Valid</b>\n\n";
         $text .= "Format yang benar: /topup (id) (jumlah)\n";
         $text .= "Contoh: <code>/topup 123456 50000</code>";
      }
   } else {
      $text = "🚫 <b>Akses Ditolak</b>\n\n";
      $text .= "Maaf, akses ini hanya untuk Administrator.\n";
      $text .= "Silakan hubungi admin jika Anda memerlukan bantuan.";
   }

   $options = [
      'parse_mode' => 'html'
   ];
   return Bot::sendMessage($text, $options);
});
//lihatsaldo commands
$mkbot->cmd('/lihatsaldo|/ceksaldo', function ($jumlah) {
   include('../config/system.conn.php');
   $info   = bot::message();
   $iduser = $info['from']['id'];
   $msgid  = $info['message_id'];
   $name   = $info['from']['username'];
   $id     = $info['from']['id'];
   $lihat  = lihatuser($id);
   $ids    = $info['chat']['id'];

   if (empty($lihat)) {
      $text = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Anda belum terdaftar di sistem kami.\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ • Silakan daftar terlebih dahulu\n";
      $text .= "┃ • Hubungi admin atau gunakan /daftar\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   } else {
      $angka = lihatsaldo($id);
      $text = "💰 <b>Informasi Saldo</b>\n\n";
      $text .= "┏━━━━ 👤 Detail Pengguna ━━━━\n";
      $text .= "┃ 🆔 ID User : $id\n";
      $text .= "┃ 👤 Nama    : $name\n";
      $text .= "┣━━━━ 💵 Saldo ━━━━\n";
      $text .= "┃ 💰 Jumlah  : " . rupiah($angka) . "\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
   }

   $options = [
      'parse_mode' => 'html'
   ];
   return Bot::sendMessage($text, $options);
});
//resource commands
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
         $text = "📡 <b>Resource Information</b>\n\n";
         $text .= "┏━━━━ 🖥️ System Details ━━━━\n";
         $text .= "┃ 🌡️ Temperature : $sehat°C\n";
         $text .= "┃ 📋 Board Name  : $board\n";
         $text .= "┃ 💻 Platform    : $platform\n";
         $text .= "┃ ⏱️ Uptime      : " . formatDTM($uptime) . "\n";
         $text .= "┣━━━━ 🔧 CPU Information ━━━━\n";
         $text .= "┃ 📊 CPU Load    : $cpuload%\n";
         $text .= "┃ 🔢 CPU Type    : $cpu\n";
         $text .= "┃ ⚡ CPU Speed   : $cpufreq MHz / $cpucount cores\n";
         $text .= "┣━━━━ 💾 Memory Usage ━━━━\n";
         $text .= "┃ 🆓 Free Memory : $fremem\n";
         $text .= "┃ 💽 Total Memory: $memory\n";
         $text .= "┃ 📊 Usage       : $mempersen%\n";
         $text .= "┣━━━━ 💿 Disk Usage ━━━━\n";
         $text .= "┃ 🆓 Free Space  : $frehdd\n";
         $text .= "┃ 💽 Total Space : $hdd\n";
         $text .= "┃ 📊 Usage       : $hddpersen%\n";
         $text .= "┣━━━━ 🔍 Disk Health ━━━━\n";
         $text .= "┃ 🔢 Sectors Written    : $sector\n";
         $text .= "┃ 🔄 Since Reboot       : $setelahreboot\n";
         $text .= "┃ ⚠️ Bad Blocks         : $kerusakan%\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";

         $options = [
               'parse_mode' => 'html'
            ];

         Bot::sendMessage($text, $options);
      }
   } else {
      $text = "🚫 <b>Akses Ditolak</b>\n\n";
      $text .= "Maaf, akses ini hanya untuk Administrator.\n";
      $text .= "Silakan hubungi admin jika Anda memerlukan bantuan.";
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
               $text .= "👤 <b>User Aktif</b>\n\n";
               $text .= "┏━━━━ 🔹 Informasi User ━━━━\n";
               $text .= "┃ 🆔 ID        : $id\n";
               $text .= "┃ 👤 Username  : $user\n";
               $text .= "┃ 🌐 IP Address: $address\n";
               $text .= "┣━━━━ ⏱️ Statistik Waktu ━━━━\n";
               $text .= "┃ 🕒 Uptime    : $uptime\n";
               $text .= "┃ ⏳ Sesi      : $usesstime\n";
               $text .= "┣━━━━ 📊 Statistik Data ━━━━\n";
               $text .= "┃ ⬇️ Byte IN   : $bytesi\n";
               $text .= "┃ ⬆️ Byte OUT  : $byteso\n";
               $text .= "┣━━━━ 🔐 Informasi Login ━━━━\n";
               $text .= "┃ 🔑 Login By  : $loginby\n";
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
               $text .= "👥 <b>Informasi User</b> (ID: $dataid)\n\n";
               $text .= "┏━━━━ 👤 Detail Pengguna ━━━━\n";
               $text .= "┃ 📛 Nama     : $name\n";
               $text .= "┃ 🔑 Password : $data3\n";
               $text .= "┃ 📱 MAC      : $data4\n";
               $text .= "┃ 👤 Profil   : $data5\n";
               $text .= "┣━━━━ 🗑️ Aksi ━━━━\n";
               $text .= "┃ Hapus User: /rEm0v$dataid\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
            }

            $arr2       = str_split($text, 4000);
            $amount_gen = count($arr2);

            for ($i = 0; $i < $amount_gen; $i++) {
               $texta = $arr2[$i];

               Bot::sendMessage($texta);
            }
         } else {
            $text = "📊 <b>Daftar Server Hotspot</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ Pilih server untuk melihat:\n";
            $text .= "┃ • Daftar user\n";
            $text .= "┃ • User aktif\n";
            $text .= "┣━━━━ 🖥️ Server Tersedia ━━━━\n";

            $serverhot = $API->comm('/ip/hotspot/print');

            foreach ($serverhot as $index => $jambu) {
               $sapubasah = str_replace('-', '0', $jambu['name']);
               $sapubasahbasah = str_replace(' ', '11', $sapubasah);
               $text .= "┃ • /see_$sapubasahbasah\n";
            }

            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
            $text .= "Gunakan perintah di atas atau tombol di bawah ini.";

            $keyboard = [
               ['!Hotspot user', '!Hotspot aktif'],
               ['!Menu', '!Help'],
               ['!Hide']
            ];
            $replyMarkup = [
               'keyboard' => $keyboard,
               'resize_keyboard' => true,
               'one_time_keyboard' => true,
               'selective' => true
            ];
            $options = [
               'reply' => true,
               'reply_markup' => json_encode($replyMarkup),
               'parse_mode' => 'html'
            ];
            Bot::sendMessage($text, $options);
         }
      } else {
         $text = "⚠️ <b>Koneksi Gagal</b>\n\n";
         $text .= "Tidak dapat terhubung dengan Mikrotik.\n";
         $text .= "Silakan coba kembali atau hubungi administrator.";
         $options = [
            'reply' => true,
            'parse_mode' => 'html'
         ];
         Bot::sendMessage($text, $options);
      }
   } else {
      $text = "🚫 <b>Akses Ditolak</b>\n\n";
      $text .= "Maaf, akses ini hanya untuk Administrator.\n";
      $text .= "Silakan hubungi admin jika Anda memerlukan bantuan.";
      Bot::sendMessage($text);
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

            foreach ($ARRAY as $index => $baris) {
               $text = "👤 <b>Hotspot Client</b>\n\n";
               $text .= "┏━━━━ 📋 Informasi Akun ━━━━\n";
               $text .= "┃ 📛 Nama     : " . $baris['name'] . "\n";
               $text .= "┃ 🔑 Password : " . $baris['password'] . "\n";
               $text .= "┃ ⏳ Limit    : " . $baris['limit-uptime'] . "\n";
               $text .= "┃ 🕒 Uptime   : " . formatDTM($baris['uptime']) . "\n";
               $text .= "┣━━━━ 📊 Statistik Penggunaan ━━━━\n";
               $text .= "┃ ⬆️ Upload   : " . formatBytes($baris['bytes-in']) . "\n";
               $text .= "┃ ⬇️ Download : " . formatBytes($baris['bytes-out']) . "\n";
               $text .= "┣━━━━ 👤 Profil ━━━━\n";
               $text .= "┃ 📁 Profil   : " . $baris['profile'] . "\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $data   = $baris['.id'];
               $dataid = str_replace('*', 'id', $data);
            }

            foreach ($get as $index => $baris) {
               $experid = "📅 <b>Informasi Waktu</b>\n\n";
               $experid .= "┏━━━━ ⏰ Detail Waktu ━━━━\n";
               $experid .= "┃ 🕐 Mulai    : " . $baris['start-date'] . " " . $baris['start-time'] . "\n";
               $experid .= "┃ 🔄 Interval : " . $baris['interval'] . "\n";
               $experid .= "┃ ⏳ Berakhir : " . $baris['next-run'] . "\n";
               $experid .= "┗━━━━━━━━━━━━━━━━━━━━\n";
            }

            $texta = $text . "\n" . $experid . "\n";
            $texta .= "🗑️ Hapus User: /rEm0v$dataid\n\n";
         }
      }

      $options = ['parse_mode' => 'html',];
      Bot::sendMessage($texta, $options);
   } else {
      $denid = "🚫 <b>Akses Ditolak</b>\n\n";
      $denid .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $denid .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
      $denid .= "┣━━━━ 📝 Saran ━━━━\n";
      $denid .= "┃ • Gunakan akun Administrator\n";
      $denid .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
      $denid .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      
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
      $text .= "<code>      " . date('d-m-Y') . "</code>\n";
      $text .= "=========================\n";
      $text .= "Total Voucher Bulan ini\n";
      $text .= "" . countvoucher() . " Voucher\n";
      $text .= "=========================\n";
      $text .= "Top up Debit Bulan ini\n";
      $text .= "" . rupiah(getcounttopup()) . "\n";
      $text .= "=========================\n";
      $text .= "Mutasi Voucher Bulan ini\n";
      $text .= "" . rupiah(estimasidata()) . "\n";
      $text .= "=========================\n";
      $text .= "User + Bulan ini\n";
      $text .= "+ " . countuser() . " User\n";
      $text .= "=========================\n";
   } else {
      $text = "Maaf..! Aksess Hanya untuk Administator";
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
         $text .= "Daftar Host Netwatch $num\n\n";

         for ($i = 0; $i < $num; $i++) {
            $no       = $i + 1;
            $host     = $ARRAY[$i]['host'];
            $interval = $ARRAY[$i]['interval'];
            $timeout  = $ARRAY[$i]['timeout'];
            $status   = $ARRAY[$i]['status'];
            $since    = $ARRAY[$i]['since'];
            $text .= "📝 Netwatch$no\n";
            $text .= "┠ Host : $host \n";

            if ($status == "up") {
               $text .= "┠ Status : ✔ UP \n";
            } else {
               $text .= "┠ Status : ⚠ Down \n";
            }

            $text .= "┗ Since : $since \n\n";
         }
      } else {
         $text = "Tidak dapat Terhubung dengan Mikrotik Coba Kembali";
      }

      $arr2       = str_split($text, 4000);
      $amount_gen = count($arr2);

      for ($i = 0; $i < $amount_gen; $i++) {
         $texta   = $arr2[$i];
         $options = ['parse_mode' => 'html'];
         Bot::sendMessage($arr2[$i], $options);
      }
   } else {
      $text = "Maaf..! Aksess Hanya untuk Administator";
      Bot::sendMessage($text);
   }
});
//debug message semua
$mkbot->cmd('dbg', function ($pesan) {
   $info    = bot::message();
   $id      = $info['chat']['id'];
   $text    = "<code>" . json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</code>";
   $options = ['parse_mode' => 'html',];
   return Bot::sendMessage($text, $options);
});
//qrcode terjemah qrcode
$mkbot->cmd('/qrcode', function () {
   include('../config/system.conn.php');
   $info        = bot::message();
   $ambilgambar = $info['reply_to_message']['photo'][0]['file_id'];

   if (empty($ambilgambar)) {
      $text = "Balas Gambar/foto QRcode";
      Bot::sendMessage($text);
   } else {
      $cek           = Bot::getFile($ambilgambar);
      $hasilkirimaaa = json_decode($cek, true);
      $hasilurl      = $hasilkirimaaa['result']['file_path'];
      $urlkirim      = 'http://api.qrserver.com/v1/read-qr-code/?fileurl=https://api.telegram.org/file/bot' . $token . '/' . $hasilurl;
      $hasilurla     = file_get_contents($urlkirim);
      $hasilkirim    = json_decode($hasilurla, true);
      $terjemah      = "Hasil Scan QRCODE \n " . $hasilkirim[0]['symbol'][0]['data'];
      return Bot::sendMessage($terjemah);
   }
});
//see_ melihat user aktif
$mkbot->regex('/^\/see_/', function ($matches) {
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   $isipesan     = $info['text'];
   Bot::sendChatAction('typing');
   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      if ($isi == '/see_') {
         $text .= "⛔  Periksa \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan ";
      } else {
         $sapubasah  = str_replace('/see_', '', $isipesan);
         $sapulantai = str_replace('0', '-', $sapubasah);
         $sapuujuk   = str_replace('11', ' ', $sapulantai);
         $sapulidi   = str_replace('@' . $usernamebot . '', '', $sapuujuk);
         $API        = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => $sapulidi]);

            if (empty($pepaya)) {
               $texta = "Tidak ada user aktif server $sapulidi";
               Bot::sendMessage($texta);
            }

            for ($i = 0; $i < count($pepaya); $i++) {
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
               $text .= "👤 <b>User Aktif</b> - Server: $server\n\n";
               $text .= "┏━━━━ 🔹 Informasi User ━━━━\n";
               $text .= "┃ 🆔 ID        : $id\n";
               $text .= "┃ 👤 Username  : $user\n";
               $text .= "┃ 🌐 IP Address: $address\n";
               $text .= "┣━━━━ ⏱️ Statistik Waktu ━━━━\n";
               $text .= "┃ 🕒 Uptime    : $uptime\n";
               $text .= "┃ ⏳ Sesi      : $usesstime\n";
               $text .= "┣━━━━ 📊 Statistik Data ━━━━\n";
               $text .= "┃ ⬇️ Byte IN   : $bytesi\n";
               $text .= "┃ ⬆️ Byte OUT  : $byteso\n";
               $text .= "┣━━━━ 🔐 Informasi Login ━━━━\n";
               $text .= "┃ 🔑 Login By  : $loginby\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";

               Bot::sendMessage($text);
               $total = "Total login $server " . count($pepaya);
               Bot::sendMessage($total);
            }
         }
      }
   } else {
      $denid = "🚫 <b>Akses Ditolak</b>\n\n";
      $denid .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $denid .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
      $denid .= "┣━━━━ 📝 Saran ━━━━\n";
      $denid .= "┃ • Gunakan akun Administrator\n";
      $denid .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
      $denid .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      Bot::sendMessage($denid);
   }
});
$mkbot->regex('/^\/rEm0vid/', function ($matches) {
   $info         = bot::message();
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];
   $isipesan     = $info['text'];
   Bot::sendChatAction('typing');
   $text = "";
   include('../config/system.conn.php');

   if ($idtelegram == $id_own) {
      if ($isipesan == '/rEm0vid') {
         $text .= "⚠️ <b>Gagal Menghapus User</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ ID User tidak ditemukan.\n";
         $text .= "┣━━━━ 📝 Saran ━━━━\n";
         $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
         $text .= "┃ • Pastikan user masih ada dalam sistem\n";
         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      } else {
         $id  = str_replace('/rEm0vid', '*', $isipesan);
         $ids = str_replace('@' . $usernamebot, '', $id);
         $API = new routeros_api();

         if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY  = $API->comm("/ip/hotspot/user/print", ["?.id" => $ids,]);
            $data1  = $ARRAY[0]['.id'];
            $data2  = $ARRAY[0]['name'];
            $data3  = $ARRAY[0]['password'];
            $data5  = $ARRAY[0]['profile'];
            $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $ids,]);
            $texta  = json_encode($ARRAY2);

            if (
               strpos(strtolower($texta), 'no such item') !== false ||
               strpos(strtolower($texta), 'invalid internal item number') !== false ||
               strpos(strtolower($texta), 'default trial user can not be removed') !== false
            ) {
               $gagal = $ARRAY2['!trap'][0]['message'];
               $text = "⚠️ <b>Gagal Menghapus User</b>\n\n";
               $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
               $text .= "┃ $gagal\n";
               $text .= "┣━━━━ 📝 Saran ━━━━\n";
               $text .= "┃ • Periksa kembali ID user\n";
               $text .= "┃ • Pastikan user bukan trial default\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
            } else {
               $text = "✅ <b>User Berhasil Dihapus</b>\n\n";
               $text .= "┏━━━━ 👤 Informasi User ━━━━\n";
               $text .= "┃ 🆔 ID       : $ids\n";
               $text .= "┃ 🖥️ Server   : $data1\n";
               $text .= "┃ 👤 Nama     : $data2\n";
               $text .= "┃ 🔑 Password : $data3\n";
               $text .= "┃ 📁 Profile  : $data5\n";
               $text .= "┣━━━━ 📊 Statistik ━━━━\n";
               sleep(2);
               $ARRAY3 = $API->comm("/ip/hotspot/user/print");
               $jumlah = count($ARRAY3);
               $text .= "┃ 👥 Total user saat ini: $jumlah\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
            }
         } else {
            $text = "⚠️ <b>Koneksi Gagal</b>\n\n";
            $text .= "Tidak dapat terhubung ke router.\n";
            $text .= "Silakan periksa koneksi dan coba lagi.";
    
         }
      }

      $options = ['parse_mode' => 'html',];
      $texta   = json_encode($ARRAY2);
      return Bot::sendMessage($text, $options);
   } else {
      $denid = "🚫 <b>Akses Ditolak</b>\n\n";
      $denid .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $denid .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
      $denid .= "┣━━━━ 📝 Saran ━━━━\n";
      $denid .= "┃ • Gunakan akun Administrator\n";
      $denid .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
      $denid .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      Bot::sendMessage($denid);
   }
});
$mkbot->cmd('!Voucher|!voucher|/Voucher|/voucher', function () {
   $info         = bot::message();
   $ids          = $info['chat']['id'];
   $msgid        = $info['message_id'];
   $nametelegram = $info['from']['username'];
   $idtelegram   = $info['from']['id'];

   $text         = "";
   if (has($idtelegram)) {
      include('../config/system.conn.php');
      $data = json_decode($voucher_1, true);
      if (!empty($data)) {
         $text =. "🎟️ <b>Daftar Voucher</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Silakan pilih voucher di bawah ini:\n";
         $text .= "┣━━━━ 📋 Voucher Tersedia ━━━━\n";

         foreach ($data as $hargas) {
            $textlist = $hargas['Text_List'];
            $text .= "┃ • $textlist\n";
         }

         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";


         for ($i = 0; $i < count($data); $i++) {
            ${'database' . $i}

               = ['text' => $data[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $data[$i]['id'] . ''];
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
         $menu_idakhir = [
            ['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'],
            ['text' => '🔖 iNFORMASI', 'callback_data' => 'informasi'],
         ];

         $send = [];
         array_push($send, $vouchernamea0);
         array_push($send, $vouchernameb1);
         array_push($send, $vouchernamec2);
         array_push($send, $menu_idakhir);

         $options = [
            'reply_markup' => json_encode(['inline_keyboard' => $send]),
            'parse_mode' => 'html'
         ];

         Bot::sendMessage($text, $options);
         unset($data, $voucher_1);
      } else {
         $text = "⚠️ <b>Tidak Ada Voucher</b>\n\n";
         $text .= "Maaf, saat ini tidak ada voucher yang tersedia.\n";
         $text .= "Silakan coba lagi nanti atau hubungi admin.";

         $options = ['parse_mode' => 'html'];
         Bot::sendMessage($text, $options);
      }
   } else {
      $text = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Anda belum terdaftar di sistem kami.\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ • Silakan daftar terlebih dahulu\n";
      $text .= "┃ • Hubungi admin untuk pendaftaran\n";
      $text .= "┃ • Atau gunakan perintah /daftar\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";

      $options = [
         'parse_mode' => 'html',
         'reply_markup' => json_encode([
            'inline_keyboard' => [
               [['text' => '📝 Daftar Sekarang', 'callback_data' => 'daftar']],
               [['text' => '👨‍💼 Hubungi Admin', 'url' => 'https://t.me/username_admin']]
            ]
         ])
      ];

      Bot::sendMessage($text, $options);
   }
});

$mkbot->cmd('!Vouchers|/vouchers|/Vouchers', function () {
   $info              = bot::message();
   $usernamepelanggan = $info['from']['username'];
   $id                = $info['from']['id'];
   $nama              = $info['from']['first_name'];
   include('../config/system.conn.php');
   if ($id == $id_own) {

      $data = json_decode($Voucher_nonsaldo, true);
      $text = "🎉 <b>Selamat Datang, $nama!</b>\n\n";
      $text .= "🎟️ <b>Daftar Voucher</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Silakan pilih voucher di bawah ini:\n";
      $text .= "┣━━━━ 📋 Voucher Tersedia ━━━━\n";

      foreach ($data as $hargas) {
         $textlist = $hargas['Text_List'];
         $text .= "┃ • $textlist\n";
      }

      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";

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
         'reply_markup' => json_encode(['inline_keyboard' => $send]),
         'parse_mode' => 'html'
      ];

      Bot::sendMessage($text, $options);
      unset($data, $voucher_1);
   } else {
      $denid = "🚫 <b>Akses Ditolak</b>\n\n";
      $denid .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $denid .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
      $denid .= "┣━━━━ 📝 Saran ━━━━\n";
      $denid .= "┃ • Gunakan akun Administrator\n";
      $denid .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
      $denid .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      Bot::sendMessage($denid);
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


      if (strpos($command, 'Vcr') !== false) {
         $data  = json_decode($voucher_1, true);
         $cekid = "Vcr" . $data[0]['id'] . ",Vcr" . $data[1]['id'] . ",Vcr" . $data[2]['id'] . ",Vcr" . $data[3]['id'] . ",Vcr" . $data[4]['id'] . ",Vcr" . $data[5]['id'];

         if (preg_match('/' . $command . '/i', $cekid)) {
            $API = new routeros_api();

            foreach ($data as $datas => $getdata) {
               $getid2         = $getdata['id'];
               $princevoc      = $getdata['price'];
               $profile        = $getdata['profile'];
               $length         = $getdata['length'];
               $vouchername    = $getdata['Voucher'];
               $markup         = $getdata['markup'];
               $server         = $getdata['server'];
               $type           = $getdata['type'];
               $typechar       = $getdata['typechar'];
               $Color          = $getdata['Color'];
               $limituptime    = $getdata['Limit'];
               $limit_download = toBytes($getdata['limit_download']);
               $limit_upload   = toBytes($getdata['limit_upload']);
               $limit_total    = toBytes($getdata['limit_total']);

               if ($command == 'Vcr' . $getid2) {
                  if (sisasaldo($id, $princevoc) == true) {
                     $limitsaldo  = "⚠️ <b>Saldo Tidak Mencukupi</b>\n\n";
                     $limitsaldo .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                     $limitsaldo .= "┃ Maaf, saldo Anda tidak mencukupi\n";
                     $limitsaldo .= "┃ untuk melakukan pembelian voucher.\n";
                     $limitsaldo .= "┣━━━━ 💡 Saran ━━━━\n";
                     $limitsaldo .= "┃ • Lakukan top up saldo\n";
                     $limitsaldo .= "┃ • Pilih voucher dengan harga lebih rendah\n";
                     $limitsaldo .= "┃ • Cek saldo Anda dengan perintah /ceksaldo\n";
                     $limitsaldo .= "┗━━━━━━━━━━━━━━━━━━━━\n";

                     $options = [
                        'chat_id' => $chatidtele,
                        'message_id' => (int) $message['message']['message_id'],
                        'text' => $limitsaldo,
                        'reply_markup' => json_encode([
                           'inline_keyboard' => [
                              [
                                 ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                              ],
                           ]
                        ]),
                        'parse_mode' => 'html'

                     ];

                     Bot::editMessageText($options);
                  } else {
                     $sendupdate = "🎟️ <b>Pembelian Voucher</b>\n\n";
                     $sendupdate .= "┏━━━━ 💳 Detail Transaksi ━━━━\n";
                     $sendupdate .= "┃ 💰 Harga    : " . rupiah($princevoc) . "\n";
                     $sendupdate .= "┃ 🆔 ID User  : $id\n";
                     $sendupdate .= "┃ 👤 Username : @$usernamepelanggan\n";
                     $sendupdate .= "┃ 🕒 Status   : ⏳ Pending\n";
                     $sendupdate .= "┣━━━━ ℹ️ Informasi ━━━━\n";
                     $sendupdate .= "┃ Mohon tunggu, voucher sedang diproses.\n";
                     $sendupdate .= "┃ Anda akan menerima notifikasi segera.\n";
                     $sendupdate .= "┗━━━━━━━━━━━━━━━━━━━━\n";

                     $options = [
                        'chat_id' => $chatidtele,
                        'message_id' => (int) $message['message']['message_id'],
                        'text' => $sendupdate,
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

                           $echoexperid .= "┃ ⏳ Expired   : $uptime\n";
                           break;
                     }

                     if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                        $add_user_api = $API->comm("/ip/hotspot/user/add", [
                           "server" => $server,
                           "profile" => $profile,
                           "name" => $usernamereal,
                           "limit-uptime" => $limituptimereal,
                           "limit-bytes-out" => $limit_download,
                           "limit-bytes-in" => $limit_upload,
                           "limit-bytes-total" => $limit_total,
                           "password" => $passwordreal,
                           "comment" => "vc-bot|$usernamepelanggan|$princevoc|" . date('d-m-Y'),
                        ]);

                        if ($type == 'up') {
                           $caption = "🎟️ <b>Detail Voucher (Username & Password)</b>\n\n";
                           $caption .= "┏━━━━ ℹ️ Informasi Voucher ━━━━\n";
                           $caption .= "┃ 🆔 ID         : $add_user_api\n";
                           $caption .= "┃ 👤 Username   : <code>$usernamereal</code>\n";
                           $caption .= "┃ 🔑 Password   : <code>$passwordreal</code>\n";
                           $caption .= "┃ 📁 Profile    : <code>$profile</code>\n";
                           $caption .= $echoexperid;
                           $caption .= "┣━━━━ 📢 Peringatan ━━━━\n";
                           $caption .= "┃ GUNAKAN INTERNET DENGAN BIJAK\n";
                           $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                        } else {
                           $caption = "🎟️ <b>Detail Voucher</b>\n\n";
                           $caption .= "┏━━━━ ℹ️ Informasi Voucher ━━━━\n";
                           $caption .= "┃ 🆔 ID         : $add_user_api\n";
                           $caption .= "┃ 🎫 ID Voucher : <code>$usernamereal</code>\n";
                           $caption .= "┃ 📁 Profile    : $profile\n";
                           $caption .= $echoexperid;
                           $caption .= "┣━━━━ 📢 Peringatan ━━━━\n";
                           $caption .= "┃ GUNAKAN INTERNET DENGAN BIJAK\n";
                           $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                        }

                        //cek apakah ada kesalahan pada setting voucher.
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
                              ['text' => 'Go to Login', 'url' => $url],
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
            }

            if (!empty($ganguan)) {
               //remove User jika terjadi error
               if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                  $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api,]);
               }

               $gagal = "❌ <b>Pembelian Voucher Gagal</b>\n\n";
               $gagal .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $gagal .= "┃ 💰 Harga    : " . rupiah($princevoc) . "\n";
               $gagal .= "┃ 🆔 ID User  : $id\n";
               $gagal .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagal .= "┃ 🚫 Status   : Gagal Terhubung ke Server\n";
               $gagal .= "┣━━━━ ℹ️ Informasi ━━━━\n";
               $gagal .= "┃ Maaf, server sedang mengalami gangguan.\n";
               $gagal .= "┃ Silakan hubungi admin untuk bantuan.\n";
               $gagal .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options = [
                  'chat_id' => $chatidtele,
                  'parse_mode' => 'html'

               ];
               $keterangan = 'gagal';
               Bot::sendMessage($gagal, $options);

               $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
            } elseif (!empty($errorprint)) {

               //remove User jika terjadi error
               if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                  $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $add_user_api,]);
               }

               $gagalprint = "⚠️ <b>Pembelian Voucher Berhasil, Gagal Mencetak</b>\n\n";
               $gagalprint .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $gagalprint .= "┃ 💰 Harga    : " . rupiah($princevoc) . "\n";
               $gagalprint .= "┃ 🆔 ID User  : $id\n";
               $gagalprint .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagalprint .= "┃ 🖨️ Status   : Gagal Mencetak Voucher\n";
               $gagalprint .= "┣━━━━ ℹ️ Informasi ━━━━\n";
               $gagalprint .= "┃ Voucher berhasil dibuat, namun gagal dicetak.\n";
               $gagalprint .= "┃ Admin akan mengirimkan voucher Anda segera.\n";
               $gagalprint .= "┣━━━━ 📞 Bantuan ━━━━\n";
               $gagalprint .= "┃ Silakan hubungi admin untuk informasi lebih lanjut.\n";
               $gagalprint .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options    = ['chat_id' => $chatidtele, 'parse_mode' => 'html'];
               $keterangan = 'gagalprint';
               Bot::sendMessage($gagalprint, $options);

               $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
            } else if (!empty($succes)) {

               $Success = "✅ <b>Pembelian Voucher Berhasil</b>\n\n";
               $Success .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $Success .= "┃ 💰 Harga    : " . rupiah($princevoc) . "\n";
               $Success .= "┃ 🆔 ID User  : $id\n";
               $Success .= "┃ 👤 Username : @$usernamepelanggan\n";
               $Success .= "┃ 🟢 Status   : Berhasil\n";
               $Success .= "┣━━━━ ℹ️ Informasi ━━━━\n";
               $Success .= "┃ Voucher Anda telah berhasil dibuat.\n";
               $Success .= "┃ Silakan cek pesan selanjutnya untuk detail voucher.\n";
               $Success .= "┗━━━━━━━━━━━━━━━━━━━━\n";

               if (isset($Success)) {
                  $saldoawal   = lihatsaldo($id);
                  $keterangan  = 'Success';
                  $markupakhir = minus($princevoc, $markup);
                  $set         = belivoucher($id, $usernamepelanggan, $markupakhir, $markup, $usernamereal, $passwordreal, $profile, $keterangan);
                  $angka       = lihatsaldo($id);
                  $options     = [
                     'chat_id' => $chatidtele,
                     'reply_markup' => json_encode([
                        'inline_keyboard' => [
                           [
                              ['text' => '⏱ History', 'callback_data' => 'VMarkup|' . $princevoc . '|' . $markup . '|' . $markupakhir . '|' . $saldoawal . '|' . $angka . ''],
                              ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                           ], [
                              ['text' => '💰 Cek Saldo', 'callback_data' => 'notifsaldo'],
                           ]
                        ]
                     ]),
                     'parse_mode' => 'html'

                  ];

                  Bot::sendMessage($Success, $options);
               }
            }
         } else {
            $Success = "⚠️ <b>Voucher Tidak Tersedia</b>\n\n";
            $Success .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $Success .= "┃ Maaf, voucher yang Anda pilih sudah tidak tersedia.\n";
            $Success .= "┣━━━━ 💡 Saran ━━━━\n";
            $Success .= "┃ • Silakan pilih voucher lain yang tersedia\n";
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
         $data = json_decode($voucher_1, true);
         $text = "🎟️ <b>Daftar Voucher</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Silakan pilih voucher di bawah ini:\n";
         $text .= "┣━━━━ 📋 Voucher Tersedia ━━━━\n";

         foreach ($data as $hargas) {
            $textlist = $hargas['Text_List'];
            $text .= "┃ • $textlist\n";
         }

         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         $datavoc = json_decode($voucher_1, true);
         for ($i = 0; $i < count($datavoc); $i++) {
            ${'database' . $i} = ['text' => $datavoc[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $datavoc[$i]['id'] . ''];
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

         $menu_idakhir = [
            ['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'],
            ['text' => '🔖 iNFORMASI', 'callback_data' => 'informasi'],
         ];
         $send = [];
         array_push($send, $vouchernamea0);
         array_push($send, $vouchernameb1);
         array_push($send, $vouchernamec2);
         array_push($send, $menu_idakhir);

         $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
            'reply_markup' => json_encode(['inline_keyboard' => $send]),
            'parse_mode' => 'html'

         ];

         Bot::editMessageText($options);
      } elseif ($command == 'Menus') {
         $data = json_decode($Voucher_nonsaldo, true);
         $text = "🎉 <b>Selamat Datang, $nama!</b>\n\n";
         $text .= "🎟️ <b>Daftar Voucher</b>\n\n";
         $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $text .= "┃ Silakan pilih voucher di bawah ini:\n";
         $text .= "┣━━━━ 📋 Voucher Tersedia ━━━━\n";

         foreach ($data as $hargas) {
            $textlist = $hargas['Text_List'];
            $text .= "┃ • $textlist\n";
         }

         $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         for ($i = 0; $i < count($data); $i++) {
            ${'database' . $i} = ['text' => $data[$i]['Voucher'] . '', 'callback_data' => 'nonsalvcr' . $data[$i]['id'] . ''];
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
      } elseif ($command == 'ceksaldo') {
         if (has($id) == false) {
            $text = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ Anda belum terdaftar dalam sistem.\n";
            $text .= "┣━━━━ 📝 Cara Mendaftar ━━━━\n";
            $text .= "┃ • Hubungi admin untuk pendaftaran\n";
            $text .= "┃ • Atau gunakan perintah /daftar\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         } else {
            $angka = lihatsaldo($id);
            $text = "💰 <b>Informasi Saldo</b>\n\n";
            $text .= "┏━━━━ 👤 Detail Akun ━━━━\n";
            $text .= "┃ 🆔 ID User : $id\n";
            $text .= "┃ 👤 Nama    : @$usernamepelanggan\n";
            $text .= "┣━━━━ 💵 Saldo ━━━━\n";
            $text .= "┃ 💰 Jumlah  : " . rupiah($angka) . "\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         }

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
      } elseif ($command == 'informasi') {
         $text = "ℹ️ <b>Informasi Terkini</b>\n\n";
         $text .= "┏━━━━ 📢 Pengumuman ━━━━\n";
         $text .= "┃ Saat ini tidak ada informasi terbaru.\n";
         $text .= "┣━━━━ 💡 Saran ━━━━\n";
         $text .= "┃ • Cek kembali nanti untuk update\n";
         $text .= "┃ • Ikuti channel resmi kami\n";
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
      } elseif (strpos($command, 'nonsalvcr') !== false) {

         $data  = json_decode($Voucher_nonsaldo, true);
         $cekid = "nonsalvcr" . $data[0]['id'] . ",nonsalvcr" . $data[1]['id'] . ",nonsalvcr" . $data[2]['id'] . ",nonsalvcr" . $data[3]['id'] . ",nonsalvcr" . $data[4]['id'] . ",nonsalvcr" . $data[5]['id'];

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

               if ($command == 'nonsalvcr' . $getid2) {
                  $sendupdate = "🎟️ <b>Pembelian Voucher</b>\n\n";
                  $sendupdate .= "┏━━━━ 💳 Detail Transaksi ━━━━\n";
                  $sendupdate .= "┃ 🆔 ID User  : $id\n";
                  $sendupdate .= "┃ 👤 Username : @$usernamepelanggan\n";
                  $sendupdate .= "┃ 🕒 Status   : ⏳ Pending\n";
                  $sendupdate .= "┣━━━━ ℹ️ Informasi ━━━━\n";
                  $sendupdate .= "┃ Mohon tunggu, voucher sedang diproses.\n";
                  $sendupdate .= "┃ Anda akan menerima notifikasi segera.\n";
                  $sendupdate .= "┗━━━━━━━━━━━━━━━━━━━━\n";

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

                        $echoexperid .= "┃ ⏳ Expired   : $uptime\n";
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
                        $caption = "🎟️ <b>Detail Voucher (Username & Password)</b>\n\n";
                        $caption .= "┏━━━━ ℹ️ Informasi Voucher ━━━━\n";
                        $caption .= "┃ 🆔 ID         : $add_user_api\n";
                        $caption .= "┃ 👤 Username   : <code>$usernamereal</code>\n";
                        $caption .= "┃ 🔑 Password   : <code>$passwordreal</code>\n";
                        $caption .= "┃ 📁 Profile    : <code>$profile</code>\n";
                        $caption .= $echoexperid;
                        $caption .= "┣━━━━ 📢 Peringatan ━━━━\n";
                        $caption .= "┃ GUNAKAN INTERNET DENGAN BIJAK\n";
                        $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     } else {
                        $caption = "🎟️ <b>Detail Voucher</b>\n\n";
                        $caption .= "┏━━━━ ℹ️ Informasi Voucher ━━━━\n";
                        $caption .= "┃ 🆔 ID      : $add_user_api\n";
                        $caption .= "┃ 🎫 Voucher : <code>$usernamereal</code>\n";
                        $caption .= "┃ 📁 Profile : <code>$profile</code>\n";
                        $caption .= $echoexperid;
                        $caption .= "┣━━━━ 📢 Peringatan ━━━━\n";
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
                           ['text' => 'Go to Login', 'url' => $url],
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

               $gagal .= "❌ <b>Pembelian Voucher Gagal</b>\n\n";
               $gagal .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $gagal .= "┃ 🆔 ID User  : $id\n";
               $gagal .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagal .= "┃ 🚫 Status   : Gagal Terhubung ke Server\n";
               $gagal .= "┣━━━━ ℹ️ Informasi ━━━━\n";
               $gagal .= "┃ Maaf, server sedang mengalami gangguan.\n";
               $gagal .= "┃ Silakan hubungi admin untuk bantuan.\n";
               $gagal .= "┗━━━━━━━━━━━━━━━━━━━━\n";
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

               $gagalprint .= "";
               $gagalprint .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $gagalprint .= "┃ 🆔 ID User  : $id\n";
               $gagalprint .= "┃ 👤 Username : @$usernamepelanggan\n";
               $gagalprint .= "┃ 🖨️ Status   : Gagal Mencetak Voucher\n";
               $gagalprint .= "┣━━━━ ℹ️ Informasi ━━━━\n";
               $gagalprint .= "┃ Voucher berhasil dibuat, namun gagal dicetak.\n";
               $gagalprint .= "┃ Admin akan mengirimkan voucher Anda segera.\n";
               $gagalprint .= "┣━━━━ 📞 Bantuan ━━━━\n";
               $gagalprint .= "┃ Silakan hubungi admin untuk informasi lebih lanjut.\n";
               $gagalprint .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options    = ['chat_id' => $chatidtele, 'parse_mode' => 'html'];
               $keterangan = 'gagalprintNonSaldo';
               Bot::sendMessage($gagalprint, $options);

               $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
            } else if (!empty($succes)) {

               $Success .= "┏━━━━ 🛒 Detail Transaksi ━━━━\n";
               $Success .= "┃ 🆔 ID User  : $id\n";
               $Success .= "┃ 👤 Username : @$usernamepelanggan\n";
               $Success .= "┃ 🟢 Status   : Berhasil\n";
               $Success .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               $options = [
                  'chat_id' => $chatidtele,
                  'reply_markup' => json_encode([
                     'inline_keyboard' => [
                        [
                           ['text' => 'Back', 'callback_data' => 'Menus'],
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
            $Success = "";
            $Success = "Maaf voucher ini tidak lagi tersedia \n";

            $options = [
               'chat_id' => $chatidtele,
               'parse_mode' => 'html'

            ];

            Bot::sendMessage($Success, $options);
         }
      } elseif (strpos($command, 'tps') !== false) {
         if (preg_match('/^tps/', $command)) {
            $cekdata  = explode('|', $command);
            $cek      = $cekdata[1];
            $text = "💰 <b>Permintaan Deposit Diterima</b>\n\n";
            $text .= "┏━━━━ 📝 Detail Permintaan ━━━━\n";
            $text .= "┃ 👤 Username : @$usernamepelanggan\n";
            $text .= "┃ 💵 Nominal  : " . rupiah($cek) . "\n";
            $text .= "┣━━━━ ℹ️ Instruksi ━━━━\n";
            $text .= "┃ 1. Kirim foto bukti pembayaran\n";
            $text .= "┃ 2. Sertakan caption:\n";
            $text .= "┃    #konfirmasi deposit $cek\n";
            $text .= "┣━━━━ ⏰ Batas Waktu ━━━━\n";
            $text .= "┃ Konfirmasi maks. 2 jam setelah permintaan\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
            $options = [
               'chat_id' => $chatidtele,
               'message_id' => (int) $message['message']['message_id'],
               'text' => $text,
               'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);

            $textsend = "🔔 <b>Permintaan Deposit Baru</b>\n\n";
            $textsend .= "┏━━━━ 👤 Informasi Pengguna ━━━━\n";
            $textsend .= "┃ 🆔 ID User  : <code>$id</code>\n";
            $textsend .= "┃ 👤 Username : @$usernamepelanggan\n";
            $textsend .= "┣━━━━ 💰 Detail Deposit ━━━━\n";
            $textsend .= "┃ 💵 Nominal  : " . rupiah($cek) . "\n";
            $textsend .= "┣━━━━ 📢 Tindakan ━━━━\n";
            $textsend .= "┃ • Tindak lanjuti permintaan\n";
            $textsend .= "┃ • Hubungi pengguna jika perlu\n";
            $textsend .= "┗━━━━━━━━━━━━━━━━━━━━\n";
            $textsend .= "Gunakan tombol di bawah untuk mengisi saldo otomatis:";


            $kirimpelangan = [
               'chat_id' => $id_own,
               'reply_markup' => json_encode([
                  'inline_keyboard' => [
                     [
                        ['text' => 'QUICK TOP UP', 'callback_data' => '12'],
                     ],
                     [
                        ['text' => '' . rupiah($cek) . '', 'callback_data' => 'tp|' . $cek . '|' . $id . '|' . $usernamepelanggan . ''],
                     ],
                     [
                        ['text' => 'OR COSTUM', 'callback_data' => '12'],
                     ],
                     [
                        ['text' => '10000', 'callback_data' => 'tp|10000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '15000', 'callback_data' => 'tp|15000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '20000', 'callback_data' => 'tp|20000|' . $id . '|' . $usernamepelanggan . ''],
                     ],
                     [

                        ['text' => '25000', 'callback_data' => 'tp|25000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '30000', 'callback_data' => 'tp|30000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '50000', 'callback_data' => 'tp|50000|' . $id . '|' . $usernamepelanggan . ''],
                     ],
                     [

                        ['text' => '100000', 'callback_data' => 'tp|100000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '150000', 'callback_data' => 'tp|150000|' . $id . '|' . $usernamepelanggan . ''],
                        ['text' => '200000', 'callback_data' => 'tp|200000|' . $id . '|' . $usernamepelanggan . ''],
                     ],
                     [

                        ['text' => 'Reject Request', 'callback_data' => 'tp|reject|' . $id . '|reject']
                     ],

                  ]
               ]),
               'parse_mode' => 'html'

            ];

            Bot::sendMessage($textsend, $kirimpelangan);
         }
      } elseif (strpos($command, 'tp') !== false) {

         if (preg_match('/^tp/', $command)) {
            $cekdata     = explode('|', $command);
            $cekkodeunik = $cekdata[0];
            $jumlah      = $cekdata[1];
            $iduser      = $cekdata[2];
            $namauser    = $cekdata[3];
            $text        = "";
            if ($jumlah == 'reject') {
               $text = "⏳ <b>Permintaan Deposit Kadaluarsa</b>\n\n";
               $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
               $text .= "┃ Masa tunggu konfirmasi deposit telah habis.\n";
               $text .= "┃ Permintaan deposit Anda telah kadaluarsa.\n";
               $text .= "┣━━━━ ⚠️ Penting ━━━━\n";
               $text .= "┃ Harap konfirmasi deposit maksimal 2 jam\n";
               $text .= "┃ setelah melakukan permintaan deposit.\n";
               $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
               $text .= "Terima kasih atas pengertian Anda.";
               //kirim ke user
               $kirimpelangan = [
                  'chat_id' => $iduser,
                  'parse_mode' => 'html'

               ];
               Bot::sendMessage($text, $kirimpelangan);

               $options = [
                  'chat_id' => $chatidtele,
                  'message_id' => (int) $message['message']['message_id'],
                  'text' => 'Reject Deposit berhasil',
                  'parse_mode' => 'html'
               ];
               Bot::editMessageText($options);
            } else {

               if ($id == $id_own) {
                  if (!empty($iduser) && !empty($jumlah)) {
                     if (has($iduser) == false) {
                        $text = "❌ <b>Data Tidak Ditemukan</b>\n\n";
                        $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                        $text .= "┃ ID: $iduser\n";
                        $text .= "┃ Status: Tidak terdaftar\n";
                        $text .= "┣━━━━ 📝 Saran ━━━━\n";
                        $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
                        $text .= "┃ • Pastikan pengguna sudah terdaftar\n";
                        $text .= "┃ • Hubungi admin jika masalah berlanjut\n";
                        $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     } else {

                        if (preg_match('/^[0-9]+$/', $jumlah)) {
                           if (strlen($jumlah) < 7) {
                              $text = topupresseller($iduser, $namauser, $jumlah, $id_own);

                              //kirim ke user
                              $kirimpelangan = [
                                 'chat_id' => $iduser,
                                 'reply_markup' => json_encode([
                                    'inline_keyboard' => [
                                       [
                                          ['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'],
                                          ['text' => '📛 Promo Hot', 'callback_data' => 'informasi'],
                                       ],
                                    ]
                                 ]),
                                 'parse_mode' => 'html'
                              ];
                              Bot::sendMessage($text, $kirimpelangan);
                              //
                           } else {
                              $text = "⚠️ <b>Batas Maksimal Top Up</b>\n\n";
                              $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                              $text .= "┃ Batas maksimal top up: Rp 1.000.000,00\n";
                              $text .= "┣━━━━ 📝 Saran ━━━━\n";
                              $text .= "┃ • Kurangi jumlah top up Anda\n";
                              $text .= "┃ • Lakukan beberapa kali top up jika diperlukan\n";
                              $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                           }
                        } else {
                           $text = "❌ <b>Format Nominal Salah</b>\n\n";
                           $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                           $text .= "┃ Nominal harus berupa angka\n";
                           $text .= "┣━━━━ 📝 Saran ━━━━\n";
                           $text .= "┃ • Masukkan hanya angka tanpa karakter lain\n";
                           $text .= "┃ • Contoh: 50000 (bukan Rp 50.000)\n";
                           $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                        }
                     }
                  } else {
                     $text = "❌ <b>Format Data Salah</b>\n\n";
                     $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                     $text .= "┃ Format data yang Anda masukkan salah\n";
                     $text .= "┣━━━━ 📝 Saran ━━━━\n";
                     $text .= "┃ • Periksa kembali format input Anda\n";
                     $text .= "┃ • Pastikan Anda mengikuti petunjuk yang diberikan\n";
                     $text .= "┃ • Hubungi admin jika Anda memerlukan bantuan\n";
                     $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                  }
               } else {
                  $text = "🚫 <b>Akses Ditolak</b>\n\n";
                  $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                  $text .= "┃ Maaf, akses ini hanya untuk Administrator.\n";
                  $text .= "┣━━━━ 📝 Saran ━━━━\n";
                  $text .= "┃ • Gunakan akun Administrator\n";
                  $text .= "┃ • Hubungi admin jika Anda memerlukan akses\n";
                  $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               }
               $options = [
                  'chat_id' => $chatidtele,
                  'message_id' => (int) $message['message']['message_id'],
                  'text' => $text,
                  'parse_mode' => 'html'
               ];
               Bot::editMessageText($options);
            }
         }
      } elseif (strpos($command, 'VMarkup') !== false) {
         $cekdata     = explode('|', $command);
         $cekkodeunik = $cekdata[0];
         $princevoc   = $cekdata[1];
         $markup      = $cekdata[2];
         $markupakhir = $cekdata[3];
         $saldoawal   = $cekdata[4];
         $saldo       = $cekdata[5];
         $text        = "";

         if (!empty($princevoc)) {
            $text = "💰 <b>Rincian Transaksi Voucher</b>\n\n";
            $text .= "┏━━━━ 📊 Detail Keuangan ━━━━\n";
            $text .= "┃ 💳 Saldo Awal   : " . rupiah($saldoawal) . "\n";
            $text .= "┃ 🏷️ Harga Voucher : " . rupiah($princevoc) . "\n";
            $text .= "┃ 📈 Total Markup  : " . rupiah($markup) . "\n";
            $text .= "┣━━━━ 🧮 Perhitungan ━━━━\n";
            $text .= "┃ Voucher - Markup:\n";
            $text .= "┃ " . rupiah($princevoc) . " - " . rupiah($markup) . " = " . rupiah($markupakhir) . "\n";
            $text .= "┃ Saldo Awal - Harga Akhir:\n";
            $text .= "┃ " . rupiah($saldoawal) . " - " . rupiah($markupakhir) . " = " . rupiah($saldo) . "\n";
            $text .= "┣━━━━ 💼 Hasil Akhir ━━━━\n";
            $text .= "┃ 💰 Sisa Saldo: " . rupiah($saldo) . "\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         } else {
            $text = "❌ <b>Format Data Salah</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ Maaf, format data yang Anda masukkan salah.\n";
            $text .= "┣━━━━ 📝 Saran ━━━━\n";
            $text .= "┃ • Periksa kembali input Anda\n";
            $text .= "┃ • Pastikan semua data terisi dengan benar\n";
            $text .= "┃ • Hubungi admin jika masalah berlanjut\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         }

         $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
            'reply_markup' => json_encode([
               'inline_keyboard' => [
                  [
                     ['text' => '🔙 Back', 'callback_data' => 'Menu'],
                  ],
               ]
            ]),
            'parse_mode' => 'html'

         ];

         Bot::editMessageText($options);
      } elseif (strpos($command, 'notifsaldo') !== false) {

         if (has($id) == false) {
            $text = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ Anda belum terdaftar di sistem kami.\n";
            $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
            $text .= "┃ • Silakan daftar terlebih dahulu\n";
            $text .= "┃ • Hubungi admin untuk pendaftaran\n";
            $text .= "┃ • Atau gunakan perintah /daftar\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         } else {
            $angka = lihatsaldo($id);
            $text = "💰 <b>Informasi Saldo</b>\n\n";
            $text .= "┏━━━━ 👤 Detail Akun ━━━━\n";
            $text .= "┃ 🆔 ID User : $id\n";
            $text .= "┃ 💵 Saldo   : " . rupiah($angka) . "\n";
            if ($angka < 3000) {
               $text .= "┣━━━━ ⚠️ Peringatan ━━━━\n";
               $text .= "┃ Saldo Anda sudah hampir habis!\n";
               $text .= "┣━━━━ 📝 Saran ━━━━\n";
               $text .= "┃ • Segera isi ulang saldo Anda\n";
               $text .= "┃ • Hubungi admin untuk top up\n";
            }
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         }
         Bot::answerCallbackQuery($text, $options = ['show_alert' => true]);
      }
   } else {
      $text = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
      $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
      $text .= "┃ Anda belum terdaftar di sistem kami.\n";
      $text .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
      $text .= "┃ • Silakan daftar terlebih dahulu\n";
      $text .= "┃ • Hubungi admin untuk pendaftaran\n";
      $text .= "┃ • Atau gunakan perintah /daftar\n";
      $text .= "┗━━━━━━━━━━━━━━━━━━━━\n";
      $options = [
         'chat_id' => $chatidtele,
         'message_id' => (int) $message['message']['message_id'],
         'text' => $text,
      ];
      Bot::editMessageText($options);
   }
});

$mkbot->on('photo', function () {
   $info           = bot::message();
   $nametelegram   = $info['from']['username'];
   $idtelegram     = $info['from']['id'];
   $caption        = strtolower($info['caption']);
   $explode        = explode(' ', $caption);
   $konfirmasitext = $explode['0'];
   $deposittext    = $explode['1'];
   $jumlahtext     = $explode['2'];

   if (!empty($caption)) {
      include('../config/system.conn.php');
      if (has($idtelegram)) {
         //cek kandungan
         if (preg_match('/^#konfirmasi/', $konfirmasitext)) {
            //cek lagi sesuai format
            if ($konfirmasitext == '#konfirmasi' && $deposittext == 'deposit' && !empty($jumlahtext)) {
               if (preg_match('/^[0-9]+$/', $jumlahtext)) {
                  $fototerbaik = $info['photo'][3]['file_id'];
                  $fotomedium  = $info['photo'][2]['file_id'];
                  $fotorendah  = $info['photo'][1]['file_id'];
                  $fotojelek   = $info['photo'][0]['file_id'];
                  $caption = "🔔 <b>Permintaan Deposit Baru</b>\n\n";
                  $caption .= "┏━━━━ 👤 Informasi Pengguna ━━━━\n";
                  $caption .= "┃ 🆔 ID User  : <code>$idtelegram</code>\n";
                  $caption .= "┃ 👤 Username : @$nametelegram\n";
                  $caption .= "┣━━━━ 💰 Detail Deposit ━━━━\n";
                  $caption .= "┃ 💵 Nominal  : " . rupiah($jumlahtext) . "\n";
                  $caption .= "┣━━━━ 📢 Tindakan ━━━━\n";
                  $caption .= "┃ • Tindak lanjuti permintaan\n";
                  $caption .= "┃ • Hubungi pengguna jika perlu\n";
                  $caption .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                  $caption .= "Gunakan tombol di bawah untuk mengisi saldo otomatis:";
                  if (!empty($fototerbaik)) {
                     Bot::sendPhoto($fototerbaik, $options = ['chat_id' => $id_own, 'caption' => $caption, 'parse_mode' => 'html']);
                     $response = "💰 <b>Permintaan Deposit Dikirim</b>\n\n";
                     $response .= "┏━━━━ 📝 Detail Permintaan ━━━━\n";
                     $response .= "┃ 👤 Username : @$usernamepelanggan\n";
                     $response .= "┃ 💵 Nominal  : " . rupiah($jumlahtext) . "\n";
                     $response .= "┣━━━━ ℹ️ Instruksi ━━━━\n";
                     $response .= "┃ 1. Kirim foto bukti pembayaran\n";
                     $response .= "┃ 2. Sertakan caption:\n";
                     $response .= "┃    <code>#konfirmasi deposit $jumlahtext</code>\n";
                     $response .= "┣━━━━ ⏰ Batas Waktu ━━━━\n";
                     $response .= "┃ Konfirmasi maks. 2 jam setelah permintaan\n";
                     $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     Bot::sendMessage($response);
                  } elseif (!empty($fotomedium)) {
                     Bot::sendPhoto($fotomedium, $options = ['chat_id' => $id_own, 'caption' => $caption, 'parse_mode' => 'html']);
                     $response = "💰 <b>Permintaan Deposit Diterima</b>\n\n";
                     $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                     $response .= "┃ Konfirmasi deposit Anda telah kami terima.\n";
                     $response .= "┃ Kami akan segera memproses permintaan Anda.\n";
                     $response .= "┣━━━━ ⏳ Proses ━━━━\n";
                     $response .= "┃ Mohon tunggu beberapa saat.\n";
                     $response .= "┃ Kami akan memberikan notifikasi setelah selesai.\n";
                     $response .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                     $response .= "Terima kasih atas kesabaran Anda.";
                     Bot::sendMessage($response);
                  } elseif (!empty($fotorendah)) {
                     $response = "❌ <b>Foto Tidak Jelas</b>\n\n";
                     $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                     $response .= "┃ Maaf, foto yang Anda kirim tidak jelas.\n";
                     $response .= "┃ Sistem kami tidak dapat membaca foto tersebut.\n";
                     $response .= "┣━━━━ 📝 Saran ━━━━\n";
                     $response .= "┃ • Kirim ulang foto dengan kualitas lebih baik\n";
                     $response .= "┃ • Pastikan foto tidak buram atau terpotong\n";
                     $response .= "┃ • Gunakan pencahayaan yang cukup\n";
                     $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     Bot::sendMessage($response);
                  } else {
                     $response = "❌ <b>Foto Tidak Jelas</b>\n\n";
                     $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                     $response .= "┃ Maaf, foto yang Anda kirim tidak jelas.\n";
                     $response .= "┃ Sistem kami tidak dapat membaca foto tersebut.\n";
                     $response .= "┣━━━━ 📝 Saran ━━━━\n";
                     $response .= "┃ • Kirim ulang foto dengan kualitas lebih baik\n";
                     $response .= "┃ • Pastikan foto tidak buram atau terpotong\n";
                     $response .= "┃ • Gunakan pencahayaan yang cukup\n";
                     $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                     Bot::sendMessage($response);
                  }
               } else {
                  $response = "❌ <b>Format Jumlah Salah</b>\n\n";
                  $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                  $response .= "┃ Jumlah deposit harus berupa angka saja.\n";
                  $response .= "┣━━━━ 📝 Contoh ━━━━\n";
                  $response .= "┃ <code>/deposit 50000</code>\n";
                  $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
                  Bot::sendMessage($response);
               }
            } else {
               $response = "ℹ️ <b>Panduan Konfirmasi Deposit</b>\n\n";
               $response .= "┏━━━━ 📝 Format ━━━━\n";
               $response .= "┃ <code>#konfirmasi deposit [jumlah]</code>\n";
               $response .= "┣━━━━ 📸 Instruksi ━━━━\n";
               $response .= "┃ • Kirim foto bukti transfer\n";
               $response .= "┃ • Sertakan keterangan sesuai format\n";
               $response .= "┣━━━━ 💡 Contoh ━━━━\n";
               $response .= "┃ <code>#konfirmasi deposit 50000</code>\n";
               $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
               Bot::sendMessage($response);
            }
         }
      } else {
         $response = "⚠️ <b>Akun Tidak Terdaftar</b>\n\n";
         $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
         $response .= "┃ Anda belum terdaftar di sistem kami.\n";
         $response .= "┣━━━━ 📝 Langkah Selanjutnya ━━━━\n";
         $response .= "┃ • Silakan daftar terlebih dahulu\n";
         $response .= "┃ • Hubungi admin untuk pendaftaran\n";
         $response .= "┃ • Atau gunakan perintah /daftar\n";
         $response .= "┗━━━━━━━━━━━━━━━━━━━━\n";
         Bot::editMessageText($response);
      }
   }
});
$mkbot->run();

/*Please contact @Bangachil for bugs
history
1 Maret 2019
-Make ceksaldo command
-Make cekid
2 Maret 2019
-Make callback data
-Make menu command
-Make array menu
-Make callback answer
3 Maret 2019
-Make database Saldo
-bugs fix daftar
-bugs fix menu
-bugs fix saldo minus
-bugs fix topup
-Make topup send to ID
-Make button menu
10 Maret 2019
-make emoticon button menu
-make cek id calbback
-make voucher defalut disable
-make voucher null
19 Maret 2019
-bugs fix menu command
-bugs fix callback answer
-bugs fix list Voucher array
-bugs fix database
Version update 1.2.3
20 maret 2019
-Make User id callback
-remove emotion calbback
-remove array_filter
-move data callback
-move ceksaldo
-Make ceksaldo cek id
Version update 1.2.11

2 april 2019
-remove start auto join
-make hitspot view
-make remove user hotspot cmd
-make help cmd
-Make hass user
Version update 1.2.13


3 april 2019
-edited vcr callback data

Version update 1.2.14
8 april 2019
-Penambahan type char 
-color qrcode 
-bugs fix saldo minus
Version update 1.3.00

-10 april 2019
-Perispan nonsaldo
-edit text 
-Version update 1.4.00
11 april 2019

-Version update 1.5.00

14 april 2019
make non saldo 
Thanks to topupGroup an member , SengkuniCode, and to all user support mini project
Thanks to SengkuniCode for web ui,

 */
