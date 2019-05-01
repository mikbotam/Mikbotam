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
	$noactive = "class='nav-link'";

	$page = $_GET["Mikbotam"];

	if ($page == null) {
		$dashboard = "active";
	} elseif ($page == "NewUser") {
		$Nshow   = "show-sub";
		$NewUser = "active";
	} elseif ($page == "Record") {
		$Nshow  = "show-sub";
		$Record = "active";
	} elseif ($page == "userlist") {
		$Nshow    = "show-sub";
		$UserList = "active";
	} elseif ($page == "Qrcode") {
		$Nshow  = "show-sub";
		$Qrcode = "active";
	} elseif ($page == "Generate") {
		$Nshow    = "show-sub";
		$Generate = "active";
	} elseif ($page == "Hotspotuserlist") {
		$hSHOWHotspot = "show-sub";
		$Hotspot      = "active";
	} elseif ($page == "pppuser") {
		$hSHOWPPP = "show-sub";
		$ppp      = "active";
	} elseif ($page == "pppactive") {
		$hSHOWPPP   = "show-sub";
		$ppp_active = "active";
	} elseif ($page == "pppprofile") {
		$hSHOWPPP    = "show-sub";
		$ppp_profile = "active";
	} elseif ($page == "sendMessage") {
		$Nshow     = "show-sub";
		$Broadcast = "active";
	} elseif ($page == "sendVoc") {
		$Nshow   = "show-sub";
		$sendVoc = "active";
	} elseif ($page == "about") {
		$Nshowabaoute = "show-sub";
		$about        = "active";
	} elseif ($page == "topupsaldo") {
		$Nshow      = "show-sub";
		$topupsaldo = "active";
	} elseif ($page == "topdownsaldo") {
		$Nshow        = "show-sub";
		$topdownsaldo = "active";
	} elseif ($page == "Delete") {
		$Nshow  = "show-sub";
		$Delete = "active";
	} elseif ($page == "Settings") {
		$sshow    = "show-sub";
		$Settings = "active";
	} elseif ($page == "SettingsVoc") {
		$sshow       = "show-sub";
		$SettingsVoc = "active";
	} elseif ($page == "SettingsVocnonsaldo") {
		$sshow                = "show-sub";
		$SettingsVocnonsaldos = "active";
	} elseif ($page == "monitortraffic") {
		$Mmonitortraffic = "show-sub";
		$monitortraffic  = "active";
	} elseif ($page == "addprofile") {
		$hSHOWHotspot = "show-sub";
		$addprofilec  = "active";
	} elseif ($page == "vouchergraph") {
		$Mvouchergraph = "show-sub";
		$vouchergraph  = "active";
	} elseif ($page == "setwebhook") {
		$toolsshow      = "show-sub";
		$setwebhookmenu = "active";
	} elseif ($page == "boteditor") {
		$toolsshow = "show-sub";
		$boteditor = "active";
	} elseif ($page == "useractive") {
		$hSHOWHotspot = "show-sub";
		$useractive   = "active";
	} elseif ($page == "Settingstext") {
		$sshow        = "show-sub";
		$Settingstext   = "active";
	}

