<!DOCTYPE html>
<html>

<head>
	<title></title>

</head>

<body>

	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Bulan</td>
				<td>Tahun</td>
				<td>Jum Absen</td>
				<td>Jum Cuti</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($data as $d) {
				$nama = $this->db->query("select nama from t_karyawan where noinduk='" . $d['noinduk'] . "'")->result_array();
				echo "<tr>";
				echo "<td>" . $d['noinduk'] . "</td>";
				echo "<td>";
				if (isset($nama[0]['nama'])) {
					echo $nama[0]['nama'];
				} else {
					echo "-";
				}
				echo "</td>";
				echo "<td>" . $d['bulan'] . "</td>";
				echo "<td>" . $d['tahun'] . "</td>";
				echo "<td>" . $d['jum_absen'] . "</td>";
				echo "<td>" . $d['jum_cuti'] . "</td>";
				echo "<td> <a href='#formku' data-toggle='modal' class='btn btn-primary' style='border-radius:50px' onclick=submit('$d[noinduk],$d[bulan],$d[tahun]')>EDIT</a></td>";
				//echo "<td> <a href='#modal' data-toggle='modal' class='btn btn-primary' onclick=submit('$d[noinduk]')>EDIT</a></td>";
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
						<h2 class="panel-title">Edit Data Absensi</h2>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<tr>
								<td>No Induk</td>
								<td><input type="text" name="nama">
									<input type="hidden" name="noinduk" value="">
								</td>
							</tr>
							<tr>
								<td>Bulan</td>
								<td><input type="text" name="bulan"></td>
							</tr>
							<tr>
								<td>Tahun</td>
								<td><input type="text" name="tahun"></td>
							</tr>
							<tr>
								<td>Absen</td>
								<td><input type="text" name="absen"></td>
							</tr>
							<tr>
								<td>Cuti</td>
								<td><input type="text" name="cuti"></td>
							</tr>

							<tr>
								<td>
									<input type="button" class="btn btn-primary" style="border-radius:50px" value="Ubah" onclick="ubahdata()">
									<input type="button" data-dismiss="modal" style="border-radius:50px" value="Tutup" class="btn btn-danger">
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
				url: '<?php echo base_url() . "index.php/bulanan/ambilidabsen" ?>',
				dataType: 'json',
				success: function(hasil) {
					$('[name=nama]').val(hasil[0].noinduk);
					$('[name=bulan]').val(hasil[0].bulan);
					$('[name=tahun]').val(hasil[0].tahun);
					$('[name=absen]').val(hasil[0].jum_absen);
					$('[name=cuti]').val(hasil[0].jum_cuti);

				}
			});
		}

		function ubahdata() {
			var noinduk = $('[name=nama]').val();
			var bulan = $('[name=bulan]').val();
			var tahun = $('[name=tahun]').val();
			var jum_absen = $('[name=absen]').val();
			var jum_cuti = $('[name=cuti]').val();

			$.ajax({
				type: "POST",
				url: '<?php echo base_url() . "index.php/bulanan/update_absen_bulanan" ?>',
				dataType: 'json',
				data: 'noinduk=' + noinduk + '&bulan=' + bulan + '&tahun=' + tahun + '&jum_absen=' + jum_absen + '&jum_cuti=' + jum_cuti,
				success: function(data) {
					//menghilangkan modal dengan paksa
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					loadData();

				}
			})
		}

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/bulanan/ambil_absen_bulanan' ?>',
				data: {
					bulan: $('[name=bulan]').val(),
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