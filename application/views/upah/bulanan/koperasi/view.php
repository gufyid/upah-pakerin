<!DOCTYPE html>
<html>

<head>
	<title></title>
	<!-- 	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>	
 -->
</head>

<body>

	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<td>No Koperasi</td>
				<td>Nama</td>
				<td>Bulan</td>
				<td>Tahun</td>
				<td>Jum Pinjaman</td>
				<td>Cicilan ke:</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($data as $d) {
				$nama = $this->db->query("select nama from t_karyawan where nokop='" . $d['noac'] . "'")->result_array();
				echo "<tr>";
				echo "<td>" . $d['noac'] . "</td>";
				echo "<td>";
				if (isset($nama[0]['nama'])) {
					echo $nama[0]['nama'];
				} else {
					echo "-";
				}
				echo "</td>";
				echo "<td>" . $d['bulan'] . "</td>";
				echo "<td>" . $d['tahun'] . "</td>";
				echo "<td>" . number_format($d['jumkoperasi']) . "</td>";
				echo "<td>" . $d['cicilan'] . "</td>";
				echo "<td> <a href='#modal' data-toggle='modal' class='btn btn-primary' style='border-radius:50px' onclick=submit('$d[noac],$d[bulan],$d[tahun]')>EDIT</a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<div class="modal fade" id="modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h2 class="panel-title">Edit Data Koperasi</h2>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<tr>
								<td>No AC</td>
								<td><input type="text" name="noac" id="noac" placeholder="No Koperasi">
								</td>
							</tr>
							<tr>
								<td>Bulan</td>
								<td><input type="text" name="bulan" id="bulan" placeholder="Bulan"></td>
							</tr>
							<tr>
								<td>Tahun</td>
								<td><input type="text" name="tahun" id="tahun" placeholder="Tahun"></td>
							</tr>
							<tr>
								<td>Koperasi</td>
								<td><input type="text" name="koperasi" id="koperasi" placeholder="Koperasi"></td>
							</tr>

							<tr>
								<td>
									<input type="button" class="btn btn-primary" value="Ubah" style="border-radius:50px" onclick="ubahdata()">
									<input type="button" data-dismiss="modal" value="Tutup" class="btn btn-danger" style="border-radius:50px">
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
		$(document).ready(function() {
			$('#table1').dataTable({
				responsive: true
			});
		})

		function submit(x) {
			$.ajax({
				type: 'POST',
				data: 'id=' + x,
				url: '<?php echo base_url() . "index.php/bulanan/ambilidkop" ?>',
				dataType: 'json',
				success: function(hasil) {
					$('[name=noac]').val(hasil[0].noac);
					$('[name=bulan]').val(hasil[0].bulan);
					$('[name=tahun]').val(hasil[0].tahun);
					$('[name=koperasi]').val(hasil[0].jumkoperasi);
				}
			});
		}

		function ubahdata() {
			var noac = $('[name=noac]').val();
			var bulan = $('[name=bulan]').val();
			var tahun = $('[name=tahun]').val();
			var jumkop = $('[name=koperasi]').val();

			$.ajax({
				type: "POST",
				url: '<?php echo base_url() . "index.php/bulanan/update_koperasi_bulanan" ?>',
				dataType: 'json',
				data: 'noac=' + noac + '&bulan=' + bulan + '&tahun=' + tahun + '&jumkoperasi=' + jumkop,
				success: function(data) {
					//menghilangkan modal dengan paksa
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					Swal.fire("Good Job !!!", "Data berhasil diUpdate", "success");
					loadData();

				}
			})
		}

		function loadData() {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() . 'index.php/bulanan/ambil_koperasi_bulanan' ?>',
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