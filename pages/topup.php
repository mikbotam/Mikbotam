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
    error_reporting(0);

    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:../admin/login.php");
    } else {
        include '../config/system.conn.php';
        $data = lihatdata();
    }

?>
    <script>
    var _0xfa4d=["\x76\x61\x6C","\x23\x49\x44\x55\x73\x65\x72","\x23\x53\x61\x6C\x64\x6F","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x49\x44\x20\x55\x73\x65\x72","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x69\x6D\x67\x2D\x66\x6C\x75\x69\x64\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x74\x68\x65\x20\x49\x44\x20\x55\x73\x65\x72\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x49\x6E\x70\x75\x74\x20\x53\x61\x6C\x64\x6F","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x69\x6D\x67\x2D\x66\x6C\x75\x69\x64\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x53\x61\x6C\x64\x6F\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x63\x75\x72\x73\x6F\x72","\x77\x61\x69\x74","\x63\x73\x73","\x62\x6F\x64\x79","\x3C\x64\x69\x76\x20\x61\x6C\x69\x67\x6E\x3D\x22\x63\x65\x6E\x74\x65\x72\x22\x3E\x3C\x69\x6D\x67\x20\x73\x72\x63\x3D\x22\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x22\x20\x2F\x3E\x3C\x2F\x64\x69\x76\x3E","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74","\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x73\x61\x6C\x64\x6F\x2E\x70\x68\x70","\x49\x44\x55\x73\x65\x72\x3D","\x26\x53\x61\x6C\x64\x6F\x3D","\x26\x75\x70\x3D\x75\x70","\x64\x65\x66\x61\x75\x6C\x74","\x61\x6A\x61\x78","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x56\x31","\x73\x75\x63\x63\x65\x73\x73","\x64\x69\x73\x6D\x69\x73\x73\x65\x64","\x6C\x6F\x67","\x6E\x6F\x74\x69\x66\x79"];function topupsaldo(){var _0x2376x2=$(_0xfa4d[1])[_0xfa4d[0]]();var _0x2376x3=$(_0xfa4d[2])[_0xfa4d[0]]();if(_0x2376x2[_0xfa4d[3]]== 0){alertify[_0xfa4d[6]](_0xfa4d[4],_0xfa4d[5])}else {if(_0x2376x3[_0xfa4d[3]]== 0){alertify[_0xfa4d[6]](_0xfa4d[7],_0xfa4d[8])}else {$(_0xfa4d[12])[_0xfa4d[11]](_0xfa4d[9],_0xfa4d[10]);$(_0xfa4d[15])[_0xfa4d[14]](_0xfa4d[13]);$[_0xfa4d[21]]({url:_0xfa4d[16],data:_0xfa4d[17]+ _0x2376x2+ _0xfa4d[18]+ _0x2376x3+ _0xfa4d[19],cache:false,success:function(_0x2376x4){$(_0xfa4d[15])[_0xfa4d[14]](_0x2376x4);$(_0xfa4d[12])[_0xfa4d[11]](_0xfa4d[9],_0xfa4d[20])}});alertify[_0xfa4d[26]](_0xfa4d[22],_0xfa4d[23],5,function(){console[_0xfa4d[25]](_0xfa4d[24])})}}}
        
    </script>

    <div class="card-body pd-sm-10">
        <div class="row row-sm mg-t--1">
            <div class="col-sm-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white"><i class="fa  fa-money "></i> Top Up Saldo </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <!-- row -->

                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">ID User  </label>
                                                             <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="IDUser" name="idnya" data-placeholder="Select ID">
                                <option value="">Select ID</option>
                                <?php
                                foreach ($data as $index => $baris): ?> <!-- Mulai loop -->
                                           <option value="<?=$baris['id_user'];?>"><?php echo $baris['id_user'] . '    (' . $baris['nama_seller'] . ')'; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                            <!-- row -->
  
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
                       <button  class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onclick="topupsaldo();return false;"><i class="fa fa-thumbs-up mg-r-2"></i>  Save</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa  fa-trash"> </i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            </form>
                    </div>
                    <div id="view-respont"></div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
                                     <div class="col-xl-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-pencil"></i> Format </div>
                    <div class="card-body pd-sm-15">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <p style="padding:0px 2px;">
                                            Top <code>UP </code>.<br> Fungsi  :<code> Tambahakan saldo counter </code><br>Case : <code>Isi ulang saldo counter</code>.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- card-body -->
                        <!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- body -->
