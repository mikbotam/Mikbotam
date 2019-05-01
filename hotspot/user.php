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

error_reporting(0);

if (!isset($_SESSION["Mikbotamuser"])) {
    header("Location:admin/login.php");
} else {
    include '../config/system.conn.php';
    include '../config/system.byte.php';
    include '../Api/routeros_api.class.php';
    $API = new routeros_api();

    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port));

    if (isset($_POST['save_user'])) {
        $server           = $_POST['server'];
        $username         = $_POST['username'];
        $password         = $_POST['password'];
        $profile          = $_POST['profile'];
        $limit_uptime     = $_POST['limit_uptime'];
        $limit_download   = toBytes($_POST['limit_download']);
        $limit_upload     = toBytes($_POST['limit_upload']);
        $add_user_hotspot = $API->comm("/ip/hotspot/user/add", [
            "server" => $server,
            "name" => $username,
            "password" => $password,
            "profile" => $profile,
            "limit-uptime" => $limit_uptime,
            "limit-bytes-out" => $limit_download,
            "limit-bytes-in" => $limit_upload,
        ]);
        $checkdata = json_encode($add_user_hotspot);

        if (strpos(strtolower($checkdata), '!trap')) {
            echo '<script language="javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'alertify.alert("Vaild Add User Hotspot", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Vaild  Add User Hotspot </center>");';
            echo '});';
            echo '</script>';
        } else {

            echo '<script language="javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'alertify.alert("Success  Add User Hotspot", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center> Success  Add User Hotspot </center>");';
            echo '});';
            echo '</script>';
        }
    }

    $getaction = $_GET['action'];

    if (isset($_GET['action'])) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            switch ($getaction) {
                case 'Delete':
                    $id = $_GET['id'];
                    $API->write("/ip/hotspot/user/remove", false);
                    $API->write("=.id=" . $id);
                    $API->read();
                    echo '<script language="javascript">';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo 'alertify.alert("Delete PPP Secret", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center> Success Delete PPP Secret </center>").set(\'onok\', function(closeEvent){ window.location.href = "?Mikbotam=Hotspotuserlist";} );';
                    echo '});';
                    echo '</script>';
                    break;
                case 'Disable':
                    $id = $_GET['id'];
                    $API->write("/ip/hotspot/user/disable", false);
                    $API->write("=.id=" . $id);
                    $API->read();
                    break;
                case 'Enable':
                    $id = $_GET['id'];
                    $API->write("/ip/hotspot/user/enable", false);
                    $API->write("=.id=" . $id);
                    $API->read();
                    break;
                case 'Edit':
                    echo '<script>';
                    echo '$("#Hotspotadd").modal("show")';
                    echo '</script>';
                    break;
                default:
                    // code...
                    break;
            }
        }
    }

    $QUEUE = $API->comm("/queue/simple/print", [
        "?dynamic" => "false",
    ]);
    $seeprofile = $API->comm('/ip/hotspot/user/profile/print');
    $seesever  = $API->comm('/ip/hotspot/print');
    $seeuser   = $API->comm('/ip/hotspot/user/print');
}

?>


