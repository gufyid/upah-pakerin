<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
	<style type="text/css">
		.modal-dialog {
			width: 70%;
		}
	</style>
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
				echo "<tr>";
				echo "<td>" . $d['noinduk'] . "</td>";
				echo "<td>" . $d['nama'] . "</td>";
				echo "<td align='center'> <a href='#modal' data-toggle='modal'  class='btn btn-primary' style='border-radius:50px' onclick=submit('$d[noinduk],$periode_awal,$periode_akhir,$status')>Input SPL</a></td>";
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
						<h2 class="panel-title">Input Data Lembur / SPL </h2>
					</div>
					<div class="panel-body">
						<table class="table table-striped" id="table2">
							<tbody id="targettbl"></tbody>
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
			$('#table1,#table2').dataTable({
				responsive: true
			});


		})

		function submit(x) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . "index.php/mingguan/hitung_tgl" ?>',
				data: 'id=' + x,
				dataType: 'json',
				success: function(data) {
					//console.log(data);
					var periode_akhir = data.periode_akhir;
					var periode_awal = data.periode_awal;
					var noinduk = data.noinduk;
					var jumdata = data.arraytgl.length;
					var baris = '';
					baris += '<tr>';
					//			$('#targettbl').html(data);
					$.each(data.arraytgl, function(index, value) {
						baris += '<td>' + value + '</td>';
					});
					baris += '</tr>';
					baris += '<tr>';
					$.each(data.arraytgl, function(index, value) {
						var y = index + 1;
						baris += '<td><input type="text" class="form-control" size="2" name=' + value + '></td>';
					});

					baris += '</tr>';
					baris += '<tr>';
					baris += '<td><input type="hidden" name="noinduk" value=' + noinduk + '></td>';
					baris += '<td><input type="hidden" name="periode_awal" value=' + periode_awal + '></td>';
					baris += '<td><input type="hidden" name="periode_akhir" value=' + periode_akhir + '></td>';
					baris += '</tr>';
					baris += '<tr>';
					baris += '<td colspan="14"><input type="button" class="btn btn-primary" value="Simpan" style="border-radius:50px" onclick="simpan()">&nbsp;<input type="button" data-dismiss="modal" class="btn btn-danger" value="Batal" style="border-radius:50px"></td>';
					baris += '</tr>';

					$('#targettbl').html(baris);

					ambilspl(x);
				}
			});


		}

		function ambilspl(x) {
			$.ajax({
				type: 'POST',
				data: 'y=' + x,
				url: '<?php echo base_url() . "index.php/mingguan/ambilidspl" ?>',
				dataType: 'json',
				success: function(data) {

					$('[name=01]').val(data[0].tgl1);
					$('[name=02]').val(data[0].tgl2);
					$('[name=03]').val(data[0].tgl3);
					$('[name=04]').val(data[0].tgl4);
					$('[name=05]').val(data[0].tgl5);
					$('[name=06]').val(data[0].tgl6);
					$('[name=07]').val(data[0].tgl7);
					$('[name=08]').val(data[0].tgl8);
					$('[name=09]').val(data[0].tgl9);
					$('[name=10]').val(data[0].tgl10);
					$('[name=11]').val(data[0].tgl11);
					$('[name=12]').val(data[0].tgl12);
					$('[name=13]').val(data[0].tgl13);
					$('[name=14]').val(data[0].tgl14);
					$('[name=15]').val(data[0].tgl15);
					$('[name=16]').val(data[0].tgl16);
					$('[name=17]').val(data[0].tgl17);
					$('[name=18]').val(data[0].tgl18);
					$('[name=19]').val(data[0].tgl19);
					$('[name=20]').val(data[0].tgl20);
					$('[name=21]').val(data[0].tgl21);
					$('[name=22]').val(data[0].tgl22);
					$('[name=23]').val(data[0].tgl23);
					$('[name=24]').val(data[0].tgl24);
					$('[name=25]').val(data[0].tgl25);
					$('[name=26]').val(data[0].tgl26);
					$('[name=27]').val(data[0].tgl27);
					$('[name=28]').val(data[0].tgl28);
					$('[name=29]').val(data[0].tgl29);
					$('[name=30]').val(data[0].tgl30);
					$('[name=31]').val(data[0].tgl31);
				}
			});
		}

		function simpan() {
			var noinduk = $('[name=noinduk]').val();
			var periode_awal = $('[name=periode_awal]').val();
			var periode_akhir = $('[name=periode_akhir]').val();
			var status = $('input:radio[name=status]:checked').val();
			var proyek = $('[name=proyek]').val();
			var tgl1 = $('[name=01]').val();
			var tgl2 = $('[name=02]').val();
			var tgl3 = $('[name=03]').val();
			var tgl4 = $('[name=04]').val();
			var tgl5 = $('[name=05]').val();
			var tgl6 = $('[name=06]').val();
			var tgl7 = $('[name=07]').val();
			var tgl8 = $('[name=08]').val();
			var tgl9 = $('[name=09]').val();
			var tgl10 = $('[name=10]').val();
			var tgl11 = $('[name=11]').val();
			var tgl12 = $('[name=12]').val();
			var tgl13 = $('[name=13]').val();
			var tgl14 = $('[name=14]').val();
			var tgl15 = $('[name=15]').val();
			var tgl16 = $('[name=16]').val();
			var tgl17 = $('[name=17]').val();
			var tgl18 = $('[name=18]').val();
			var tgl19 = $('[name=19]').val();
			var tgl20 = $('[name=20]').val();
			var tgl21 = $('[name=21]').val();
			var tgl22 = $('[name=22]').val();
			var tgl23 = $('[name=23]').val();
			var tgl24 = $('[name=24]').val();
			var tgl25 = $('[name=25]').val();
			var tgl26 = $('[name=26]').val();
			var tgl27 = $('[name=27]').val();
			var tgl28 = $('[name=28]').val();
			var tgl29 = $('[name=29]').val();
			var tgl30 = $('[name=30]').val();
			var tgl31 = $('[name=31]').val();

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . "index.php/mingguan/simpan_spl" ?>',
				dataType: 'json',
				data: 'noinduk=' + noinduk + '&periode_awal=' + periode_awal + '&periode_akhir=' + periode_akhir + '&proyek=' + proyek + '&status=' + status + '&tgl1=' + tgl1 + '&tgl2=' + tgl2 + '&tgl3=' + tgl3 + '&tgl4=' + tgl4 + '&tgl5=' + tgl5 + '&tgl6=' + tgl6 + '&tgl7=' + tgl7 + '&tgl8=' + tgl8 + '&tgl9=' + tgl9 + '&tgl10=' + tgl10 + '&tgl11=' + tgl11 + '&tgl12=' + tgl12 + '&tgl13=' + tgl13 + '&tgl14=' + tgl14 + '&tgl15=' + tgl15 + '&tgl16=' + tgl16 + '&tgl17=' + tgl17 + '&tgl18=' + tgl18 + '&tgl19=' + tgl19 + '&tgl20=' + tgl20 + '&tgl21=' + tgl21 + '&tgl22=' + tgl22 + '&tgl23=' + tgl23 + '&tgl24=' + tgl24 + '&tgl25=' + tgl25 + '&tgl26=' + tgl26 + '&tgl27=' + tgl27 + '&tgl28=' + tgl28 + '&tgl29=' + tgl29 + '&tgl30=' + tgl30 + '&tgl31=' + tgl31,
				success: function(data) {
					$(".modal").removeClass("in");
					$(".modal-backdrop").remove();
					$('body').removeClass('modal-open');
					$('body').css('padding-right', '');
					$(".modal").hide();
					reload();
					//window.location.reload();
				}
			});

			//	alert(noinduk+' '+periode_awal+' '+periode_akhir+' '+jumlah+' '+tgl1); 
		}

		function reload() {

			$.ajax({
				type: "POST",
				data: {
					seksi: $('[name=seksi]').val(),
					periode_awal: $('[name=periode_awal]').val(),
					periode_akhir: $('[name=periode_akhir]').val(),
					status: $('[name=status]').val()
					// $proyek: $('[name=proyek]').val()
				},
				url: "<?php echo base_url() . 'index.php/mingguan/ambil_karyawan_seksi' ?>",

				success: function(hasil) {
					$('#target').html(hasil);
				}
			});

		}
	</script>
</body>

</html>