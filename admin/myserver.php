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

        if (isset($_POST['save'])) {
            $id          = $_SESSION['Mikbotamid'];
            $token       = $_POST['tokenbot'];
            $usernamebot = $_POST['usernamebot'];
            $ipmik       = $_POST['ipmikrotik'];
            $port        = $_POST['port'];
            $usernamemik = $_POST['usermikrotik'];
            $passmik     = encrypturl($_POST['passmikrotik']);
            $namarouter  = $_POST['namarouter'];
            $owner       = $_POST['owner'];
            $idowner     = $_POST['idowner'];
            $dns         = $_POST['dnsname'];
            $namarouter  = $_POST['namarouter'];

            $viewid = getid($id);
            if (empty($viewid)) {
                $make = inbot($id, $token, $usernamebot, $namarouter, $ipmik, $usernamemik, $passmik, $port, $dns, $owner, $idowner);
            } else {

                $dump = upbot($id, $token, $usernamebot, $namarouter, $ipmik, $usernamemik, $passmik, $port, $dns, $owner, $idowner);
            }
            unset($settings);
        }

        include '../config/system.conn.php';
    }

?>
     <script src='../js/mikbotamRunnertext.js'></script>

     <script>
    function Passmikbot() {
        var x = document.getElementById('password');
        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    };

function testcon(){var _0x17A28=$("\x23\x69\x70").val();var _0x17A88=$("\x23\x75\x73\x65\x72\x6E\x61\x6D\x65").val();var _0x17A48=$("\x23\x70\x61\x73\x73\x77\x6F\x72\x64").val();var _0x17A68=$("\x23\x70\x6F\x72\x74\x61\x70\x69").val();$("\x23\x74\x65\x73\x74\x2D\x63\x6F\x6E\x6E\x65\x63\x74").html("\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x63\x61\x72\x64\x20\x70\x64\x2D\x32\x30\x20\x70\x64\x2D\x73\x6D\x2D\x32\x30\x20\x62\x67\x2D\x70\x72\x69\x6D\x61\x72\x79\x20\x22\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x73\x69\x67\x6E\x69\x6E\x2D\x6C\x6F\x67\x6F\x20\x74\x78\x2D\x63\x65\x6E\x74\x65\x72\x20\x74\x78\x2D\x34\x30\x20\x74\x78\x2D\x62\x6F\x6C\x64\x20\x74\x78\x2D\x77\x68\x69\x74\x65\x22\x3E\x4C\x4F\x41\x44\x49\x4E\x47\x2E\x2E\x2E\x2E\x20\x3C\x2F\x64\x69\x76\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x78\x2D\x63\x65\x6E\x74\x65\x72\x20\x20\x74\x78\x2D\x77\x68\x69\x74\x65\x22\x3E\x50\x6C\x65\x61\x73\x65\x20\x77\x61\x69\x74\x20\x61\x20\x66\x65\x77\x20\x73\x65\x63\x6F\x6E\x64\x73\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E");$.ajax({type:"\x50\x4F\x53\x54",url:"\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x63\x6F\x6E\x6E\x74\x65\x73\x74\x2E\x70\x68\x70\x3F\x63\x6D\x64\x3D\x74\x65\x73\x74\x63\x6F\x6E",cache:false,data:{ip:_0x17A28,user:_0x17A88,pass:_0x17A48,portapi:_0x17A68},success:function(_0x17AA8){$("\x23\x74\x65\x73\x74\x2D\x63\x6F\x6E\x6E\x65\x63\x74").html(_0x17AA8)}})}

    </script>

    <div class="sl-pagebody">
        <div class="bd-primary mg-t-10">
            <div class="card bd-primary">
                <div class="card-header bg-primary tx-white"> <i class="fa fa-gear"></i> MikroTik Settings &nbsp; | &nbsp;&nbsp;<i onclick="Reload();" class="fa fa-refresh pointer " title="Reload data"></i></div>
                <div class="card-body pd-sm-15">
                    <form autocomplete="off" method="post" name="settings">
                        <div class="row row-sm mg-t--1">
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">MikroTik</div>
                                    <div class="card-body pd-sm-15">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">IP MikroTik</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input id="ip" type="text" class="form-control" name="ipmikrotik" placeholder="IP MikroTik" value="<?=$mikrotik_ip;?>">
                                            </div>
                                        </div>
                                          <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Port  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input id="portapi" type="text" class="form-control" name="port" placeholder="example 8728" value="<?=$mikrotik_port;?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Username  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input id="username" type="text" class="form-control" name="usermikrotik" placeholder="Username MikroTik" value="<?=$mikrotik_username;?>">
                                            </div>
                                        </div>
                                  
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Password  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
                  <label class="ckbox wd-16">
                    <input type="checkbox" name="checkbox" value="0" onclick="Passmikbot()" ><span></span>
                                                    </label>
                                                    </span>
                                                    <input  id="password" type="password" class="form-control" name="passmikrotik" id="passmikbot" placeholder="Password" value="<?=$mikrotik_password;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">
                                        Test connection to mikrotik </div>
                                    <div class="card-body pd-sm-15 h-100">

