<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
	<style type="text/css">
		img {
			margin-top: 150px;
		}
	</style>

</head>

<body class="no-skin">
	<center>
		<span id='hasil'></span>
	</center>
	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Proses Gaji Mingguan
				</h2>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_import">
							<div class="space-4"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Periode Upah</label>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_awal_upah" id="periode_awal_upah" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Awal Upah" required />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_akhir_upah" id="periode_akhir_upah" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Akhir Upah" required />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Periode Data</label>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_awal_data" id="periode_awal_data" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Awal Data" required />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_akhir_data" id="periode_akhir_data" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Akhir Data" required />
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
						<hr />

					</div><!-- /.col -->

				</div><!-- /.row -->
			</div>
		</div><!-- /.page-content -->
	</div>
	<span id="load"></span>
	<!-- modal-->
	<div class="modal modal-transparent fade" id="mymodal" role="dialog" data-backdrop="static" data-keyboard="false">
		<center><img src="<?php echo base_url() . 'asset/images/gear4.gif' ?>" width="250" height="250">
			<h4>
				<font color="white">Please Wait!!!</font>
			</h4>
		</center>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('[name=periode_awal_data]').val('');
			$('[name=periode_akhir_data]').val('');
			$('[name=periode_awal_upah]').val('');
			$('[name=periode_akhir_upah]').val('');
			$('#proses').click(function() {

				if (confirm('Yakin mau proses gaji Mingguan?') == true) {
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url() . "index.php/mingguan/proses_gaji" ?>',
						data: {
							periode_awal_data: $('[name=periode_awal_data]').val(),
							periode_akhir_data: $('[name=periode_akhir_data]').val(),
							periode_awal_upah: $('[name=periode_awal_upah]').val(),
							periode_akhir_upah: $('[name=periode_akhir_upah]').val()
						},
						dataType: 'text',
						beforeSend: function() {
							$("#mymodal").modal('show');
						},
						success: function(data) {
							$("#mymodal").modal('hide');
							$('#hasil').html(data.pesan);
							loadData();
							$('[name=periode_awal_data]').val('');
							$('[name=periode_akhir_data]').val('');
							$('[name=periode_awal_upah]').val('');
							$('[name=periode_akhir_upah]').val('');
						}

					});
				}

			});

		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . "index.php/mingguan/ambil_gaji_mingguan" ?>',
				data: {
					periode_awal_upah: $('[name=periode_awal_upah]').val(),
					periode_akhir_upah: $('[name=periode_akhir_upah]').val()
				},
				success: function(dataku) {
					$('#load').html(dataku);

				}
			});

		}

		jQuery(function($) {
			$("#periode_awal_data,#periode_akhir_data,#periode_awal_upah,#periode_akhir_upah").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				yearRange: '-55:-0',
				hideIfNoPrevNext: true,
				autoclose: true,
				todayHighlight: true
			});

			$("#periode_akhir_upah").change(function() {
				//loadData();
			})

		})
	</script>
</body>

</html>