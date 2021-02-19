<!DOCTYPE html>
<html>

<head>
	<title></title>

	<style type="text/css">
		img {
			margin-top: 150px;
		}
	</style>
</head>

<body class="no-skin">
	<center><span id="pesan"></span></center>
	<div role="main" class="non-printable">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Laporan Insentif
				</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-8">
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_lt">
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

							<div class="form-group">
								<div class="col-sm-4">
									<label for="pabrik">Pabrik</label>
									<select class="form-control" name="pabrik" id="pabrik">
										<option value="">Pilih Tahun...</option>
										<option value="PAKERIN">PAKERIN</option>
										<option value="JAVA PAPER">JAVA PAPER</option>
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
					</div>
				</div>
			</div>
		</div>
	</div>

	<span id="load"></span>
	<div class="modal fade modal-transparent" id="mymodal" role="dialog" data-backdrop="static" data-keyboard="false">
		<center><img src="<?php echo base_url() . 'asset/images/gear4.gif' ?>" width="250" height="250">
			<h4>
				<font color="white">Please Wait!!!!!!!</font>
				<h4>
		</center>
	</div>
	<script src="<?php echo base_url(); ?>asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/ace-elements.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>asset/js/ace.min.js"></script> -->
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('[name=bulan]').val('');
			$('[name=tahun]').val('');
			$('#proses').click(function() {
				// if (confirm('Yakin mau proses Insentif?') == true) {
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: '<?php echo base_url() . "index.php/mingguan/proses_lap_insentif" ?>',
				// 		data: {
				// 			bulan: $('[name=bulan]').val(),
				// 			tahun: $('[name=tahun]').val(),
				// 			pabrik: $('[name=pabrik]').val()
				// 		},
				// 		//	dataType : 'json',
				// 		beforeSend: function() {
				// 			$('#mymodal').modal('show');
				// 		},
				// 		success: function(data) {
				// 			//console.log(data);
				// 			$('#mymodal').modal('hide');
				// 			$('#pesan').text('Proses Berhasil!!!');
				// 			$('#load').html(data);
				// 			// loadData();
				// 		}
				// 	});
				// }
				Swal.fire({
					title: 'Are you sure?',
					text: "",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Do it!'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() . "index.php/mingguan/proses_lap_insentif" ?>',
							data: {
								bulan: $('[name=bulan]').val(),
								tahun: $('[name=tahun]').val(),
								pabrik: $('[name=pabrik]').val()
							},
							//	dataType : 'json',
							beforeSend: function() {
								$('#mymodal').modal('show');
							},
							success: function(data) {
								$('#mymodal').modal('hide');
								swal.fire('Good Job', 'Proses Berhasil', 'success')
								$('#load').html(data);
							}
						});
					}
				})

			});
		})

		// function loadData(){
		// 	$.ajax({
		// 		type : 'post',
		// 		url : '<?php echo base_url() . 'index.php/bulanan/ambil_rekap_insentif' ?>',
		// 		data : {
		// 			bulan : $('[name=bulan]').val(),
		// 			tahun : $('[name=tahun]').val(),
		// 			seksi   : $('[name=seksi]').val(),
		// 			status  :  $('input:radio[name=status]:checked').val(),
		// 			proyek  : $('[name=proyek]').val(),
		// 			susulan  : $('[name=susulan]').val()
		// 		},
		// 		success : function(data)
		// 		{
		// 			$('#load').html(data);

		// 		}
		// 	})	
		// }
	</script>
</body>

</html>