?>



 <body <?=$hideBodyHotspot . $hideBodyPPP;?>>
    <div id="mikbotam" class="sl-logo bg-primary tx-white">MIKBOTAM</div>

    <div class="sl-sideleft">
      <div class="input-group input-group-search">

      </div><!-- input-group -->


      <div class="sl-sideleft-menu">
        <a href="index.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-home tx-22"></i>
            <span class="menu-item-label"> Dashboard</span>
          </div><!-- menu-item -->
        </a>
        <a href="#" class="sl-menu-link  <?=$Record . $Broadcast . $sendVoc . $NewUser . $UserList . $topdownsaldo . $topupsaldo . " " . $Nshow;?> ">
          <div class="sl-menu-item">
             <i class="menu-item-icon fa fa-clipboard tx-22"></i>
            <span class="menu-item-label"> GoVocher</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
        <ul class="sl-menu-sub nav flex-column">
         <li class="nav-item"><a class="nav-link <?=$NewUser;?>" href="./?Mikbotam=NewUser"><i class="fa fa-user-plus "></i> Add User </a></li>
                <li class="nav-item"><a class="nav-link <?=$topupsaldo;?>" href="./?Mikbotam=topupsaldo"><i class="fa fa-level-up"></i> Top Up Saldo </a></li>
        <li class="nav-item"><a class="nav-link <?=$topdownsaldo;?>" href="./?Mikbotam=topdownsaldo"><i class="fa fa-level-down"></i></i> Top Down Saldo </a></li>
                <li class="nav-item"><a class="nav-link <?=$UserList;?>" href="./?Mikbotam=userlist"><i class="fa fa-users "></i> User List </a></li>
                <li class="nav-item"><a class="nav-link <?=$sendVoc;?>" href="./?Mikbotam=sendVoc"><i class="fa  fa-paper-plane-o "></i> Send Voucher</a></li>
                <li class="nav-item"><a class="nav-link <?=$Broadcast;?>" href="./?Mikbotam=sendMessage"><i class="fa  fa-paper-plane "></i> Send Message</a></li>
                <li class="nav-item"><a class="nav-link <?=$Record;?>" href="./?Mikbotam=Record"><i class="fa fa-history"></i></i> History User</a></li>
        </ul>
        <a href="./?Mikbotam=comingsoon" class="sl-menu-link "  >
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-id-badge tx-16"></i>
            <span class="menu-item-label"> GoCustomer</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
                         <a href="./?Mikbotam=comingsoon" class="sl-menu-link "  >
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-envelope tx-16"></i>
            <span class="menu-item-label"> SMS Gateway</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>

         <a href="#" class="sl-menu-link <?=$hSHOWHotspot;?>">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa   fa-wifi tx-16"></i>
            <span class="menu-item-label"> Hotspot</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
            <ul class="sl-menu-sub nav flex-column">
         <li class="nav-item"><a class="nav-link <?=$Hotspot;?>" href="./?Mikbotam=Hotspotuserlist"><i class="fa    fa-users"></i> User List</a></li>

            <li class="nav-item"><a class="nav-link <?=$useractive;
