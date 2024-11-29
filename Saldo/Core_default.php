<?php

// =====================================================START====================//

/*

   Core_default.php

   Diperbaharui pada 25 Juli 2024 by HexSorcerer

    */

// =====================================================START SCRIPT====================//

date_default_timezone_set('Asia/Jakarta');
include 'src/FrameBot.php';
require_once '../config/system.conn.php';
$mkbot = new FrameBot($token, $usernamebot);
require_once '../config/system.byte.php';
require_once '../Api/routeros_api.class.php';

// Any commands akan di cegah dengan ini jika  perlu silahakan dihapus /* dan  */

/*
   $mkbot->cmd('*', 'Maaf commands tidak tersedia');
    */

// Start commands
$mkbot->cmd('/start|/Start', function () {
    include '../config/system.conn.php';
    $info = bot::message();
    $ids = $info['chat']['id'];
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    if (has($idtelegram) == false) {
        $text = '';
        // Ubah text dibawah ini untuk user yang belum terdaftar
        $text = "👋 <b>Selamat Datang di Layanan Kami!</b>\n\n";
        $text .= "┏━━━━ ℹ️ Status Akun ━━━━\n";
        $text .= "┃ Anda belum terdaftar sebagai pengguna\n";
        $text .= "┃━━━━ 📝 Langkah Selanjutnya ━━━━\n";
        $text .= "┃ Silakan daftar untuk mulai menggunakan\n";
        $text .= "┃ layanan kami\n";
        $text .= "┃━━━━ 🔍 Cara Mendaftar ━━━━\n";
        $text .= "┃ • Ketik /daftar\n";
        $text .= '┗━━━━━━━━━━━━━━━━━━━━';
        $options = [
            'parse_mode' => 'html',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '📞 Hubungi Admin', 'url' => 'https://t.me/ahmadcircleid']],
                ],
            ]),
        ];

        return Bot::sendMessage($text, $options);
    } else {
        $text = "👋 <b>Hai @$nametelegram!</b>\n\n";
        $text .= "┏━━━━ 🌟 Selamat Datang Kembali ━━━━\n";
        $text .= "┃ Senang melihat Anda lagi di layanan kami\n";
        $text .= "┃━━━━ 🔍 Bantuan ━━━━\n";
        $text .= "┃ Gunakan /help untuk melihat daftar bantuan\n";
        $text .= "┃━━━━ 📌 Menu Cepat ━━━━\n";
        $text .= "┃ Pilih menu di bawah untuk akses cepat:\n";
        $text .= '┗━━━━━━━━━━━━━━━━━━━━';
    }

    $options = [
        'parse_mode' => 'html',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo']],
                [['text' => '📦 Beli Voucher', 'callback_data' => 'Menu']],
                [['text' => '📞 Hubungi Admin', 'url' => 'https://t.me/ahmadcircleid']],
            ],
        ]),
    ];

    return Bot::sendMessage($text, $options);
});
// deposit commands
$mkbot->cmd('/deposit|/request', function ($jumlah) {
    include '../config/system.conn.php';
    $info = bot::message();
    $ids = $info['chat']['id'];
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];

    $text = '';

    if (!empty($jumlah)) {
        if (has($idtelegram) == false) {
            // jika user belum terdaftar
            $text = "❌ <b>Anda belum terdaftar</b>\n\n";
            $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
            $text .= "┃ Akun Anda belum terdaftar di sistem\n";
            $text .= "┃━━━━ 📝 Petunjuk ━━━━\n";
            $text .= "┃ Silakan daftar terlebih dahulu\n";
            $text .= "┃ sebelum melakukan request top up\n";
            $text .= "┃━━━━ 🔍 Cara Daftar ━━━━\n";
            $text .= "┃ Ketik atau klik: /daftar\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
            $text .= 'Setelah terdaftar, Anda dapat melakukan request top up saldo.';
        } else {
            if (preg_match('/^[0-9]+$/', $jumlah)) {
                if (strlen($jumlah) < 7) {
                    // jika user belum terdaftar
                    $text = "✅ <b>Permintaan Deposit Diterima</b>\n\n";
                    $text .= "┏━━━━ 📋 Detail Permintaan ━━━━\n";
                    $text .= "┃ 👤 User   : @$nametelegram\n";
                    $text .= '┃ 💰 Jumlah : '.rupiah($jumlah)."\n";
                    $text .= "┃━━━━ 📸 Instruksi ━━━━\n";
                    $text .= "┃ Kirim foto bukti pembayaran\n";
                    $text .= "┃ dengan caption:\n";
                    $text .= "┃ <code>#konfirmasi deposit $jumlah</code>\n";
                    $text .= "┃━━━━ ⏳ Batas Waktu ━━━━\n";
                    $text .= "┃ Konfirmasi maksimal 2 jam\n";
                    $text .= "┃ setelah permintaan deposit\n";
                    $text .= '┗━━━━━━━━━━━━━━━━━━━━';

                    $textsend = "🔔 <b>Permintaan Deposit Baru</b>\n\n";
                    $textsend .= "┏━━━━ 👤 Informasi User ━━━━\n";
                    $textsend .= "┃ Username : @$nametelegram\n";
                    $textsend .= "┃ ID       : <code>$idtelegram</code>\n";
                    $textsend .= "┃━━━━ 💰 Detail Deposit ━━━━\n";
                    $textsend .= '┃ Nominal  : '.rupiah($jumlah)."\n";
                    $textsend .= "┃━━━━ 📝 Tindak Lanjut ━━━━\n";
                    $textsend .= "┃ • Hubungi @$nametelegram\n";
                    $textsend .= "┃ • Atau gunakan tombol di bawah\n";
                    $textsend .= "┃   untuk top up otomatis\n";
                    $textsend .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                    $textsend .= '👇 Tekan tombol untuk top up otomatis';

                    // -===================rubah texnya saja ya
                    $kirimpelangan = [
                        'chat_id' => $id_own,
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [['text' => 'QUICK TOP UP', 'callback_data' => '12']],
                                [['text' => ''.rupiah($jumlah).'', 'callback_data' => 'tp|'.$jumlah.'|'.$idtelegram.'|'.$nametelegram.'']],
                                [['text' => 'OR COSTUM', 'callback_data' => '12']],
                                [['text' => '10000', 'callback_data' => 'tp|10000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '15000', 'callback_data' => 'tp|15000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '20000', 'callback_data' => 'tp|20000|'.$idtelegram.'|'.$nametelegram.'']],
                                [['text' => '25000', 'callback_data' => 'tp|25000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '30000', 'callback_data' => 'tp|30000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '50000', 'callback_data' => 'tp|50000|'.$idtelegram.'|'.$nametelegram.'']],
                                [['text' => '100000', 'callback_data' => 'tp|100000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '150000', 'callback_data' => 'tp|150000|'.$idtelegram.'|'.$nametelegram.''], ['text' => '200000', 'callback_data' => 'tp|200000|'.$idtelegram.'|'.$nametelegram.'']],
                            ],
                        ]),
                        'parse_mode' => 'html',
                    ];

                    Bot::sendMessage($textsend, $kirimpelangan);
                } else {
                    $text = "⚠️ <b>Peringatan: Batas Maksimal</b>\n\n";
                    $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                    $text .= "┃ Deposit melebihi batas maksimal\n";
                    $text .= "┃━━━━ 💰 Batas Maksimal ━━━━\n";
                    $text .= "┃ Rp 1.000.000,00\n";
                    $text .= "┃━━━━ 📝 Saran ━━━━\n";
                    $text .= "┃ Silakan masukkan jumlah yang lebih kecil\n";
                    $text .= '┗━━━━━━━━━━━━━━━━━━━━';
                }
            } else {
                $text = "❌ <b>Input Tidak Valid</b>\n\n";
                $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                $text .= "┃ Input nominal saldo tidak valid\n";
                $text .= "┃━━━━ 📝 Petunjuk ━━━━\n";
                $text .= "┃ • Gunakan hanya angka\n";
                $text .= "┃ • Tanpa titik atau koma\n";
                $text .= "┃━━━━ 🔍 Contoh ━━━━\n";
                $text .= "┃ Benar  : 50000\n";
                $text .= "┃ Salah  : 50.000 atau 50,000\n";
                $text .= '┗━━━━━━━━━━━━━━━━━━━━';
            }
        }
    } else {
        $text .= "💰 <b>Request Deposit Saldo</b>\n\n";
        $text .= "┏━━━━ 📝 Cara Request ━━━━\n";
        $text .= "┃ Gunakan format berikut:\n";
        $text .= "┃ <code>/deposit [nominal]</code>\n";
        $text .= "┃━━━━ 🔍 Contoh ━━━━\n";
        $text .= "┃ • <code>/deposit 10000</code>\n";
        $text .= "┃ • <code>/deposit 50000</code>\n";
        $text .= "┃━━━━ 💡 Alternatif ━━━━\n";
        $text .= "┃ Pilih nominal dari tombol di bawah\n";
        $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
        $text .= '👇 Silakan pilih atau ketik nominal deposit';
        $options = [
            'reply_markup' => json_encode([
                'inline_keyboard' => [[['text' => '⬇ REQUEST ⬇', 'callback_data' => '12']], [['text' => '10000', 'callback_data' => 'tps|10000'], ['text' => '15000', 'callback_data' => 'tps|15000'], ['text' => '20000', 'callback_data' => 'tps|20000']], [['text' => '25000', 'callback_data' => 'tps|25000'], ['text' => '30000', 'callback_data' => 'tps|30000'], ['text' => '50000', 'callback_data' => 'tps|50000']], [['text' => '100000', 'callback_data' => 'tps|100000'], ['text' => '150000', 'callback_data' => 'tps|150000'], ['text' => '200000', 'callback_data' => 'tps|200000']]],
            ]),
            'parse_mode' => 'html',
        ];
    }

    return Bot::sendMessage($text, $options);
});
// cekid commands
$mkbot->cmd('/cekid|/Cekid', function ($jumlah) {
    include '../config/system.conn.php';
    $info = bot::message();
    $iduser = $info['from']['id'];
    $msgid = $info['message_id'];
    $name = $info['from']['username'];
    $id = $info['from']['id'];
    $statusId = has($id);
    $statusStr = $statusId ? '✅ Terdaftar' : '❌ Belum Terdaftar';

    $text = "🔍 <b>Informasi ID Anda</b>\n\n";
    $text .= "┏━ 👤 Detail Pengguna ━\n";
    $text .= "┃ 🆔 ID User  : <code>$id</code>\n";
    $text .= "┃ 👤 Username : @$name\n";
    $text .= "┃ 📊 Status   : $statusStr\n";
    $text .= "┗━━━━━━━━━━━━\n";

    if (!$statusId) {
        $text .= "\n⚠️ Anda belum terdaftar. Gunakan /daftar untuk mendaftar.";
    }

    $options = [
        'parse_mode' => 'html',
    ];

    return Bot::sendMessage($text, $options);
});
// daftar commands
$mkbot->cmd('/daftar', function () {
    include '../config/system.conn.php';
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];

    Bot::sendChatAction('typing');
    $ids = $info['chat']['id'];

    if (empty($nametelegram)) {
        $text = "⚠️ <b>Peringatan</b>\n\n";
        $text .= "Akun Telegram Anda belum memiliki username.\n";
        $text .= 'Silakan atur username Anda terlebih dahulu di pengaturan Telegram.';
    } else {
        if (has($idtelegram) == false) {
            $cek = daftar($idtelegram, $nametelegram);

            if (empty($cek)) {
                $text = "❌ <b>Pendaftaran Gagal</b>\n\n";
                $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                $text .= "┃ Sistem kami sedang mengalami gangguan\n";
                $text .= "┣━━━━ 🔧 Tindak Lanjut ━━━━\n";
                $text .= "┃ Silakan hubungi Administrator\n";
                $text .= "┃ untuk bantuan lebih lanjut\n";
                $text .= '┗━━━━━━━━━━━━━━━━━━━━';
            } else {
                $text = "✅ <b>Pendaftaran Berhasil</b>\n\n";
                $text .= "┏━━━━ 📋 Informasi Akun ━━━━\n";
                $text .= "┃ 🆔 ID User  : <code>$idtelegram</code>\n";
                $text .= "┃ 👤 Username : @$nametelegram\n";
                $text .= "┃ ✅ Status   : Terdaftar\n";
                $text .= "┣━━━━ 💰 Langkah Selanjutnya ━━━━\n";
                $text .= "┃ Silakan isi saldo Anda di outlet kami\n";
                $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                $text .= "🙏 Terima kasih atas kepercayaan Anda\n";
                $text .= 'menggunakan layanan kami.';
            }
        } else {
            $text = "ℹ️ <b>Informasi Akun</b>\n\n";
            $text .= "┏━━━━ 📋 Detail Akun ━━━━\n";
            $text .= "┃ 🆔 ID User  : <code>$idtelegram</code>\n";
            $text .= "┃ 👤 Username : @$nametelegram\n";
            $text .= "┃ ✅ Status   : Terdaftar\n";
            $text .= "┣━━━━ 🔔 Pemberitahuan ━━━━\n";
            $text .= "┃ Anda sudah terdaftar dalam layanan ini\n";
            $text .= '┗━━━━━━━━━━━━━━━━━━━━';
        }
    }

    $options = [
        'parse_mode' => 'html',
    ];

    return Bot::sendMessage($text, $options);
});
// help commands
$mkbot->cmd('/help|!Help', function ($id, $name, $notlp, $saldo) {
    include '../config/system.conn.php';
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    $text = "🔰 <b>Daftar Perintah</b>\n\n";
    $text .= "┏━━━━ 🚀 Perintah Umum ━━━━\n";
    $text .= "┃ 📋 /menu     - Menu Voucher\n";
    $text .= "┃ 📝 /daftar   - Daftar sebagai Member\n";
    $text .= "┃ 💰 /ceksaldo - Cek Saldo Layanan\n";
    $text .= "┃ 🔍 /cekid    - Status User\n";
    $text .= "┃ 📷 /qrcode   - Terjemahkan QR Code\n";
    $text .= "┃ 💳 /deposit  - Permintaan Deposit\n";
    $text .= "┗━━━━━━━━━━━━━━━━━━\n";

    if ($idtelegram == $id_own) {
        $text .= "\n🛡️ <b>Perintah Administrator</b>\n\n";
        $text .= "┏━━━━ 🔧 Admin Tools ━━━━\n";
        $text .= "┃ 🛠️ dbg       - Pesan Debug\n";
        $text .= "┃ 📇 /daftarid - Daftar User Manual\n";
        $text .= "┃ 📉 /topdown  - Kurangi Saldo User\n";
        $text .= "┃ 💸 /topup    - Tambah Saldo User\n";
        $text .= "┃ 🌐 /hotspot  - Monitor Hotspot\n";
        $text .= "┃ 🔌 /ppp      - Monitor PPP\n";
        $text .= "┃ 📡 /resource - Resource Router\n";
        $text .= "┃ 👁️ /netwatch - Netwatch Router\n";
        $text .= "┃ 📊 /report   - Laporan Mikhbotam\n";
        $text .= "┃ ❓ /user     - Cari User Hotspot\n";
        $text .= "┗━━━━━━━━━━━━━━━━━━\n";
    }

    $text .= "\n📌 Ketik atau klik perintah diatas untuk mengakses fitur";

    $optionss = ['parse_mode' => 'html'];
    Bot::sendMessage($text, $optionss);
});
// daftar manual khusus Administator
$mkbot->cmd('/daftarid', function ($id, $name, $notlp, $saldo) {
    include '../config/system.conn.php';
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    if ($idtelegram == $id_own) {
        if (empty($id) && empty($name) && empty($notlp) && empty($saldo)) {
            $text = "❌ <b>Format Salah</b>\n\n";
            $text .= "📝 Mohon masukkan format dengan benar:\n";
            $text .= "<code>/daftarid [id] [nama] [no_telp] [saldo]</code>\n\n";
            $text .= "Contoh:\n<code>/daftarid 123456 John_Doe 081234567890 50000</code>";
        } else {
            $lihat = lihatuser($id);

            if (empty($lihat)) {
                $hasil = daftarid($id, $name, $notlp, $saldo);
                $text = "✅ <b>Pendaftaran Berhasil</b>\n\n";
                $text .= "┏━━━━ 📋 Detail User ━━━━\n";
                $text .= "┃ 🆔 ID User     : <code>$id</code>\n";
                $text .= "┃ 👤 Nama        : $name\n";
                $text .= "┃ 📞 No. Telepon : $notlp\n";
                $text .= '┃ 💰 Saldo Awal  : '.rupiah($saldo)."\n";
                $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";
                $text .= $hasil; // Tambahkan pesan hasil dari fungsi daftarid() jika ada
            } else {
                $text = "⚠️ <b>Peringatan:</b> User Sudah Terdaftar\n\n";
                $text .= "User dengan ID <code>$id</code> sudah terdaftar dalam sistem.\n";
                $text .= 'Silakan periksa kembali atau gunakan ID lain.';
            }
        }
    } else {
        $text = "🚫 <b>Akses Ditolak</b>\n\n";
        $text .= 'Maaf, akses hanya untuk Administrator.';
    }

    $options = [
        'parse_mode' => 'html',
    ];

    return Bot::sendMessage($text, $options);
});
// topdown khusus Administator
$mkbot->cmd('/topdown', function ($id, $jumlahan) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $name = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        if (!empty($id) && !empty($jumlahan)) {
            if (has($id) == false) {
                $text = "❌ <b>Error:</b> ID tidak terdaftar\n\n";
                $text .= 'Silakan periksa kembali ID yang Anda masukkan.';
            } else {
                if (preg_match('/^[0-9]+$/', $jumlahan)) {
                    if (strlen($jumlahan) < 7) {
                        $topdown = topdown($id, $jumlahan);
                        $text = "💸 <b>Informasi Refund</b>\n\n";
                        $text .= "┏━━━━ 📊 Detail Refund ━━━━\n";
                        $text .= "┃ 🆔 ID User     : <code>$id</code>\n";
                        $text .= '┃ 💰 Jumlah      : '.rupiah($jumlahan)."\n";
                        $text .= '┃ 💼 Saldo Akhir : '.rupiah(lihatsaldo($id))."\n";
                        $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";
                        $text .= '✅ Penarikan saldo berhasil dilakukan.';
                    } else {
                        $text = "⚠️ <b>Peringatan:</b> Maksimal Refund\n\n";
                        $text .= 'Maaf, maksimal refund adalah '.rupiah(1000000).'.';
                    }
                } else {
                    $text = "❌ <b>Error:</b> Input Tidak Valid\n\n";
                    $text .= 'Maaf, input jumlah refund hanya boleh berupa angka.';
                }
            }
        } else {
            $text = "❗ <b>Format Salah</b>\n\n";
            $text .= "Gunakan format: <code>/topdown (id) (jumlah)</code>\n";
            $text .= 'Contoh: <code>/topdown 123456 50000</code>';
        }
    } else {
        $text = "🚫 <b>Akses Ditolak</b>\n\n";
        $text .= 'Maaf, akses hanya untuk Administrator.';
    }

    $optionss = ['parse_mode' => 'html'];
    Bot::sendMessage($text, $optionss);
});
// topup khusus Administator
$mkbot->cmd('/topup', function ($id, $jumlah) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $name = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');
    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        if (!empty($id) && !empty($jumlah)) {
            if (has($id) == false) {
                $text = "❌ <b>Error:</b> ID tidak terdaftar\n\n";
                $text .= 'Silakan periksa kembali ID yang Anda masukkan.';
            } else {
                if (preg_match('/^[0-9]+$/', $jumlah)) {
                    if (strlen($jumlah) < 7) {
                        $text = topupresseller($id, $name, $jumlah, $id_own);

                        $kirimpelangan = [
                            'chat_id' => $id,
                            'reply_markup' => json_encode([
                                'inline_keyboard' => [[['text' => '🛒 Beli Voucher', 'callback_data' => 'Menu'], ['text' => '🔥 Promo Hot', 'callback_data' => 'informasi']]],
                            ]),
                            'parse_mode' => 'html',
                        ];
                        Bot::sendMessage($text, $kirimpelangan);
                    } else {
                        $text = "⚠️ <b>Peringatan:</b> Maksimal Top Up\n\n";
                        $text .= 'Maaf, maksimal top up adalah '.rupiah(1000000).'.';
                    }
                } else {
                    $text = "❌ <b>Error:</b> Input Tidak Valid\n\n";
                    $text .= 'Maaf, input saldo hanya boleh berupa angka.';
                }
            }
        } else {
            $text = "❗ <b>Format Salah</b>\n\n";
            $text .= "Gunakan format: <code>/topup (id) (jumlah)</code>\n";
            $text .= 'Contoh: <code>/topup 123456 50000</code>';
        }
    } else {
        $text = "🚫 <b>Akses Ditolak</b>\n\n";
        $text .= 'Maaf, akses hanya untuk Administrator.';
    }

    $options = [
        'parse_mode' => 'html',
    ];

    return Bot::sendMessage($text, $options);
});
// lihatsaldo commands
$mkbot->cmd('/lihatsaldo|/ceksaldo', function ($jumlah) {
    include '../config/system.conn.php';
    $info = bot::message();
    $iduser = $info['from']['id'];
    $msgid = $info['message_id'];
    $name = $info['from']['username'];
    $id = $info['from']['id'];
    $lihat = lihatuser($id);
    $ids = $info['chat']['id'];

    if (empty($lihat)) {
        $text = "❌ <b>Anda belum terdaftar</b>\n\n";
        $text .= 'Silakan daftar terlebih dahulu ke admin atau klik /daftar';
    } else {
        $angka = lihatsaldo($id);
        $text = "💰 <b>Informasi Saldo</b>\n\n";
        $text .= "┏━━━  👤 Detail Pengguna ━━━\n";
        $text .= "┃ 🆔 ID User     : <code>$id</code>\n";
        $text .= "┃ 👤 Nama        : @$name\n";
        $text .= '┃ 💰 Saldo       : <b>'.rupiah($angka)."</b>\n";
        $text .= "┗━━━━━━━━━━━━━━━\n\n";
        if ($angka < 10000) {
            $text .= '⚠️ <i>Saldo Anda sudah menipis. Disarankan melakukan pengisian ulang!</i>';
        } else {
            $text .= '✅ <i>Saldo Anda masih mencukupi.</i>';
        }
    }

    $options = [
        'parse_mode' => 'html',
    ];

    return Bot::sendMessage($text, $options);
});
// resource commands
$mkbot->cmd('/resource|/Resource', function () {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        $API = new routeros_api();

        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $jambu = $API->comm('/system/health/print');
            $dhealth = $jambu['0'];
            $ARRAY = $API->comm('/system/resource/print');
            $jeruk = $ARRAY['0'];
            $memperc = $jeruk['free-memory'] / $jeruk['total-memory'];
            $hddperc = $jeruk['free-hdd-space'] / $jeruk['total-hdd-space'];
            $mem = $memperc * 100;
            $hdd = $hddperc * 100;
            $sehat = $dhealth['temperature'];
            $platform = $jeruk['platform'];
            $board = $jeruk['board-name'];
            $version = $jeruk['version'];
            $architecture = $jeruk['architecture-name'];
            $cpu = $jeruk['cpu'];
            $cpuload = $jeruk['cpu-load'];
            $uptime = $jeruk['uptime'];
            $cpufreq = $jeruk['cpu-frequency'];
            $cpucount = $jeruk['cpu-count'];
            $memory = formatBytes($jeruk['total-memory']);
            $fremem = formatBytes($jeruk['free-memory']);
            $mempersen = number_format($mem, 3);
            $hdd = formatBytes($jeruk['total-hdd-space']);
            $frehdd = formatBytes($jeruk['free-hdd-space']);
            $hddpersen = number_format($hdd, 3);
            $sector = $jeruk['write-sect-total'];
            $setelahreboot = $jeruk['write-sect-since-reboot'];
            $kerusakan = $jeruk['bad-blocks'];

            $text = "📡 <b>Resource Information</b>  🌡️ $sehat°C\n\n";
            $text .= "┏━━━━ 🖥️ System Info ━━━━\n";
            $text .= "┃ 🏷️ Boardname : $board\n";
            $text .= "┃ 🏗️ Platform  : $platform\n";
            $text .= '┃ ⏱️ Uptime    : '.formatDTM($uptime)."\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";

            $text .= "┏━━━━ 💻 CPU Info ━━━━━━\n";
            $text .= "┃ 🔄 CPU Load  : $cpuload%\n";
            $text .= "┃ 💻 CPU Type  : $cpu\n";
            $text .= "┃ ⚡ CPU Freq  : $cpufreq MHz / $cpucount core(s)\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";

            $text .= "┏━━━━ 🧠 Memory Usage ━━━━━\n";
            $text .= "┃ 💾 Total     : $memory\n";
            $text .= "┃ 🆓 Free      : $fremem\n";
            $text .= "┃ 📊 Used      : $mempersen%\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";

            $text .= "┏━━━━ 💽 Disk Usage ━━━━\n";
            $text .= "┃ 💾 Total     : $hdd\n";
            $text .= "┃ 🆓 Free      : $frehdd\n";
            $text .= "┃ 📊 Used      : $hddpersen%\n";
            $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";

            $text .= "┏━━━━━━ 🔧 Disk Health ━━━━\n";
            $text .= "┃ 📝 Write Sectors : $sector\n";
            $text .= "┃ 🔄 Since Reboot  : $setelahreboot\n";
            $text .= "┃ ⚠️ Bad Blocks    : $kerusakan%\n";
            $text .= '┗━━━━━━━━━━━━━━━━━━';
        } else {
            $text = '❌ Gagal terhubung ke Router. Silakan periksa koneksi Anda.';
        }
    } else {
        $text = '🚫 Maaf! Akses hanya untuk Administrator';
    }

    $options = ['parse_mode' => 'html'];
    Bot::sendMessage($text, $options);
});
// Hotspot commands khusus Adminstator
$mkbot->cmd('!Hotspot|?hotspot|/hotspot|/Hotspot|!Hotspot', function ($user, $telo) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        $API = new routeros_api();

        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            if ($user == 'aktif') {
                if ($telo != '') {
                    $pepaya = $API->comm('/ip/hotspot/active/print', ['?server' => ''.$telo.'']);
                    $anggur = count($pepaya);
                    $apel = $API->comm('/ip/hotspot/active/print', ['count-only' => '', '?server' => ''.$telo.'']);
                } else {
                    $pepaya = $API->comm('/ip/hotspot/active/print');
                    $anggur = count($pepaya);
                    $apel = $API->comm('/ip/hotspot/active/print', ['count-only' => '']);
                }

                $text .= "User Aktif $apel item\n\n";

                for ($i = 0; $i < $anggur; ++$i) {
                    $mangga = $pepaya[$i];
                    $id = $mangga['.id'];
                    $server = $mangga['server'];
                    $user = $mangga['user'];
                    $address = $mangga['address'];
                    $mac = $mangga['mac-address'];
                    $uptime = $mangga['uptime'];
                    $usesstime = $mangga['session-time-left'];
                    $bytesi = formatBytes($mangga['bytes-in'], 2);
                    $byteso = formatBytes($mangga['bytes-out'], 2);
                    $loginby = $mangga['login-by'];
                    $comment = $mangga['comment'];
                    $text .= "┏━━━━ 👤 User Aktif ━━━━\n";
                    $text .= "┃ 🆔 ID        : $id\n";
                    $text .= "┃ 👤 User      : $user\n";
                    $text .= "┃ 🌐 IP        : $address\n";
                    $text .= "┃ ⏱️ Uptime    : $uptime\n";
                    $text .= "┃━━━━━━━━ Penggunaan Data ━━━━━━━\n";
                    $text .= "┃ ⬇️ Byte IN   : $bytesi\n";
                    $text .= "┃ ⬆️ Byte OUT  : $byteso\n";
                    $text .= "┃━━━━━━━━━━ Info Sesi ━━━━━━━━━━\n";
                    $text .= "┃ 🕒 Session   : $usesstime\n";
                    $text .= "┃ 🔐 Login     : $loginby\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                    $text .= "🔍 Lihat detail: /see_$server\n\n";
                }

                $arr2 = str_split($text, 4000);
                $amount_gen = count($arr2);

                for ($i = 0; $i < $amount_gen; ++$i) {
                    $texta = $arr2[$i];
                    Bot::sendMessage($texta);
                }
            } elseif ($user == 'user') {
                $ARRAY = $API->comm('/ip/hotspot/user/print');
                $num = count($ARRAY);
                $text = "Total $num User\n\n";

                for ($i = 0; $i < $num; ++$i) {
                    $no = $i;
                    $data = $ARRAY[$i]['.id'];
                    $dataid = str_replace('*', 'id', $data);
                    $server = $ARRAY[$i]['server'];
                    $name = $ARRAY[$i]['name'];
                    $data3 = $ARRAY[$i]['password'];
                    $data4 = $ARRAY[$i]['mac-address'];
                    $data5 = $ARRAY[$i]['profile'];
                    $data6 = $ARRAY[$i]['limit-uptime'];
                    $text .= "┏━━━━ 👥 User Info ━━━━\n";
                    $text .= "┃ 🆔 ID       : $dataid\n";
                    $text .= "┃ 👤 Nama     : $name\n";
                    $text .= "┃ 🔑 Password : $data3\n";
                    $text .= "┃ 📱 MAC      : $data4\n";
                    $text .= "┃ 👥 Profil   : $data5\n";
                    $text .= "┃━━━━━━━━━━ Aksi ━━━━━━━━━━━━━\n";
                    $text .= "┃ 🗑️ Hapus User: /rEm0v$dataid\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━━\n\n";
                }

                $arr2 = str_split($text, 4000);
                $amount_gen = count($arr2);

                for ($i = 0; $i < $amount_gen; ++$i) {
                    $texta = $arr2[$i];

                    Bot::sendMessage($texta);
                }
            } else {
                $text .= "📋 <b>Daftar User Aktif</b>\n";
                $text .= "┏━━━━━━━━━━━━━━━━━━━━━\n";
                $text .= "┃ Filter by server\n";
                $serverhot = $API->comm('/ip/hotspot/print');

                foreach ($serverhot as $index => $jambu) {
                    $sapubasah = str_replace('-', '0', $jambu['name']);
                    $sapubasahbasah = str_replace(' ', '11', $sapubasah);

                    $text .= "┃ 🌐 /see_$sapubasahbasah\n";
                }

                $text .= '┗━━━━━━━━━━━━━━━━━━━━━';

                $keyboard = [['!Hotspot user', '!Hotspot aktif'], ['!Menu', '!Help'], ['!PPP']];
                $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true];
                $options = [
                    'reply' => true,
                    'reply_markup' => json_encode($replyMarkup),
                    'parse_mode' => 'html', // Tambahkan parse_mode untuk mendukung HTML
                ];
                Bot::sendMessage($text, $options);
            }
        } else {
            $text = '❌ Tidak dapat terhubung dengan Mikrotik. Silakan coba kembali.';
            $options = [
                'reply' => true,
            ];
            Bot::sendMessage($text, $options);
        }
    } else {
        $denid = '🚫 Maaf! Akses hanya untuk Administrator';
        Bot::sendMessage($denid);
    }
});
// PPP monitor commands khusus Administrator
$mkbot->cmd('/ppp', function () {
    include '../config/system.conn.php';
    $info = bot::message();
    $idtelegram = $info['from']['id'];
    $chatidtele = $info['chat']['id'];

    try {
        if ($idtelegram == $id_own) {
            $API = new routeros_api();

            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                $pppUsers = $API->comm('/ppp/active/print');

                $text = "📋 <b>Daftar User PPP Aktif</b>\n";
                $text .= "┏━━━━━━━━━━━━━━━━━━━━━\n";

                foreach ($pppUsers as $user) {
                    $address = $user['address'];
                    $bytesIn = $user['bytes-in'];
                    $bytesOut = $user['bytes-out'];
                    $name = $user['name'];
                    $service = $user['service'];
                    $sessionId = $user['session-id'];
                    $uptime = $user['uptime'];

                    // Query terpisah untuk mendapatkan profile
                    $profileData = $API->comm('/ppp/secret/print', [
                       '?name' => $name,
                    ]);
                    $profile = $profileData[0]['profile'] ?? 'N/A';

                    $text .= "┃ 🌐 <b>IP Address:</b> $address\n";
                    $text .= "┃ 👤 <b>Nama:</b> $name\n";
                    $text .= "┃ 📦 <b>Paket:</b> $profile\n";
                    $text .= "┃ 🛠️ <b>Layanan:</b> $service\n";
                    $text .= "┃ 🆔 <b>ID Sesi:</b> $sessionId\n";
                    $text .= '┃ ⏱️ <b>Waktu Aktif:</b> '.formatDTM($uptime)."\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━━\n";
                }

                $options = [
                    'parse_mode' => 'html',
                ];
                Bot::sendMessage($text, $options);
            } else {
                Bot::sendMessage('❌ Tidak dapat terhubung dengan Mikrotik. Silakan coba kembali.');
            }
        } else {
            Bot::sendMessage('🚫 Maaf! Akses hanya untuk Administrator');
        }
    } catch (Exception $e) {
        $text = '❌ Error: '.$e->getMessage();
        Bot::sendMessage($text);
    }
});
// User commands khusus Administator
$mkbot->cmd('?hs|/user|/User|!User|?user|!user|', function ($name) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        $API = new routeros_api();

        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm('/ip/hotspot/user/print', ['?name' => $name]);
            $get = $API->comm('/system/scheduler/print', ['?name' => $name]);

            if (empty($ARRAY)) {
                $texta = '❌ User tidak ditemukan...Untuk mencari rincian user silahkan ketik /user username';
            } else {
                foreach ($ARRAY as $index => $baris) {
                    $text = '';
                    $text .= "┏━━━━ 🌟 Hotspot Client ━━━━\n";
                    $text .= '┃ 👤 Nama     : '.$baris['name']."\n";
                    $text .= '┃ 🔑 Password : '.$baris['password']."\n";
                    $text .= '┃ ⏳ Limit    : '.$baris['limit-uptime']."\n";
                    $text .= '┃ ⏱️ Uptime   : '.formatDTM($baris['uptime'])."\n";
                    $text .= '┃ ⬆️ Upload   : '.formatBytes($baris['bytes-in'])."\n";
                    $text .= '┃ ⬇️ Download : '.formatBytes($baris['bytes-out'])."\n";
                    $text .= '┃ 👥 Profil   : '.$baris['profile']."\n";
                    $data = $baris['.id'];
                    $dataid = str_replace('*', 'id', $data);
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━━━━\n";
                }

                foreach ($get as $index => $baris) {
                    $experid = "┏━━━━ ⏰ Informasi Waktu ━━━━\n";
                    $experid .= '┃ 🕐 Start-time : '.$baris['start-date'].' '.$baris['start-time']."\n";
                    $experid .= '┃ 🔄 Interval   : '.$baris['interval']."\n";
                    $experid .= '┃ 📅 Expired    : '.$baris['next-run']."\n";
                    $experid .= "┗━━━━━━━━━━━━━━━━━━━━━━━\n";
                }

                $texta = $text.$experid."\n🗑️ Hapus User: /rEm0v$dataid\n\n";
            }
        } else {
            $texta = '❌ Tidak dapat terhubung dengan Mikrotik. Silakan coba kembali.';
        }

        $options = ['parse_mode' => 'html'];
        Bot::sendMessage($texta, $options);
    } else {
        $denid = '🚫 Maaf! Akses hanya untuk Administrator';
        Bot::sendMessage($denid);
    }
});
// report commands khusus Administator
$mkbot->cmd('/report', function ($name) {
    $info = bot::message();
    $id = $info['chat']['id'];
    $iduser = $info['from']['id'];
    $msgid = $info['message_id'];
    Bot::sendChatAction('typing');

    if ($idtelegram == $id_own) {
        $text .= '📊 <b>Laporan Bulanan</b> - '.date('d-m-Y')."\n\n";
        $text .= "┏━━━━ 📈 Statistik ━━━━\n";
        $text .= '┃ 🎟️ Total Voucher : '.countvoucher()." Voucher\n";
        $text .= '┃ 💰 Top up Debit  : '.rupiah(getcounttopup())."\n";
        $text .= '┃ 📊 Mutasi Voucher: '.rupiah(estimasidata())."\n";
        $text .= '┃ 👥 User Baru     : + '.countuser()." User\n";
        $text .= "┗━━━━━━━━━━━━━━━━━\n";
    } else {
        $text = '🚫 Maaf! Akses hanya untuk Administrator';
    }

    $options = [
        'parse_mode' => 'html',
    ];
    Bot::sendMessage($text, $options);
});
// netwatch commands khusus Administator
$mkbot->cmd('/netwatch|/Netwatch', function () {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');

    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        $API = new routeros_api();

        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm('/tool/netwatch/print');
            $num = count($ARRAY);
            $text .= "Daftar Host Netwatch $num\n\n";

            for ($i = 0; $i < $num; ++$i) {
                $no = $i + 1;
                $host = $ARRAY[$i]['host'];
                $interval = $ARRAY[$i]['interval'];
                $timeout = $ARRAY[$i]['timeout'];
                $status = $ARRAY[$i]['status'];
                $since = $ARRAY[$i]['since'];
                $text .= "┏━━━━━━━ 🖥️ Netwatch $no ━━━━━━━\n";
                $text .= "┃ 🌐 Host   : $host\n";
                $text .= '┃ 🕒 Status : ';

                if ($status == 'up') {
                    $text .= "✅ UP\n";
                } else {
                    $text .= "⚠️ Down\n";
                }

                $text .= "┃ 🕰️ Since  : $since\n";
                $text .= "┗━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            }
        } else {
            $text = '❌ Tidak dapat terhubung dengan Mikrotik. Silakan coba kembali.';
        }

        $arr2 = str_split($text, 4000);
        $amount_gen = count($arr2);

        for ($i = 0; $i < $amount_gen; ++$i) {
            $texta = $arr2[$i];
            $options = ['parse_mode' => 'html'];
            Bot::sendMessage($arr2[$i], $options);
        }
    } else {
        $text = '🚫 Maaf! Akses hanya untuk Administrator';
        Bot::sendMessage($text);
    }
});
// debug message semua
$mkbot->cmd('dbg', function ($pesan) {
    $info = bot::message();
    $id = $info['chat']['id'];
    $text = '<code>'.json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).'</code>';
    $options = ['parse_mode' => 'html'];

    return Bot::sendMessage($text, $options);
});
// qrcode terjemah qrcode
$mkbot->cmd('/qrcode', function () {
    include '../config/system.conn.php';
    $info = bot::message();
    $ambilgambar = $info['reply_to_message']['photo'][0]['file_id'];

    if (empty($ambilgambar)) {
        $text = '📸 Silakan balas pesan ini dengan gambar/foto QR code yang ingin Anda scan.';
        Bot::sendMessage($text);
    } else {
        $cek = Bot::getFile($ambilgambar);
        $hasilkirimaaa = json_decode($cek, true);
        $hasilurl = $hasilkirimaaa['result']['file_path'];
        $urlkirim = 'http://api.qrserver.com/v1/read-qr-code/?fileurl=https://api.telegram.org/file/bot'.$token.'/'.$hasilurl;
        $hasilurla = file_get_contents($urlkirim);
        $hasilkirim = json_decode($hasilurla, true);

        $terjemah = "🔍 <b>Hasil Scan QR Code</b>\n\n";
        $terjemah .= "┏━━━━ 📊 Informasi ━━━━\n";
        $terjemah .= '┃ 📝 Isi : '.$hasilkirim[0]['symbol'][0]['data']."\n";
        $terjemah .= "┗━━━━━━━━━━━━━━━━━\n";

        $options = [
            'parse_mode' => 'html',
        ];

        return Bot::sendMessage($terjemah, $options);
    }
});
// see_ melihat user aktif
$mkbot->regex('/^\/see_/', function ($matches) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    $isipesan = $info['text'];
    Bot::sendChatAction('typing');
    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        if ($isi == '/see_') {
            $text = "⚠️ <b>Periksa</b>\n\n<b>KETERANGAN:</b> Tidak Ditemukan";
        } else {
            $sapubasah = str_replace('/see_', '', $isipesan);
            $sapulantai = str_replace('0', '-', $sapubasah);
            $sapuujuk = str_replace('11', ' ', $sapulantai);
            $sapulidi = str_replace('@'.$usernamebot.'', '', $sapuujuk);
            $API = new routeros_api();

            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                $pepaya = $API->comm('/ip/hotspot/active/print', ['?server' => $sapulidi]);

                if (empty($pepaya)) {
                    $texta = "Tidak ada user aktif server $sapulidi";
                    Bot::sendMessage($texta);
                }

                for ($i = 0; $i < count($pepaya); ++$i) {
                    $mangga = $pepaya[$i];
                    $id = $mangga['.id'];
                    $server = $mangga['server'];
                    $user = $mangga['user'];
                    $address = $mangga['address'];
                    $mac = $mangga['mac-address'];
                    $uptime = $mangga['uptime'];
                    $usesstime = $mangga['session-time-left'];
                    $bytesi = formatBytes($mangga['bytes-in'], 2);
                    $byteso = formatBytes($mangga['bytes-out'], 2);
                    $loginby = $mangga['login-by'];
                    $comment = $mangga['comment'];
                    $text .= "┏━━━━ 👤 User Aktif ━━━━\n";
                    $text .= "┃ 🆔 ID        : $id\n";
                    $text .= "┃ 👤 User      : $user\n";
                    $text .= "┃ 🌐 IP        : $address\n";
                    $text .= "┃ ⏱️ Uptime    : $uptime\n";
                    $text .= "┃━━━━━━━━ Penggunaan Data ━━━━━━━\n";
                    $text .= "┃ ⬇️ Byte IN   : $bytesi\n";
                    $text .= "┃ ⬆️ Byte OUT  : $byteso\n";
                    $text .= "┃━━━━━━━━━━ Info Sesi ━━━━━━━━━━\n";
                    $text .= "┃ 🕒 Session   : $usesstime\n";
                    $text .= "┃ 🔐 Login     : $loginby\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                }
                $text .= "📊 Total login di $server: ".count($pepaya)." user\n";
            } else {
                $text = '❌ Tidak dapat terhubung dengan Mikrotik. Silakan coba kembali.';
            }
        }
        $options = [
            'parse_mode' => 'html',
        ];
        Bot::sendMessage($text, $options);
    } else {
        $denid = '🚫 Maaf! Akses hanya untuk Administrator';
        Bot::sendMessage($denid);
    }
});
$mkbot->regex('/^\/rEm0vid/', function ($matches) {
    $info = bot::message();
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    $isipesan = $info['text'];
    Bot::sendChatAction('typing');
    $text = '';
    include '../config/system.conn.php';

    if ($idtelegram == $id_own) {
        if ($isipesan == '/rEm0vid') {
            $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan Id User";
        } else {
            $id = str_replace('/rEm0vid', '*', $isipesan);
            $ids = str_replace('@'.$usernamebot, '', $id);
            $API = new routeros_api();

            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                $ARRAY = $API->comm('/ip/hotspot/user/print', ['?.id' => $ids]);
                $data1 = $ARRAY[0]['.id'];
                $data2 = $ARRAY[0]['name'];
                $data3 = $ARRAY[0]['password'];
                $data5 = $ARRAY[0]['profile'];
                $ARRAY2 = $API->comm('/ip/hotspot/user/remove', ['numbers' => $ids]);
                $texta = json_encode($ARRAY2);

                if (strpos(strtolower($texta), 'no such item') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } elseif (strpos(strtolower($texta), 'invalid internal item number') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } elseif (strpos(strtolower($texta), 'default trial user can not be removed') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } else {
                    $text .= "✅ Berhasil Dihapus\n\n";
                    $text .= "┏━━━━ 👤 User Info ━━━━\n";
                    $text .= "┃ 🆔 ID       : $ids\n";
                    $text .= "┃ 🖥️ Server   : $data1\n";
                    $text .= "┃ 👤 Nama     : $data2\n";
                    $text .= "┃ 🔑 Password : $data3\n";
                    $text .= "┃ 👥 Profil   : $data5\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━\n\n";
                    sleep(2);
                    $ARRAY3 = $API->comm('/ip/hotspot/user/print');
                    $jumlah = count($ARRAY3);
                    $text .= "📊 Jumlah user saat ini: $jumlah user";
                }
            } else {
                $text = '❌ Gagal terhubung ke Router. Silakan periksa koneksi Anda.';
            }
        }

        $options = ['parse_mode' => 'html'];
        $texta = json_encode($ARRAY2);

        return Bot::sendMessage($text, $options);
    } else {
        $denid = '🚫 Maaf! Akses hanya untuk Administrator';
        Bot::sendMessage($denid);
    }
});
$mkbot->cmd('!Menu|/Menu|/menu', function () {
    $info = bot::message();
    $ids = $info['chat']['id'];
    $msgid = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];

    $text = '';
    if (has($idtelegram)) {
        include '../config/system.conn.php';
        $data = json_decode($voucher_1, true);
        if (!empty($data)) {
            $text .= "🎫 <b>Daftar Voucher</b>\n\n";
            $text .= "<i>Silakan pilih voucher di bawah ini:</i>\n\n";
            $text .= "📋 <b>Daftar Voucher:</b>\n";

            foreach ($data as $hargas) {
                $textlist = $hargas['Text_List'];

                $text .= "<code>$textlist  </code>\n";
            }

            for ($i = 0; $i < count($data); ++$i) {
                ${'database'.$i} = ['text' => $data[$i]['Voucher'].'', 'callback_data' => 'Vcr'.$data[$i]['id'].''];
            }

            $vouchernamea0 = array_filter([$database0, $database1]);

            $vouchernameb1 = array_filter([$database2, $database3]);

            $vouchernamec2 = array_filter([$database4, $database5]);
            $menu_idakhir = [['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'], ['text' => '🔖 Informasi', 'callback_data' => 'informasi']];

            $send = [];
            array_push($send, $vouchernamea0);
            array_push($send, $vouchernameb1);
            array_push($send, $vouchernamec2);
            array_push($send, $menu_idakhir);

            $options = [
                'reply_markup' => json_encode(['inline_keyboard' => $send]),
                'parse_mode' => 'html',
            ];

            Bot::sendMessage($text, $options);
            unset($data, $voucher_1);
        } else {
            Bot::sendMessage('❌ Maaf, sistem tidak memiliki voucher saat ini.');
        }
    } else {
        $text = "⚠️ Anda belum terdaftar.\n\n";
        $text .= 'Silakan daftar terlebih dahulu ke admin atau klik /daftar';
        Bot::sendMessage($text);
    }
});
$mkbot->on('callback', function ($command) {
    $message = Bot::message();
    $id = $message['from']['id'];
    $usernamepelanggan = $message['from']['username'];
    $namatele = $message['from']['first_name'];
    $chatidtele = $message['message']['chat']['id'];
    $message_idtele = $message['message']['message_id'];

    include '../config/system.conn.php';

    if (has($id)) {
        if (strpos($command, 'Vcr') !== false) {
            $data = json_decode($voucher_1, true);
            $cekid = 'Vcr'.$data[0]['id'].',Vcr'.$data[1]['id'].',Vcr'.$data[2]['id'].',Vcr'.$data[3]['id'].',Vcr'.$data[4]['id'].',Vcr'.$data[5]['id'];

            if (preg_match('/'.$command.'/i', $cekid)) {
                $API = new routeros_api();

                foreach ($data as $datas => $getdata) {
                    $getid2 = $getdata['id'];
                    $princevoc = $getdata['price'];
                    $profile = $getdata['profile'];
                    $length = $getdata['length'];
                    $vouchername = $getdata['Voucher'];
                    $markup = $getdata['markup'];
                    $server = $getdata['server'];
                    $type = $getdata['type'];
                    $typechar = $getdata['typechar'];
                    $Color = $getdata['Color'];
                    $limituptime = $getdata['Limit'];
                    $limit_download = toBytes($getdata['limit_download']);
                    $limit_upload = toBytes($getdata['limit_upload']);
                    $limit_total = toBytes($getdata['limit_total']);

                    if ($command == 'Vcr'.$getid2) {
                        if (sisasaldo($id, $princevoc) == true) {
                            $limitsaldo = "⚠️ Maaf, saldo Anda tidak mencukupi untuk membeli voucher.\n";

                            $options = [
                                'chat_id' => $chatidtele,
                                'message_id' => (int) $message['message']['message_id'],
                                'text' => $limitsaldo,
                                'reply_markup' => json_encode([
                                    'inline_keyboard' => [[['text' => '🔙 Back', 'callback_data' => 'Menu']]],
                                ]),
                                'parse_mode' => 'html',
                            ];

                            Bot::editMessageText($options);
                        } else {
                            $sendupdate = '';
                            $sendupdate .= "┏━━━━━━━━━━━━━━━━━━━━━━━━\n";
                            $sendupdate .= "┃  🎫 Beli Voucher       \n";
                            $sendupdate .= "┃━━━━━━━━━━━━━━━━━━━━━━━━\n";
                            $sendupdate .= '┃ 💰 Harga   : '.rupiah($princevoc)."\n";
                            $sendupdate .= "┃ 🆔 ID User : $id\n";
                            $sendupdate .= "┃ 👤 Username: @$usernamepelanggan\n";
                            $sendupdate .= "┃ ⏳ Status  : Pending   \n";
                            $sendupdate .= "┗━━━━━━━━━━━━━━━━━━━━━━━━\n";
                            $sendupdate .= "⏳ Mohon ditunggu, Voucher akan segera dibuat\n";

                            $options = [
                                'chat_id' => $chatidtele,
                                'message_id' => (int) $message['message']['message_id'],
                                'text' => $sendupdate,
                                'parse_mode' => 'html',
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
                                $add_user_api = $API->comm('/ip/hotspot/user/add', [
                                    'server' => $server,
                                    'profile' => $profile,
                                    'name' => $usernamereal,
                                    'limit-uptime' => $limituptimereal,
                                    'limit-bytes-out' => $limit_upload,
                                    'limit-bytes-in' => $limit_download,
                                    'limit-bytes-total' => $limit_total,
                                    'password' => $passwordreal,
                                    'comment' => "vc-bot|$usernamepelanggan|$princevoc|".date('d-m-Y'),
                                ]);

                                if ($type == 'up') {
                                    $caption = '';
                                    $caption .= "┏━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃  🎫 Informasi Voucher     \n";
                                    $caption .= "┃━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃ 🆔 ID       : $add_user_api\n";
                                    $caption .= "┃ 👤 Username : <code>$usernamereal</code>\n";
                                    $caption .= "┃ 🔑 Password : <code>$passwordreal</code>\n";
                                    $caption .= "┃ 📦 Paket    : $profile\n";
                                    $caption .= $echoexperid;
                                    $caption .= "┃━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃ 🌐 GUNAKAN INTERNET DGN BIJAK\n";
                                    $caption .= "┗━━━━━━━━━━━━━━━━━\n";
                                } else {
                                    $caption = '';
                                    $caption .= "┏━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃  🎫 Informasi Voucher     \n";
                                    $caption .= "┃━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃ 🆔 ID      : $add_user_api\n";
                                    $caption .= "┃ 🎟️ Voucher : <code>$usernamereal</code>\n";
                                    $caption .= "┃ 📦 Paket   : $profile\n";
                                    $caption .= $echoexperid;
                                    $caption .= "┃━━━━━━━━━━━━━━━━━\n";
                                    $caption .= "┃ 🌐 GUNAKAN INTERNET DGN BIJAK\n";
                                    $caption .= "┗━━━━━━━━━━━━━━━━━\n";
                                }

                                // cek apakah ada kesalahan pada setting voucher.
                                $cekvalidasiadd = json_encode($add_user_api);

                                if (strpos(strtolower($cekvalidasiadd), '!trap')) {
                                    // salah maka bot akan dianggap salah
                                    $ganguan = true;
                                } else {
                                    // benar maka bot akan send voucher

                                    // cek dnsname sudah ada http belum?
                                    if (strpos($dnsname, 'http://') !== false) {
                                        $url = "$dnsname/login?username=$usernamereal&password=$passwordreal";
                                    } else {
                                        $url = "http://$dnsname/login?username=$usernamereal&password=$passwordreal";
                                    }

                                    $qrcode = 'http://qrickit.com/api/qr.php?d='.urlencode($url).'&addtext='.urlencode($Name_router).'&txtcolor=000000&fgdcolor='.$Color.'&bgdcolor=FFFFFF&qrsize=500';
                                    $keyboard[] = [['text' => 'Go to Login', 'url' => $url]];

                                    $options = [
                                        'chat_id' => $chatidtele,
                                        'caption' => $caption,
                                        'reply_markup' => ['inline_keyboard' => $keyboard],
                                        'parse_mode' => 'html',
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
                    // remove User jika terjadi error
                    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                        $ARRAY2 = $API->comm('/ip/hotspot/user/remove', ['numbers' => $add_user_api]);
                    }

                    $gagal .= "┏━━━━━━━━━━━━━━━━━\n";
                    $gagal .= "┃  ❌ Beli Voucher Gagal     \n";
                    $gagal .= "┃━━━━━━━━━━━━━━━━━\n";
                    $gagal .= '┃ 💰 Harga    : '.rupiah($princevoc)."\n";
                    $gagal .= "┃ 🆔 ID User  : $id\n";
                    $gagal .= "┃ 👤 Username : @$usernamepelanggan\n";
                    $gagal .= "┃ ⚠️ Status    : Gagal Koneksi Server\n";
                    $gagal .= "┃━━━━━━━━━━━━━━━━━\n";
                    $gagal .= "┃ Maaf, server sedang gangguan\n";
                    $gagal .= "┃ Silakan hubungi admin.\n";
                    $gagal .= "┗━━━━━━━━━━━━━━━━━\n";
                    $options = [
                        'chat_id' => $chatidtele,
                        'parse_mode' => 'html',
                    ];
                    $keterangan = 'gagal';
                    Bot::sendMessage($gagal, $options);

                    $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
                } elseif (!empty($errorprint)) {
                    // remove User jika terjadi error
                    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                        $ARRAY2 = $API->comm('/ip/hotspot/user/remove', ['numbers' => $add_user_api]);
                    }

                    $gagalprint .= "┏━━━━━━━━━━━━━━━━━\n";
                    $gagalprint .= "┃  ❌ Beli Voucher Gagal     \n";
                    $gagalprint .= "┃━━━━━━━━━━━━━━━━━\n";
                    $gagalprint .= '┃ 💰 Harga    : '.rupiah($princevoc)."\n";
                    $gagalprint .= "┃ 🆔 ID User  : $id\n";
                    $gagalprint .= "┃ 👤 Username : @$usernamepelanggan\n";
                    $gagalprint .= "┃ ⚠️ Status    : Gagal Cetak Voucher\n";
                    $gagalprint .= "┃━━━━━━━━━━━━━━━━━\n";
                    $gagalprint .= "┃ Maaf, server sedang gangguan\n";
                    $gagalprint .= "┃ Silakan hubungi admin.\n";
                    $gagalprint .= "┗━━━━━━━━━━━━━━━━━\n";
                    $options = ['chat_id' => $chatidtele, 'parse_mode' => 'html'];
                    $keterangan = 'gagalprint';
                    Bot::sendMessage($gagalprint, $options);

                    $set = belivoucher($id, $usernamepelanggan, '0', '0', $usernamereal, $passwordreal, $profile, $keterangan);
                } elseif (!empty($succes)) {
                    $Success = '';
                    $Success .= "┏━━━━━━━━━━━━━━━━━\n";
                    $Success .= "┃  ✅ Beli Voucher Berhasil  \n";
                    $Success .= "┃━━━━━━━━━━━━━━━━━\n";
                    $Success .= '┃ 💰 Harga    : '.rupiah($princevoc)."\n";
                    $Success .= "┃ 🆔 ID User  : $id\n";
                    $Success .= "┃ 👤 Username : @$usernamepelanggan\n";
                    $Success .= "┃ ✅ Status   : Berhasil\n";
                    $Success .= "┗━━━━━━━━━━━━━━━━━\n";

                    if (isset($Success)) {
                        $saldoawal = lihatsaldo($id);
                        $keterangan = 'Success';
                        $markupakhir = minus($princevoc, $markup);
                        $set = belivoucher($id, $usernamepelanggan, $markupakhir, $markup, $usernamereal, $passwordreal, $profile, $keterangan);
                        $angka = lihatsaldo($id);
                        $options = [
                            'chat_id' => $chatidtele,
                            'reply_markup' => json_encode([
                                'inline_keyboard' => [[['text' => '⏱ History', 'callback_data' => 'VMarkup|'.$princevoc.'|'.$markup.'|'.$markupakhir.'|'.$saldoawal.'|'.$angka.''], ['text' => '🔙 Back', 'callback_data' => 'Menu']], [['text' => '💰 Cek Saldo', 'callback_data' => 'notifsaldo']]],
                            ]),
                            'parse_mode' => 'html',
                        ];

                        Bot::sendMessage($Success, $options);
                    }
                }
            } else {
                $Success = '';
                $Success .= "┏━━━━━━━━━━━━━━━━━\n";
                $Success .= "┃  ⚠️ Voucher Tidak Tersedia \n";
                $Success .= "┃━━━━━━━━━━━━━━━━━\n";
                $Success .= "┃ Maaf, voucher ini tidak    \n";
                $Success .= "┃ lagi tersedia.             \n";
                $Success .= "┃                            \n";
                $Success .= "┃ Silakan pilih voucher lain \n";
                $Success .= "┃ atau hubungi admin.        \n";
                $Success .= "┗━━━━━━━━━━━━━━━━━\n";

                $options = [
                    'chat_id' => $chatidtele,
                    'parse_mode' => 'html',
                ];

                Bot::sendMessage($Success, $options);
            }
        } elseif ($command == 'Menu') {
            $text = '';
            $data = json_decode($voucher_1, true);
            $text = "┏━━━━━━━━━━━━━━━━━\n";
            $text .= "┃  🎫 Daftar Voucher         \n";
            $text .= "┃━━━━━━━━━━━━━━━━━\n";
            $text .= "┃ Silakan pilih voucher:     \n";
            $text .= "┃                            \n";
            $data = json_decode($voucher_1, true);
            foreach ($data as $hargas) {
                $textlist = $hargas['Text_List'];
                $text .= "┃ • $textlist\n";
            }
            $text .= "┗━━━━━━━━━━━━━━━━━\n";

            $datavoc = json_decode($voucher_1, true);
            for ($i = 0; $i < count($datavoc); ++$i) {
                ${'database'.$i} = ['text' => $datavoc[$i]['Voucher'].'', 'callback_data' => 'Vcr'.$datavoc[$i]['id'].''];
            }

            $vouchernamea0 = array_filter([$database0, $database1]);

            $vouchernameb1 = array_filter([$database2, $database3]);

            $vouchernamec2 = array_filter([$database4, $database5]);

            $menu_idakhir = [['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'], ['text' => '🔖 Informasi', 'callback_data' => 'informasi']];
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
                'parse_mode' => 'html',
            ];

            Bot::editMessageText($options);
        } elseif ($command == 'ceksaldo') {
            if (has($id) == false) {
                $text = "┏━━━━━━━━━━━━━━━━━\n";
                $text .= "┃  ⚠️ Pengguna Tidak Terdaftar\n";
                $text .= "┃━━━━━━━━━━━━━━━━━\n";
                $text .= "┃ Anda belum terdaftar.      \n";
                $text .= "┃ Silakan daftar ke admin    \n";
                $text .= "┃ atau klik /daftar          \n";
                $text .= "┗━━━━━━━━━━━━━━━━━\n";
            } else {
                $angka = lihatsaldo($id);
                $text = "┏━━━━━━━━━━━━━━━━━\n";
                $text .= "┃  💰 Informasi Saldo        \n";
                $text .= "┃━━━━━━━━━━━━━━━━━\n";
                $text .= "┃ 🆔 ID User : $id\n";
                $text .= "┃ 👤 Nama    : @$usernamepelanggan\n";
                $text .= '┃ 💵 Saldo   : '.rupiah($angka)."\n";
                $text .= "┗━━━━━━━━━━━━━━━━━\n";
            }

            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [[['text' => '🔙 Back', 'callback_data' => 'Menu']]],
                ]),
                'parse_mode' => 'html',
            ];

            Bot::editMessageText($options);
        } elseif ($command == 'informasi') {
            $text = "┏━━━━━━━━━━━━━━━━━\n";
            $text .= "┃  ℹ️ Informasi               \n";
            $text .= "┃━━━━━━━━━━━━━━━━━\n";
            $text .= "┃ Tidak ada informasi terkini\n";
            $text .= "┗━━━━━━━━━━━━━━━━━\n";
            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [[['text' => 'Back', 'callback_data' => 'Menu']]],
                ]),
                'parse_mode' => 'html',
            ];

            Bot::editMessageText($options);
        } elseif (strpos($command, 'tps') !== false) {
            if (preg_match('/^tps/', $command)) {
                $cekdata = explode('|', $command);
                $cek = $cekdata[1];
                $text .= "┏━━━━ 💰 Permintaan Deposit ━━━━\n";
                $text .= "┃ ✅ Diterima dari: @$usernamepelanggan\n";
                $text .= '┃ 💵 Jumlah: '.rupiah($cek)."\n";
                $text .= "┃━━━━━━━━━━━━━━━━━━\n";
                $text .= "┃ 📸 Kirim bukti pembayaran:\n";
                $text .= "┃ <code>#konfirmasi deposit $cek</code>\n";
                $text .= "┃━━━━━━━━━━━━━━━━━━\n";
                $text .= "┃ ⏳ Harap konfirmasi dalam 2 jam\n";
                $text .= "┗━━━━━━━━━━━━━━━━━━\n";
                $text .= 'Terima kasih! 🙏';
                $options = [
                    'chat_id' => $chatidtele,
                    'message_id' => (int) $message['message']['message_id'],
                    'text' => $text,
                    'parse_mode' => 'html',
                ];

                Bot::editMessageText($options);

                $textsend = '';
                $textsend .= "┏━━━━ 🌟 Permintaan Deposit ━━━━\n";
                $textsend .= "┃ 👤 User     : @$usernamepelanggan\n";
                $textsend .= "┃ 🆔 ID       : <code>$id</code>\n";
                $textsend .= '┃ 💰 Nominal  : '.rupiah($cek)."\n";
                $textsend .= "┃━━━━━━━━━━━━━━━━━━\n";
                $textsend .= "┃ 🔔 Tindak Lanjut:\n";
                $textsend .= "┃ • Hubungi user @$usernamepelanggan\n";
                $textsend .= "┃ • Atau gunakan tombol di bawah\n";
                $textsend .= "┃   untuk mengisi saldo otomatis\n";
                $textsend .= "┗━━━━━━━━━━━━━━━━━━\n";
                $textsend .= 'Dengan menekan tombol di bawah ini, saldo user akan otomatis terisi.';

                $kirimpelangan = [
                    'chat_id' => $id_own,
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [['text' => 'QUICK TOP UP', 'callback_data' => '12']],
                            [['text' => ''.rupiah($cek).'', 'callback_data' => 'tp|'.$cek.'|'.$id.'|'.$usernamepelanggan.'']],
                            [['text' => 'OR COSTUM', 'callback_data' => '12']],
                            [['text' => '10000', 'callback_data' => 'tp|10000|'.$id.'|'.$usernamepelanggan.''], ['text' => '15000', 'callback_data' => 'tp|15000|'.$id.'|'.$usernamepelanggan.''], ['text' => '20000', 'callback_data' => 'tp|20000|'.$id.'|'.$usernamepelanggan.'']],
                            [['text' => '25000', 'callback_data' => 'tp|25000|'.$id.'|'.$usernamepelanggan.''], ['text' => '30000', 'callback_data' => 'tp|30000|'.$id.'|'.$usernamepelanggan.''], ['text' => '50000', 'callback_data' => 'tp|50000|'.$id.'|'.$usernamepelanggan.'']],
                            [['text' => '100000', 'callback_data' => 'tp|100000|'.$id.'|'.$usernamepelanggan.''], ['text' => '150000', 'callback_data' => 'tp|150000|'.$id.'|'.$usernamepelanggan.''], ['text' => '200000', 'callback_data' => 'tp|200000|'.$id.'|'.$usernamepelanggan.'']],
                            [['text' => 'Reject Request', 'callback_data' => 'tp|reject|'.$id.'|reject']],
                        ],
                    ]),
                    'parse_mode' => 'html',
                ];

                Bot::sendMessage($textsend, $kirimpelangan);
            }
        } elseif (strpos($command, 'tp') !== false) {
            if (preg_match('/^tp/', $command)) {
                $cekdata = explode('|', $command);
                $cekkodeunik = $cekdata[0];
                $jumlah = $cekdata[1];
                $iduser = $cekdata[2];
                $namauser = $cekdata[3];
                $text = '';
                if ($jumlah == 'reject') {
                    $text = "⚠️ <b>Permintaan Deposit Kadaluarsa</b>\n\n";
                    $text .= "┏━━━━ ⏳ Informasi ━━━━\n";
                    $text .= "┃ • Masa tunggu konfirmasi telah habis\n";
                    $text .= "┃ • Permintaan deposit Anda kadaluarsa\n";
                    $text .= "┃━━━━ 📝 Petunjuk ━━━━\n";
                    $text .= "┃ Harap konfirmasi deposit maksimal\n";
                    $text .= "┃ 2 jam setelah permintaan deposit\n";
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                    $text .= 'Terima kasih atas pengertian Anda. 🙏'; // kirim ke user
                    $kirimpelangan = [
                        'chat_id' => $iduser,
                        'parse_mode' => 'html',
                    ];
                    Bot::sendMessage($text, $kirimpelangan);

                    $options = [
                        'chat_id' => $chatidtele,
                        'message_id' => (int) $message['message']['message_id'],
                        'text' => 'Reject Deposit berhasil',
                        'parse_mode' => 'html',
                    ];
                    Bot::editMessageText($options);
                } else {
                    if ($id == $id_own) {
                        if (!empty($iduser) && !empty($jumlah)) {
                            if (has($iduser) == false) {
                                $text = "❌ <b>Data Tidak Ditemukan</b>\n\n";
                                $text .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                                $text .= "┃ 🆔 ID: <code>$iduser</code>\n";
                                $text .= "┃ 📃 Status: Tidak terdaftar\n";
                                $text .= "┃━━━━ 🔍 Saran ━━━━\n";
                                $text .= "┃ • Periksa kembali ID yang dimasukkan\n";
                                $text .= "┃ • Pastikan pengguna sudah terdaftar\n";
                                $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                                $text .= 'Jika masalah berlanjut, hubungi admin. 🙏';
                            } else {
                                if (preg_match('/^[0-9]+$/', $jumlah)) {
                                    if (strlen($jumlah) < 7) {
                                        $text = topupresseller($iduser, $namauser, $jumlah, $id_own);

                                        // kirim ke user
                                        $kirimpelangan = [
                                            'chat_id' => $iduser,
                                            'reply_markup' => json_encode([
                                                'inline_keyboard' => [[['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'], ['text' => '📛 Promo Hot', 'callback_data' => 'informasi']]],
                                            ]),
                                            'parse_mode' => 'html',
                                        ];
                                        Bot::sendMessage($text, $kirimpelangan);
                                    } else {
                                        $text = "⚠️ <b>Batas Maksimal Top Up</b>\n\n";
                                        $text .= "Maaf, maksimal top up adalah Rp 1.000.000,00\n";
                                        $text .= 'Silakan masukkan jumlah yang lebih kecil.';
                                    }
                                } else {
                                    $text = "❌ <b>Format Nominal Salah</b>\n\n";
                                    $text .= "Maaf, nominal harus berupa angka.\n";
                                    $text .= 'Contoh: 50000 (tanpa titik atau koma)';
                                }
                            }
                        } else {
                            $text = "❗ <b>Format Data Salah</b>\n\n";
                            $text .= "Maaf, format data yang Anda masukkan salah.\n";
                            $text .= 'Silakan periksa kembali dan coba lagi.';
                        }
                    } else {
                        $text = "🚫 <b>Akses Ditolak</b>\n\n";
                        $text .= "Maaf, akses hanya untuk Administrator.\n";
                        $text .= 'Silakan hubungi admin jika Anda memerlukan bantuan.';
                    }
                    $options = [
                        'chat_id' => $chatidtele,
                        'message_id' => (int) $message['message']['message_id'],
                        'text' => $text,
                        'parse_mode' => 'html',
                    ];
                    Bot::editMessageText($options);
                }
            }
        } elseif (strpos($command, 'VMarkup') !== false) {
            $cekdata = explode('|', $command);
            $cekkodeunik = $cekdata[0];
            $princevoc = $cekdata[1];
            $markup = $cekdata[2];
            $markupakhir = $cekdata[3];
            $saldoawal = $cekdata[4];
            $saldo = $cekdata[5];
            $text = '';

            if (!empty($princevoc)) {
                $text = "📊 <b>Laporan Transaksi</b>\n\n";
                $text .= "┏━━━━ 💰 Rincian Saldo ━━━━\n";
                $text .= '┃ 💵 Saldo Awal   : '.rupiah($saldoawal)."\n";
                $text .= '┃ 🎟️ Harga Voucher : '.rupiah($princevoc)."\n";
                $text .= '┃ 📈 Total Markup  : '.rupiah($markup)."\n";
                $text .= "┃━━━━ 🧮 Perhitungan ━━━━\n";
                $text .= "┃ Voucher - Markup:\n";
                $text .= '┃ '.rupiah($princevoc).' - '.rupiah($markup).' = '.rupiah($markupakhir)."\n";
                $text .= "┃ Saldo Awal - Markup Akhir:\n";
                $text .= '┃ '.rupiah($saldoawal).' - '.rupiah($markupakhir).' = '.rupiah($saldo)."\n";
                $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                $text .= '💰 <b>Sisa Saldo</b>: '.rupiah($saldo);
            } else {
                $text = "❌ <b>Format Data Salah</b>\n\n";
                $text .= "Maaf, format data yang Anda masukkan tidak valid.\n";
                $text .= 'Silakan periksa kembali dan coba lagi.';
            }

            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [[['text' => '🔙 Back', 'callback_data' => 'Menu']]],
                ]),
                'parse_mode' => 'html',
            ];

            Bot::editMessageText($options);
        } elseif (strpos($command, 'notifsaldo') !== false) {
            if (has($id) == false) {
                $text = "⚠️ Anda belum terdaftar\n\n";
                $text .= 'Silakan daftar terlebih dahulu ke admin atau klik /daftar';
            } else {
                $angka = lihatsaldo($id);
                $text = "┏━━━━ 💰 Informasi Saldo ━━━━\n";
                $text .= "┃ 🆔 ID Anda   : $id\n";
                $text .= '┃ 💵 Sisa Saldo : '.rupiah($angka)."\n";
                if ($angka < 3000) {
                    $text .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                    $text .= "⚠️ Peringatan: Saldo Anda rendah!\n";
                    $text .= 'Silahkan isi ulang saldo Anda.';
                } else {
                    $text .= '┗━━━━━━━━━━━━━━━━━━━━';
                }
            }
            Bot::answerCallbackQuery($text, $options = ['show_alert' => true]);
        }
    } else {
        $text = "🚫 Anda belum terdaftar\n\n";
        $text .= 'Silakan daftar terlebih dahulu ke admin atau klik /daftar';
        $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
        ];
        Bot::editMessageText($options);
    }
});
$mkbot->on('photo', function () {
    $info = bot::message();
    $nametelegram = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    $caption = strtolower($info['caption']);
    $explode = explode(' ', $caption);
    $konfirmasitext = $explode['0'];
    $deposittext = $explode['1'];
    $jumlahtext = $explode['2'];

    if (!empty($caption)) {
        include '../config/system.conn.php';
        if (has($idtelegram)) {
            // cek kandungan
            if (preg_match('/^#konfirmasi/', $konfirmasitext)) {
                // cek lagi sesuai format
                if ($konfirmasitext == '#konfirmasi' && $deposittext == 'deposit' && !empty($jumlahtext)) {
                    if (preg_match('/^[0-9]+$/', $jumlahtext)) {
                        $fototerbaik = $info['photo'][3]['file_id'];
                        $fotomedium = $info['photo'][2]['file_id'];
                        $fotorendah = $info['photo'][1]['file_id'];
                        $fotojelek = $info['photo'][0]['file_id'];
                        $caption = "Lapor ! konfirmasi deposit dari @$nametelegram Jumlah ".rupiah($jumlahtext).' Silahkan di periksa dan ditindak lanjut';
                        if (!empty($fototerbaik)) {
                            Bot::sendPhoto($fototerbaik, $options);
                            $response = "✅ <b>Konfirmasi Deposit Diterima</b>\n\n";
                            $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                            $response .= "┃ • Konfirmasi telah kami terima\n";
                            $response .= "┃ • Deposit akan segera diproses\n";
                            $response .= "┃━━━━ ⏳ Status ━━━━\n";
                            $response .= "┃ Mohon tunggu proses verifikasi\n";
                            $response .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                            $response .= 'Terima kasih atas kesabaran Anda! 🙏';
                        } elseif (!empty($fotomedium)) {
                            Bot::sendPhoto($fotomedium, $options);
                            $response = "✅ <b>Konfirmasi Deposit Diterima</b>\n\n";
                            $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                            $response .= "┃ • Konfirmasi telah kami terima\n";
                            $response .= "┃ • Deposit akan segera diproses\n";
                            $response .= "┃━━━━ ⏳ Status ━━━━\n";
                            $response .= "┃ Mohon tunggu proses verifikasi\n";
                            $response .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                            $response .= 'Terima kasih atas kesabaran Anda! 🙏';
                        } elseif (!empty($fotorendah) || !empty($fotojelek)) {
                            $response = "⚠️ <b>Foto Kurang Jelas</b>\n\n";
                            $response .= "┏━━━━ 📸 Informasi ━━━━\n";
                            $response .= "┃ Sistem tidak dapat membaca foto\n";
                            $response .= "┃━━━━ 🔄 Tindak Lanjut ━━━━\n";
                            $response .= "┃ Mohon kirim ulang dengan foto yang:\n";
                            $response .= "┃ • Lebih jelas\n";
                            $response .= "┃ • Tidak blur atau buram\n";
                            $response .= "┃ • Menampilkan seluruh bukti transfer\n";
                            $response .= '┗━━━━━━━━━━━━━━━━━━━━';
                        } else {
                            $response = "⚠️ <b>Format Jumlah Deposit Salah</b>\n\n";
                            $response .= "┏━━━━ ℹ️ Informasi ━━━━\n";
                            $response .= "┃ Jumlah deposit harus berupa angka\n";
                            $response .= "┃━━━━ 📝 Contoh Benar ━━━━\n";
                            $response .= "┃ <code>#konfirmasi deposit 50000</code>\n";
                            $response .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                            $response .= 'Silakan kirim ulang dengan format yang benar.';
                            Bot::sendMessage($response, ['parse_mode' => 'html']);
                        }
                    } else {
                        Bot::sendMessage("⚠️ Maaf, jumlah deposit hanya boleh berupa angka.\n\n📝 Contoh yang benar: <code>#konfirmasi deposit 50000</code>", ['parse_mode' => 'html']);
                    }
                } else {
                    $response = "ℹ️ <b>Panduan Konfirmasi Deposit</b>\n\n";
                    $response .= "┏━━━━ 📝 Instruksi ━━━━\n";
                    $response .= "┃ Untuk konfirmasi deposit:\n";
                    $response .= "┃ 1. Kirim foto bukti transfer\n";
                    $response .= "┃ 2. Tambahkan keterangan:\n";
                    $response .= "┃    <code>#konfirmasi deposit [jumlah]</code>\n";
                    $response .= "┃━━━━ 🔍 Contoh ━━━━\n";
                    $response .= "┃ <code>#konfirmasi deposit 50000</code>\n";
                    $response .= "┗━━━━━━━━━━━━━━━━━━━━\n\n";
                    $response .= '📸 Pastikan foto jelas dan nominal sesuai.';
                    Bot::sendMessage($response, ['parse_mode' => 'html']);
                }
            }
        } else {
            $response = "⚠️ Anda belum terdaftar\n\n";
            $response .= 'Silakan daftar terlebih dahulu ke admin atau klik /daftar';
            Bot::editMessageText($response);
        }
    }
});
$mkbot->run();
