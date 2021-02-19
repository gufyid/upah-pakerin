<!DOCTYPE html>
<html>

<head>
	<title></title>
	<!-- <script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>	 -->
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
	if ($status == "T") {
		$status = "TETAP";
	} elseif ($status == "K") {
		$status = "KONTRAK";
	} elseif ($status == "H") {
		$status = "HONOR";
	} else {
		$status = "MAGANG";
	}

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
				<a href="#" onclick=submit();><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;
				<a href="<?php echo base_url() ?>./index.php/bulanan/lap_rekap_lembur_excell/<?php echo $bulan ?>/<?php echo $tahun ?>/<?php echo $status ?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 center">
				REKAPITULASI UPAH LEMBUR BULANAN PT. <?php echo $pabrik ?> (<?php echo $status ?>)<br />
				BULAN : <?php echo $bul[$bulan] . " " . $tahun ?>

			</div>
			<div class="col-xs-12">
				<table class="display" border="1" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Seksi</th>
							<th>Jumlah</th>
							<th>SPL+LT/LT</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						$tot_jumlah = '';
						$tot_spllt = '';
						$tot_lt = '';
						if ($data) {
							foreach ($data as $d) {
								$no++;
								$spllt = $d['spl'] + $d['lt'];
								$kdseksi = $d['seksi'];
								$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
								echo "<tr>";
								echo "<td style='text-align:center'>" . $no . "</td>";
								echo "<td style='text-align:left'>";
								echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>" . number_format($d['lembur']) . "</td>";
								echo "<td>" . $spllt . "/" . $d['lt'] . "</td>";
								echo "</tr>";
								$tot_jumlah += $d['lembur'];
								$tot_spllt += $spllt;
								$tot_lt += $d['lt'];
							}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<?php if ($data) { ?>
								<td colspan="2" style="text-align:center">TOTAL</td>
								<td><?php echo number_format($tot_jumlah); ?></td>
								<td><?php echo number_format($tot_spllt) . "/" . number_format($tot_lt); ?></td>
							<?php } ?>
						</tr>
					</tfoot>
				</table>
				<div class="col-xs-2 right">,</div>
				<div class="col-xs-7 right"></div>
				<div class="col-xs-3 right">Bangun, <?php echo date('d M Y'); ?></div>
				<div class="row">
					<div class="col-xs-2 "></div>
					<div class="col-xs-2 ">Disetujui,</div>
					<div class="col-xs-5 ">Diperiksa,</div>
					<div class="col-xs-3 ">Dibuat,</div>
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

			function submit() {
				$('[name=tableku]').removeAttr('id');
				window.print();
			}
		</script>
</body>

</html>