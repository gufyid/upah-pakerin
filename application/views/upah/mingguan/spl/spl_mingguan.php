<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>

</head>

<body class="no-skin">
	<center><span id="loading" style="display:none"><img src="<?php echo base_url() . 'asset/images/loading.gif' ?>" width="450" height="90">Please Wait!!!!!!!</span></center>
	<div class="main-container ace-save-state" id="main-container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					Surat Perintah Lembur (SPL) Mingguan
				</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_import">
							<div class="space-4"></div>
							<div class="row">
								<div class="col-sm-2">
									<label>Status : </label>
								</div>
								<div class="col-sm-12">
									<input type="radio" name="status" value="0" checked>Non Susulan</input>
									<input type="radio" name="status" value="1">Susulan</input>
								</div>
							</div><br />
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
								<label class="col-sm-2 control-label no-padding-right" for="proyek">Proyek</label>
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
						</form>


					</div><!-- /.col -->
				</div><!-- /.row -->
				<br>
				<div id='target'></div>

			</div>
		</div><!-- /.page-content -->
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
			// $('[name=periode_awal]').val('');
			// $('[name=periode_akhir]').val('');
			// $('[name=seksi]').val('');
			// $('#form_import').on('submit',function(e){
			// 	e.preventDefault();
			// 	$.ajax({
			// 		type : 'POST',
			// 		url : '<?php echo base_url() . "index.php/mingguan/upload_premi_mingguan" ?>',	
			// 		  data:new FormData(this),
			// 	     // data : $(this).serialize(),
			// 	      contentType:false,
			// 	      cache:false,
			// 	      processData:false,
			// 	      beforeSend : function(){
			// 	      	$('#loading').show();
			// 	      },
			// 		success : function(data){
			// 			$('#loading').hide();
			// 			loadData();
			// 			$('[name=periode_awal]').val('');
			// 			$('[name=periode_akhir]').val('');
			// 			$('#file').val('');

			// 		}   

			// 	});				
			// });

			$('[name=seksi],[name=status]').change(function(e) {

				e.preventDefault();
				$.ajax({
					type: "POST",
					data: {
						seksi: $('[name=seksi]').val(),
						periode_awal: $('[name=periode_awal]').val(),
						periode_akhir: $('[name=periode_akhir]').val(),
						status: $('input:radio[name=status]:checked').val()
					},
					url: "<?php echo base_url() . 'index.php/mingguan/ambil_karyawan_seksi' ?>",

					success: function(hasil) {
						$('#target').html(hasil);
						//console.log(hasil);
					}
				});
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
				$('[name=seksi]').val('');
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
		})



		function loadData() {
			$.ajax({
				type: 'post',
				url: "<?php echo base_url() . 'index.php/mingguan/ambil_premi_mingguan' ?>",
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