# Mikbotamv1.8
#Changelogs

#01/04/2019 Mikbotam V1.8 krakatau

Fixed  * :

Penambahan Limit uptime di settings voucher
Perbaikan Limit uptime dan penambahan limit qouta
Perbaikan Script Add Profile hotspot (lock user dan  validty = masa tenggang / user otomatis terhapus setelah mencapai validtiy)
Perbaikan add PPP profile
Perbaikan Laporan bulanan

Fixed Bot *:

Penambahan fitur history transaksi  bot
Penambahan fitur cek saldo popup 
Perbaikan dan penambahan permintaan topup/deposit
Penambahan Reject Request deposit
Penambahan Goto login
Penambahan konfirmasi deposit disertai dengan foto #konfimasi deposit (jumlahdeposit)
Handle jika anda salah setup voucher setting atau hasil berupa array maka akan dianggap error
jika terjadi error maka user yang telah dibuat di mikrotik akan otomatis dihapus
Handle jika kita belum memasukan http:// di settings dns name 
Terakhir kalinya Kami replace Folder saldo saat Update.zip
Catatan Cara update : 

 

Replace folder yang sudah ada jangan lupa bakup folder sebelum replace 
 

Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Untuk versi sebelumnya v1.2, v1.3, v1.4, v1.5, v1.6, v1.7 bisa langsung melakukan update.zip
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Jika inggin Update silahkan download   
Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Jika baru / mengginkan Menggunakan sqlite silahkan download         Plug N Play  tutorial ada di  Facebook
Jika baru / mengginkan Menggunakan Mysql silahkan download      

Non saldo bisa running secara bersamaan dengan yang sistem saldo dengan non saldo dalam 1 bot .
Secara default bot akan running  hanya saldo maka dari itu :

Metode Webhook (hosting)

jika menginginkan kedua-duanya running silahkan alihkan webhook anda Saldo/Core_Saldo_Nonsaldo.php
jika menginginkan hanya non saldo yang running silahkan arahkan webhook ke /Saldo/Core_Nonsaldo.php
Jika Menginginkan hanya saldo yang running silahkan arrahkan webhook ke /Saldo/Core.php
Metode Long Polling

Seperti halnya webhook jika menginginkan kedua-duanya running silahkan ekseksui bot  anda php Core_Saldo_Nonsaldo.php
.jika menginginkan hanya non saldo yang running silahkan ekseksui bot  anda php Core_Nonsaldo.php
Jika Menginginkan hanya saldo yang running silahkan ekseksui bot  anda php Core.php
 

Salam luar biasa . . . .

 

 

 

#23/04/2019 Mikbotam V1.7 Fix bugs  Ep : 2

Fixed BOT * 

Perbaikan Script Bot /deposit dan callback data
Penambahan any command ditangkal dengan text jadi perintah yang tidak ada akan di tangkal dengan text
Fixed web ui *

Perbaikan Setting Voucher Text list
Catatan Cara update : 

Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Jika inggin Update silahkan download   
Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Jika baru / mengginkan Menggunakan sqlite silahkan download         Plug N Play  tutorial ada di  Facebook
Jika baru / mengginkan Menggunakan Mysql silahkan download      
Salam luar biasa . . . .
 


#23/04/2019 Mikbotam V1.7 

Fixed BOT * 

Perbaikan Script Bot (Bongkar total) rebuild script
Perbaikan /resource Command Fix
Tambahan perintah  /deposit atau /request untuk user fungsinya request top up saldo
Fixed web ui *

Perbaikan notif error Voucher Settings
Perbaikan Script User Profile  *Report Hijau Net
Perbaikan pass=user menjadi Id voucher
Penghapusan Limit uptime di Voucher settings
Catatan Cara update : 

Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Jika inggin Update silahkan download   
Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Jika baru / mengginkan Menggunakan sqlite silahkan download         Plug N Play  tutorial ada di  Facebook
Jika baru / mengginkan Menggunakan Mysql silahkan download      
Salam luar biasa . . . .


 


#21/04/2019 Mikbotam V1.6 SQLITE Fixed bugs

Fitur *

Perbaikan Script bot
Terdapat perbaikan terkait dengan script bot yang tidak sesuai dengan settings,

Cara update dan Catatan: 

Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Jika menggunakan versi sebelumnya V1.5.3 dan inggin update silahkan download   
Jika baru / mengginkan Menggunakan sqlite silahkan download         Plug N Play  tutorial ada di  
Jika baru / mengginkan Menggunakan Mysql silahkan download      
Salam luar biasa . . . .

 

#21/04/2019 Mikbotam V1.6 SQLITE

Fitur *

Fixed PHP 7
Fixed  Bugs logs
Fixed  User list table
Fixed js dan optimalisasi speed
Fixed bot non Voucher
Fixed hidden password for ID Voucher


