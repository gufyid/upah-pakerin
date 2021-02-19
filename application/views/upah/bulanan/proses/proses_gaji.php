<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<style type="text/css">
		#animasi {
			margin-top: 150px;
		}
	</style>
</head>

<body class="no-skin">
	<center>
		<span id="loading" style="display:none"><img src="<?php echo base_url() . 'asset/images/loading.gif' ?>" width="450" height="100">Please Wait!!!!!!!</span>
		<span id='hasil'></span></center>
	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Proses Gaji Bulanan
				</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_import">
							<div class="space-4"></div>

							<div class="form-group">
								<div class="col-sm-4">
									<?php
									$bulan = array(
										"1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni",
										"7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
									);
									?>
									<label for="bulan">Bulan</label>
									<select class="form-control" name="bulan" id="bulan">
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
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<label for="tahun">Tahun</label>
									<select class="form-control" name="tahun" id="tahun">
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
		<center><img src="<?php echo base_url() . 'asset/images/gear4.gif' ?>" width="250" height="250" id='animasi'>
			<font color="white">
				<h4>Please Wait!!!</h4>
			</font>
		</center>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('[name=bulan]').val('');
			$('[name=tahun]').val('');
			$('#proses').click(function() {
				// if (confirm('Yakin mau proses gaji bulanan?') == true) {
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: '<?php echo base_url() . "index.php/bulanan/proses_gaji" ?>',
				// 		data: {
				// 			bulan: $('[name=bulan]').val(),
				// 			tahun: $('[name=tahun]').val()
				// 		},
				// 		dataType: 'text',
				// 		beforeSend: function() {
				// 			$("#mymodal").modal('show');
				// 		},
				// 		success: function(data) {
				// 			$("#mymodal").modal('hide');
				// 			console.log(data);
				// 			loadData();
				// 		}
				// 	});
				// }
				Swal.fire({
					title: 'Proses Gaji',
					text: "Yakin mau proses gaji bulanan?",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Do it!'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() . "index.php/bulanan/proses_gaji" ?>',
							data: {
								bulan: $('[name=bulan]').val(),
								tahun: $('[name=tahun]').val()
							},
							//	dataType : 'json',
							beforeSend: function() {
								$('#mymodal').modal('show');
							},
							success: function(data) {
								$('#mymodal').modal('hide');
								Swal.fire('Good Job', 'Proses Berhasil', 'success')
								loadData();
							}
						});
					}
				})

			});

			$('[name=tahun]').on('change', function(e) {
				e.preventDefault();
				loadData();
			})

		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/bulanan/ambil_gaji_bulanan' ?>',
				data: {
					bulan: $('[name=bulan]').val(),
					tahun: $('[name=tahun]').val()
				},
				success: function(data) {
					$('#load').html(data);

				}
			})
		}
	</script>
</body>

</html>