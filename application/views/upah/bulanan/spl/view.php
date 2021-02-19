<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/pindah.js"></script>

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
				echo "<td align='center'> <a href='#modal' data-toggle='modal' class='btn btn-primary' style='border-radius:50px' onclick=submit('$d[noinduk],$bulan,$tahun,$proyek,$status')>Input SPL</a></td>";
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
						<h2 class="panel-title">Input Data SPL</h2>
					</div>
					<div class="panel-body">
						<div class="container">
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">1</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">2</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">3</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">4</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">5</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">6</label>
							</div>
							<div class="row">
								<div class="col-lg-1">
									<input type="text" name="1" class="form-control" autocomplete="off">
									<input type="hidden" name="noinduk" value="">
									<input type="hidden" name="bulan" value="">
									<input type="hidden" name="tahun" value="">
								</div>
								<div class="col-lg-1"><input type="text" name="2" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="3" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="4" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="5" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="6" class="form-control" autocomplete="off"></div>
							</div>
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">7</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">8</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">9</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">10</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">11</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">12</label>
							</div>
							<div class="row">
								<div class="col-lg-1"><input type="text" name="7" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="8" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="9" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="10" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="11" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="12" class="form-control" autocomplete="off"></div>
							</div>
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">13</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">14</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">15</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">16</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">17</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">18</label>
							</div>
							<div class="row">
								<div class="col-lg-1"><input type="text" name="13" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="14" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="15" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="16" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="17" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="18" class="form-control" autocomplete="off"></div>
							</div>
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">19</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">20</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">21</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">22</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">23</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">24</label>
							</div>
							<div class="row">
								<div class="col-lg-1"><input type="text" name="19" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="20" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="21" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="22" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="23" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="24" class="form-control" autocomplete="off"></div>
							</div>
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">25</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">26</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">27</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">28</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">29</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">30</label>
							</div>
							<div class="row">
								<div class="col-lg-1"><input type="text" name="25" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="26" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="27" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="28" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="29" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="30" class="form-control" autocomplete="off"></div>
							</div>
							<div class="row">
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">31</label>
								<label class="col-sm-1 control-label no-padding-right" for="form-field-2" style="text-align:center">LT</label>

							</div>
							<div class="row">
								<div class="col-lg-1"><input type="text" name="31" class="form-control" autocomplete="off"></div>
								<div class="col-lg-1"><input type="text" name="lt" readonly class="form-control"></div>
							</div>
							&nbsp;
							<div class="row">
								<div class="col-lg-1"><input type="button" name="simpan" id="simpan" class="btn btn-primary" style="border-radius:50px" value="Simpan"></div>
								<div class="col-lg-1"><input type="button" data-dismiss="modal" name="simpan" class="btn btn-danger" style="border-radius:50px" value="Batal"></div>
							</div>
							<div class="clearfix"></div>
							&nbsp;
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

			$('#simpan').click(function() {
				var noinduk = $('[name=noinduk]').val();
				var bulan = $('[name=bulan]').val();
				var tahun = $('[name=tahun]').val();
				var proyek = $('[name=proyek]').val();
				var seksi = $('[name=seksi]').val();
				var status = $('input:radio[name=status]:checked').val();
				var tgl1 = $('[name=1]').val();
				var tgl2 = $('[name=2]').val();
				var tgl3 = $('[name=3]').val();
				var tgl4 = $('[name=4]').val();
				var tgl5 = $('[name=5]').val();
				var tgl6 = $('[name=6]').val();
				var tgl7 = $('[name=7]').val();
				var tgl8 = $('[name=8]').val();
				var tgl9 = $('[name=9]').val();
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
					url: '<?php echo base_url() . "index.php/bulanan/simpan_spl" ?>',
					dataType: 'json',
					data: 'noinduk=' + noinduk + '&bulan=' + bulan + '&tahun=' + tahun + '&tgl1=' + tgl1 + '&tgl2=' + tgl2 + '&tgl3=' + tgl3 + '&tgl4=' + tgl4 + '&tgl5=' + tgl5 + '&tgl6=' + tgl6 + '&tgl7=' + tgl7 + '&tgl8=' + tgl8 + '&tgl9=' + tgl9 + '&tgl10=' + tgl10 + '&tgl11=' + tgl11 + '&tgl12=' + tgl12 + '&tgl13=' + tgl13 + '&tgl14=' + tgl14 + '&tgl15=' + tgl15 + '&tgl16=' + tgl16 + '&tgl17=' + tgl17 + '&tgl18=' + tgl18 + '&tgl19=' + tgl19 + '&tgl20=' + tgl20 + '&tgl21=' + tgl21 + '&tgl22=' + tgl22 + '&tgl23=' + tgl23 + '&tgl24=' + tgl24 + '&tgl25=' + tgl25 + '&tgl26=' + tgl26 + '&tgl27=' + tgl27 + '&tgl28=' + tgl28 + '&tgl29=' + tgl29 + '&tgl30=' + tgl30 + '&tgl31=' + tgl31 + '&proyek=' + proyek + '&seksi=' + seksi + '&status=' + status,
					success: function(data) {
						$(".modal").removeClass("in");
						$(".modal-backdrop").remove();
						$('body').removeClass('modal-open');
						$('body').css('padding-right', '');
						$(".modal").hide();
						Swal.fire("Good Job", "Data Berhasil disimpan/diudate", "success")
						reload();
						//window.location.reload();
					}
				});
			});

		})

		function submit(x) {

			var induk = x.split(",", 1);
			$('[name=noinduk]').val(induk);
			bersih();
			$.ajax({
				type: 'POST',
				data: 'id=' + x,
				url: '<?php echo base_url() . "index.php/bulanan/ambilidspl" ?>',
				dataType: 'json',
				success: function(hasil) {
					//	$('[name=bulan]').val(hasil[0].bulan);
					//	$('[name=tahun]').val(hasil[0].tahun);				
					$('[name=1]').val(hasil[0].tgl1);
					$('[name=2]').val(hasil[0].tgl2);
					$('[name=3]').val(hasil[0].tgl3);
					$('[name=4]').val(hasil[0].tgl4);
					$('[name=5]').val(hasil[0].tgl5);
					$('[name=6]').val(hasil[0].tgl6);
					$('[name=7]').val(hasil[0].tgl7);
					$('[name=8]').val(hasil[0].tgl8);
					$('[name=9]').val(hasil[0].tgl9);
					$('[name=10]').val(hasil[0].tgl10);
					$('[name=11]').val(hasil[0].tgl11);
					$('[name=12]').val(hasil[0].tgl12);
					$('[name=13]').val(hasil[0].tgl13);
					$('[name=14]').val(hasil[0].tgl14);
					$('[name=15]').val(hasil[0].tgl15);
					$('[name=16]').val(hasil[0].tgl16);
					$('[name=17]').val(hasil[0].tgl17);
					$('[name=18]').val(hasil[0].tgl18);
					$('[name=19]').val(hasil[0].tgl19);
					$('[name=20]').val(hasil[0].tgl20);
					$('[name=21]').val(hasil[0].tgl21);
					$('[name=22]').val(hasil[0].tgl22);
					$('[name=23]').val(hasil[0].tgl23);
					$('[name=24]').val(hasil[0].tgl24);
					$('[name=25]').val(hasil[0].tgl25);
					$('[name=26]').val(hasil[0].tgl26);
					$('[name=27]').val(hasil[0].tgl27);
					$('[name=28]').val(hasil[0].tgl28);
					$('[name=29]').val(hasil[0].tgl29);
					$('[name=30]').val(hasil[0].tgl30);
					$('[name=31]').val(hasil[0].tgl31);
					//$('[name=lt]').val(hasil[0].jumlt);
				}

			});
			ambillt();
		}

		function bersih() {
			$('[name=1]').val('');
			$('[name=2]').val('');
			$('[name=3]').val('');
			$('[name=4]').val('');
			$('[name=5]').val('');
			$('[name=6]').val('');
			$('[name=7]').val('');
			$('[name=8]').val('');
			$('[name=9]').val('');
			$('[name=10]').val('');
			$('[name=11]').val('');
			$('[name=12]').val('');
			$('[name=13]').val('');
			$('[name=14]').val('');
			$('[name=15]').val('');
			$('[name=16]').val('');
			$('[name=17]').val('');
			$('[name=18]').val('');
			$('[name=19]').val('');
			$('[name=20]').val('');
			$('[name=21]').val('');
			$('[name=22]').val('');
			$('[name=23]').val('');
			$('[name=24]').val('');
			$('[name=25]').val('');
			$('[name=26]').val('');
			$('[name=27]').val('');
			$('[name=28]').val('');
			$('[name=29]').val('');
			$('[name=30]').val('');
			$('[name=31]').val('');
		}

		function reload() {

			$.ajax({
				type: "POST",
				data: {
					seksi: $('[name=seksi]').val(),
					bulan: $('[name=bulan]').val(),
					tahun: $('[name=tahun]').val(),
					proyek: $('[name=proyek]').val(),
					status: $('[name=status]').val()
				},
				url: "<?php echo base_url() . 'index.php/bulanan/ambil_karyawan_seksi' ?>",

				success: function(hasil) {
					$('#target').html(hasil);
				}
			});

		}

		function ambillt() {
			$.ajax({
				type: "POST",
				data: {
					noinduk: $('[name=noinduk]').val(),
					bulan: $('[name=bulan]').val(),
					tahun: $('[name=tahun]').val(),
				},
				url: "<?php echo base_url() . 'index.php/bulanan/ambillt' ?>",
				dataType: "json",
				success: function(data) {
					$('[name=lt]').val(data[0].jumlt);
					//console.log(hasil);
				}
			});

		}
	</script>
</body>

</html>