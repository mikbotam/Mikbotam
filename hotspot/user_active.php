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

	$data = $API->comm('/ip/hotspot/active/print');

}

?>


<div class="sl-pagebody">
      <div class="card bd-primary mg-t-3">
      	 <div class="card-header bg-primary tx-white"><i class="fa fa-user"></i>   Hotspot Active </div>
      <div class="card-body pd-sm-15">
      	
				 <div class="table-wrapper">
					<table  id="userlist" class="table display nowrap " width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>User</th>
								<th>Address</th>
								<th>Mac Address</th>
								<th>Uptime</th>
								<th>Server</th>
							
							</tr>
						</thead>
						<tbody>
							<?php foreach( $data as $index => $baris ) : ?> 
							<tr>
								<td><?php echo $baris['.id']; ?></td>
								<td><?php echo $baris['user']; ?></td>
								<td><?php echo $baris['address']; ?></td>
								<td><?php echo $baris['mac-address']; ?></td>
								<td><?php echo $baris['uptime']; ?></td>
								<td><?php echo $baris['server']; ?></td>
							
							</tr>
							<?php endforeach; ?>                       
						</tbody>
					</table>
				</div>
			</div>
	
	</div>
</div>