<script>
var _0x82f1=["\x73\x68\x6F\x77\x2E\x62\x73\x2E\x6D\x6F\x64\x61\x6C","\x69\x64","\x64\x61\x74\x61","\x72\x65\x6C\x61\x74\x65\x64\x54\x61\x72\x67\x65\x74","\x63\x75\x72\x73\x6F\x72","\x77\x61\x69\x74","\x63\x73\x73","\x62\x6F\x64\x79","\x2E\x2E\x2F\x68\x6F\x74\x73\x70\x6F\x74\x2F\x75\x73\x65\x72\x5F\x65\x64\x69\x74\x2E\x70\x68\x70","\x69\x64\x3D","\x68\x74\x6D\x6C","\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74","\x64\x65\x66\x61\x75\x6C\x74","\x61\x6A\x61\x78","\x6F\x6E","\x23\x75\x73\x65\x72\x65\x64\x69\x74"];function edituser(){$(_0x82f1[15])[_0x82f1[14]](_0x82f1[0],function(_0xfe4ax2){var _0xfe4ax3=$(_0xfe4ax2[_0x82f1[3]])[_0x82f1[2]](_0x82f1[1]);$(_0x82f1[7])[_0x82f1[6]](_0x82f1[4],_0x82f1[5]);$[_0x82f1[13]]({url:_0x82f1[8],data:_0x82f1[9]+ _0xfe4ax3,cache:false,success:function(_0xfe4ax4){$(_0x82f1[11])[_0x82f1[10]](_0xfe4ax4);$(_0x82f1[7])[_0x82f1[6]](_0x82f1[4],_0x82f1[12])}})})}
    </script>

    <div class="sl-pagebody">
      <div class="card bd-primary mg-t-3">
      	 <div class="card-header bg-primary tx-white"><i class="fa fa-user"></i>   Hotspot Manager </div>
      <div class="card-body pd-sm-15">

                <div class="table-wrapper">
                    <table  id="hotspot" class="table display nowrap " width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                
                                <th>Username</th>
                                <th>Password</th>
                                <th>Uptime Limit</th>
                                <th>Uptime Used</th>
                                <th>Download</th>
                                <th>Upload</th>
                                <th>Profile</th>
                                <th>Status</th>
                                <th>comment</th>
                               <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $seeuser as $index => $baris ) :
                                $comment = explode ("|",$baris['comment']); ?>
                            <tr>

                                <td><?php echo $baris['.id']; ?></td>
                               
                                <td><a href='#useredit' class="txt-black" data-toggle='modal' onclick='edituser();' data-id="<?=$baris['.id'];?>"><i class='fa fa-pencil-square-o'></i></a>&nbsp; <?php echo $baris['name']; ?></td>
                                <td><?php echo $baris['password']; ?></td>
                                <td ><?php echo $baris['limit-uptime']; ?></td>
                                <td ><?php echo formatDTM($baris['uptime']); ?></td>
                                <td ><?php echo formatBytes($baris['bytes-in']); ?></td>
                                <td ><?php echo formatBytes($baris['bytes-out']); ?></td>
                                <td><?php echo $baris['profile']; ?></td>
                                <td>

                                <?php if($baris['disabled'] == 'true'){ ?>

                                <a href="?Mikbotam=Hotspotuserlist&action=Enable&id=<?php echo $baris['.id']; ?>" title="Enable">
                                <span class="label label-danger">disable</span></a>

                                <?php } else { ?>

                                <a href="?Mikbotam=Hotspotuserlist&action=Disable&id=<?php echo $baris['.id']; ?>" title="Disable">
                                <span class="label label-info">enable</span></a>

                                <?php } ?>




                                </td>
                                <td><?php echo $comment[0]." ".rupiah($comment[2])." ".$comment[1] ;?></td>
                               <td><select class="form-control select2id" onchange="window.location.href=this.value " style="width: 94px;"  data-placeholder="Action">
                                       <option><?= ucfirst($delete); ?></option>
        								<option value="./index.php?Mikbotam=Hotspotuserlist&action=Enable&id=<?=$baris['.id'];?>">Enable</option>
        								<option value="./index.php?Mikbotam=Hotspotuserlist&action=Disable&id=<?=$baris['.id'];?>">Disable</option>
        								<option value="./index.php?Mikbotam=Hotspotuserlist&action=Delete&id=<?=$baris['.id'];?>">Delete</option>

                                            </select>

                                      </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                </div>
      </div> </div>


   <div id="Hotspotadd" class="modal fade" role="dialog">
    <div class="modal-dialog wd-100p mn-wd-50p" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-25 bg-primary">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Add User Hotspot </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body pd-15">
    <div class="card bd bd-primary  ">
            <div class="card-body pd-sm-15">

                <form action="" method="post">
                	    <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Server : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <select class="form-control select2id" style="width: 100%;" name="server" required>
                                <option>all</option>
                                <?php $TotalReg = count($seesever);
                                for ($i=0; $i<$TotalReg; $i++){
                                  echo "<option>" . $seesever[$i]['name'] . "</option>";
                                  }
                                ?>
                            </select>
                                </div>
                            </div>
                <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Username : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                            </div>


                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Password : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <input type="text" name="password" class="form-control" >
                                </div>
                            </div>

                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Uptime : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <input type="text" name="limit_uptime" class="form-control" value="00:00:00">
                                       <p>
                                [wdhm] ex: 30d = 30hari, 12h = 12jam, 4w3d = 31hari.
                            </p>
                                </div>
                            </div>



                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download" class="form-control" value="0">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload" class="form-control" value="0">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>




                      <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Profile : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <select class="form-control select2id" style="width: 100%;" name="profile" required>
                                <option value=''>- choose -</option>
                                <?php foreach( $seeprofile as $index => $baris ) :
                                    echo "<option value='".$baris['name']."'>".$baris['name']."</option>";
                                endforeach; ?>
                            </select>
                                </div>
                            </div>
                            <div class="row mg-t-8">
                            <label class="col-sm-4 form-control-label">Parent Queue</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2id" style="width: 100%;" name="parent" data-toggle="tooltip" data-placement="top" title="Jika kosong pilih none" >
                                <option>none</option>
                                <?php  foreach ($QUEUE as $index => $barisan) : ?>

                                <option value="<?=$barisan['name'] ?>"><?=$barisan['name'] ?></option>

                                <?php  endforeach;
                                ?>
                            </select>
                            </div>
                            </div>


                       <div class="row row-xs mg-t-10">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                     				<button type="submit" class="btn bg-primary tx-white" name="save_user" >Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger">Reset</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>

                </form>
            </div>

            </div>


             </div> </div>

            </div>   </div>



               <div id="useredit" class="modal fade" role="dialog">
    <div class="modal-dialog wd-100p mn-wd-50p" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-25 bg-primary">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Edit User Hotspot </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body pd-15">
                <div id="view-respont">

            <h2>Loading...</h2>
                 </div>

                 </div> </div>

            </div>   </div>


