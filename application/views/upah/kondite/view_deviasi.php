<?php
ini_set('display_errors', 1);
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>

</head>

<body>
	<div class="pesan"></div>
	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Seksi</td>
				<td>Pabrik</td>
				<td>Deviasi</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($data as $d) {
				$noinduk = $d['noinduk'];
				echo "<tr>";
				echo "<td>" . $noinduk . "</td>";
				echo "<td>" . $d['nama'] . "</td>";
				echo "<td>" . $d['seksi'] . "</td>";
				echo "<td>" . $d['pabrik'] . "</td>";
				echo "<td>" . $d['deviasi'] . "</td>";
				echo "<td> <a href='#formku' data-toggle='modal' class='btn btn-warning' style='border-radius:50px' onclick=submit('$d[noinduk],$d[tahun],$d[deviasi]')>UBAH</a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<div class="modal fade" id="formku" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h2 class="panel-title">Edit Deviasi</h2>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<tr>
								<td>No Induk</td>
								<td><input type="text" name="noinduk" readonly>
									<input type="hidden" name="tahun" value="">
								</td>
							</tr>
							<tr>

							<tr>
								<td>Deviasi</td>
								<td><input type="text" name="deviasi"></td>
							</tr>

							<tr>
								<td>
									<input type="button" class="btn btn-primary" value="Ubah" onclick="ubahdata()">
									<input type="button" data-dismiss="modal" value="batal" class="btn btn-primary">
								</td>
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
		$('document').ready(function() {

			$('#table1').dataTable({
				responsive: true
			});
		})

		function submit(x) {

			$.ajax({
				type: 'POST',
				data: 'id=' + x,
				url: '<?php echo base_url() . "index.php/kondite/ambiliddev" ?>',
				dataType: 'json',
				success: function(hasil) {
					$('[name=noinduk]').val(hasil.noinduk);
					$('[name=deviasi]').val(hasil.deviasi);
					$('[name=tahun]').val(hasil.tahun);
				}
			});
		}

		function ubahdata() {
			var noinduk = $('[name=noinduk]').val();
			var tahun = $('[name=tahun]').val();
			var deviasi = $('[name=deviasi]').val();

			$.ajax({
				type: "POST",
				url: '<?php echo base_url() . "index.php/kondite/update_deviasi" ?>',
				dataType: 'json',
				data: 'noinduk=' + noinduk + '&tahun=' + tahun + '&deviasi=' + deviasi,
				success: function(data) {
					//menghilangkan modal dengan paksa
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					alert('Data berhasil diupdate!!!');
					loadData();

				}
			})
		}

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/kondite/ambil_deviasi' ?>',
				data: {

					tahun: $('[name=tahun]').val()
				},
				success: function(data) {
					$('#hasil').html(data);
				}
			})
		}
	</script>
</body>

</html>