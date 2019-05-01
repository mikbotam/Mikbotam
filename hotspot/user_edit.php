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


	include '../config/system.conn.php';
	include '../config/system.byte.php';
	include '../Api/routeros_api.class.php';
	$API = new routeros_api();

	if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port));

	$id          = $_GET['id'];
	$getuserdata = $API->comm("/ip/hotspot/user/print", [
		"?.id" => $id,
	]);

	$lim_upload    = $getuserdata[0]['limit-bytes-in'] / 1000000;
	$lim_download  = $getuserdata[0]['limit-bytes-out'] / 1000000;
	$profiles      = $API->comm('/ip/hotspot/user/profile/print');
	$serverhotspot = $API->comm('/ip/hotspot/print');
	$serverhotspot = $serverhotspot;


?>

	<div class="card bd bd-primary  ">
			<div class="card-body pd-sm-15">
                      
                <form action="" method="post">
                 <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Server : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                         <select class="form-control select2id" name="server" required="1">
                                <option>all</option>
                                <?php foreach ($serverhotspot as $data) { ?>
                                	<option value="<?=$data['name'];?>"
                                		<?php if($getuserdata[0]['server'] == $data['name']){
                                			echo 'selected';
                                		}?>
                                	><?=$data['name'];?></option>
                                <?php }?>
                            </select>
                                </div>
                            </div>
                            
                  <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Username : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                  <input type="text" name="username" class="form-control" value="<?=$getuserdata[0]['name'];?>" required>
                                </div>
                            </div>
                            
          
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Password : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="password" class="form-control" value="<?=$getuserdata[0]['password'];?>">
                                </div>
                            </div>
                            
           
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Uptime : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                   <input type="text" name="limit_uptime" class="form-control" value="<?=$getuserdata[0]['limit-uptime'];?>"> 
                                </div>
                            </div>
                
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_download" class="form-control" value="<?=$lim_download;?>"> 
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            
                            
               
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_upload" class="form-control" value="<?=$lim_upload;?>"> 
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            
                            
                            
             
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Uptime : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <input type="text" name="" class="form-control" value="<?=formatDTM($getuserdata[0]['uptime']);?>" readonly> 
                                </div>
                            </div>
                            
                            
                   
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Download : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="" class="form-control" value="<?=formatBytes($getuserdata[0]['bytes-in']);?>" readonly> 
                                </div>
                            </div>
                            
                            
               
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Upload : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                 <input type="text" name="" class="form-control" value="<?=formatBytes($getuserdata[0]['bytes-out']);?>" readonly> 
                                </div>
                            </div>
              
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Profile : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                      <select class="form-control select2id" name="profile" required>
                                <option value=''>- choose -</option>
                                <?php foreach($profiles as $baris) {?> 
                                    <option value="<?=$baris['name'];?>"
                                    <?php if($getuserdata[0]['profile'] == $baris['name']){
                                    	echo 'selected';
                                    }?>
                                    ><?=$baris['name'];?></option>
                                <?php } ?>
                            </select>
                                </div>
                            </div>
                            
        
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Comment : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                  <input type="text" name="comment" class="form-control" value="<?=$getuserdata[0]['comment'];?>" >
                                </div>
                            </div>
                            
                   
                    
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Status : </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                       <select class="form-control select2id" name="disabled" required>
                                <option value=''>- choose -</option>
                                <option value='false' <?php if($getuserdata[0]['disabled'] == 'false'){echo "selected";}?>>Enabled</option>
                                <option value='true' <?php if($getuserdata[0]['disabled'] == 'true'){echo "selected";}?>>Disabled</option>
                            </select>
                                </div>
                            </div>
                            
                            
              
                      
                       <div class="row row-xs mg-t-10">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                     				<input type="hidden" name="uid" value="<?=$getuserdata[0]['.id'];?>" > 
                            <button type="submit" class="btn btn-primary" name="save_user">Save User</button>
                            <button type="button" class="btn btn-danger">Reset</button>
                                    </div>
                                
                                </div>
                           
                            </div>
                  
                </form>
            </div>           </div>