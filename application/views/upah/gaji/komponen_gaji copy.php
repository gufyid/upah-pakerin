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

				<?php echo $this->session->flashdata('pesan'); ?>

			</div>
			<div class="clearfix">
				<!--<a href="#frmgaji" data-toggle="modal" class="btn btn-primary" onclick="submit('tambah')">TAMBAH KOMPONEN GAJI</a>
		<div class="pull-right "><i>&nbsp;</i></div>-->
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

									<?php
									$no = 0;
									foreach ($kompgaji as $d) :
										$no++;
										$noinduk = $d['noinduk'];
										$nama = $this->db->query("select nama from t_karyawan where noinduk = '$noinduk'")->result_array();
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $d['noinduk']; ?></td>
											<td><?php echo $nama[0]['nama']; ?></td>
											<td><?php echo number_format($d['gp']); ?></td>
											<td><?php echo number_format($d['tjab']); ?></td>
											<td><?php echo number_format($d['t3e']); ?></td>
											<td><?php echo number_format($d['t3m']); ?></td>

											<td>
												<a href="#frmgaji" data-toggle="modal" class="btn btn-primary" onclick="submit(<?php echo $d['noinduk'] ?>)">Ubah</a>
												<!--
								<center><a href="<?php echo base_url() . "index.php/utama/barang_edit/barang_edit/" . $d['kode']; ?>/0"><i class="ace-icon fa fa-edit ">&nbsp; Edit </i></a>&nbsp;</center>
								
								|&nbsp;
								<a href="<?php echo base_url() . "index.php/utama/hapus_barang/" . $d['kode']; ?>" onclick="javascript: return confirm('Anda yakin ingin menghapus barang ini ?')"><i class="ace-icon fa fa-trash ">&nbsp; Hapus </i></a>
								-->
											</td>
										</tr>
									<?php
									endforeach
									?>

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
												<td>Karyawan</td>
												<td>
													<input type="text" name="nama" id="nama" placeholder="Nama Kayawan">
													<input type="hidden" name="noinduk" id="noinduk">
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
													<input type="button" id="btn-tambah" onclick="tambahdata()" class="btn btn-primary" value="SIMPAN">
													<input type="button" id="btn-ubah" onclick="ubahdata()" class="btn btn-primary" value="UBAH">
												</td>
												<td>
													<input type="button" data-dismiss="modal" class="btn btn-warning" value="BATAL">
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
			if (x == 'tambah') {
				$('#btn-tambah').show();
				$('#btn-ubah').hide();
			} else {
				$('#btn-tambah').hide();
				$('#btn-ubah').show();
			}

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . "index.php/gaji/datagaji" ?>',
				data: 'id=' + x,
				dataType: 'json',
				success: function(data) {
					$('[name=nama]').val(data[0].nama);
					$('[name=noinduk]').val(data[0].noinduk);
					$('[name=gp]').val(data[0].gp);
					$('[name=tjab]').val(data[0].tjab);
					$('[name=t3m]').val(data[0].t3m);
					$('[name=t3e]').val(data[0].t3e);

				}
			});

		}

		function ubahdata() {

			var noinduk = $('[name=noinduk]').val();
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
					alert('Berhasil di update');
					location.reload();
				}

			});
		}
	</script>
</body>

</html><!-- page content -->