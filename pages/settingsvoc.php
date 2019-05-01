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
     *  all damage caused by editing we will not be responsible please think carefully,
     *
     */

//=====================================================START SCRIPT====================//


error_reporting(0);
if (!isset($_SESSION["Mikbotamuser"])) {
	header("Location:../admin/login.php");
} else {

	include '../Api/routeros_api.class.php';
	include '../config/system.conn.php';

	$API = new routeros_api();
	if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
		$ARRAY = $API->comm('/ip/hotspot/user/profile/print');
		$serverhot = $API->comm('/ip/hotspot/print');
	}

	$id = $_SESSION['Mikbotamid'];

	if (isset($_POST['save'])) {
		if (!empty($_POST['vocname_1'])) {
			$voc1 = [
				"id" => "0",
				"Voucher" => $_POST['vocname_1'],
				"price" => $_POST['price_2'],
				"profile" => $_POST['profile_3'],
				"markup" => $_POST['markup_0'],
				"server" => $_POST['server_0'],
				"Limit" => $_POST['limit_1'],  
				"limit_download"=> $_POST['limit_download_1'],
				"limit_upload"=> $_POST['limit_upload_1'],
				"limit_total"=> $_POST['limit_total_1'],
				"Text_List" => $_POST['Text_List_1'],
				"type" => $_POST['Type_0'],
				"typechar" => $_POST['typechar_0'],
				"length" => $_POST['length_1'],
				"Color" =>$_POST['Color_1']
			];
		} else {}
		if (!empty($_POST['vocname_5'])) {
			$voc2 = [
				"id" => "1",
				"Voucher" => $_POST['vocname_5'],
				"price" => $_POST['price_6'],
				"profile" => $_POST['profile_7'],
				"markup" => $_POST['markup_1'],
				"server" => $_POST['server_1'],
				"Limit" => $_POST['limit_2'],  
				"limit_download"=> $_POST['limit_download_2'],
				"limit_upload"=> $_POST['limit_upload_2'],
				"limit_total"=> $_POST['limit_total_2'],  
				"Text_List" => $_POST['Text_List_2'],
				"type" => $_POST['Type_1'],
				"typechar" => $_POST['typechar_1'],
				"length" => $_POST['length_2'],
				"Color"=>$_POST['Color_2']
			];
		}
		if (!empty($_POST['vocname_9'])) {
			$voc3 =
			[
				"id" => "2",
				"Voucher" => $_POST['vocname_9'],
				"price" => $_POST['price_10'],
				"profile" => $_POST['profile_11'],
				"markup" => $_POST['markup_2'],
				"server" => $_POST['server_2'],
				"Limit" => $_POST['limit_3'],  
				"limit_download"=> $_POST['limit_download_3'],
				"limit_upload"=> $_POST['limit_upload_3'],
				"limit_total"=> $_POST['limit_total_3'],  
				"Text_List" => $_POST['Text_List_3'],
				"type" => $_POST['Type_2'],
				"typechar" => $_POST['typechar_2'],
				"length" => $_POST['length_3'],
				"Color"=>$_POST['Color_3']
			];
		}
		if (!empty($_POST['vocname_13'])) {
			$voc4 =
			[
				"id" => "3",
				"Voucher" => $_POST['vocname_13'],
				"price" => $_POST['price_14'],
				"profile" => $_POST['profile_15'],
				"markup" => $_POST['markup_3'],
				"server" => $_POST['server_3'],
				"Limit" => $_POST['limit_4'],  
				"limit_download"=> $_POST['limit_download_4'],
				"limit_upload"=> $_POST['limit_upload_4'],
				"limit_total"=> $_POST['limit_total_4'],  
				"Text_List" => $_POST['Text_List_4'],
				"type" => $_POST['Type_3'],
				"typechar" => $_POST['typechar_3'],
				"length" => $_POST['length_4'],
				"Color"=>$_POST['Color_4']
			];
		}
		if (!empty($_POST['vocname_17'])) {
			$voc5 =
			[
				"id" => "4",
				"Voucher" => $_POST['vocname_17'],
				"price" => $_POST['price_18'],
				"profile" => $_POST['profile_19'],
				"markup" => $_POST['markup_4'],
				"server" => $_POST['server_4'],
				"Limit" => $_POST['limit_5'],  
				"limit_download"=> $_POST['limit_download_5'],
				"limit_upload"=> $_POST['limit_upload_5'],
				"limit_total"=> $_POST['limit_total_5'],  
				"Text_List" => $_POST['Text_List_5'],
				"type" => $_POST['Type_4'],
				"typechar" => $_POST['typechar_4'],
				"length" => $_POST['length_5'],
				"Color"=>$_POST['Color_5']
			];
		}
		if (!empty($_POST['vocname_21'])) {
			$voc6 =
			[
				"id" => "5",
				"Voucher" => $_POST['vocname_21'],
				"price" => $_POST['price_22'],
				"profile" => $_POST['profile_23'],
				"markup" => $_POST['markup_5'],
				"server" => $_POST['server_5'],
				"Limit" => $_POST['limit_6'],  
				"limit_download"=> $_POST['limit_download_6'],
				"limit_upload"=> $_POST['limit_upload_6'],
				"limit_total"=> $_POST['limit_total_6'],  
				"Text_List" => $_POST['Text_List_6'],
				"type" => $_POST['Type_5'],
				"typechar" => $_POST['typechar_5'],
				"length" => $_POST['length_6'],
				"Color"=>$_POST['Color_6']
			];
		}

		$voc = [$voc1, $voc2, $voc3, $voc4, $voc5, $voc6];
		$first = array_filter($voc);
		$sendfungsi = json_encode($first);
		$updatedata = upvoc($sendfungsi, $id);
		echo "<script>setTimeout(\"location.href = '?Mikbotam=SettingsVoc';\");</script>";
	}

	if (isset($_POST['hapus'])) {
		$first = null;
		$sendfungsi = json_encode($first);
		$updatedata = upvoc($sendfungsi, $id);
	}

	$ARRAYvoc = getvoc($id);

	$datajson = json_decode($ARRAYvoc, true);
}
?>
<script src="../js/MikbotamColorSelector.js"></script>
<div class="sl-pagebody">
		<a href='#edit_modal' class='btn btn-success' data-toggle='modal'>Petunjuk</a> 	
			<a href='index.php' class='btn btn-success'>Dashboard</a> 
			<a href='?Mikbotam=SettingsVocnonsaldo' class='btn btn-success'>Non Saldo</a>
				<form method="post">
					<div class="row row-sm mg-t--1">
						<div class="col-xl-6 mg-t-10">
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
									<?=markup($datajson[0]['price'], $datajson[0]['markup']);
									?>
								</div>
								<div class="card-body pd-sm-15">
						
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="vocname_1" value="<?=$datajson[0]['Voucher'];
											?>">
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="Text_List_1" value="<?=$datajson[0]['Text_List'];
											?>">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="price_2" value="<?=$datajson[0]['price'];
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="markup_0" value="<?php if (!empty($datajson[0]['markup'])) { echo $datajson[0]['markup'];
												} else { echo '0';
												}
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="server_0" data-placeholder="Select Server  ">

												<option value="<?=$datajson[0]['server'];
													?>"><?=$datajson[0]['server'];
													?></option>
												<option value="all">all</option>

												<?php foreach ($serverhot as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="profile_3" data-placeholder="Select Profile">
												<option value="<?=$datajson[0]['profile'];
													?>"><?=$datajson[0]['profile'];
													?></option>
												<?php foreach ($ARRAY as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_1" value="<?=$datajson[0]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_1" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[0]['limit_download'])) { echo $datajson[0]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_1" class="form-control  boxsadaw"   min="0"  value="<?php if (!empty($datajson[0]['limit_upload'])) { echo $datajson[0]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_1" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[0]['limit_total'])) { echo $datajson[0]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="typechar_0" data-placeholder="Select Type">
												<?=show_string($datajson[0]['typechar']) ?>

												<option value="1">1234</option>
												<option value="2">ABCDE</option>
												<option value="3">abcd</option>
												<option value="4">ABCDabcd</option>
												<option value="5">AbcdABCD1234</option>
												<option value="6">abcd1234</option>
												<option value="7">ABCD1234</option>
												<option value="checkCode">ABCDabcd1234</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Login  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="Type_0" data-placeholder="Select Type">
												<option value="<?=$datajson[0]['type'];
													?>"><?php if ($datajson[0]['type'] == 'userpass') {
														echo 'Username = Password';
													} else {
														echo 'Username & Password';
													}
													?></option>
												<option value="up">Username & Password</option>
												<option value="userpass">Username = Password</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Length Character  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">

