<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>./asset/css/bootstrap.min.css"></style>
	<!-- <style type="text/css">
		.modal-dialog {
			width: 75%;
			height: 100%;
			padding-left: 15%;
			margin: 0;
		}
	</style> -->
</head>

<body>
	<div role="main" id="wadah">
		<div class="">
			<div class="page-title">

			</div>
			<div class="clearfix">
				<!--<a href="#form_modal" data-toggle="modal" class="btn btn-warning">TAMBAH KARYAWAN</a>-->
				<a href="<?php echo base_url() . 'index.php/utama/panggil/tambahkaryawan' ?>" class="btn btn-primary" style="border-radius:50px;">Tambah Data Karyawan</a>
				<div class="pull-right "><i>&nbsp;</i></div>
			</div><br>
			<div class="table-header">
				DAFTAR KARYAWAN PT. PABRIK KERTAS INDONESIA
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="col-xs-12 col-md-6 u-no-padding text-md-right text-xs-center">
						</div>
						<div class="x_title">
							<span id="pesan"></span>
							<table class="table table-striped table-bordered table-hover" id="table1">
								<thead>
									<tr>
										<th width="5%" style="text-align: center;">No</th>
										<th style="text-align: center;">NIP</th>
										<th style="text-align: center;">NO INDUK</th>
										<th style="text-align: center;">NAMA</th>
										<th style="text-align: center;">BAGIAN</th>
										<th style="text-align: center;">SEKSI</th>
										<th style="text-align: center;">STATUS</th>
										<th width="20%" style="text-align: center;">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<!--  -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- modal hapus -->
	<div class="modal fade" id="form_hapus" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <div class="modal-title"> -->
					<h5 class="modal-title">Hapus Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
					<!-- </div> -->
				</div>
				<div class="modal-body">
					Anda yakin ingin menghapus data <span id="kode"></span> ???
					<input type="hidden" name="noindukh">
				</div>
				<div class="modal-footer">
					<!-- <input type="submit" value="Hapus"> -->
					<a href="" class="badge badge-danger" id="hapus">Hapus</a>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// $('#table1').dataTable({
			// 	responsive: true
			// });
			var table;
			//	$('#table1').DataTable();
			//	"processing" : true,
			//	"serverSide" : true,
			//datatables
			table = $('#table1').DataTable({

				"serverSide": true,
				"processing": true,
				"order": [],

				"ajax": {
					"url": "<?php echo site_url('utama/get_data_karyawan') ?>",
					"type": "POST",
				},


				"columnDefs": [{
					"targets": [0],
					"orderable": false,
					"className": "text-center"
				}, ],

			});

			$('#hapus').on('click', function() {
				// e.preventDefault();
				// var x = $('[name=noindukh]').val();
				// alert(x);
				$.ajax({
					type: "POST",
					url: '<?php echo base_url() . "index.php/utama/hapus_karyawan" ?>',
					dataType: 'json',
					data: {
						noinduk: $('[name=noindukh]').val()
					},
					beforeSend: function() {
						// alert(x);
					},
					success: function(data) {
						// $('#pesan').html(data);
						// console.log(data);
						alert("Data berhasil dihapus");
					}
				})

			});
		});

		function submit(x) {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url() . "index.php/utama/edit_karyawan" ?>',
				data: {
					noinduk: x
				},
				success: function(data) {
					$('#wadah').html(data);
				}
			})
		}

		function subm(x) {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url() . "index.php/utama/view_karyawan" ?>',
				data: {
					noinduk: x
				},
				success: function(data) {
					$('#wadah').html(data);
				}
			})
		}

		function sub(x) {
			// var xx = x.split(",", 2, 1);
			$('#kode').text(x);
			$('[name=noindukh]').val(x);
		}
	</script>
</body>

</html><!-- page content -->