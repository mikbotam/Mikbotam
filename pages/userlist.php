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

    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:../admin/login.php");
    } else {
        include '../config/system.conn.php';
        $data = lihatdata();
    }


?>
<script>
	function makebroadcast() {
		$("\x23\x65\x64\x69\x74\x5F\x6D\x6F\x64\x61\x6C").on("\x73\x68\x6F\x77\x2E\x62\x73\x2E\x6D\x6F\x64\x61\x6C", function(_0x5381) {
			var _0x53B3 = $(_0x5381.relatedTarget).data("\x69\x64"); $("\x62\x6F\x64\x79").css("\x63\x75\x72\x73\x6F\x72", "\x77\x61\x69\x74"); $.ajax({
				url: "\x2E\x2E\x2F\x50\x72\x6F\x73\x73\x65\x73\x2F\x65\x78\x70\x6F\x72\x74\x75\x73\x65\x72\x2E\x70\x68\x70", data: "\x69\x64\x3D"+ _0x53B3+ "\x26\x70\x72\x6F\x66\x69\x6C\x65\x3D\x79\x65\x73", cache: false, success: function(_0x53E5) {
					$("\x23\x76\x69\x65\x77\x2D\x72\x65\x73\x70\x6F\x6E\x74").html(_0x53E5); $("\x62\x6F\x64\x79").css("\x63\x75\x72\x73\x6F\x72", "\x64\x65\x66\x61\x75\x6C\x74")}})})}
</script>

<div class="card-body pd-sm-10">
	<div class="row row-sm mg-t--1">
		<div class="col-sm-12 mg-t-10">
			<div class="card bd-primary">
				<div class="card-header bg-primary tx-white">
					<i class="fa fa-users "></i> User List
				</div>
				<div class="card-body pd-sm-15">
					<div class="table-wrapper">
						<table id="userhistory" class="table display  nowrap " width="100%">
							<thead>
								<tr>
									<th>NO</th>
									<th>ID User</th>
									<th>Nama User</th>
									<th>No Telp/whatsapp</th>
									<th>Saldo Akhir</th>
									<th>Total Voucher</th>
									<th>Status</th>
									<th>Last Update</th>
									<th>Operation</th>
								</tr>
							</thead>
							<tbody>

								<?php	 $no = 1;
								foreach ($data as $index => $baris) : ?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $baris['id_user'];?></td>
									<td><?php echo $baris['nama_seller'];?></td>
									<td><?php echo $baris['nomer_tlp'];?></td>
									<td><?php echo rupiah($baris['saldo']);?></td>
									<td><?php echo $baris['voucher_terjual'];?></td>
									<td><?php echo $baris['status'];?></td>
									<td><?php echo $baris['Tanggal'];?></td>
									<td>
	<a href='../Prosses/exportuser.php?id=<?php echo $baris['id_user'];?>&profile=no' class='btn btn-success'><i class='fa fa-download'></i></a>&nbsp;
	<a href='#edit_modal' class='btn btn-success' data-toggle='modal' onclick='makebroadcast();' data-id="<?php echo $baris['id_user'];?>"><i class='fa fa-pencil-square-o'></i></a>&nbsp;
	<a href='../Prosses/exportuser.php?id=<?php echo $baris['id_user'];?>&profile=delete ' class='btn btn-danger' onClick="return confirm('Delete : Anda Yakin Seluruh history dan akun akan dihapus anda tidak dapat mengembalikan semuanya?...')"><i class='fa fa fa-trash-o'></i></a></td>
								</tr>
								<?php endforeach;
								?>

							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="edit_modal" class="modal fade" role="dialog">
	<div class="modal-dialog wd-100p" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-header pd-x-25 bg-primary">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-white tx-bold">Counter Profile </h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body pd-25">
				<div id="view-respont"></div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>

</div>


<script src="../lib/bootstrap/bootstrap.js"></script>