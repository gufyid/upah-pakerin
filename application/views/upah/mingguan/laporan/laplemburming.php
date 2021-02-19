<!DOCTYPE html>
<html>

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
	<div role="main" class="non-printable">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Laporan Rekap Upah Lembur Harian (SPL)
				</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-8">
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_lt">
							<div class="space-4"></div>
							<div class="row">
								<div class="col-sm-2">
									<label>Status : </label>
								</div>
								<div class="col-sm-12">
									<input type="radio" name="status" value="T" checked>Tetap</input>
									<input type="radio" name="status" value="K">Kontrak</input>
									<input type="radio" name="status" value="H">Honor</input>
									<input type="radio" name="status" value="M">Magang</input>
								</div>
							</div>

							<br>

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
									<select class="col-xs-10 col-sm-5" name="pabrik" id="pabrik">
										<option value="">Pilih status... </option>
										<option value="PAKERIN">PAKERIN</option>
										<option value="JAVA PAPER">JAVA PAPER</option>
									</select>
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Seksi</label>
								<div class="col-sm-7">

									<select class="col-xs-10 col-sm-5" name="seksi" id="seksi">
										<option value="">Pilih Seksi... </option>
										<?php
										foreach ($seksi_mingguan as $d) {
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

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Susulan/Tidak</label>
								<div class="col-sm-7">
									<select class="col-xs-10 col-sm-5" name="susulan" id="susulan">
										<option value="">Pilih ... </option>
										<option value="1">Susulan</option>
										<option value="0">Tidak Susulan</option>
									</select>
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Proyek</label>
								<div class="col-sm-7">
									<?php
									$proyek = $this->db->get('t_proyek')->result();
									?>
									<select class="col-xs-10 col-sm-5" name="proyek" id="proyek" required>
										<option value="">Pilih..</option>
										<?php
										foreach ($proyek as $d) {
											echo "<option value='" . $d->id . "'>" . $d->nama . "</option>";
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
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			//	$('[name=status]').val('');
			$('[name=periode_awal]').val('');
			$('[name=periode_akhir]').val('');
			$('[name=seksi]').val('');
			//$('[name=susulan]').val('');
			$('#proses').click(function() {
				// if (confirm('Yakin mau Laporan SPL Mingguan?') == true) {

				// 	$.ajax({
				// 		type: 'POST',
				// 		url: '<?php echo base_url() . "index.php/mingguan/proses_lap_spl_mingguan" ?>',
				// 		data: {
				// 			periode_awal: $('[name=periode_awal]').val(),
				// 			periode_akhir: $('[name=periode_akhir]').val(),
				// 			seksi: $('[name=seksi]').val(),
				// 			status: $('input:radio[name=status]:checked').val(),
				// 			susulan: $('[name=susulan]').val(),
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
				// 			loadData();
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
							url: '<?php echo base_url() . "index.php/mingguan/proses_lap_spl_mingguan" ?>',
							data: {
								periode_awal: $('[name=periode_awal]').val(),
								periode_akhir: $('[name=periode_akhir]').val(),
								seksi: $('[name=seksi]').val(),
								status: $('input:radio[name=status]:checked').val(),
								susulan: $('[name=susulan]').val(),
								pabrik: $('[name=pabrik]').val(),
								proyek: $('[name=proyek]').val()
							},
							//	dataType : 'json',
							beforeSend: function() {
								$('#mymodal').modal('show');
							},
							success: function(data) {
								$('#mymodal').modal('hide');
								swal.fire('Good Job', 'Proses Berhasil', 'success')
								loadData();
							}
						});
					}
				})
			});

			$('[name=seksi]').on('change', function(e) {
				e.preventDefault();
				// loadData();
			});

			$('[name=proyek]').on('change', function(e) {
				e.preventDefault();
				loadData();
			});

			//ambil nilai status 
			$('[name=status]').click(function() {
				// loadData();
			});

			$('[name=susulan]').click(function() {
				// loadData();
			});
		})

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/mingguan/ambil_rekap_spl_mingguan' ?>',
				data: {
					periode_awal: $('[name=periode_awal]').val(),
					periode_akhir: $('[name=periode_akhir]').val(),
					seksi: $('[name=seksi]').val(),
					status: $('input:radio[name=status]:checked').val(),
					susulan: $('[name=susulan]').val(),
					pabrik: $('[name=pabrik]').val(),
					proyek: $('[name=proyek]').val()
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