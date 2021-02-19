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
	<center><span id="pesan"></span></center>
	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Upload Lembur Tetap Mingguan
				</h2>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_import">
							<div class="space-4"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Periode</label>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_awal" id="periode_awal" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Awal" autocomplete="off" readonly required />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
								<div class="col-sm-3">
									<input class="form-control date-picker" Name="periode_akhir" id="periode_akhir" type="text" data-date-format="yyyy-mm-dd" placeholder="Periode Akhir" autocomplete="off" readonly required />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">File Excell</label>
								<div class="col-sm-4">
									<input type="file" name="file" id="file" />
								</div>
								<label class="col-sm-2 control-label no-padding-left" for="form-field-2">* Excell File Only</label>
							</div>


							<div class="clearfix">
								<div class="col-md-offset-0 col-md-9">
									<input type="submit" class="btn btn-info" id="import" name="import" value="Upload" style="border-radius:50px">
								</div>
							</div>

						</form>


					</div><!-- /.col -->
				</div><!-- /.row -->
				<br>
				<span id='hasil'></span>
			</div>
		</div><!-- /.page-content -->
	</div>
	<div class="modal fade modal-transparent" id="modal2" role="dialog" data-backdrop="static" data-keyboard="false">
		<center><img src="<?php echo base_url() . 'asset/images/gear4.gif' ?>" width="250" height="250">
			<h4>
				<font color="white">Please Wait!!!!!!!</font>
				<h4>
		</center>
	</div>

	<div id="target_tgl"></div>
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
		$('document').ready(function() {
			$('[name=periode_awal]').val('');
			$('[name=periode_akhir]').val('');
			$('#form_import').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url() . "index.php/mingguan/upload_lt_mingguan" ?>',
					data: new FormData(this),
					// data : $(this).serialize(),
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function() {
						$('#modal2').modal('show');
					},
					success: function(data) {
						$('#modal2').modal('hide');
						loadData();
						$('[name=periode_awal]').val('');
						$('[name=periode_akhir]').val('');
						$('#file').val('');
						$('#pesan').text('Data berhasil diUpload!!!');
					}

				})
			})


		})

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
				loadData();
			});
		})

		$('document').ready(function() {
			jQuery(function($) {
				$('#file').ace_file_input({
					no_file: 'No File ...',
					btn_choose: 'Choose',
					btn_change: 'Change',
					droppable: false,
					onchange: null,
					thumbnail: false, //| true | large
					whitelist: 'xls'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				// alert('Pastikan format excell sudah benar!!!!!!')	
			});
		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: "<?php echo base_url() . 'index.php/mingguan/ambil_lt_mingguan' ?>",
				data: {
					periode_awal: $('[name=periode_awal]').val(),
					periode_akhir: $('[name=periode_akhir]').val()
				},
				success: function(data) {
					$('#hasil').html(data);
				}
			})
		}
	</script>
</body>

</html>