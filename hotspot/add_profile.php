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
	header("Location:admin/login.php");
} else {
	include '../config/system.conn.php';
	include '../config/system.byte.php';
	include '../Api/routeros_api.class.php';
	$API = new routeros_api();

	if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port));

	$getallqueue = $API->comm("/queue/simple/print", [
		"?dynamic" => "false",
	]);

	if (isset($_POST['saveprofile']) && !empty($_POST['name'])) {
		$name              = $_POST['name'];
		$shared_userscount = $_POST['shared-users'];
		$rate_limittraf    = $_POST['rate-limit'];
		$validdity         = $_POST['valid_time'];
		$lock_macs         = $_POST['lock_mac'];
		$parent            = $_POST['parent'];
		$trasparants       = $_POST['checkbox'];

		if ($trasparants == true) {
			$trasparant = 'yes';
		} else {
			$trasparant = "no";
		}

		if ($lock_macs == 'enable') {
			$on_login = ':put (",' . $lock_macs . ',' . $validdity . ',");{:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $validdity . ');:local macadd $"mac-address";:local ipaddresslocal $"address";[/ip hotspot user set mac-address=$"macadd" [find where name=$user]];[/system scheduler add disabled=no interval=$uptime name=$user on-event= "[/ip hotspot active remove [find where user=$user]];[/ip hotspot user remove [find where name=$user]];[/ip hotspot cookie remove [find user=$user]];[/sys sch re [find where name=$user]]" start-date=$date start-time=$time];}}';
		} else {
			$on_login = ':put (",' . $lock_macs . ',' . $validdity . ',");{:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $validdity . ');:local macadd $"mac-address";:local ipaddresslocal $"address";[/system scheduler add disabled=no interval=$uptime name=$user on-event= "[/ip hotspot active remove [find where user=$user]];[/ip hotspot user remove [find where name=$user]];[/ip hotspot cookie remove [find user=$user]];[/sys sch re [find where name=$user]]" start-date=$date start-time=$time];}}';
		}

		if ($validdity != 0) {
			$profile = $API->comm("/ip/hotspot/user/profile/add", [
				"name" => $name,
				"rate-limit" => $rate_limittraf,
				"shared-users" => $shared_userscount,
				"status-autorefresh" => "1m",
				"transparent-proxy" => $trasparant,
				"on-login" => $on_login,
				"parent-queue" => $parent,
			]);
		} else {
			$profile = $API->comm("/ip/hotspot/user/profile/add", [
				"name" => $name,
				"rate-limit" => $rate_limittraf,
				"shared-users" => $shared_userscount,
				"status-autorefresh" => "1m",
				"transparent-proxy" => $trasparant,
				"parent-queue" => $parent,
			]);
		}

		echo "<script>setTimeout(\"location.href = '?Mikbotam=addprofile';\");</script>";
	}
}

?>


<div class="sl-pagebody">
	<div class="col-sm-6 pd-1-force mg-t-8">
		<div class="card bd-primary">
			<div class="card-header bg-primary tx-white">
				Add Profile Hotspot
			</div>
			<div class="card-body pd-sm-15">
				<form method="post" action="">
					<div class="row mg-t-8">
						<label class="col-sm-4 form-control-label">Name Profile</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<input type="text" class="form-control" name="name" data-toggle="tooltip" data-placement="top" title="Nama tidak boleh ada spasi" value="">
						</div>
					</div>
					<div class="row mg-t-8">
						<label class="col-sm-4 form-control-label">Parent Queue</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<select class="form-control select2id" name="parent" data-toggle="tooltip" data-placement="top" title="Jika kosong pilih none" >
								<option>none</option>
								<?php  foreach ($getallqueue as $index => $barisan) : ?>

								<option value="<?=$barisan['name'] ?>"><?=$barisan['name'] ?></option>

								<?php  endforeach;
								?>
							</select>
						</div>
					</div>

					<div class="row mg-t-8">
						<label class="col-sm-4 form-control-label">Rate limit [TX/RX]</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<input type="text" class="form-control" name="rate-limit" value="" data-toggle="tooltip" data-placement="top" title="example 1M/512k" placeholder="1M/512k">
						</div>
					</div>
					<div class="row mg-t-8">
						<label class="col-sm-4 form-control-label">Shared Users</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<input id="colorful2" class="form-control" name="shared-users" type="number" min="1" max="10" value="1" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<div class="row mg-t-8">
						<label class="col-sm-4 form-control-label">Validity</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<input type="text" class="form-control" name="valid_time" value="" data-toggle="tooltip" data-placement="top" title="Masa Berlaku Contoh : 30d = 30hari, 12h = 12jam, 30m = 30menit" placeholder="1d" required>
						</div>
					</div>


					<div class="row mg-t-10 mg-b-10">
						<label class="col-sm-4 form-control-label">Lock User</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<select class="form-control select2id" name="lock_mac" data-placeholder="Select Type" data-toggle="tooltip" data-placement="top" title="Lock username dengan Mac">
								<option value="disable">Disable</option>
								<option value="enable">Enable</option>
							</select>
						</div>
					</div>
					<div class="row mg-t-10 mg-b-10">
						<label class="col-sm-4 form-control-label">Transparent Proxy</label>
						<div class="col-sm-8 mg-t-10 mg-sm-t-0">
							<label class="ckbox">
								<input type="checkbox" name="checkbox" value="true"><span>Transparent</span>  </label>
						</div>
					</div>
					<div class="row row-xs mg-t-8">
						<div class="col-sm-15 mg-l-auto">
							<div class="form-layout-footer">
								<button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" name="saveprofile" type="submit"><i class="fa fa-send mg-r-2"></i> Save</button>
								<button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa fa-trash mg-r-2"></i> Delete</button>
							</div>
							<!-- form-layout-footer -->
						</div>
						<!-- col-8 -->
					</div>
					<!-- card-body -->
				</form>
			</div>
		</div>
	</div>
</div>
	<script src="../lib/bootstrap/bootstrap.js"></script>
<script src="../js/MikbotamNumberCheck.js"></script>
<script>
	$(document).ready(function() {


		// Initialize tooltip
		$('[data-toggle="tooltip"]').tooltip();

		// Initialize popover
		$('[data-popover-color="default"]').popover();

		$(document).on('click', function (e) {
			$('[data-toggle="popover"],[data-original-title]').each(function () {
				//the 'is' for buttons that trigger popups
				//the 'has' for icons within a button that triggers a popup
				if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
					(($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false  // fix for BS 3.3.6
				}

			});
		});

	});
	$('#colorful1,#colorful2,#colorful3,#colorful4,#colorful5,#colorful6').bootstrapNumber({
		upClass: 'success',
		downClass: 'danger'
	});
</script>