Fixed Live Edit Bot
Fixed Dasboard remove widget voucher error
Enable Send Broadcast photo for web hosting
Add Hostpot menu 
Add hostpot manager web ui
Add PPP manager web ui


Add optional limit uptime on voucher settings
ATTENTION FOR  V 1.6

Ada dua metode dalam versi ini dan mungkin akan berkelanjut untuk versi kedepannya  Versi Sqlite dan Versi Mysql

Versi Sqlite  - Plug n play Database disimpan secara portable tidak bisa di buka dengan aplikasi lain kecuali menggunakan mikbotam dan di engkripsi dengan 100 character
Versi mysql - Database disimpan didalam mysql dan biasanya menggunakan phpmyadmin untuk manager database Saya sarankan memakai mysql untuk traffic penjualan yang besar
Folder mikbotam wajib chmod ke 0775 atau 0777
Versi Sqlite silahkan download dan extrack dan langsung login , Jika menggunakan server lokal bukan hosting silahkan aktifkan modul sqlite di php.ini tutorial Silahkan simak di postingan.

Update zip berlaku untuk semua versi Sqlite maupun mysql

Cara update dan Catatan: 

Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Jika menggunakan versi sebelumnya V1.5.3 dan inggin update silahkan download   
Jika baru / mengginkan Menggunakan sqlite silahkan download         Plug N Play  tutorial ada di  
Jika baru / mengginkan Menggunakan Mysql silahkan download      
Salam luar biasa . . . .


#14/04/2019 Mikbotam V1.5.3 Azkal

Fitur  *

Fixed PHP 7
Fixed  Bugs logs
Fixed  User list table
Fixed js dan optimalisasi
Fixed User Profile add (fix)
Speed up web ui
Fixed Nonsaldo Voucher
Add Edit bot Core.php in web ui 


Add Record Markup


Persiapan print voucher manual
Change curent page before ssesion timeout
Dan masih banyak lagi
Bot update 

Fixed Nonsadolo Sudah bisa running
Fixed topdown
 
ATTENTION FOR  V 1.5 

Non saldo sudah bisa running secara bersamaan dengan yang sistem saldo dengan non saldo dalam 1 bot .
Secara default bot akan running  hanya saldo maka dari itu :

Metode Webhook (hosting)

jika menginginkan kedua-duanya running silahkan alihkan webhook anda Saldo/Core_Saldo_Nonsaldo.php
jika menginginkan hanya non saldo yang running silahkan arahkan webhook ke /Saldo/Core_Nonsaldo.php
Jika Menginginkan hanya saldo yang running silahkan arrahkan webhook ke /Saldo/Core.php
Metode Long Polling

Seperti halnya webhook jika menginginkan kedua-duanya running silahkan ekseksui bot  anda php Core_Saldo_Nonsaldo.php
.jika menginginkan hanya non saldo yang running silahkan ekseksui bot  anda php Core_Nonsaldo.php
Jika Menginginkan hanya saldo yang running silahkan ekseksui bot  anda php Core.php
Cara update dan Catatan: 

Replace folder yang sudah ada jangan lupa bakup folder sebelum replace ,
Hati-hati Update.zip akan mereplace Core.php jika anda sudah edit file Core.php silahkan copy terlebih dahulu atau rename Core.php sebelumnya !
Jika sudah silahkan bot disesuaikan dengan  yang anda edit tinggal copy paste ribet? Sekalian belajar 
Salam luar biasa . . . .

Download : 


# 12/04/2019 Mikbotam V1.5  Stable

FItur  * 

Fixed PHP 7
Fixed  Bugs logs
Add Type character
Add Color Qrcode
Add fitur non saldo /Belum fix akan segara di update
Add export Per bulan
Add news update
Add new table  Database 
Add Tools Setwebhook Untuk hosting
other
ATTENTION FOR  V 1.5

Dikarenakan terdapat fitur baru silahkan untuk Membuat database baru import dengan database Newdatabase.sql jika mengingginkan menggunakan database lama
import ulang database dengan file  Dropandinsert.sql belumnya Kami mohon maaf yang sebesar besarnya kami pastikan hal ini tidak akan terjadi lagi dan Perlu diketahui data anda sepenuhnya akan HILANG! Maka dari itu ada perlu setting ulang di web ui mikbotam kami mohon maaf yang sebesar besarnya,

Jika tidak memperbarui database 

1.bot akan error dan akan macet
2.Anda tidak bisa menggunakan fitur baru .
3.Anda tidak dapat menerima update selanjutnya karena nantinya akan menggunakan database yang baru ini,

Sekali lagi kami mohon maaf atas  Moment ini, atas perhatiannya dan dukungannya kami ucapkan terimakasih jangan lupa bahagia :-D
