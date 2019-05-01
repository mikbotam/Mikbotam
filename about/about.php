<?php //=====================================================START====================//

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
        header("Location:admin/login.php");
    }else{
    	include '../config/system.database.php';
    }

?>
<div class="sl-pagebody">
 <div class="row mg-t-2">
        <div class="col-sm-4 pd-8">
            <div class="user-profile-box mg-b-8">
                <div class="box-profile text-white">
                    <img class="profile-user-img img-responsive rounded-circle mg-b-2" src="../img/logoM.png" alt="User profile picture">
                     <h3 class="profile-username text-center">Mikbotam</h3>
                    <p class="text-center">© BangAcil</p>
                    <p class="text-center mg-t-1">Profesional mikrotik manager.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-8 pd-4">
            <div class="card">

                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="mail-contnet">
                                         <h5>Mikrotik hotspot bot telegram </h5>
                                 
                                               <ul>   <li>Version : <?=Version();?>,</li>
                                                <li>Author : BangAcil, <a href="https://mikrotik.com/training/certificates/b101043c12c303053eb3">MTCNA</a></li>
                                                <li>API Bot telegram Official: <a href="https://core.telegram.org/bots/api">Telegram bot,</a>
                                                </li>
                                                <li>API Bot telegram FrameBot: Thanks to Bang Hasan,</li>
                                                <li>API Class Mikrotik: <a href="https://github.com/BenMenking/routeros-api">Router Library</a>
                                                </li>
                                                <li>Facebook : <a href="https://www.facebook.com/bangachiilll">fb.com/bangachiill</a>
                                                </li>
                                            </ul>
                                          <p>Terima kasih kepada seluruh pendukung mikbotam baik support dan para donatur</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
