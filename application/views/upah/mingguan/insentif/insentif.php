<!DOCTYPE html>
<html>

<head>
	<title></title>

	<style rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>./asset/css/bootstrap.min.css"></style>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>

</head>

<body>
	<div role="main">
		<div class="">
			<div class="page-title">


			</div>
			<div class="clearfix">
				<a href="#frmgaji" data-toggle="modal" class="btn btn-info" style="border-radius:50px" onclick="submit('tambah')">TAMBAH INSENTIF</a>
				<div class="pull-right "><i>&nbsp;</i></div>
			</div>
			<br />
			<div id="pesan"></div>
			<div class="table-header">
				INSENTIF MINGGUAN
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
										<th style="text-align: center;">NO INDUK</th>
										<th style="text-align: center;">NAMA</th>
										<th style="text-align: center;">SEKSI</th>
										<th style="text-align: center;">INSENTIF</th>

										<th width="20%" style="text-align: center;">Aksi</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$no = 0;
									foreach ($juminsentif as $d) {
										$no++;
									?>
										<tr>
											<td><?php echo $d['noinduk']; ?></td>
											<td><?php echo $d['nama']; ?></td>
											<td><?php echo $d['nmseksi']; ?></td>
											<td><?php echo number_format($d['insentif']); ?></td>

											<td class="text-center">
												<a href="#frmgaji" data-toggle="modal" class="btn btn-primary " style="border-radius:50px" onclick="submit(<?php echo $d['noinduk'] ?>)">Ubah</a>
											</td>
										</tr>
									<?php
									}
									?>

								</tbody>
							</table>
							<div class="modal fade" id="frmgaji" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="modal-title">
												<h1>Tambah Insentif</h1>
											</div>
										</div>
										<span id="target"></span>
										<table class="table table-striped">

											<tr>
												<td>Karyawan/No Induk</td>
												<td>
													<input type="text" name="nama" id="nama" readonly>
													<input type="text" name="noinduknew" id="noinduknew">
													<input type="hidden" name="noinduk" id="noinduk">
												</td>

											</tr>
											<tr>
												<td>INSENTIF</td>
												<td>
													<input type="text" name="insentif" id="insentif" placeholder="Insentif..">
												</td>
											</tr>
											<tr>
												<td>
													<input type="button" id="btn-tambah" onclick="tambahdata()" class="btn btn-primary" value="SIMPAN">
													<input type="button" id="btn-ubah" style="border-radius:50px" onclick="ubahdata()" class="btn btn-primary" value="UBAH">
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
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table1').dataTable({
				responsive: true
			});

			// $("#nama").on('keyup',function(){
			// 	var x = $(this).val();
			// 	$.ajax({
			// 		type :'post',
			// 		url : '<?php echo base_url() . 'index.php/gaji/ambilid' ?>',
			// 		data : 'id='+x,

			// 		success : function(data){
			// 			$('#target').html(data);
			// 		} 
			// 	})
			// })
			// $('[name=nama]').val('');

		})

		function submit(x) {

			if (x == 'tambah') {
				$('#btn-tambah').show();
				$('#btn-ubah').hide();
				$('#nama').hide();
				$('#nama').val('');
				$('#insentif').val('');
				$('#noinduknew').show();
				$('#noinduknew').focus();


			} else {
				$('#btn-tambah').hide();
				$('#btn-ubah').show();
				$('#nama').show();
				$('#noinduknew').hide();


				$.ajax({
					type: 'POST',
					url: '<?php echo base_url() . "index.php/mingguan/datainsentif" ?>',
					data: 'id=' + x,
					dataType: 'json',
					success: function(data) {

						$('[name=nama]').val(data[0].nama);
						$('[name=noinduk]').val(data[0].noinduk);
						$('[name=insentif]').val(data[0].insentif);
					}
				});
			}

		}

		function ubahdata() {

			var noinduk = $('[name=noinduk]').val();
			var insentif = $('[name=insentif]').val();

			$.ajax({
				type: 'POST',
				data: 'noinduk=' + noinduk + '&insentif=' + insentif,
				url: '<?php echo base_url() . "index.php/mingguan/update_insentif" ?>',

				dataType: 'json',
				success: function(hasil) {

					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					alert('Berhasil di update');

					location.reload();
				}

			});
		}

		function tambahdata() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . "index.php/mingguan/simpan_insentif" ?>',
				data: {
					noinduk: $('[name=noinduknew]').val(),
					insentif: $('[name=insentif]').val()
				},
				dataType: 'json',
				success: function(data) {
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					alert('Data berhasil disimpan');
					location.reload();
					//$('#pesan').html(data.pesan);


				}
			});
		}
	</script>
</body>

</html><!-- page content -->