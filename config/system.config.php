<?php

/*

Pastikan server sudah terinstall webserver (apache, PHP, MYSQL);

============Baru Download ====================
buat lah database terserah namanya
setelah itu  pilih import database, import file Newdatabase.sql di folder ini ke databasenya

setelah itu edit file system.config.php menggunakan notpad++ atau editor lain,

setelah berhasil silahkan buka webya melalui web browser

login dengan username admin password admin
jika berhasil login maka anda akan diarahkan ke setting server set up semuanya diisi seluruhnya
jika gagal login berarti tidak dapat terkoneksi dengan database silahkan teliti kembali, setting di file system.config.php


*/


require_once 'system.medoo.php';
        //tidak perlu diedit     jika menggunakan sqlite
        //jika tidak bisa login silahkan kunjungi mikbotam.net untuk tutorial menghidupkan modul sqlite
        
$mikbotamdata = new medoo([
    'database_type' => 'sqlite',
    'database_file' => '../config/mibotam.db',
]);


