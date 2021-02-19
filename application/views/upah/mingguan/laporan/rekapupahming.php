<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>


	<style type="text/css">
		img {
			margin-top: 150px;
		}
	</style>
</head>

<body class="no-skin">
	<center><span id="pesan"></span></center>
	<div role="main" class="non-printable">
		<div class="main-content">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">
						Laporan Rekap Upah Mingguan
					</h2>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-8">
							<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_lt">
								<div class="space-4"></div>

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Periode</label>
									<div class="col-sm-3">
										<input class="form-control date-picker" Name="periode_awal" id="periode_awal" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Awal" autocomplete="off" required readonly />
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
									<div class="col-sm-3">
										<input class="form-control date-picker" Name="periode_akhir" id="periode_akhir" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Akhir" autocomplete="off" required readonly />
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Pabrik</label>
									<div class="col-sm-7">
										<select class="col-xs-10 col-sm-5" name="pabrik" id="pabrik" class="form-control">
											<option value="">Pilih status... </option>
											<option value="PAKERIN">PAKERIN</option>
											<option value="JAVA PAPER">JAVA PAPER</option>
										</select>
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Status</label>
									<div class="col-sm-7">
										<select class="col-xs-10 col-sm-5" name="status" id="status">
											<option value="">Pilih status... </option>
											<option value="T">Tetap</option>
											<option value="K">kontrak</option>
											<option value="H">Honor</option>
											<option value="M">Magang</option>
										</select>
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>

								<div class="clearfix">
									<div class="col-md-offset-0 col-md-9">
										<input type="button" class="btn btn-info" id="proses" name="proses" value="Proses" style="border-radius:50px">
									</div>
								</div>

							</form>
						</div><!-- /.col -->
					</div><!-- /.row -->

				</div>
			</div><!-- /.page-content -->
		</div>
	</div><!-- /.main-content -->


	<span id="load"></span>
	<div class="modal fade modal-transparent" id="mymodal" role="dialog" data-backdrop="static" data-keyboard="false">
		<center><img src="<?php echo base_url() . 'asset/images/gear4.gif' ?>" width="250" height="250">
			<h4>
				<font color="white">Please Wait!!!!!!!</font>
				<h4>
		</center>
	</div>

	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table1').dataTable({
				responsive: true
			});
		})
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('[name=periode_awal]').val('');
			$('[name=periode_akhir]').val('');
			$('[name=status]').val('');
			$('#proses').click(function() {
				// if (confirm('Yakin mau proses ?') == true) {
				// 	var periode_awal = $('[name=periode_awal]').val();
				// 	var periode_akhir = $('[name=periode_akhir]').val();
				// 	var status = $('[name=status]').val();
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: '<?php echo base_url() . "index.php/mingguan/proses_lap_upah_mingguan" ?>',
				// 		data: {
				// 			periode_awal: $('[name=periode_awal]').val(),
				// 			periode_akhir: $('[name=periode_akhir]').val(),
				// 			status: $('[name=status]').val(),
				// 			pabrik: $('[name=pabrik]').val()
				// 		},
				// 		//	dataType : 'json',
				// 		beforeSend: function() {
				// 			$('#mymodal').modal('show');
				// 		},
				// 		success: function(data) {

				// 			$('#mymodal').modal('hide');
				// 			$('#pesan').text('Proses berhasil!!!');
				// 			loadData();
				// 		}
				// 	});
				// }
				Swal.fire({
					title: 'Are You Sure?',
					text: "",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Do It!'
				}).then((result) => {
					if (result.isConfirmed) {
						var periode_awal = $('[name=periode_awal]').val();
						var periode_akhir = $('[name=periode_akhir]').val();
						var status = $('[name=status]').val();
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() . "index.php/mingguan/proses_lap_upah_mingguan" ?>',
							data: {
								periode_awal: $('[name=periode_awal]').val(),
								periode_akhir: $('[name=periode_akhir]').val(),
								status: $('[name=status]').val(),
								pabrik: $('[name=pabrik]').val()
							},
							//	dataType : 'json',
							beforeSend: function() {
								$('#mymodal').modal('show');
							},
							success: function(data) {
								$('#mymodal').modal('hide');
								// $('#pesan').text('Proses berhasil!!!');
								swal.fire('Good Job', 'Proses Berhasil', 'success');
								loadData();
							}
						});
					}
				})
			});

			$('[name=status]').on('change', function(e) {
				e.preventDefault();
				loadData();
			});
		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/mingguan/ambil_rekap_upah_mingguan' ?>',
				data: {
					periode_awal: $('[name=periode_awal]').val(),
					periode_akhir: $('[name=periode_akhir]').val(),
					status: $('[name=status]').val(),
					pabrik: $('[name=pabrik]').val()
				},
				success: function(data) {
					$('#load').html(data);

				}
			})
		}

		jQuery(function($) {
			$("#periode_awal,#periode_akhir").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				yearRange: '-55:-0',
				hideIfNoPrevNext: true,
				autoclose: true,
				todayHighlight: true
			});
			//jika datepicker di ubah
			$('#periode_awal').change(function() {
				var x = $(this).val();
				$.ajax({
					type: "post",
					url: "<?php echo base_url() . 'index.php/mingguan/hitung_tanggal' ?>",
					data: 'tgl_awal=' + x,
					success: function(data) {
						//					var hasil = new date();
						$('#periode_akhir').val(data);
					}
				});
			});

			$('#periode_akhir').change(function() {
				//loadData();
			});
		})
	</script>
</body>

</html>