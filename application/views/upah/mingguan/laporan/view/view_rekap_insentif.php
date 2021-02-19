<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style type="text/css">
		@media print {
			#cetak {
				display: none;
			}

			.non-printable {
				display: none;
			}

			.footer {
				display: none;
			}

			.breadcrumbs {
				display: none;
			}

			.printable {
				display: block;
			}

			#print {
				display: none;
			}

			#pesan {
				display: none;
			}

			a {
				display: none;
			}

			td {
				font-size: 10px;
			}

			th {
				font-size: 10px;
			}

			/*r { height: 10px }*/
		}

		td {
			text-align: right;
			padding-right: 5px;
			padding-left: 5px
		}

		th {
			text-align: center;
		}
	</style>

</head>

<body>
	<?php
	$bul = array(
		'1' => 'Januari',
		'2' => 'Februari',
		'3' => 'Maret',
		'4' => 'April',
		'5' => 'Mei',
		'6' => 'Juni',
		'7' => 'Juli',
		'8' => 'Agustus',
		'9' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember',
	);
	?>
	<div role="main">
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-5">
			</div>
			<div class="col-md-1">
				<a href="#" class="cetak"><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;
				<!--<a href="<?php echo base_url() ?>./index.php/mingguan/lap_rekap_lembur_excell/<?php echo $periode_awal ?>/<?php echo $periode_akhir ?>/<?php echo $status ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	  -->
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 center">
				<h4>INSENTIF OPERATOR & PENGAWAS OPERATOR ALAT BERAT PT. <?php echo $pabrik ?> <br />
					BULAN : <?php echo $bul[$bulan] . '  ' . $tahun ?></h4>
			</div>
			<div class="col-xs-12">
				<table border="1" height="400px" width="100%">
					<thead>
						<tr>
							<th colspan='2' style="text-align: left">SEKSI</th>

							<th>JUMLAH </th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = '';
						foreach ($data as $d) {
							echo "<tr>";
							echo "<td style='text-align:left'>" . $d['nama'] . "</td>";
							echo "<td>SUB TOTAL</td>";
							echo "<td>" . number_format($d['insentif']) . "</td>";
							echo "</tr>";
							// $no =0;
							// $tot_jumlah = '';
							// $tot_jam = '';
							// foreach($data as $d)
							// {
							// 	$no++;
							// 	$kdseksi = $d['seksi'];
							// 	$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							// 	echo "<tr>";
							// 		echo "<td style='text-align:center'>". $no ."</td>";
							// 		echo "<td style='text-align:left'>";
							// 		 	echo $seksi[0]['nama'];
							// 		echo "</td>";
							// 		echo "<td>". number_format($d['lembur']) ."</td>";
							// 		echo "<td>".number_format($d['jam'])."</td>";
							// 	echo "</tr>";
							// 	$tot_jumlah += $d['lembur'];
							$total += $d['insentif'];
						}
						echo "<tr>";
						echo "<td colspan='2' style='text-align:center'>TOTAL</td>";
						echo "<td style='text-align:center'> <b>" . number_format($total) . "</b></td>";
						echo "</tr>";

						?>
					</tbody>
					<tfoot>
						<tr>
							<!-- <?php if ($data) { ?>
						<td colspan="2" style="text-align:center">TOTAL</td>
						<td><?php echo number_format($tot_jumlah); ?></td>
						<td><?php echo number_format($tot_jam); ?></td>
						<?php } ?> -->
						</tr>
					</tfoot>
				</table>
				<!-- <div class="col-xs-5 right">,</div>
			<div class="col-xs-4 right"></div>
			<div class="col-xs-3 right">Bangun, <?php echo date('d M Y'); ?></div>
			<div class="row">
			<div class="col-xs-1 "></div>
			<div class="col-xs-3 ">Disetujui,</div>
			<div class="col-xs-5 ">Diperiksa,</div>
			<div class="col-xs-2 ">Dibuat,</div> -->
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

			$(".cetak").click(function() {
				window.print();
			})
		})
	</script>
</body>

</html>