<div id="test-connect" ></div>
                                    </div>
                                    <div class="card-footer py-sm-custom">
                                   <div class="row row-xs mg-t-0">
                                    <div class="col-sm-20 mg-l-auto">
                                        <div class="form-layout-footer">
                                    <button class="btn btn-success lh-0 tx-xthin mg-r-0" onclick="testcon();return false;" style="cursor: pointer;"><i class="fa fa-thumbs-up mg-r-2"></i> Test Conection</button>
                                        </div>
                                        <!-- form-layout-footer -->
                                    </div>
                                    <!-- col-8 -->
                                </div>
  </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                                                        <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">
                                        MikroTik Dns </div>
                                    <div class="card-body pd-sm-15">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">DNS Hotspot</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="dnsname" placeholder="Dns name" value="<?=$dnsname;?>">
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mg-t-20">
                                            <label class="col-sm-4 form-control-label">Router Name </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="namarouter" placeholder="Name Router" value="<?=$identitiy;?>">
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Bot Settings</div>
                                    <div class="card-body pd-sm-15">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Token Bot</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="tokenbot" placeholder="Enter Token Bot" value="<?=$token;?>">
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mg-t-20">
                                            <label class="col-sm-4 form-control-label">Username Bot </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="usernamebot" placeholder="Username Bot" value="<?=$usernamebot;?>">
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-15">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Owner</div>
                                    <div class="card-body pd-sm-15">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Username Owner</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="owner" placeholder="Username Owner" value="<?=$owner;?>">
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mg-t-20">
                                            <label class="col-sm-4 form-control-label">ID Telegram Owner </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="idowner" placeholder="ID Telegram Owner" value="<?=$id_own;?>">
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-12 mg-t-15">
                                <div class="row row-xs mg-t-10">
                                    <div class="col-sm-20 mg-l-auto">
                                        <div class="form-layout-footer">
                                            <button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit"  style="cursor: pointer;" name="save"><i class="fa fa-thumbs-up mg-r-2"></i> Save</button>
                                            <button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit" style="cursor: pointer;" name="Delete"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                        </div>
                                        <!-- form-layout-footer -->
                                    </div>
                                    <!-- col-8 -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- body -->
        </div>
    </div>


  <script type='text/javascript'>
  const typewriter = new Typewriter('#test-connect', {
      loop: false
    });

    typewriter.typeString('<center class="tx-bold tx-20 tx-warning">Tips and Trick</center>')
      .typeString('<center class="tx-bold tx-15 tx-primary ">Mengamankan Router Mikrotik</center>')
      .pauseFor(200)
      .typeString('<br/>')
      .typeString('1. Ganti Username dan Password Router Mikrotik ')
      .pauseFor(200)
      .typeString('<br/>')
      .typeString('2. Ubah atau Matikan Service yang Tidak Diperlukan')
      .pauseFor(200)
       .typeString('<br/>')
      .typeString('3. Non-Aktifkan Neighbors Discovery ')
      .pauseFor(200)
       .typeString('<br/>')
      .typeString('4. Non-Aktifkan Neighbors Discovery ')
      .pauseFor(200)
       .deleteAll(15)
      .typeString('<i>Lanjutan...</i><br/>')
      .typeString('5. Aktifkan Firewall Filter Untuk Akses Service Router (DNS dan Web Proxy)  ')
      .pauseFor(200)
      .typeString('<br/>')
      .typeString('6. Non-Aktifkan Btest Server   ')
      .pauseFor(200)
       .typeString('<br/>')
      .typeString('7.  Ubah pin atau Non-Aktifkan Fitur LCD    ')
      .pauseFor(200)
       .typeString('<br/>')
      .typeString('8. Lakukan Backup secara berkala serta Enkripsi dan Ambil File backupnya    ')
      .pauseFor(200)
      .typeString('<br/>')
      .typeString('Other Klik  <a href="http://www.mikrotik.co.id/artikel_lihat.php?id=263">Disini</a>  ')
      .pauseFor(200)
      .start();


  </script>
