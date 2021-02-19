<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<!--<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>	 -->

</head>

<body>

	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($data as $d) {
				$noinduk = $d['noinduk'];
				echo "<tr>";
				echo "<td>" . $d['noinduk'] . "</td>";
				echo "<td>" . $d['nama'] . "</td>";
				echo "<td align='center'> <a href='#modal' data-toggle='modal' style='border-radius:50px' class='btn btn-primary' onclick=submit('$noinduk,$periode_awal,$periode_akhir,$komponen')>Input Adjustment</a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

	<div class="modal fade" id="modal" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h2 class="panel-title">Input Adjustment</h2>
					</div>
					<div class="panel-body">
						<table class="table" id="table3">
							<tr>
								<td>Adjustment</td>
								<td>
									<input type="text" name="adjustment" class="form-control" width='50%'>
									<input type="hidden" name="noinduk">
									<input type="hidden" name="komponen">
									<input type="hidden" name="periode_awal">
									<input type="hidden" name="periode_akhir">
								</td>
							</tr>
							<tr>
								<td><input type="submit" name="proses" style="border-radius:50px" onclick="simpan()" value="Simpan" class=" btn btn-primary form-control"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$('#table1,#table2,#table3').dataTable({
				responsive: true
			});


		})

		function submit(x) {
			$.ajax({
				type: 'POST',
				data: 'y=' + x,
				url: '<?php echo base_url() . "index.php/mingguan/pecahdata" ?>',
				dataType: 'json',
				success: function(data) {

					$('[name=noinduk]').val(data.noinduk);
					$('[name=periode_awal]').val(data.periode_awal);
					$('[name=periode_akhir]').val(data.periode_akhir);
					ambiladjustment(x);
				}
			});
		}

		function ambiladjustment(x) {

			$.ajax({
				type: 'POST',
				data: 'z=' + x,
				url: '<?php echo base_url() . "index.php/mingguan/ambiladjustment" ?>',
				dataType: 'json',
				success: function(hasil) {

					if (hasil.length > 0) {
						$('[name=adjustment]').val(hasil[0].adjustment);

					} else {
						$('[name=adjustment]').val('');

					}

				}
			});
		}


		function simpan() {

			var noinduk = $('[name=noinduk]').val();
			var komponen = $('[name=komponen]').val();
			var periode_awal = $('[name=periode_awal]').val();
			var periode_akhir = $('[name=periode_akhir]').val();
			var adjustment = $('[name=adjustment]').val();

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . "index.php/mingguan/simpan_adjustment" ?>',
				dataType: 'json',
				data: 'noinduk=' + noinduk + '&periode_awal=' + periode_awal + '&periode_akhir=' + periode_akhir + '&adjustment=' + adjustment + '&komponen=' + komponen,
				success: function(data) {
					//menghilangkan modal dengan paksa
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					reload();
					alert('Data berhasil disimpan..')
					//window.location.reload();
				}
			});
		}

		function reload() {

			$.ajax({
				type: "POST",
				data: {
					seksi: $('[name=seksi]').val(),
					komponen: $('[name=komponen]').val(),
					periode_awal: $('[name=periode_awal]').val(),
					periode_akhir: $('[name=periode_akhir]').val(),
				},
				url: "<?php echo base_url() . 'index.php/mingguan/ambil_karyawan_seksi_adjustment' ?>",

				success: function(hasil) {
					$('#target').html(hasil);
					/* bulan	  = $('[name=bulan]').val('');
					 tahun 	  = $('[name=tahun]').val('');
					 seksi	  = $('[name=seksi]').val('');		*/
				}
			});

		}
	</script>
</body>

</html>