<input id="colorful1" class="form-control  boxsadaw"  name="length_1" type="number" min="1" max="10" value="<?php if (!empty($datajson[0]['length'])) { echo $datajson[0]['length'];} else { echo '1';}?>" onkeypress="return isNumber(event)" />
										</div>
									</div>
								<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[0]['Color'];?>" name="Color_1">

										
										</div>
									</div>
									<!-- card-body -->
								</div>
								<!-- card-body -->
							</div>
							<!-- card -->
						</div>
						<div class="col-xl-6 mg-t-10">
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
									<?=markup($datajson[1]['price'], $datajson[1]['markup']);
									?>
								</div>
								<div class="card-body pd-sm-15">
									<!-- row -->
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="vocname_5" value="<?=$datajson[1]['Voucher'];
											?>">
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="Text_List_2" value="<?=$datajson[1]['Text_List'];
											?>">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="price_6" value="<?=$datajson[1]['price'];
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="markup_1" value="<?php if (!empty($datajson[1]['markup'])) { echo $datajson[1]['markup'];
												} else { echo '0';
												}
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="server_1" data-placeholder="Select Server  ">

												<option value="<?=$datajson[1]['server'];
													?>"><?=$datajson[1]['server'];
													?></option>
												<option value="all">all</option>
												<?php foreach ($serverhot as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="profile_7" data-placeholder="Select Profile">
												<option value="<?=$datajson[1]['profile'];
													?>"><?=$datajson[1]['profile'];
													?></option>
												<?php foreach ($ARRAY as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_2" value="<?=$datajson[1]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_2" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[1]['limit_download'])) { echo $datajson[1]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_2" class="form-control  boxsadaw" min="0"   value="<?php if (!empty($datajson[1]['limit_upload'])) { echo $datajson[1]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_2" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[1]['limit_total'])) { echo $datajson[1]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="typechar_1" data-placeholder="Select Type">
												<?=show_string($datajson[1]['typechar']) ?>

												<option value="1">1234</option>
												<option value="2">ABCDE</option>
												<option value="3">abcd</option>
												<option value="4">ABCDabcd</option>
												<option value="5">AbcdABCD1234</option>
												<option value="6">abcd1234</option>
												<option value="7">ABCD1234</option>
												<option value="checkCode">ABCDabcd1234</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Login  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="Type_1" data-placeholder="Select Type">
												<option value="<?=$datajson[1]['type'];
													?>"><?php if ($datajson[1]['type'] == 'userpass') {
														echo 'Username = Password';
													} else {
														echo 'Username & Password';
													}
													?></option>

												<option value="up">Username & Password</option>
												<option value="userpass">Username = Password</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Length Character  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">

											<input id="colorful2" class="form-control  boxsadaw"  name="length_2" type="number" min="1" max="10" value="<?php if (!empty($datajson[1]['length'])) { echo $datajson[1]['length'];
											} else { echo '1';
											}
											?>" onkeypress="return isNumber(event)" />
										</div>
									</div>
							<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[1]['Color'];?>" name="Color_2">

										
										</div>
									</div>
								</div>
						
							</div>
						</div>
						<div class="col-xl-6 mg-t-10">
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
									<?=markup($datajson[2]['price'], $datajson[2]['markup']);
									?>
								</div>
								<div class="card-body pd-sm-15">
									<!-- row -->
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="vocname_9" value="<?=$datajson[2]['Voucher'];
											?>">
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="Text_List_3" value="<?=$datajson[2]['Text_List'];
											?>">
										</div>
									</div>
									
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="price_10" value="<?=$datajson[2]['price'];
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="markup_2" value="<?php if (!empty($datajson[2]['markup'])) { echo $datajson[2]['markup'];
												} else { echo '0';
												}
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="server_2" data-placeholder="Select Server  ">

												<option value="<?=$datajson[2]['server'];
													?>"><?=$datajson[2]['server'];
													?></option>
												<option value="all">all</option>
												<?php foreach ($serverhot as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="profile_11" data-placeholder="Select Profile">
												<option value="<?=$datajson[2]['profile'];
													?>"><?=$datajson[2]['profile'];
													?></option>
												<?php foreach ($ARRAY as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_3" value="<?=$datajson[2]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_3" class="form-control  boxsadaw"   min="0" value="<?php if (!empty($datajson[2]['limit_download'])) { echo $datajson[2]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_3" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[2]['limit_upload'])) { echo $datajson[2]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_3" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[2]['limit_total'])) { echo $datajson[2]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="typechar_2" data-placeholder="Select Type">
												<?=show_string($datajson[2]['typechar']) ?>

												<option value="1">1234</option>
												<option value="2">ABCDE</option>
												<option value="3">abcd</option>
												<option value="4">ABCDabcd</option>
												<option value="5">AbcdABCD1234</option>
												<option value="6">abcd1234</option>
												<option value="7">ABCD1234</option>
												<option value="checkCode">ABCDabcd1234</option>

											</select>
										</div>
									</div>

									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Login  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="Type_2" data-placeholder="Select Type">
												<option value="<?=$datajson[2]['type'];
													?>"><?php if ($datajson[2]['type'] == 'userpass') {
														echo 'Username = Password';
													} else {
														echo 'Username & Password';
													}
													?></option>

												<option value="up">Username & Password</option>
												<option value="userpass">Username = Password</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Length Character  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">

											<input id="colorful3" class="form-control  boxsadaw"  name="length_3" type="number" min="1" max="10" value="<?php if (!empty($datajson[2]['length'])) { echo $datajson[2]['length'];
											} else { echo '1';
											}
											?>" onkeypress="return isNumber(event)" />
										</div>
									</div>
							<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[2]['Color'];?>" name="Color_3">

										
										</div>
									</div>
								</div>
						
							</div>
						
						</div>
						<div class="col-xl-6 mg-t-10">
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
									<?=markup($datajson[3]['price'], $datajson[3]['markup']);
									?>
								</div>
								<div class="card-body pd-sm-15">
									<!-- row -->
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="vocname_13" value="<?=$datajson[3]['Voucher'];
											?>">
										</div>
									</div>
									
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="Text_List_4" value="<?=$datajson[3]['Text_List'];
											?>">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="price_14" value="<?=$datajson[3]['price'];
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="markup_3" value="<?php if (!empty($datajson[3]['markup'])) { echo $datajson[3]['markup'];
												} else { echo '0';
												}
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="server_3" data-placeholder="Select Server  ">

												<option value="<?=$datajson[3]['server'];
													?>"><?=$datajson[3]['server'];
													?></option>
												<option value="all">all</option>

												<?php foreach ($serverhot as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="profile_15" data-placeholder="Select Profile">
												<option value="<?=$datajson[3]['profile'];
													?>"><?=$datajson[3]['profile'];
													?></option>
												<?php foreach ($ARRAY as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_4" value="<?=$datajson[3]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_4" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[3]['limit_download'])) { echo $datajson[3]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_4" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[3]['limit_upload'])) { echo $datajson[3]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_4" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[3]['limit_total'])) { echo $datajson[3]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="typechar_3" data-placeholder="Select Type">
												<?=show_string($datajson[3]['typechar']) ?>
												<option value="1">1234</option>
												<option value="2">ABCDE</option>
												<option value="3">abcd</option>
												<option value="4">ABCDabcd</option>
												<option value="5">AbcdABCD1234</option>
												<option value="6">abcd1234</option>
												<option value="7">ABCD1234</option>
												<option value="checkCode">ABCDabcd1234</option>

											</select>
										</div>
									</div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Login  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="Type_3" data-placeholder="Select Type">
												<option value="<?=$datajson[3]['type'];
													?>"><?php if ($datajson[3]['type'] == 'userpass') {
														echo 'Username = Password';
													} else {
														echo 'Username & Password';
													}
													?></option>

												<option value="up">Username & Password</option>
												<option value="userpass">Username = Password</option>

											</select>
										</div>
									</div>

									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Length Character  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">

											<input id="colorful4" class="form-control  boxsadaw"  name="length_4" type="number" min="1" max="10" value="<?php if (!empty($datajson[3]['length'])) { echo $datajson[3]['length'];
											} else { echo '1';
											}
											?>" onkeypress="return isNumber(event)" />
										</div>
									</div>
							<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[3]['Color'];?>" name="Color_4">

										
										</div>
									</div>
								</div>
						
							</div>
						</div>
						<div class="col-xl-6 mg-t-10">
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
									<?=markup($datajson[4]['price'], $datajson[4]['markup']);
									?>
								</div>
								<div class="card-body pd-sm-15">
									<!-- row -->
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="vocname_17" value="<?=$datajson[4]['Voucher'];
											?>">
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="Text_List_5" value="<?=$datajson[4]['Text_List'];
											?>">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="price_18" value="<?=$datajson[4]['price'];
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"  name="markup_4" value="<?php if (!empty($datajson[4]['markup'])) { echo $datajson[4]['markup'];
												} else { echo '0';
												}
												?>" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="server_4" data-placeholder="Select Server  ">

												<option value="<?=$datajson[4]['server'];
													?>"><?=$datajson[4]['server'];
													?></option>
												<option value="all">all</option>
												<?php foreach ($serverhot as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="profile_19" data-placeholder="Select Profile">
												<option value="<?=$datajson[4]['profile'];
													?>"><?=$datajson[4]['profile'];
													?></option>
												<?php foreach ($ARRAY as $index => $jambu): ?>
												<option value="<?=$jambu['name'];
													?>"><?php echo $jambu['name'];
													?></option>
												<?php endforeach;
												?>

											</select>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_5" value="<?=$datajson[4]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_5" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[4]['limit_download'])) { echo $datajson[4]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_5" class="form-control  boxsadaw"  min="0"   value="<?php if (!empty($datajson[4]['limit_upload'])) { echo $datajson[4]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_5" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[4]['limit_total'])) { echo $datajson[4]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<select class="form-control select2id" name="typechar_4" data-placeholder="Select Type">
												<	<?=show_string($datajson[4]['typechar']) ?>

													<option value="1">1234</option>
													<option value="2">ABCDE</option>
													<option value="3">abcd</option>
													<option value="4">ABCDabcd</option>
													<option value="5">AbcdABCD1234</option>
													<option value="6">abcd1234</option>
													<option value="7">ABCD1234</option>
													<option value="checkCode">ABCDabcd1234</option>

												</select>
											</div>
										</div>

										<div class="row mg-t-10 mg-b-10">
											<label class="col-sm-4 form-control-label">Type Login  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<select class="form-control select2id" name="Type_4" data-placeholder="Select Type">
													<option value="<?=$datajson[4]['type'];
														?>"><?php if ($datajson[4]['type'] == 'userpass') {
															echo 'Username = Password';
														} else {
															echo 'Username & Password';
														}
														?></option>
													<option value="up">Username & Password</option>
													<option value="userpass">Username = Password</option>

												</select>
											</div>
										</div>
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Length Character  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input id="colorful5" class="form-control  boxsadaw"  name="length_5" type="number" min="0" max="10" value="<?php if (!empty($datajson[4]['length'])) { echo $datajson[4]['length'];
												} else { echo '1';
												}
												?>" onkeypress="return isNumber(event)" />
											</div>
										</div>
							<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[4]['Color'];?>" name="Color_5">

										
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 mg-t-10">
								<div class="card bd-primary">
									<div class="card-header bg-primary tx-white">
										Voucher
										<?=markup($datajson[5]['price'], $datajson[5]['markup']);
										?>
									</div>
									<div class="card-body pd-sm-15">
										<!-- row -->
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Nama Voucher  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input type="text" class="form-control  boxsadaw"  name="vocname_21" value="<?=$datajson[5]['Voucher'];
												?>">
											</div>
										</div>
											<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Text List</label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input type="text" class="form-control  boxsadaw"  name="Text_List_6" value="<?=$datajson[5]['Text_List'];
												?>">
											</div>
										</div>
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Harga Voucher  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<div class="input-group">
													<span class="input-group-addon bg-transparent">
														<label class="wd-8 lh-8">
															Rp.
														</label>
													</span>
													<input type="text" class="form-control  boxsadaw"  name="price_22" value="<?=$datajson[5]['price'];
													?>" onkeypress="return isNumber(event)">
												</div>
											</div>
										</div>
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Markup Voucher  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<div class="input-group">
													<span class="input-group-addon bg-transparent">
														<label class="wd-8 lh-8">
															Rp.
														</label>
													</span>
													<input type="text" class="form-control  boxsadaw"  name="markup_5" value="<?php if (!empty($datajson[5]['markup'])) { echo $datajson[5]['markup'];
													} else { echo '0';
													}
													?>" onkeypress="return isNumber(event)">
												</div>
											</div>
										</div>
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Server  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<select class="form-control select2id" name="server_5" data-placeholder="Select Server ">

													<option value="<?=$datajson[5]['server'];
														?>"><?=$datajson[5]['server'];
														?></option>
													<option value="all">all</option>
													<?php foreach ($serverhot as $index => $jambu): ?>
													<option value="<?=$jambu['name'];
														?>"><?php echo $jambu['name'];
														?></option>
													<?php endforeach;
													?>

												</select>
											</div>
										</div>
										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Profile  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<select class="form-control select2id" name="profile_23" data-placeholder="Select Profile">

													<option value="<?=$datajson[5]['profile'];
														?>"><?=$datajson[5]['profile'];
														?></option>

													<?php foreach ($ARRAY as $index => $jambu): ?>
													<option value="<?=$jambu['name'];
														?>"><?php echo $jambu['name'];
														?></option>
													<?php endforeach;
													?>

												</select>
											</div>
										</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Limit Uptime  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  name="limit_6" value="<?=$datajson[5]['Limit'];
											?>">
										</div>
									</div>
									
                        <div class="row mg-t-8">
                                <label class="col-sm-4 form-control-label">Limit Quota Download  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                     <div class="input-group">
                                <input type="number" name="limit_download_6" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[5]['limit_download'])) { echo $datajson[5]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>



                        <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Upload  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_upload_6" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[5]['limit_upload'])) { echo $datajson[5]['limit_upload'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
                       <div class="row mg-t-10">
                                <label class="col-sm-4 form-control-label">Limit Quota Total  </label>
                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <div class="input-group">
                                <input type="number" name="limit_total_6" class="form-control  boxsadaw"  min="0"  value="<?php if (!empty($datajson[5]['limit_total'])) { echo $datajson[5]['limit_total'];} else { echo '0';}?>">
                                <span class="input-group-addon">Mbps</span>
                            </div>
                                </div>
                            </div>
										<div class="row mg-t-10 mg-b-10">
											<label class="col-sm-4 form-control-label">Type Char  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<select class="form-control select2id" name="typechar_5" data-placeholder="Select Type">
													<?=show_string($datajson[5]['typechar']) ?>

													<option value="1">1234</option>
													<option value="2">ABCDE</option>
													<option value="3">abcd</option>
													<option value="4">ABCDabcd</option>
													<option value="5">AbcdABCD1234</option>
													<option value="6">abcd1234</option>
													<option value="7">ABCD1234</option>
													<option value="checkCode">ABCDabcd1234</option>

												</select>
											</div>
										</div>
										<div class="row mg-t-10 mg-b-10">
											<label class="col-sm-4 form-control-label">Type Login  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<select class="form-control select2id" name="Type_5" data-placeholder="Select Type">
													<option value="<?=$datajson[5]['type'];
														?>"><?php if ($datajson[5]['type'] == 'userpass') {
															echo 'Username = Password';
														} else {
															echo 'Username & Password';
														}
														?></option>

													<option value="up">Username & Password</option>
													<option value="userpass">Username = Password</option>

												</select>
											</div>
										</div>

										<div class="row mg-t-8">
											<label class="col-sm-4 form-control-label">Length Character  </label>
											<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input id="colorful6" class="form-control  boxsadaw"  name="length_6" type="number" min="0" max="10" value="<?php if (!empty($datajson[5]['length'])) { echo $datajson[5]['length'];
												} else { echo '1';
												}
												?>" onkeypress="return isNumber(event)" />

											</div>
										</div>
								<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