?>" href="./?Mikbotam=useractive"><i class="fa   fa-check-circle-o "></i> User Active</a></li>
        <li class="nav-item"><a class="nav-link <?=$addprofilec;?>" href="./?Mikbotam=addprofile"><i class="fa fa-user-plus"></i> Add Profile</a></li>
        </ul>

        <a href="#" class="sl-menu-link <?=   $ppp_active." ".$hSHOWPPP ;?> " >
          <div class="sl-menu-item">
            <i class="menu-item-icon fa   fa-retweet tx-16"></i>
            <span class="menu-item-label"> PPP</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
          <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a class="nav-link <?=$ppp;?>" href="./?Mikbotam=pppuser"><i class="fa  fa-users "></i> PPP User</a></li>
          <li class="nav-item"><a class="nav-link <?=$ppp_active;?>" href="./?Mikbotam=pppactive"><i class="fa   fa-check-circle-o "></i> PPP Active</a></li>
           <li class="nav-item"><a class="nav-link <?=$ppp_profile;?>" href="./?Mikbotam=pppprofile"><i class="fa    fa-th-large "></i> PPP Profile</a></li>
        </ul>
        


         <a href="#" class="sl-menu-link  <?=$Mmonitortraffic . $vouchergraph;?>" >
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-desktop tx-16"></i>
            <span class="menu-item-label"> Report Graffic</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a class="nav-link <?=$monitortraffic;?>" href="./?Mikbotam=monitortraffic"><i class="fa fa-cog "></i> Traffic</a></li>
          <li class="nav-item"><a class="nav-link <?=$vouchergraph;?>" href="./?Mikbotam=comingsoon"><i class="fa fa-file "></i> Voucher</a></li>
        </ul>


        <a href="#" class="sl-menu-link <?=$Settings .$Settingstext. $SettingsVoc . " " . $sshow;?>" >
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-cogs tx-16"></i>
            <span class="menu-item-label"> Settings</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a>
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a class="nav-link <?=$Settings;?>" href="./?Mikbotam=Settings"><i class="fa fa-cog "></i> Settings</a></li>
          <li class="nav-item"><a class="nav-link <?=$SettingsVoc;?>" href="./?Mikbotam=SettingsVoc"><i class="fa fa-ticket "></i> Settings Voucher</a></li>
           <li class="nav-item"><a class="nav-link <?=$SettingsVocnonsaldos;?>" href="./?Mikbotam=SettingsVocnonsaldo"><i class="fa fa-ticket "></i> Settings Voucher Non saldo</a></li>
          <li class="nav-item"><a class="nav-link " href="./?Mikbotam=Settingstext"><i class="fa  fa-pencil-square-o "></i> Text Settings</a></li>

        </ul>
        <a href="#" class="sl-menu-link  <?=$toolsshow;?> ">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-wrench tx-20"></i>
            <span class="menu-item-label"> Tools</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a class="nav-link <?=$setwebhookmenu;?>" href="./?Mikbotam=setwebhook"><i class="fa fa-cog "></i> Set Webhook</a></li>
         <li class="nav-item"><a class="nav-link <?=$boteditor;?> " href="./?Mikbotam=boteditor&bottype=Core"><i class="fa fa-pencil "></i> Edit Bot Core</a></li>
        </ul>

        <a href="./?Mikbotam=comingsoon" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-paper-plane tx-16"></i>
            <span class="menu-item-label">Chat admin</span>
          </div>
        </a>
        <a href="#" class="sl-menu-link <?=$Nshowabaoute;?>">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa  fa-info-circle tx-22"></i>
            <span class="menu-item-label">About</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a class="nav-link <?=$about;?>" href="./?Mikbotam=about"><i class="fa fa-cog "></i> About</a></li>
          <li class="nav-item"><a class="nav-link " href="./?Mikbotam=comingsoon"><i class="fa  fa-exclamation-circle "></i> Change logs</a></li>
        </ul>
      </div>

      <br>
    </div>
    <div class="sl-header bg-primary">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="fa fa-bars"></i></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="fa fa-bars"></i></a></div>
      </div>
      <div class="sl-header-right bg-primary">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">Admin<span class="hidden-md-down">Stator</span></span>
              <img src="../img/logoMwhite.svg" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="../admin/index.php?admin=sessionedit"><i class="menu-item-icon fa  fa-user"></i> <span class=""> Edit Profile</span></a></li>
                <li><a href="./?Mikbotam=Settings"><i class="menu-item-icon fa fa-file"></i><span class="">  Settings</span></a></li>
                <li><a href="./?Mikbotam=logout"><i class="menu-item-icon fa fa-sign-out"></i><span class=""> Sign Out</span></a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
           <i class="fa fa-dot-circle-o"></i>

            <span class="square-8 bg-danger"></span>

          </a>
        </div>
      </div>
    </div>
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content ">                        <div class="pd-12 pd-sm-12 bg-primary mg-t-5">

                                    <span class="tx-15 tx-spacing-1 tx-white">

<?php
    function IPnya() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'IP Tidak Dikenali';
        }

        return $ipaddress;
    }

    $ipaddress = $_SERVER['REMOTE_ADDR'];
    echo "IP anda adalah : ";
    echo IPnya();
    echo "<br>Browser : ";
    echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br> Sistem Operasi :";
echo php_uname();
?></span>

                        </div>
      </div><!-- tab-content -->
    </div><!-- sl-sideright -->



