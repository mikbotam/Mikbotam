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

    $API->write('/ppp/active/getall');
    $ARRAY = $API->read();
    $data  = $ARRAY;

}

?>

 <div class="sl-pagebody">
      <div class="card bd-primary mg-t-3">
      	 <div class="card-header bg-primary tx-white"><i class="fa fa-user"></i>   PPP Active </div>
      <div class="card-body pd-sm-15">
      	
				 <div class="table-wrapper">
					<table  id="userlist" class="table display nowrap " width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>service</th>
                                    <th>caller-id</th>
                                    <th>address</th>
                                    <th>uptime</th>
                                    <th>encoding</th>
                                    <th>session-id</th>
                                    <th>limit-bytes-in</th>
                                    <th>limit-bytes-out</th>
                                    <th>radius</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $data as $index => $baris ) : ?> 
                                <tr class="text-besar">
                                    <td><?php echo $baris['.id']; ?></td>
                                    <td><?php echo $baris['name']; ?></td>
                                    <td><?php echo $baris['service']; ?></td>
                                    <td><?php echo $baris['caller-id']; ?></td>
                                    <td><?php echo $baris['address']; ?></td>
                                    <td><?php echo $baris['uptime']; ?></td>
                                    <td><?php echo $baris['encoding']; ?></td>
                                    <td><?php echo $baris['session-id']; ?></td>
                                    <td><?php echo $baris['limit-bytes-in']; ?></td>
                                    <td><?php echo $baris['limit-bytes-out']; ?></td>
                                    <td><?php echo $baris['radius']; ?></td>
                                </tr>
                                <?php endforeach; ?>                    
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>