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
        header("Location:../admin/login.php");
    } else {
    	
        include '../config/system.conn.php';
    
    	$scheme = $_SERVER['REQUEST_SCHEME'];
    	if (strpos(strtolower($scheme), 'http') !== false){
    		$cekhttps="https://";
    	}else{
    	  $cekhttps=$scheme."://";
    	}
    	 
    	
    	if (isset($_POST['setwebhook'])){
    		$tokensaldo=$_POST['Tokensaldo'];
    		$urlsaldo=$_POST['URLsaldo'];
    		$set=setwebhook($urlsaldo,$token);
    		echo "<script>setTimeout(\"location.href = '?Mikbotam=setwebhook';\");</script>";
    	}
    	
    	if (isset($_POST['unsetwebhook'])){
    		if (isset($_POST['Tokensaldo'])&& !empty($_POST['Tokensaldo']) ){
    		$tokensaldo=$_POST['Tokensaldo'];
    		$urlsaldo=$_POST['URLsaldo'];
    	  $uset=	unssetwebhook($token); 
    		echo "<script>setTimeout(\"location.href = '?Mikbotam=setwebhook';\");</script>";
    	}
    	}
        $urlpath=$_SERVER['REQUEST_URI'];
       
        
        if (strpos($urlpath ,'index.php?Mikbotam=setwebhook')){
        	
         $linktobot=str_replace('/pages/index.php?Mikbotam=setwebhook', '/Saldo/Core.php',$urlpath);
        	
        }else{
        	
        $linktobot=str_replace('/pages/?Mikbotam=setwebhook', '/Saldo/Core.php',$urlpath);
       
        }
        
        
       $actual_link = $cekhttps . $_SERVER['HTTP_HOST']. $linktobot;
		 $getwebhhok=getWebhookInfo($token);
		 $jsonget=json_decode($getwebhhok,true);
		 $result=$jsonget['result'];
    }

?>


    <div class="card-body pd-sm-10">
        <div class="row row-sm mg-t--1">
            <div class="col-sm-6 mg-t-10">
               <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white"><i class="fa  fa-cog "></i> Set Webhook</div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="" >
                            <div class="row mg-t-8">
                                <label class="col-sm-3 form-control-label">Token bot </label>
                                <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                        <input id="Token" type="text" class="form-control" name="Tokensaldo" value=" <?=$token ;?>" readonly>
                                    </div>
                                </div>
                            </div>
                             <div class="row mg-t-8">
                                <label class="col-sm-3 form-control-label">URL to Bot </label>
                                                             <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                        <input id="URL" type="text" class="form-control" name="URLsaldo" value="<?=$actual_link;?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                       <button  class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8"type="submit" name="setwebhook"><i class="fa fa-thumbs-up mg-r-2"></i>  Set webhook </button>
                      <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8" type="submit" name="unsetwebhook"><i class="fa  fa-trash"> </i> Unset webhook</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                    </div>
                    <div id="view-respont"></div>
                </div>
            </div> 
            <div class="col-sm-6 mg-t-10">
               <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white"><i class="fa  fa-cog "></i> Get Webhook Info</div>
                    <div class="card-body pd-sm-15">
                    	<?php if(!empty($result['url'])){
                    		
                   echo '
                    	            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15">
                                    <div class="form-layout-footer">
                        <button  class="btn btn-success  mg-r-0 mg-t-8" disabled>Active </button>
                     	<button  class="btn btn-success  mg-r-0 mg-t-8" disabled>Perintah Pending '.$result['pending_update_count'].' </button>
                     	
                                    </div>
                                </div>
                            </div>
                    
                    	<div class="row mg-t-8">
                                <label class="col-sm-3 form-control-label">Token bot Active </label>
                                <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                        <input  type="text" class="form-control" value=" '.$token.'" readonly>
                                    </div>
                                </div>
                            </div>
                             <div class="row mg-t-8">
                                <label class="col-sm-3 form-control-label">URL Active </label>
                                                             <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                        <input  type="text" class="form-control"value="'.$result['url'].'">
                                    </div>
                                </div>
                            </div>';
                           
                    	}else{
                    	
                echo '
                    			<center><h5>Hanya untuk hosting dengan metode Webhook</h5></center>
                    		<button  class="btn btn-danger  mg-r-0 mg-t-8" disabled>Nonactive </button>
                    	';
                    	}?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <!-- body -->
