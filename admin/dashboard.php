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



error_reporting(0);

?>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card bd bd-primary">
                <div class="card-body ">
                    <div class="card mg-b-20  pd-20 pd-sm-20  <?=$color[rand(1, 3)];?> ">
                        <div class="signin-logo tx-center text-capitalize tx-20 tx-bold tx-white">
                            <img src="../img/router.svg" alt="Mikbotam.id" style="
                                width: 48%;
                                ">
                            <br>
                            <?=$mikrotik_ip;
?>
                        </div>
                        <div class="tx-center text-capitalize tx-white">
                            <?=$Name_router;
?>
                        </div>
                    </div>
                    <div class="mg-l-15">
                        <span class="tx-15 tx-spacing-1 tx-gray-500">

                                <?php
                                    $getlogin = getlastlogin();
                                    echo '- Name : ' . $Name_router . ' <br>';
                                    echo '- Dns name : ' . $dnsname . ' <br>';
                                    echo '- Last Login : ' . $getlogin['lastlogin'] . ' <br>';
                                    echo '- Status Login :' . $getlogin['status'] . ' <br>';
                                    echo '- From Login : ' . $getlogin['ip'] . ' <br>';
                                    echo '- Last Update: ' . $lastupdate . ' </span>';?>

                                    </span>
                        <h6 class="tx-inverse mg-b-0"></h6>
                    </div>
                </div>
                <div class="card-footer py-sm-custom">
                    <div class="row mg-t-0">
                        <div class="col-sm-20 mg-l-auto">
                            <div class="form-layout-footer">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="" class="btn bg-primary pd-x-25  tx-white "><i class="fa fa-exclamation"></i> Connect</a>
                                    <a href='../pages' class='btn bg-primary pd-x-25  tx-white'><i class='fa fa-home'></i> Dashboard</a>
                                    <a href="index.php?admin=myserver" class="btn bg-primary pd-x-25  tx-white "><i class="fa fa-pencil-square-o"></i> Edit</a>
                                    <a href="" class="btn bg-primary pd-x-25  tx-white "><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <!-- form-layout-footer -->
                        </div>
                        <!-- col-8 -->
                    </div>
                    <!-- card -->
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card bd bd-primary">
                <div class="card-header bg-primary tx-white ">
                    </i>Motive
                </div>
                <div class="card-body fadesa">
                    <?php $getjson = sikider();

                        for ($i = 0; $i < count($getjson); $i++) {
                            echo $getjson[$i];
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- sl-sideright -->
</div>
<!-- sl-sideright -->
</div>
<!-- sl-sideright -->
