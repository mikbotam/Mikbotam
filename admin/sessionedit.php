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
  		$id=$_SESSION['Mikbotamid'];
      include '../config/system.conn.php';

    	if (isset($_POST['save'])){
    		 $user=$_POST['user'];
    		 $pass=$_POST['pass'];
    		
    		 	
    		 	if (!empty($pass)&&!empty($pass)){
    		 		
    		 		$update=updatesession($user, $pass,$id);
    		 		if (empty($update)){
    		 		 echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'alertify.alert("Oh no", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>The user and password cannot be the same as the old one</center>").set(\'onok\', function(closeEvent){ window.location.href = "?admin=sessionedit";} );';
                echo '});';
                echo '</script>';
    		 		}else{
					 echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'alertify.alert("Done", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Done ! Your session has been updated </center>").set(\'onok\', function(closeEvent){ window.location.href = "?admin=sessionedit";} );';
                echo '});';
                echo '</script>';
    		 		} 
                
    		 	}else{
    		 	
    		 	    echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'alertify.alert("Error", "<img style=\'width:30%\' class=\'responsive-image center\' src=\'../img/loading.svg\' alt=\'error\'><br><center>Username and password cannot be empty</center>").set(\'onok\', function(closeEvent){ window.location.href = "?admin=sessionedit";} );';
                echo '});';
                echo '</script>';	
    		 	}
	
    	}
    	
    }




  ?>
       
     <script>
    function Passmikbot() {
        var x = document.getElementById('password');
        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    };



    </script>
  
      <div class="sl-pagebody">
      	<div class="row row-sm">
        <div class="col-lg-4 mg-t-8">
            <div class="card bd bd-primary">
                <div class="card-body ">
                    <div class="card pd-20 pd-sm-20  bg-primary ">
                        <div class="signin-logo tx-center text-capitalize tx-20 tx-bold tx-white">
                            <img src="../img/logoMwhite.svg" alt="Mikbotam.id" style="
                                width: 48%;
                                ">
                            <br>
                                  </div>

                    </div>

                </div>

            </div>
        </div>

      	<div class="col-xl-6 mg-t-8">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa  fa-pencil-square-o"></i> Login Settings </div>
                    <div class="card-body pd-sm-15">
                        <form method="post" action="">
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Username  </label>
                                <div class="col-lg">
                                    <input type="text" name="user" class="form-control" placeholder="Username" value="<?=seeusersession($id);?>">
                                </div>
                            </div>
                            <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Password  </label>
                                <div class="col-lg">
                                                                                    <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
                  <label class="ckbox wd-16">
                    <input type="checkbox" name="checkbox" value="0" onclick="Passmikbot()" ><span></span>
                                                    </label>
                                                    </span>
                                                    <input  id="password" type="password" class="form-control" name="pass" placeholder="Password" value="<?=seepasssession($id);?>">
                                                </div>
                                </div>
                            </div>
 
                            <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                    	<button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" name="save" type="submit"><i class="fa fa-send mg-r-2"></i> Update Session</button>
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
    </div></dvi>