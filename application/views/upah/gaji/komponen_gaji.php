<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>./asset/css/bootstrap.min.css"></style>
</head>

<body>

	<div role="main">
		<div class="">
			<div class="page-title">

				<?php echo $this->session->flashdata('pesan'); ?>

			</div>
			<div class="clearfix">
				<a href="#frmgaji" data-toggle="modal" class="btn btn-primary" style="border-radius:50px" onclick="submit('tambah')">TAMBAH KOMPONEN GAJI</a>
				<div class="pull-right "><i>&nbsp;</i></div>
			</div>
			<br />
			<div class="table-header">
				KOMPONEN GAJI
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="col-xs-12 col-md-6 u-no-padding text-md-right text-xs-center">
						</div>
						<div class="x_title">
							<table class="table table-striped table-bordered table-hover" id="table1">
								<thead>
									<tr>
										<th width="5%" style="text-align: center;">No</th>
										<th style="text-align: center;">NO INDUK</th>
										<th style="text-align: center;">NAMA</th>
										<th style="text-align: center;">GP</th>
										<th style="text-align: center;">TJAB</th>
										<th style="text-align: center;">T3M</th>
										<th style="text-align: center;">T3E</th>

										<th width="20%" style="text-align: center;">Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<div class="modal fade" id="frmgaji" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h1>Tambah Komponen Gaji</h1>
										</div>
										<span id="target"></span>
										<table class="table table-striped">

											<tr>
												<td id="kar">Karyawan</td>
												<td id="ind">No Induk</td>
												<td>
													<input type="text" name="nama" id="nama" placeholder="Nama Kayawan" readonly>
													<input type="text" name="noinduk" id="noinduk" placeholder="Masukkan No Induk" autocomplete="off">
													<p id="target1"></p>
													<input type="hidden" name="noindukh" id="noindukh">
												</td>

												<td>GP</td>
												<td>
													<input type="text" name="gp" id="gp" placeholder="Gaji Pokok">
												</td>

											</tr>
											<tr>
												<td>T. JABATAN</td>
												<td>
													<input type="text" name="tjab" id="tjab" placeholder="Tunjangan Jabatan..">
												</td>
												<td>T3M</td>
												<td>
													<input type="text" name="t3m" id="t3m" placeholder="T3M">
												</td>

											</tr>
											<tr>
												<td>T3E</td>
												<td>
													<input type="text" name="t3e" id="t3e" placeholder="T3E">
												</td>

											</tr>
											<tr>
												<td>
													<input type="button" id="btn-tambah" style="border-radius:50px" onclick="tambahdata()" class="btn btn-primary" value="SIMPAN">
													<input type="button" id="btn-ubah" style="border-radius:50px" onclick="ubahdata()" class="btn btn-primary" value="UBAH">
												</td>
												<td>
													<input type="button" data-dismiss="modal" style="border-radius:50px" class="btn btn-danger" value="BATAL">
												</td>
											</tr>
										</table>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

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
					"url": "<?php echo site_url('utama/get_data_kompgaji') ?>",
					"type": "POST",
				},


				"columnDefs": [{
					"targets": [0],
					"orderable": false,
					"className": "text-center"
				}, ],

			});
			$("#nama").on('keyup', function() {
				var x = $(this).val();
				$.ajax({
					type: 'post',
					url: '<?php echo base_url() . 'index.php/gaji/ambilid' ?>',
					data: 'id=' + x,

					success: function(data) {
						$('#target').html(data);
					}
				})
			})
			$('[name=nama]').val('');

		})

		function submit(x) {
			// $('#noinduk').focus();
			$('[name=nama]').val("");
			$('[name=noinduk]').val("");
			$('[name=gp]').val("");
			$('[name=tjab]').val("");
			$('[name=t3m]').val("");
			$('[name=t3e]').val("");
			$('#target1').text("");
			if (x == 'tambah') {
				$('#btn-tambah').show();
				$('#nama').hide();
				$('#noinduk').show();
				$('#ind').show();
				$('#kar').hide();
				$('#btn-ubah').hide();

			} else {
				$('#btn-tambah').hide();
				$('#nama').show();
				$('#ind').hide();
				$('#kar').show();
				$('#noinduk').hide();
				$('#btn-ubah').show();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url() . "index.php/gaji/datagaji" ?>',
					data: 'id=' + x,
					dataType: 'json',
					success: function(data) {
						$('[name=nama]').val(data[0].nama);
						$('[name=noindukh]').val(data[0].noinduk);
						$('[name=gp]').val(data[0].gp);
						$('[name=tjab]').val(data[0].tjab);
						$('[name=t3m]').val(data[0].t3m);
						$('[name=t3e]').val(data[0].t3e);

					}
				});
			}
		}

		function tambahdata() {
			var noinduk = $('[name=noinduk]').val();
			var gp = $('[name=gp]').val();
			var tjab = $('[name=tjab]').val();
			var t3m = $('[name=t3m]').val();
			var t3e = $('[name=t3e]').val();

			$.ajax({
				type: 'POST',
				data: 'noinduk=' + noinduk + '&gp=' + gp + '&tjab=' + tjab + '&t3m=' + t3m + '&t3e=&' + t3e,
				url: '<?php echo base_url() . "index.php/gaji/simpan_komp_gaji" ?>',

				dataType: 'json',
				success: function(hasil) {
					// console.log(hasil);
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					alert('Berhasil di Simpan');
					location.reload();
				}

			});
		}

		function ubahdata() {
			var noinduk = $('[name=noindukh]').val();
			var gp = $('[name=gp]').val();
			var tjab = $('[name=tjab]').val();
			var t3m = $('[name=t3m]').val();
			var t3e = $('[name=t3e]').val();

			$.ajax({
				type: 'POST',
				data: 'noinduk=' + noinduk + '&gp=' + gp + '&tjab=' + tjab + '&t3m=' + t3m + '&t3e=&' + t3e,
				url: '<?php echo base_url() . "index.php/gaji/update_komp_gaji" ?>',

				dataType: 'json',
				success: function(hasil) {

					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					alert('Berhasil di Update');
					location.reload();
				}

			});
		}

		$('#noinduk').on('keyup', function() {
			var x = $(this).val();
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/gaji/cekkompgaji' ?>',
				data: 'id=' + x,

				success: function(data) {
					$('#target1').html(data);
				}
			})
		});
	</script>
</body>

</html><!-- page content -->