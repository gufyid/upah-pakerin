<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<!-- <script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script> -->

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
	<center><span id="loading" style="display:none"><img src="<?php echo base_url() . 'asset/images/loading.gif' ?>" width="450" height="75">Please Wait!!!!!!!</span></center>
	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Adjustment Bulanan
				</h2>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
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
									<label for="komponen">Komponen</label>
									<select class="form-control" name="komponen" id="komponen">
										<option value="">Pilih Komponen.. </option>
										<option value="Y">Upah</option>
										<option value="N">Lain-lain</option>
									</select>
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<label for="seksi">Seksi</label>
									<select class="form-control" name="seksi" id="seksi">
										<option value="">Pilih Seksi... </option>
										<?php
										foreach ($seksi_bulanan as $d) {
											$kdseksi = $d['seksi'];
											$nm = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
											echo "<option value=" . $d['seksi'] . ">" . $nm[0]['nama'] . "</option>";
										}
										?>
									</select>
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

						</form>
						<hr />

					</div><!-- /.col -->
				</div><!-- /.row -->
				<div id="target"></div>

			</div><!-- /.page-content -->
		</div>
	</div><!-- /.main-content -->

	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$('document').ready(function() {
			$('#bulan').val('');
			$('#tahun').val('');
			$('#seksi').val('');
			$('#komponen').val('');
			$('#table1').dataTable({
				responsive: true
			});

			$('[name=seksi]').change(function(e) {
				e.preventDefault();
				ambil_seksi();
			})

			$('[name=komponen]').change(function(e) {
				e.preventDefault();
				var x = $('[name=seksi]').val();
				if (x != '') {
					ambil_seksi();
				}

			})

		})

		function ambil_seksi() {
			$.ajax({
				type: "POST",
				data: {
					seksi: $('[name=seksi]').val(),
					bulan: $('[name=bulan]').val(),
					tahun: $('[name=tahun]').val(),
					komponen: $('[name=komponen]').val()
				},
				url: "<?php echo base_url() . 'index.php/bulanan/ambil_karyawan_seksi_adjustment' ?>",

				success: function(hasil) {
					$('#target').html(hasil);
				}
			});
		}
	</script>
</body>

</html>