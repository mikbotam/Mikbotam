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

       
    }

?>
    <script>
var _0xd500=["\x76\x61\x6C","\x23\x55\x73\x65\x72\x6E\x61\x6D\x65","\x23\x49\x44\x55\x73\x65\x72","\x23\x6E\x6F\x74\x65\x6C\x66\x75\x6E","\x23\x53\x61\x6C\x64\x6F","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x69\x64\x20\x75\x73\x65\x72","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x55\x73\x65\x72\x6E\x61\x6D\x65\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x49\x6E\x70\x75\x74\x20\x75\x73\x65\x72\x6E\x61\x6D\x65\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x74\x68\x65\x20\x49\x44\x20\x55\x73\x65\x72\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x49\x6E\x70\x75\x74\x20\x70\x61\x73\x73\x77\x6F\x72\x64\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x4E\x75\x6D\x62\x65\x72\x20\x70\x68\x6F\x6E\x65\x2F\x57\x68\x61\x74\x73\x61\x70\x70\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x49\x6E\x70\x75\x74\x20\x70\x72\x6F\x66\x69\x6C\x65\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x53\x61\x6C\x64\x6F\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x3C\x64\x69\x76\x20\x61\x6C\x69\x67\x6E\x3D\x22\x63\x65\x6E\x74\x65\x72\x22\x3E\x3C\x69\x6D\x67\x20\x73\x72\x63\x3D\x22\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x22\x20\x2F\x3E\x3C\x2F\x64\x69\x76\x3E","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74","\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x6E\x65\x77\x75\x73\x65\x72\x5F\x69\x64\x2E\x70\x68\x70","\x55\x73\x65\x72\x6E\x61\x6D\x65\x3D","\x26\x49\x44\x55\x73\x65\x72\x3D","\x26\x6E\x6F\x74\x65\x6C\x66\x75\x6E\x3D","\x26\x53\x61\x6C\x64\x6F\x3D","\x61\x6A\x61\x78","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x56\x31","\x73\x75\x63\x63\x65\x73\x73","\x64\x69\x73\x6D\x69\x73\x73\x65\x64","\x6C\x6F\x67","\x6E\x6F\x74\x69\x66\x79"];function adduser(){var _0xcd1dx2=$(_0xd500[1])[_0xd500[0]]();var _0xcd1dx3=$(_0xd500[2])[_0xd500[0]]();var _0xcd1dx4=$(_0xd500[3])[_0xd500[0]]();var _0xcd1dx5=$(_0xd500[4])[_0xd500[0]]();if(_0xcd1dx2[_0xd500[5]]== 0){alertify[_0xd500[8]](_0xd500[6],_0xd500[7])}else {if(_0xcd1dx3[_0xd500[5]]== 0){alertify[_0xd500[8]](_0xd500[9],_0xd500[10])}else {if(_0xcd1dx4[_0xd500[5]]== 0){alertify[_0xd500[8]](_0xd500[11],_0xd500[12])}else {if(_0xcd1dx5[_0xd500[5]]== 0){alertify[_0xd500[8]](_0xd500[13],_0xd500[14])}else {$(_0xd500[17])[_0xd500[16]](_0xd500[15]);$[_0xd500[23]]({url:_0xd500[18],data:_0xd500[19]+ _0xcd1dx2+ _0xd500[20]+ _0xcd1dx3+ _0xd500[21]+ _0xcd1dx4+ _0xd500[22]+ _0xcd1dx5,cache:false,success:function(_0xcd1dx6){$(_0xd500[17])[_0xd500[16]](_0xcd1dx6)}});alertify[_0xd500[28]](_0xd500[24],_0xd500[25],5,function(){console[_0xd500[27]](_0xd500[26])})}}}}}
    </script>
    <div class="card-body pd-sm-10">
        <div class="row row-sm mg-t--1">
            <div class="col-sm-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white"><i class="fa fa-user-plus "></i> Add User </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Username  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input id="Username" type="text" class="form-control"  placeholder="Username ">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">ID User  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input id="IDUser" type="text" class="form-control"  placeholder="ID User" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">No Tlp/Whatsapp  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input id="notelfun"type="text" class="form-control"  placeholder="No Tlp/Whatsapp" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Saldo </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                        <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                        <input id="Saldo" type="text" class="form-control" name="Saldo" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                       <button  class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onclick="adduser();return false;"><i class="fa fa-thumbs-up mg-r-2"></i> Save</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            </from>
                    </div>
                    <div id="view-respont"></div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- body -->
        </div>
    </div>
    <!-- body -->
