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
        include '../Api/routeros_api.class.php';

			$API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password,$mikrotik_port)) {
            $ARRAY      = $API->comm('/ip/hotspot/user/profile/print');
            $profilevoc = $ARRAY;
        }
			
        $id       = $_SESSION['Mikbotamid'];
        $data     = lihatdata();
        $datajson = json_decode(getvoc($id), true);
        
        if(empty($datajson)){
        	$echo='<div class="alert alert-success py-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <strong class="d-block d-sm-inline-block-force tx-black">Warning!</strong> <p class="tx-black mg-t-3">
Go to <a href="../pages/?Mikbotam=SettingsVoc">Voucher settings </a> to use this feature.</p>
            </div>';
        }
    }
    
    
    
?>
    <script>
      var _0xdc66=["\x76\x61\x6C","\x23\x6E\x6F\x69\x64\x32","\x23\x75\x73\x65\x72","\x23\x70\x61\x73\x73","\x23\x70\x72\x6F\x66\x69\x6C\x65","\x23\x6C\x69\x6D\x69\x74","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x69\x64\x20\x75\x73\x65\x72","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x75\x73\x65\x72\x20\x49\x44\x73\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x49\x6E\x70\x75\x74\x20\x75\x73\x65\x72\x6E\x61\x6D\x65\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x75\x73\x65\x72\x6E\x61\x6D\x65\x20\x68\x6F\x74\x73\x70\x6F\x74\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x49\x6E\x70\x75\x74\x20\x70\x61\x73\x73\x77\x6F\x72\x64\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x70\x61\x73\x73\x77\x6F\x72\x64\x20\x68\x6F\x74\x73\x70\x6F\x74\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x49\x6E\x70\x75\x74\x20\x70\x72\x6F\x66\x69\x6C\x65\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x70\x72\x6F\x66\x69\x6C\x65\x20\x68\x6F\x74\x73\x70\x6F\x74\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x49\x6E\x70\x75\x74\x20\x75\x70\x74\x69\x6D\x65\x20\x68\x6F\x74\x73\x70\x6F\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x75\x70\x74\x69\x6D\x65\x20\x68\x6F\x74\x73\x70\x6F\x74\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x63\x75\x72\x73\x6F\x72","\x77\x61\x69\x74","\x63\x73\x73","\x62\x6F\x64\x79","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x22\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x22\x20\x63\x6C\x61\x73\x73\x3D\x22\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x22\x3B\x20\x73\x72\x63\x3D\x22\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x22\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x77\x61\x69\x74\x20\x66\x6F\x72\x20\x74\x68\x65\x20\x76\x6F\x75\x63\x68\x65\x72\x20\x74\x6F\x20\x62\x65\x20\x6D\x61\x64\x65\x20\x73\x6F\x6F\x6E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74","\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x42\x72\x6F\x61\x64\x63\x61\x73\x74\x5F\x79\x2E\x70\x68\x70","\x69\x64\x3D","\x26\x75\x73\x65\x72\x3D","\x26\x70\x61\x73\x73\x3D","\x26\x70\x72\x6F\x66\x69\x6C\x65\x3D","\x26\x75\x70\x74\x69\x6D\x65\x3D","\x64\x65\x66\x61\x75\x6C\x74","\x61\x6A\x61\x78","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x56\x31","\x73\x75\x63\x63\x65\x73\x73","\x64\x69\x73\x6D\x69\x73\x73\x65\x64","\x6C\x6F\x67","\x6E\x6F\x74\x69\x66\x79"];function makevoucher(){var _0xfd0bx2=$(_0xdc66[1])[_0xdc66[0]]();var _0xfd0bx3=$(_0xdc66[2])[_0xdc66[0]]();var _0xfd0bx4=$(_0xdc66[3])[_0xdc66[0]]();var _0xfd0bx5=$(_0xdc66[4])[_0xdc66[0]]();var _0xfd0bx6=$(_0xdc66[5])[_0xdc66[0]]();if(_0xfd0bx2[_0xdc66[6]]== 0){alertify[_0xdc66[9]](_0xdc66[7],_0xdc66[8])}else {if(_0xfd0bx3[_0xdc66[6]]== 0){alertify[_0xdc66[9]](_0xdc66[10],_0xdc66[11])}else {if(_0xfd0bx4[_0xdc66[6]]== 0){alertify[_0xdc66[9]](_0xdc66[12],_0xdc66[13])}else {if(_0xfd0bx5[_0xdc66[6]]== 0){alertify[_0xdc66[9]](_0xdc66[14],_0xdc66[15])}else {if(_0xfd0bx6[_0xdc66[6]]== 0){alertify[_0xdc66[9]](_0xdc66[16],_0xdc66[17])}else {$(_0xdc66[21])[_0xdc66[20]](_0xdc66[18],_0xdc66[19]);$(_0xdc66[24])[_0xdc66[23]](_0xdc66[22]);$[_0xdc66[32]]({url:_0xdc66[25],data:_0xdc66[26]+ _0xfd0bx2+ _0xdc66[27]+ _0xfd0bx3+ _0xdc66[28]+ _0xfd0bx4+ _0xdc66[29]+ _0xfd0bx5+ _0xdc66[30]+ _0xfd0bx6,cache:false,success:function(_0xfd0bx7){$(_0xdc66[24])[_0xdc66[23]](_0xfd0bx7);$(_0xdc66[21])[_0xdc66[20]](_0xdc66[18],_0xdc66[31])}});alertify[_0xdc66[37]](_0xdc66[33],_0xdc66[34],10,function(){console[_0xdc66[36]](_0xdc66[35])})}}}}}}

