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
    session_start();
     error_reporting(0);
    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:../admin/login.php");
    } else {

        include '../config/system.conn.php';

        $datavoucher = gethistory($id);

    }
?>

                       <div class="sl-pagebody">

       <div class="card bd-primary mg-t-3">
                    <div class="card-header bg-primary tx-white"><i class="icol-ui-tab-content"></i>   History Transaksi</div>
                    <div class="card-body pd-sm-15">
                        <div class="table-wrapper">
                            <table id="userhistory2" class="table display  nowrap " width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID User</th>
                                        <th>Nama</th>
                                        <th>Saldo awal</th>
                                        <th>Voucher </th>
                                        <th>Saldo Akhir</th>
                                        <th>Top up</th>
                                        <th>Top Up From</th>
                                        <th>Username Voucher</th>
                                        <th>Password Voucher</th>
                                        <th>Expired Voucher</th>
                                        <th>Keterangan</th>
                                        <th>Waktu :</th>
                                        <th>Tanggal :</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                       $TotalReg = count($datavoucher);
                                       for ($i = 0; $i < $TotalReg; $i++) {
                                           $datas            = $datavoucher[$i];
                                           $no               = $i + 1;
                                           $id_user          = $datas['id_user'];
                                           $nama_seller      = $datas['nama_seller'];
                                           $saldo_awal       = $datas['saldo_awal'];
                                           $beli_voucher     = $datas['beli_voucher'];
                                           $saldo_akhir       = $datas['saldo_akhir'];
                                           $top_up            = $datas['top_up'];
                                           $top_up_fromid     = $datas['top_up_fromid'];
                                           $username_voucher = $datas['username_voucher'];
                                           $password_voucher = $datas['password_voucher'];
                                           $exp_voucher      = $datas['exp_voucher'];
                                           $keterangan       = $datas['keterangan'];
                                           $Waktu            = $datas['Waktu'];
                                           $Tanggal          = $datas['Tanggal'];

                                           echo "<tr>";
                                           echo "<td style='text-align:center'>" . $no . "</td>";
                                           echo "<td>" . $id_user . "</td>";
                                           echo "<td>" . $nama_seller . "</td>";
                                           echo "<td>" . $saldo_awal . "</td>";
                                           echo "<td>" . $beli_voucher . "</a></td>";
                                           echo "<td>" . $saldo_akhir . "</td>";
                                           echo "<td>" . $top_up . "</td>";
                                           echo "<td>" . $top_up_fromid . "</td>";
                                           echo "<td>" . $username_voucher . "</td>";
                                           echo "<td>" . $password_voucher . "</td>";
                                           echo "<td>" . $exp_voucher . "</td>";
                                           echo "<td>" . $keterangan . "</td>";
                                           echo "<td>" . $Waktu . "</td>";
                                           echo "<td>" . $Tanggal . "</td>";
                                           echo "</tr>";
                                       }
                                   ?>

                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div><!-- card-body -->
                </div><!-- card -->
                        </div><!-- table-wrapper -->

