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
 *  Last Edited : 26 Desember 2018
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

    $data = lihatdata();

    $pathdir = "../uploads";

// change your directory name
    if ($_POST['formatt'] == "sendfoto") {
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/gif"))) {
            if ($_FILES["file"]["size"] < 4000000) {
                if ($_FILES["file"]["error"] > 0) {
                    echo "Error: " . $_FILES["file"]["error"] . "<br />";
                } else {
                    $path = "../uploads/" . $_FILES["file"]['name'];
                    copy($_FILES["file"]['tmp_name'], $path);

                    $scheme = $_SERVER['REQUEST_SCHEME'];
                    if (strpos(strtolower($scheme), 'http') !== false) {
                        $cekhttps = "https://";
                    } else {
                        $cekhttps = $scheme . "://";
                    }
                    $sepath  = str_replace('..', '', $pathdir);
                    $urlreal = $cekhttps . $_SERVER['HTTP_HOST'] . $sepath . "/" . $_FILES["file"]["name"];

                    $send = sendPhoto($_POST['iduser'], $urlreal, $_POST['textdata'], $token);
                }
            } else {
                echo "Upload files less than 4000kb";
            }
        } else {
            echo "Invalid file format";
        }
    }
}

?>

    <script>
    var _0x1a27=["\x76\x61\x6C","\x23\x69\x64\x6E\x79\x61","\x23\x74\x65\x78\x74\x6E\x79\x61","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x69\x64","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x75\x73\x65\x72\x20\x49\x44\x73\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x49\x6E\x70\x75\x74\x20\x59\x6F\x75\x72\x20\x6D\x65\x73\x73\x61\x67\x65","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x65\x6E\x74\x65\x72\x20\x79\x6F\x75\x72\x20\x6D\x65\x73\x73\x61\x67\x65\x20\x3C\x62\x72\x3E\x6D\x61\x78\x20\x34\x32\x30\x30\x20\x63\x68\x61\x72\x61\x63\x74\x65\x72\x73\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x63\x75\x72\x73\x6F\x72","\x77\x61\x69\x74","\x63\x73\x73","\x62\x6F\x64\x79","\x3C\x64\x69\x76\x20\x61\x6C\x69\x67\x6E\x3D\x22\x63\x65\x6E\x74\x65\x72\x22\x3E\x3C\x69\x6D\x67\x20\x73\x72\x63\x3D\x22\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x22\x20\x2F\x3E\x3C\x2F\x64\x69\x76\x3E","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74","\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x42\x72\x6F\x61\x64\x63\x61\x73\x74\x5F\x78\x2E\x70\x68\x70","\x74\x65\x78\x74\x3D","\x26\x69\x64\x3D","\x64\x65\x66\x61\x75\x6C\x74","\x61\x6A\x61\x78","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x56\x31","\x73\x75\x63\x63\x65\x73\x73","\x64\x69\x73\x6D\x69\x73\x73\x65\x64","\x6C\x6F\x67","\x6E\x6F\x74\x69\x66\x79"];function makebroadcast(){var _0xf30bx2=$(_0x1a27[1])[_0x1a27[0]]();var _0xf30bx3=$(_0x1a27[2])[_0x1a27[0]]();if(_0xf30bx2[_0x1a27[3]]== 0){alertify[_0x1a27[6]](_0x1a27[4],_0x1a27[5])}else {if(_0xf30bx3[_0x1a27[3]]== 0){alertify[_0x1a27[6]](_0x1a27[7],_0x1a27[8])}else {$(_0x1a27[12])[_0x1a27[11]](_0x1a27[9],_0x1a27[10]);$(_0x1a27[15])[_0x1a27[14]](_0x1a27[13]);$[_0x1a27[20]]({url:_0x1a27[16],data:_0x1a27[17]+ _0xf30bx3+ _0x1a27[18]+ _0xf30bx2,cache:false,success:function(_0xf30bx4){$(_0x1a27[15])[_0x1a27[14]](_0xf30bx4);$(_0x1a27[12])[_0x1a27[11]](_0x1a27[9],_0x1a27[19])}});alertify[_0x1a27[25]](_0x1a27[21],_0x1a27[22],5,function(){console[_0x1a27[24]](_0x1a27[23])})}}}
    </script>
    <div class="card-body pd-sm-10">
        <div class="row row-sm mg-t--1">
            <div class="col-xl-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa  fa-paper-plane"></i> Send Message </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <div class="row">
                                <label class="col-sm-4 form-control-label lead">ID user</label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="idnya" name="idnya" data-placeholder="Select ID">
                                <option value="Alluser">All User</option>
                                <?php

                                foreach ($data as $baris): ?> 
                                           <option value="<?=$baris['id_user'];?>"><?php echo $baris['id_user'] . '    (' . $baris['nama_seller'] . ')'; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label lead ">Text  <span class="tx-danger tx-12">*max 4200</span></label>
                                <div class="col-lg">
                                    <textarea id="textnya" rows="3" class="form-control" placeholder="Message" style="margin-top: 0px; margin-bottom: 0px; height: 200px;"></textarea> <span id="hitung">4200</span>  Karakter Tersisa.
                                </div>
                            </div>
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onclick="makebroadcast();return false;"><i class="fa fa-send mg-r-2"></i> Send Message</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            <!-- card-body -->
                        </form>
                        <!-- card-body -->
                    </div>
                    <!-- card -->
                </div>
                        <div class="mg-t-10">
             <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa  fa-paper-plane"></i> Send Photo </div>
                    <div class="card-body pd-sm-15">
                        	<form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <label class="col-sm-4 form-control-label lead">ID user</label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="idnya" name="iduser" data-placeholder="Select ID">
                                <option value="Alluser">All User</option>
                                <?php

                                foreach ($data as $baris): ?> 
                                           <option value="<?=$baris['id_user'];?>"><?php echo $baris['id_user'] . '    (' . $baris['nama_seller'] . ')'; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label lead ">Your Photo</label>
                 <div class="col-lg">
                 
			<input type="file" name="file" id="file">
			<input type="hidden" name="formatt" id="format" value='sendfoto'>
		
		
              </div>
                            </div>
                                                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label lead ">Caption  <span class="tx-danger tx-12">*max 4200</span></label>
                                <div class="col-lg">
                                    <textarea name="textdata" rows="3" class="form-control" placeholder="Message" style="margin-top: 0px; margin-bottom: 0px; height: 200px;"></textarea> <span id="hitung">4200</span>  Karakter Tersisa.
                                </div>
                            </div>
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                    
                                        <button type="submit" id="sub" class="btn btn-success disable lh-0 tx-xthin mg-r-0 mg-t-8" ><i class="fa fa-paper-plane mg-r-2"></i> Send Photo</button>
                                        <button class="btn btn-success disable lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            <!-- card-body -->
                        </form>
                        <!-- card-body -->
                    </div>
                    <!-- card -->
                </div>
                </div>
            </div>
            <div class="col-xl-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-pencil"></i> Format Style </div>
                    <div class="card-body pd-sm-15">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                    	 <p style="padding:0px 3px;">
                                            Format Spesial Character.<br> Enter line <code>%0A</code> Space line <code>%20</code> <br>Contoh : <code>Pindah baris %0A , Spasi %20 atau bisa (langsung spasi)</code>.
                                        </p>
                                        <p style="padding:0px 2px;">
                                            Format <code>Code</code>.<br> Diawali dengan <code>&lt;code&gt;</code> diakhiri dengan <code>&lt;/code&gt;</code> <br>Contoh : <code>&lt;code&gt; Selamat Pagi &lt;/code&gt;</code>.
                                        </p>
                                        <p style="padding:0px 3px;">
                                            Format <b>Bold</b>.<br> Diawali dengan <code>&lt;b&gt;</code> diakhiri dengan <code>&lt;/b&gt;</code> <br>Contoh : <code>&lt;b&gt; Selamat Pagi &lt;/b&gt;</code>.
                                        </p>
                                        <p style="padding:0px 3px;">
                                            Format <i>italic</i>.<br> Diawali dengan <code>&lt;i&gt;</code> diakhiri dengan <code>&lt;/i&gt;</code> <br>Contoh : <code>&lt;i&gt; Selamat Pagi &lt;/i&gt;</code>.
                                        </p>
                                        <p style="padding:0px 3px;">
                                            Format Url with text.<br> Diawali dengan <code>&lt;a href=</code> diakhiri dengan <code>&lt;/a&gt;</code> <br>Contoh : <code>&lt;a href="http://www.example.com/">inline URL &lt;/a&gt;</code> <a href="http://www.mikbotam.net">Mylink</a>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- card-body -->
                        <!-- card -->
                    </div>
                </div>
                                <div class="mg-t-10">
                    <div class="card bd-primary">
                        <div class="card-header bg-primary tx-white">
                            <i class="fa  fa-desktop"></i></i> Show Response </div>
                        <div class="card-body pd-sm-15">
                            <div id="view-respont"></div>
                            <!-- card-body -->
                        </div>
                        <!-- card -->
                    </div>
                </div>
            </div>
            <!-- body -->
        </div>
    </div>
    <!-- body -->