var _0x6e79=["\x76\x61\x6C","\x23\x6E\x75\x6D\x69\x64","\x23\x56\x6F\x63\x4E\x75\x6D","\x6C\x65\x6E\x67\x74\x68","\x49\x6E\x70\x75\x74\x20\x69\x64\x20\x75\x73\x65\x72","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x75\x73\x65\x72\x20\x49\x44\x73\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x61\x6C\x65\x72\x74","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x27\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x27\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x27\x3B\x20\x73\x72\x63\x3D\x27\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x27\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x50\x6C\x65\x61\x73\x65\x20\x63\x68\x6F\x6F\x73\x65\x20\x6F\x6E\x65\x20\x6F\x66\x20\x74\x68\x65\x20\x56\x6F\x75\x63\x68\x65\x72\x2E\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x63\x75\x72\x73\x6F\x72","\x77\x61\x69\x74","\x63\x73\x73","\x62\x6F\x64\x79","\x3C\x69\x6D\x67\x20\x73\x74\x79\x6C\x65\x3D\x22\x77\x69\x64\x74\x68\x3A\x33\x30\x25\x3B\x22\x20\x63\x6C\x61\x73\x73\x3D\x22\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x2D\x69\x6D\x61\x67\x65\x20\x63\x65\x6E\x74\x65\x72\x22\x3B\x20\x73\x72\x63\x3D\x22\x2E\x2E\x2F\x69\x6D\x67\x2F\x6C\x6F\x61\x64\x69\x6E\x67\x2E\x73\x76\x67\x22\x2F\x3E\x3C\x62\x72\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E\x4D\x6F\x68\x6F\x6E\x20\x64\x69\x74\x75\x6E\x67\x67\x75\x20\x56\x6F\x75\x63\x68\x65\x72\x20\x61\x6B\x61\x6E\x20\x73\x65\x67\x65\x72\x61\x20\x64\x69\x62\x75\x61\x74\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74\x32","\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x42\x72\x6F\x61\x64\x63\x61\x73\x74\x5F\x7A\x2E\x70\x68\x70","\x6E\x75\x6D\x69\x64\x3D","\x26\x56\x6F\x63\x4E\x75\x6D\x3D","\x64\x65\x66\x61\x75\x6C\x74","\x61\x6A\x61\x78","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x56\x31","\x73\x75\x63\x63\x65\x73\x73","\x64\x69\x73\x6D\x69\x73\x73\x65\x64","\x6C\x6F\x67","\x6E\x6F\x74\x69\x66\x79"];function createVoc(){var _0xb2e2x2=$(_0x6e79[1])[_0x6e79[0]]();var _0xb2e2x3=$(_0x6e79[2])[_0x6e79[0]]();if(_0xb2e2x2[_0x6e79[3]]== 0){alertify[_0x6e79[6]](_0x6e79[4],_0x6e79[5])}else {if(_0xb2e2x3[_0x6e79[3]]== 0){alertify[_0x6e79[6]](_0x6e79[4],_0x6e79[7])}else {$(_0x6e79[11])[_0x6e79[10]](_0x6e79[8],_0x6e79[9]);$(_0x6e79[14])[_0x6e79[13]](_0x6e79[12]);$[_0x6e79[19]]({url:_0x6e79[15],data:_0x6e79[16]+ _0xb2e2x2+ _0x6e79[17]+ _0xb2e2x3,cache:false,success:function(_0xb2e2x4){$(_0x6e79[14])[_0x6e79[13]](_0xb2e2x4);$(_0x6e79[11])[_0x6e79[10]](_0x6e79[8],_0x6e79[18])}});alertify[_0x6e79[24]](_0x6e79[20],_0x6e79[21],5,function(){console[_0x6e79[23]](_0x6e79[22])})}}}
    </script>
        <div class="sl-pagebody">
    <div class="card-body pd-sm-10">
        <div class="row row-sm mg-t--1">
            <div class="col-xl-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-shield"></i> Custom & Send Voucher </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <div class="row">
                                <label class="col-sm-4 form-control-label">ID user</label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="noid2" name="idnya" data-placeholder="Select ID">
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
                                <label class="col-sm-4 form-control-label">Username  </label>
                                <div class="col-lg">
                                    <input type="text" id="user" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Password  </label>
                                <div class="col-lg">
                                    <input type="text" id="pass" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Profile  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="profile" Nama="Profile" data-placeholder="Select Profile">
                                <option value="">Select Profile</option>
  <?php
  foreach ($profilevoc as $profiles): ?> <!-- Mulai loop -->
                                           <option value="<?=$profiles['name'];?>"><?php echo $profiles['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">limit Uptime  </label>
                                <div class="col-lg">
                                    <input type="text" id="limit" class="form-control" placeholder="limit Uptime">
                                </div>
                            </div>
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onClick="makevoucher();return false;"><i class="fa fa-send mg-r-2"></i> Send Voucher</button>
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
                            <i class="fa  fa-desktop"></i> Show Response </div>
                        <div class="card-body pd-sm-15">
                            <div id="view-respont"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-share-alt-square"></i> Create & Send Voucher </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <div class="row">
                                <label class="col-sm-4 form-control-label">ID user</label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="numid" name="numid" data-placeholder="Select ID">
                                <option value="">SelectID</option>
                                <?php
                                foreach ($data as $index => $baris): ?> 
                                           <option value="<?=$baris['id_user'];?>"><?php echo $baris['id_user'] . '    (' . $baris['nama_seller'] . ')'; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Voucher  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="VocNum" Nama="VocNum" data-placeholder="Select Voucher">
                                <option value="">Select Profile</option>
  <?php
  foreach ($datajson as $datajsons): ?> <!-- Mulai loop -->
                                           <option value="<?=$datajsons['id'];?>"><?php echo $datajsons['Voucher']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                </div>
                            </div>
                              <div class="row mg-t-8">
                              	<label class="col-sm-4 form-control-label">  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												 <?= $echo ?>    		         
                            </div>				    
                            </div>
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-0" onClick="createVoc();return false;"><i class="fa fa-send mg-r-2"></i>Send Voucher</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2"> <i class="fa fa-trash mg-r-2"></i>Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            <!-- card-body -->
                        </form>
                        <!-- card-body -->
                        <!-- card -->
                    </div>
                </div>
                <div class="mg-t-10">
                    <div class="card bd-primary">
                        <div class="card-header bg-primary tx-white">
                            <i class="fa  fa-desktop"></i> Show Response </div>
                        <div class="card-body pd-sm-15">
                            <div id="view-respont2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body -->
        </div>
    </div>


</div>