<input class="jscolor form-control" value="<?=$datajson[5]['Color'];?>" name="Color_6">

										
										</div>
									</div>
									</div>
								
								</div>
						
							</div>
							<div class="col-xl-12 mg-t-15">
								<div class="row row-xs mg-t-10">
									<div class="col-sm-20 mg-l-auto">
										<div class="form-layout-footer">
											<button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit" onClick="document.location.reload(true)" style="cursor: pointer;" name="save"><i class="fa fa-thumbs-up mg-r-2"></i> Save</button>
											<button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit" onClick="return confirm('Delete : Anda Yakin ?...')" style="cursor: pointer;" name="hapus"><i class="fa fa-trash mg-r-2"></i> Delete</button>
										</div>
										<!-- form-layout-footer -->
									</div>
									<!-- col-8 -->
								</div>
							</div>
						</div>
					</form>

	</div>
	<div id="edit_modal" class="modal fade" role="dialog">
		<div class="modal-dialog wd-100p" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-header pd-x-25 bg-primary">
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Petunjuk </h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body pd-25">
				
						
							<div class="card bd-primary">
								<div class="card-header bg-primary tx-white">
									Voucher
								
								</div>
								<div class="card-body pd-sm-15">
						
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Nama Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"   value="Nama voucher">
										</div>
									</div>
										<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Text List</label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  value="Voucher 1 harga .... ">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Harga Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"   value="Harga Voucher">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Markup Voucher  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<div class="input-group">
												<span class="input-group-addon bg-transparent">
													<label class="wd-8 lh-8">
														Rp.
													</label>
												</span>
												<input type="text" class="form-control  boxsadaw"   value="Pengurangan saldo /bonus -saldo">
											</div>
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Server  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input type="text" class="form-control  boxsadaw"   value="Nama server voucher">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Profile  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
												<input type="text" class="form-control  boxsadaw"   value="Nama Profile voucher">
										</div>
									</div>
								
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Char  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"  value="Type Character voucher">
										</div>
									</div>
									<div class="row mg-t-10 mg-b-10">
										<label class="col-sm-4 form-control-label">Type Login  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
											<input type="text" class="form-control  boxsadaw"   value="Type voucher">
										</div>
									</div>
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Length Character  </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
	<input type="text" class="form-control  boxsadaw"   value="Panjang Character Username/Password voucher">
										</div>
									</div>		
									<div class="row mg-t-8">
										<label class="col-sm-4 form-control-label">Qr Code Color </label>
										<div class="col-sm-8 mg-t-10 mg-sm-t-0">
	<input type="text" class="form-control  boxsadaw" value="Warna Qrcode voucher">

										
										</div>
									</div>
									<!-- card-body -->
								</div>
								<!-- card-body -->
							</div>
							<!-- card -->
						</div>
			

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>

	</div>

	<script src="../lib/bootstrap/bootstrap.js"></script>
	<script src="../js/MikbotamNumberCheck.js"></script>
	<script>

		$('#colorful1,#colorful2,#colorful3,#colorful4,#colorful5,#colorful6').bootstrapNumber({
			upClass: 'success',
			downClass: 'danger'
		});
	</script>