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
session_start();
error_reporting(0);

if (!isset($_SESSION["Mikbotamuser"])) {

	header("Location:../admin/login.php");

} else {

	if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['profile']) && !empty($_GET['profile'])) {
		include('../config/system.conn.php');
		$id = $_GET['id'];
		if ($_GET['profile'] == 'no') {
			if (isset($_POST['month'])) {
		
					$thismonth = $_POST['month'];
					$datavoucher = sethistoryidbymonth($id,$thismonth);

			} elseif (isset($_POST['startdate']) ) {
		
					$start= $_POST['startdate'];
					$end  = $_POST['enddate'];

					$datavoucher = sethistoryidbyrange($id,$start,$end);

			} else {
				$datavoucher = sethistoryid($id);
			}

			include '../include/header.php';


			?>


			<div class="col-lg-12 mg-l-auto">

				<div class="bd-primary mg-t-10">

					<div class="card bd-primary">
						<div class="card-header card-header-default bg-primary justify-content-between">
							<h6 class="mg-b-0 tx-14 tx-white tx-normal"><i class="fa fa-gear"></i> Export Report ID <?= $datavoucher[0]['id_user'];
								?> &nbsp; | &nbsp;&nbsp;<i onclick="Reload();" class="fa fa-refresh pointer " title="Reload data"></i></h6>
							<div class="card-option tx-24">	
							   <a href="../?Mikbotam=Dashboard" type="button" class="btn btn-info lh-3 ">Dashboard</a>
								<input action="action" onclick="window.history.go(-1); return false;" type="button" class="btn btn-danger lh-3 " value="Back" />
							</div>
							<!-- card-option -->
						</div>
						<?php 	echo $startdate;
						echo $enddate;
						?>

						<div class="card-body pd-sm-15">
							<form method="post" action="">
								<div class="d-flex align-items-center ht-md-50 pd-0">
									<div class="d-flex pd-y-10 pd-md-y-0">
										<div class="input-group col-sm-5 pd-0">
											<span class="input-group-addon"><i class="fa  fa-calendar tx-16 lh-0 op-6"></i></span>
											<input type="text" class="form-control fc-datepicker " placeholder="Start date" name="startdate">
										</div>
										<div class="input-group  col-sm-5">
											<span class="input-group-addon"><i class="fa  fa-calendar tx-16 lh-0 op-6"></i></span>
											<input type="text" class="form-control fc-datepicker " placeholder="End date" name="enddate">
										</div>
										<div class="input-group ">
											<button type="submit" name="submitdatarange" class="btn bg-primary tx-white"> Submit</button>
										</div>

										<div class="input-group col-3 col-sm-3">
											<select class="form-control select2id" name="month" data-placeholder="Select month">
												<?php switch ($thismonth) {
													case 1:
														echo'	<option value="01">Januari</option>';
														break;
													case 2:
														echo'	<option value="02">Februari</option>';
														break;
													case 3:
														echo'	<option value="03">Maret</option>';
														break;
													case 4:
														echo'	<option value="04">April</option>';
														break;
													case 5:
														echo'	<option value="05">Mei</option>';
														break;
													case 6:
														echo'	<option value="06">Juni</option>';
														break;
													case 7:
														echo'	<option value="07">Juli</option>';
														break;
													case 8:
														echo'	<option value="08">Agustus</option>';
														break;
													case 9:
														echo'	<option value="09">September</option>';
														break;
													case 10:
														echo'	<option value="10">Oktober</option>';
														break;
													case 11:
														echo'	<option value="11">November</option>';
														break;
													case 12:
														echo'	<option value="12">Desember</option>';
														break;

													default:
														echo'	<option value="0">Selech Month</option>';
														break;
												}
												?>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<div class="input-group ">
											<button type="submit" name="submitdata" class="btn bg-primary tx-white"> Submit</button>
										</div>
									</div>


								</div>

							</form>


							<div class="table-wrapper mg-t-10">
								<table id="userreport" class="table display  nowrap " width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>ID USER</th>
											<th>Tanggal</th>
											<th>Keterangan</th>
											<th>Saldo Awal</th>
											<th>Voucher</th>
											<th>Top Up</th>
											<th>Markup</th>
											<th>Saldo Akhir</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php


										$TotalReg = count($datavoucher);
										for ($i = 0; $i < $TotalReg; $i++) {
											$datas = $datavoucher[$i];
											$no = $i + 1;
											$id_user = $datas['id_user'];
											$nama_seller = $datas['nama_seller'];
											$saldo_awal = rupiah($datas['saldo_awal']);


											if (!empty($datas['beli_voucher'])) {
												$beli_voucher = rupiah($datas['beli_voucher']);
											} else {
												$beli_voucher = ' ';
											}

											$saldo_akhir = rupiah($datas['saldo_akhir']);

											if (!empty($datas['top_up'])) {
												$top_up = $datas['top_up'];
											} else {
												$top_up = ' ';
											}

											$top_up_fromid = $datas['top_up_fromid'];
											$username_voucher = $datas['username_voucher'];
											$password_voucher = $datas['password_voucher'];
											$exp_voucher = $datas['exp_voucher'];
											$keterangan = $datas['keterangan'];
											$Waktu = $datas['Waktu'];
											$Tanggal = $datas['Tanggal'];
											$Markup=$datas['markup_voucher'];


											echo "<tr>";
											echo "<td>" . $no . "</td>";
											echo "<td>" . $id_user . "</td>";
											echo "<td>" . $Tanggal . "</td>";
											echo "<td>" . $keterangan."</td>";
											echo "<td>" . $saldo_awal."</td>";
											echo "<td>" . $beli_voucher. "</td>";
											echo "<td>" . $top_up . "</td>";
											echo "<td>" . $Markup . "</td>";
											echo "<td>" . $saldo_akhir . "</td>";
											echo "</tr>";
										}


										?>
									</tbody>

								</table>
							</div>
						</div>
					</div>

				</div>


			</div>
			<script>
				$(function() {

					'use strict';

					// Datepicker
					$('.fc-datepicker').datepicker({
						dateFormat: "yy-mm-dd",
						showOtherMonths: true,
						selectOtherMonths: true
					});



				});
			</script>
			<?php
		} elseif ($_GET['profile'] == 'yes') {

			$seeuser = lihatuser($id);
			if (isset($_POST['save']) == 'save') {}
			?>

			<div class="card bd bd-primary ">
				<div class="card-body ">
					<div class="card mg-b-20  pd-20 pd-sm-20  bg-primary ">
						<div class="signin-logo tx-center text-capitalize tx-20 tx-bold tx-white">
							<img src="../img/newuser.svg" alt="Mikbotam.id" style="width: 85%;" class="rounded-circle border-light ">
							<br>
							<?=$seeuser['nama_seller'];
							?>
						</div>
						<div class="tx-center text-capitalize tx-white">
							<?=rupiah($seeuser['saldo']);
							?>
						</div>
					</div>


					<div class="input-group mg-t-10">
						<span class="input-group-addon"><i class="fa fa-user tx-primary "></i></span>
						<input type="text" class="form-control" placeholder="Username" name="username" value="<?=$seeuser['nama_seller'];
						?>">
					</div>
					<div class="input-group mg-t-10">
						<span class="input-group-addon "><i class="fa fa-qrcode tx-primary"></i></span>
						<input type="text" class="form-control" placeholder="ID user" name="id_user"value="<?=$seeuser['id_user'];
						?>">

					</div>
					<div class="input-group mg-t-10">
						<span class="input-group-addon "><i class="fa fa-whatsapp tx-primary"></i></span>
						<input type="text" class="form-control" placeholder="Whatsaap" name="tlp" value="<?=$seeuser['nomer_tlp'];
						?>">

					</div>
					<div class="input-group mg-t-10">
						<span class="input-group-addon "><i class="fa fa-usd tx-primary"></i></span>
						<input type="text" class="form-control" placeholder="Saldo" name="saldo" value="<?=rupiah($seeuser['saldo']);
						?>">

					</div>


				</div>
				<div class="card-footer py-sm-custom">
					<div class="row mg-t-0">

						<div class="col-sm-15 mg-l-auto">
							<div class="form-layout-footer">
								<button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onclick="topupsaldo();return false;"><i class="fa fa-thumbs-up mg-r-2"></i>  Save</button>
								<button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa  fa-trash"> </i> Delete</button>
							</div>
							<!-- form-layout-footer -->
						</div>

						<!-- col-8 -->
					</div>
					<!-- card -->
				</div>
			</div>

			<?php
		} elseif ($_GET['profile'] == 'delete') {
			$delete = deleteuser($id);
			echo "<script>setTimeout(\"location.href = '../pages/index.php?Mikbotam=userlist';\");</script>";
		}

	} else {}
	include '../include/footer.php';
}



?>