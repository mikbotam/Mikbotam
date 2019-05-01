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
	

		if (isset($_POST['saved'])) {
			$name        = $_POST['name'];
			$loc_address = $_POST['loc_address'];
			$rem_address = $_POST['rem_address'];
			$dns_server  = $_POST['dns_server'];
			$rate_limit  = $_POST['rate_limit'];
			$par_queue   = $_POST['par_queue'];
			$selectme    = $_POST['selectme'];
			$profilemove = $_POST['profilemove'];
			$comment = $_POST['comment'];

			if ($selectme == 'enable') {
				if (empty($_POST['Validity'])) {
					$Validity = '31d';
				} else {
					$Validity = $_POST['Validity'];
				}

				$onup = ':local pengguna $user;:local date [/system clock get date];:local time [/system clock get time];:log warning "$pengguna telah login pada jam $time";{:if ([/system scheduler find name=$pengguna]="") do={/system scheduler add name=$pengguna interval=' . $Validity . ' on-event="/ppp secret set profile=' . $profilemove . ' [find name=$pengguna]\r\n/ppp active remove [find name=$pengguna]\r\n"}}';

				$profileppp = $API->comm("/ppp/profile/add", [
					"name" => $name,
					"local-address" => $loc_address,
					"remote-address" => $rem_address,
					"dns-server" => $dns_server,
					"rate-limit" => $rate_limit,
					"parent-queue" => $par_queue,
					"on-up" => $onup
				]);
			} else {

				$profileppp = $API->comm("/ppp/profile/add", [
					"name" => $name,
					"local-address" => $loc_address,
					"remote-address" => $rem_address,
					"dns-server" => $dns_server,
					"rate-limit" => $rate_limit,
					"parent-queue" => $par_queue,
				    "comment"      => $comment,
				]);
			}

			$checkdata = json_encode($profileppp);

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
						$API->write("/ppp/profile/remove", false);
						$API->write("=.id=" . $id);
						$API->read();
						echo '<script language="javascript">';
						echo 'document.addEventListener("DOMContentLoaded", function() {';
						echo 'alertify.alert("Delete PPP Profile", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center> Success Delete PPP Profile </center>").set(\'onok\', function(closeEvent){ window.location.href = "?Mikbotam=pppprofile";} );';
						echo '});';
						echo '</script>';
						break;
					case 'Disable':
						$API->write("/ppp/profile/disable", false);
						$API->write("=.id=" . $id);
						$API->read();
						break;
					case 'Enable':
						$API->write("/ppp/profile/enable", false);
						$API->write("=.id=" . $id);
						$API->read();
						break;
					case 'Edit':
						echo '<script>';
						echo '$("#").modal("show")';
						echo '</script>';
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
	$API->write('/ppp/profile/getall');
	$ARRAY = $API->read();
	$data  = $ARRAY;
	$pool =  $API->comm('/ip/pool/print');
?>


 <div class="sl-pagebody">
      <div class="card bd-primary mg-t-3">
      	 <div class="card-header bg-primary tx-white"><i class="fa fa-user"></i>   PPP Profile </div>
      <div class="card-body pd-sm-15">
				 <div class="table-wrapper">
					<table  id="ppplistprofile" class="table display nowrap " width="100%">

                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>local-address</th>
                                <th>remote-address</th>
                                <th>use-compression</th>
                                <th>use-encryption</th>
                                <th>only-one</th>
                                <th>change-tcp-mss</th>
                                <th>address-list</th>
                                <th>dns-server</th>
                                <th><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $data as $index => $baris ) : ?> 
                            <tr class="text-besar">
                                <td><?php echo $baris['.id']; ?></td>
                                <td><?php echo $baris['name']; ?></td>
                                <td><?php echo $baris['local-address']; ?></td>
                                <td><?php echo $baris['remote-address']; ?></td>
                                <td><?php echo $baris['use-compression']; ?></td> 
                                <td><?php echo $baris['use-encryption']; ?></td>
                                <td><?php echo $baris['only-one']; ?></td>
                                <td><?php echo $baris['change-tcp-mss']; ?></td>
                                <td><?php echo $baris['address-list']; ?></td>
                                <td><?php echo $baris['dns-server']; ?></td>
                               
                                  <td>  
                              <select class="form-control select2id" onchange="window.location.href=this.value " style="width: 94px;"  data-placeholder="Action">
									   <option><?= ucfirst($delete); ?></option>
	    								<option value="./index.php?Mikbotam=pppprofile&action=Enable&id=<?=$baris['.id'];?>">Enable</option>
	    								<option value="./index.php?Mikbotam=pppprofile&action=Disable&id=<?=$baris['.id'];?>">Disable</option>
	    								<option value="./index.php?Mikbotam=pppprofile&action=Edit&id=<?=$baris['.id'];?>">Edit</option>
	    								<option value="./index.php?Mikbotam=pppprofile&action=Delete&id=<?=$baris['.id'];?>">Delete</option>

											</select>
											
											
                                      
                               
                            </tr>
                            <?php endforeach; ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>    

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog wd-100p mn-wd-40p" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-header pd-x-25 bg-primary">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Add Profile PPP </h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<div class="modal-body pd-15">	
	<div class="card bd bd-primary  ">
			<div class="card-body pd-sm-15">
            
            <form id="modal-form" action="" method="post">
            	
            	
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Name : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            
             
               
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Local Addrees : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <input  id="ipaddress" type="text" name="loc_address" class="form-control" value="0.0.0.0" >
                                </div>
                            </div>
                            
                            
              
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Remote Address  : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
								<select class="form-control poll"  style="width: 100%;"  name="rem_address">

											
												<option value="all">all</option>

												<?php	

												foreach ($pool as $index => $jambus): ?>
												<option value="<?=$jambus['name'];?>"><?php echo $jambus['name'];?></option>
												<?php endforeach;
												?>

											</select>
										</div>
                            </div>
                            
            
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">DNS Server  : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                       <input  id="ipaddress" type="text" name="dns_server" class="form-control" value="0.0.0.0" >
                                </div>
                            </div>
                            
              
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Rate limit [Tx/Rx] : : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <input type="text" name="rate_limit" class="form-control">
                                </div>
                            </div>
                            
            
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Parent Queue  : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" style="width: 100%;" name="par_queue">
                        <?php 
                            $API->write('/queue/simple/getall');
                            $queeue = $API->read();
                            	echo "<option value='none'>none</option>";
                            foreach( $queeue as $index => $baris ) : 
                            
                                echo "<option value='".$baris['name']."'>".$baris['name']."</option>";
                            endforeach;
                        ?>

                    </select>
                                </div>
                                
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Comment </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <input type="text" name="Comment" class="form-control">
                                </div>
                            </div>
                              <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Move Profile After Experid : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" id="selectme" style="width: 100%;" name="selectme"  data-placeholder="Select " required>
                                    		<option value=''></option>
                                    		<option value='enable'>enable</option>
                                          <option value='disable'>disable</option>
                  				     </select>
                                </div>
                            </div>
                            	   <div id="hiden" class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Validity </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="Validity" class="form-control">
                                </div>
                                
                            </div>
         						   <div id="hidenpp" class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Move to Profile PPP  : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select class="form-control select2id" style="width: 100%;" name="profilemove" required>
                        <?php 
                          
                            foreach( $data as $index => $baris ) : 
                            
                                echo "<option value='".$baris['name']."'>".$baris['name']."</option>";
                            endforeach;
                        ?>

                    </select>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row row-xs mg-t-10">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                    	  <button type="submit" class="btn btn-primary" name="saved" value="Save">Save changes</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
             
                
            </form>
        </div>
        <script>
    var _0xa0ad=["\x68\x69\x64\x65","\x23\x68\x69\x64\x65\x6E","\x23\x68\x69\x64\x65\x6E\x70\x70","\x63\x68\x61\x6E\x67\x65","\x76\x61\x6C\x75\x65","\x65\x6E\x61\x62\x6C\x65","\x73\x68\x6F\x77","\x6F\x6E","\x23\x73\x65\x6C\x65\x63\x74\x6D\x65","\x72\x65\x61\x64\x79"];$(document)[_0xa0ad[9]](function(){$(_0xa0ad[1])[_0xa0ad[0]]();$(_0xa0ad[2])[_0xa0ad[0]]();$(_0xa0ad[8])[_0xa0ad[7]](_0xa0ad[3],function(){if(this[_0xa0ad[4]]== _0xa0ad[5]){$(_0xa0ad[1])[_0xa0ad[6]]();$(_0xa0ad[2])[_0xa0ad[6]]()}else {$(_0xa0ad[1])[_0xa0ad[0]]();$(_0xa0ad[2])[_0xa0ad[0]]()}})})
    


</script>

    </div>
</div> 
    </div>
</div> 
    </div>




