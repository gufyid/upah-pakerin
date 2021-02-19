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

	</style>
</head>

<body class="no-skin">
	<center>
		<span id="pesan"></span>
	</center>

	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Upload Data Kondite
				</h2>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_import">
							<div class="space-4"></div>

							<!-- <div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Bulan</label>
							<div class="col-sm-7">
							<?php
							$bulan = array(
								"1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni",
								"7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
							);
							?>
								<select class="col-xs-10 col-sm-5" name="bulan" id="bulan">
									<option value="">Pilih Bulan... </option>
									<?php

									for ($i = 1; $i <= 12; $i++) {
										echo "<option value=$i>" . $bulan[$i] . "</option>";
									}


									?>
								</select>		
								<span class="help-inline col-xs-12 col-sm-7">
								</span>
							</div>
						</div> -->

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Tahun</label>
								<div class="col-sm-7">
									<select class="col-xs-10 col-sm-5" name="tahun" id="tahun" required>
										<option value="">Pilih Tahun...</option>
										<?php
										//	$last = date("Y")-1;
										$last = date("Y") - 1;
										//	for($i=$last;$i<=$last+2;$i++)
										for ($i = $last; $i <= $last + 1; $i++) {
											echo "<option value=$i>$i</option>";
										}
										?>
									</select>
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
									<input type="submit" class="btn btn-info" style="border-radius:50px" id="import" name="import" value="Upload">
								</div>
							</div>

						</form>
						<hr />

					</div><!-- /.col -->
				</div><!-- /.row -->
				<span id='hasil'></span>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-dialog-centered">
				<img src="<?php echo base_url() . 'asset/images/warning/absen_bulanan.jpg' ?>">
			</div>
		</div>
	</div>

	<div class="modal fade modal-transparent" id="modal2" role="dialog" data-backdrop="static" data-keyboard="false">

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
		$('document').ready(function() {

			$('[name=tahun]').val('');
			$('#form_import').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url() . "index.php/kondite/upload_kondite" ?>',
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
						$('[name=tahun]').val('');
						$('#file').val('');
						//$("#form_import")[0].reset();
						$('#pesan').text('Data berhasil diUpload!!!');

					}

				})
			})

			$('[name=tahun]').on('change', function(e) {
				e.preventDefault();
				loadData();

			})


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
				//$('#modal1').modal('show');
				// alert('Pastikan format excell sudah benar!!!!!!');
			});

		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/kondite/ambil_kondite' ?>',
				data: {

					tahun: $('[name=tahun]').val()
				},
				success: function(data) {
					$('#hasil').html(data);
					//alert(data);
				}

			});

		}
	</script>
</body>

</html>