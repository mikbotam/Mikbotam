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

		$getaction = $_GET['pppuseraction'];

		if (isset($_POST['savedata'])) {
			$name            = $_POST['name'];
			$password        = $_POST['password'];
			$service         = $_POST['service'];
			$profiles        = $_POST['profile'];
			$loc_address     = $_POST['loc_address'];
			$rem_address     = $_POST['rem_address'];
			$comment         = $_POST['Comment'];
			$makeuserprofile = $API->comm("/ppp/secret/add", [
				"name" => $name,
				"password" => $password,
				"service" => $service,
				"profile" => $profiles,
				"local-address" => $loc_address,
				"remote-address" => $rem_address,
				"comment" => 'mkb | ' . $comment
			]);
			$checkdata = json_encode($makeuserprofile);
			$cek       = $makeuserprofile['!trap'][0]['message'];

			if (strpos(strtolower($checkdata), '!trap')) {
				echo '<script language="javascript">';
				echo 'document.addEventListener("DOMContentLoaded", function() {';
				echo 'alertify.alert("Vaild Add PPP Secret", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Vaild Add PPP Secret </center>");';
				echo '});';
				echo '</script>';
			} else {

				echo '<script language="javascript">';
				echo 'document.addEventListener("DOMContentLoaded", function() {';
				echo 'alertify.alert("Success Add PPP Secret", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center> Success Add PPP Secret </center>");';
				echo '});';
				echo '</script>';
			}
		}

		if (isset($_GET['pppuseraction'])) {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				switch ($getaction) {
					case 'Delete':
						$API->write("/ppp/secret/remove", false);
						$API->write("=.id=" . $id);
						$API->read();
						echo '<script language="javascript">';
						echo 'document.addEventListener("DOMContentLoaded", function() {';
						echo 'alertify.alert("Delete PPP Secret", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center> Success Delete PPP Secret </center>").set(\'onok\', function(closeEvent){ window.location.href = "?Mikbotam=pppuser";} );';
						echo '});';
						echo '</script>';
						break;
					case 'Disable':
						$API->write("/ppp/secret/disable", false);
						$API->write("=.id=" . $id);
						$API->read();
						break;
					case 'Enable':
						$API->write("/ppp/secret/enable", false);
						$API->write("=.id=" . $id);
						$API->read();
						break;
					default:
						// code...
						break;
				}
			}
		}
	}
?>

            <?php
            	$API->write('/ppp/secret/getall');
            	$ARRAY = $API->read();
            	$data  = $ARRAY;

            ?>


 <div class="sl-pagebody">
      <div class="card bd-primary mg-t-3">
      	 <div class="card-header bg-primary tx-white"><i class="fa fa-user"></i>   PPP USER </div>
      <div class="card-body pd-sm-15">
				 <div class="table-wrapper">

					<table  id="ppplist" class="table display nowrap " width="100%">
						
						<thead>
                                        <tr>
                                            <th>id</th>
                                            <th>name</th>
                                            <th>password</th>
                                            <th>service</th>
                                            <th>profile</th>
                                            <th>local-address</th>
                                            <th>remote-address</th>
                                            <th>last-logged-out</th>
                                            <th>comment</th>
                                            <th>status</th>
                                            <th><i class="fa fa-gear"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $data as $index => $baris ) : ?> 
                                        <tr class="text-besar">
                                            <td><?php echo $baris['.id']; ?></td>
                                            <td><?php echo $baris['name']; ?></td>
                                            <td><?php echo $baris['password']; ?></td>
                                            <td><?php echo $baris['service']; ?></td>
                                            <td><?php echo $baris['profile']; ?></td>
                                            <td><?php echo $baris['local-address']; ?></td>
                                            <td><?php echo $baris['remote-address']; ?></td>
                                            <td><?php echo $baris['last-logged-out']; ?></td>
                                            <td><?php echo $baris['comment']; ?></td>
                                            <td><?php if($baris['disabled'] == 'true'){ ?>

                                           
                                            <span class="label label-danger">disable</span>

                                            <?php } else { ?>
                                            
                                            
                                            <span class="label label-info">enable</span>

                                            <?php } ?></td>
                                            <td>  
                                            	<select class="form-control select2id" onchange="window.location.href=this.value " style="width: 94px;"  data-placeholder="Action">
									   <option><?= ucfirst($delete); ?></option>
	    								<option value="./index.php?Mikbotam=pppuser&pppuseraction=Enable&id=<?=$baris['.id'];?>">Enable</option>
	    								<option value="./index.php?Mikbotam=pppuser&pppuseraction=Disable&id=<?=$baris['.id'];?>">Disable</option>
	    								<option value="./index.php?Mikbotam=pppuser&pppuseraction=Edit&id=<?=$baris['.id'];?>">Edit</option>
	    								<option value="./index.php?Mikbotam=pppuser&pppuseraction=Delete&id=<?=$baris['.id'];?>">Delete</option>

											</select>
											
											
                                      
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
             
                </div>
            </div>    
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog wd-100p mn-wd-50p" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-header pd-x-25 bg-primary">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Add User Secret </h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<div class="modal-body pd-15">	
	<div class="card bd bd-primary  ">
			<div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Name : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Password : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <input type="text" name="password" class="form-control">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Service : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                       <select class="form-control select2id" name="service" style="width: 100%;">
                                    <option value="any">any</option>
                                    <option value="async">async</option>
                                    <option value="l2tp">l2tp</option>
                                    <option value="ovpn">ovpn</option>
                                    <option value="pppoe">pppoe</option>
                                    <option value="pptp">pptp</option>
                                    <option value="sstp">sstp</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Profile : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" name="profile" style="width: 100%;">
                                    <?php 
                                        $API->write('/ppp/profile/getall');
                                        $PROFILE = $API->read();
                                        $p = $PROFILE;
                                        foreach( $p as $index => $baris ) : 
                                            echo "<option value='".$baris['name']."'>".$baris['name']."</option>";
                                        endforeach;
                                    ?>

                                </select>
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Local Address : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input id="ipaddress" type="text" name="loc_address" class="form-control" value="0.0.0.0">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Remote Address : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                   <input id="ipaddress" type="text" name="rem_address" class="form-control" value="0.0.0.0">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Comment : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <input type="text" name="Comment" class="form-control">
                                </div>
                            </div>
                            
                          
                            <div class="row row-xs mg-t-10">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                      <button type="submit" class="btn bg-primary tx-white" name="savedata" value="Save">Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            
                    </form></div>
                    
                    </div>
			 </div> </div> 
           
            </div>   </div>  