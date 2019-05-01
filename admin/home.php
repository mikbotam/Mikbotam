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

error_reporting(0);
$page = $_GET["admin"];
?>
<div class="sl-logo"><a href="">MIKBOTAM</a>
</div>
<div class="sl-sideleft">
    <div class="input-group input-group-search"></div>
    <!-- input-group -->
    <div class="sl-sideleft-menu">
        <a href="index.php?admin=Dashboard" class="sl-menu-link <?php if ($page == " Dashboard ") {echo 'active';}?>">
            <div class="sl-menu-item "> <i class="menu-item-icon fa fa-home tx-22"></i>
 <span class="menu-item-label"> Dashboard</span>

            </div>
        </a>
<a href="index.php?admin=myserver" class="sl-menu-link                                                                                                             <?php if ($page == " myserver ") {echo 'active';}?>">
            <div class="sl-menu-item"> <i class="menu-item-icon fa  fa-desktop tx-16"></i>
 <span class="menu-item-label"> Edit Sever</span>

            </div>
        </a>
        <!-- sl-menu-link -->
        <a href="index.php?admin=sessionedit" class="sl-menu-link <?php if ($page == "sessionedit") {echo 'active';}?>">
            <div class="sl-menu-item"> <i class="menu-item-icon fa   fa-pencil-square-o tx-16"></i>
 <span class="menu-item-label"> Edit Profile</span>

            </div>
        </a>
        <a href="index.php?admin=logout" class="sl-menu-link<?php if ($page == "logout") {echo 'active'; }?>">
            <div class="sl-menu-item"> <i class="menu-item-icon fa   fa-sign-out tx-16"></i>
 <span class="menu-item-label"> Sign Out</span>

            </div>
        </a>
    </div>
    <br>
</div>
<div class="sl-header">
    <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="fa fa-bars"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <!-- sl-header-left -->
    <div class="sl-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown"> <span class="logged-name">Admin<span class="hidden-md-down">Stator</span></span>
                    <img src="../img/newuser.svg" class="wd-32 rounded-circle" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="./index.php?admin=sessionedit"><i class="menu-item-icon fa  fa-user"></i> <span class="menu-item-label"> Edit Profile</span></a>
                        </li>
                        <li><a href="./index.php?admin=myserver"><i class="menu-item-icon fa fa-file"></i><span class="menu-item-label">  Settings</span></a>
                        </li>
                        <li><a href="./index.php?admin=logout"><i class="menu-item-icon fa fa-sign-out"></i><span class="menu-item-label"> Sign Out</span></a>
                        </li>
                    </ul>
                </div>
                <!-- dropdown-menu -->
            </div>
            <!-- dropdown -->
        </nav>
        <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">   <i class="fa fa-dot-circle-o"></i>

                <!-- start: if statement --> <span class="square-8 bg-danger"></span>

                <!-- end: if statement -->
            </a>
        </div>
        <!-- navicon-right -->
    </div>
    <!-- sl-header-right -->
</div>
<div class="sl-sideright">
    <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>

        </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>

        </li>
    </ul>
    <!-- sidebar-tabs -->
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="pd-12 pd-sm-12 bg-primary mg-t-5"> <span class="tx-15 tx-spacing-1 tx-white"><pre class="tx-white">

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
    echo "<br>Browser ";
    echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br>Sistem Operasi Server :";
echo php_uname();
?></pre></span>

        </div>
    </div>
</div>

