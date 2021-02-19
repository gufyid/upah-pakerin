<?php error_reporting(0); ?>
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

			/*tr { height: 10px }*/

		}

		td {
			text-align: right;
			padding-right: 5px;
			padding-left: 5px
		}

		th {
			text-align: center;
		}

		.scroll {
			width: 100%;
			/*  background: orange;*/
			padding: 10px;
			/* overflow: scroll;*/
			overflow-x: scroll;
			/*  height: 300px;*/

			/*script tambahan khusus untuk IE */
			scrollbar-face-color: #CE7E00;
			scrollbar-shadow-color: #FFFFFF;
			scrollbar-highlight-color: #6F4709;
			scrollbar-3dlight-color: #11111;
			scrollbar-darkshadow-color: #6F4709;
			scrollbar-track-color: #FFE8C1;
			scrollbar-arrow-color: #6F4709;
		}
	</style>

</head>

<body>
	<?php
	$jumdata	= count($arraytgl);
	//echo $jumdata;
	if ($status == "T") {
		$status1 = "TETAP";
	} elseif ($status == "K") {
		$status1 = "KONTRAK";
	} elseif ($status == "H") {
		$status1 = "HONOR";
	} else {
		$status1 = "MAGANG";
	}
	$proyek = $this->db->query("select * from t_proyek where id='$proyek'")->row();
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

	if ($susulan == '0') {
		$susulan1 = '';
	} else if ($susulan == '1') {
		$susulan1 = 'SUSULAN';
	}

	$nmseksi = $this->db->query("select nama from t_seksi where kode='$seksi'")->result_array();
	$nmseksi = $nmseksi[0]['nama'];
	?>
	<div role="main">
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-5">
			</div>
			<div class="col-md-1">
				<a href="#" class="cetak"><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;
				<a href="<?php echo base_url() ?>./index.php/mingguan/lap_rekap_spl_excell/<?php echo $periode_awal ?>/<?php echo $periode_akhir ?>/<?php echo $status ?>/<?php echo $seksi ?>/<?php echo $susulan ?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 center">
				<h4>DAFTAR LEMBUR <?php echo $susulan1 ?> KARYAWAN MINGGUAN <?php echo $status1 ?> <br />
					PT. <?php echo $pabrik ?></h4>
			</div>
			<div class="col-xs-12">
				BAGIAN :
			</div>
			<div class="col-xs-12">
				SEKSI : <?php echo $nmseksi ?>
			</div>
			<div class="col-xs-12">
				PEPRIODE : <?php echo date('d M Y', strtotime($periode_awal)) . ' s/d ' . date('d M Y', strtotime($periode_akhir)) ?>
			</div>

			<div class="col-xs-12">
				<div class="scroll" id="scroll">
					<table class="display" border="1" style="width:100%">
						<thead>
							<tr>
								<th rowspan="2" tyle="text-align:center;">NO</th>
								<th rowspan="2" tyle="text-align:center;">NAMA</th>
								<th style="text-align:center" colspan="<?php echo $jumdata; ?>">TANGGAL</th>
								<th rowspan="2">JAM</th>
								<th rowspan="2">L/JAM</th>
								<th rowspan="2">JUMLAH</th>
							</tr>
							<tr>
								<?php
								foreach ($arraytgl as $tgl) {
									echo "<th>" . $tgl . "</th>";
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
							$totjam = '';
							$totjum = '';

							$no = 0;
							foreach ($data as $d) {
								$jumjam = '';
								$no++;
								$noinduk = $d['noinduk'];
								$nm = $this->db->query("select nama,bagian,seksi from t_karyawan where noinduk='$noinduk'")->result_array();
							?>
								<tr>
									<td><?php echo $no; ?></td>
									<td style="text-align:left"><?php echo $nm[0]['nama']; ?></td>

									<?php
									foreach ($arraytgl as $x) {
										if (substr($x, 0, 1) == '0') {
											$x = substr($x, 1, 1);
										} else {
											$x = $x;
										}
										$tgl = $d['tgl' . $x];
										echo "<td>";
										if ($tgl != 0) {
											echo number_format($tgl, 1);
										}
										echo "</td>";
										$jumjam += $tgl;
									}

									?>

									<td>
										<?php
										echo number_format($jumjam, 1);
										?>
									</td>
									<td>
										<?php
										echo number_format($d['l_jam'], 1);
										?>
									</td>
									<td>
										<?php
										echo number_format(ceil(($d['l_jam'] * $jumjam)), 1);
										?>
									</td>
								</tr>
							<?php
								$totjam += $jumjam;
								$totjum += ($d['l_jam'] * $jumjam);
							}

							?>
							<!-- <tr>
					 	<td colspan="16" style="text-align: right;">Jumlah Rp.</td>
						<td><?php if ($totjam) {
								echo number_format($totjam);
							} ?></td>
						<td>-</td>
						<td><?php if ($totjum) {
								echo number_format($totjum);
							} ?></td>
					</tr> -->
						</tbody>
						<tfoot>
							<tr>
								<?php if ($data) { ?>
									<td colspan="13" style="text-align: center;"><?= $proyek->nama ?></td>
									<td colspan="3" style="text-align: right;">Jumlah</td>
									<td><?php if ($totjam) {
											echo number_format($totjam, 1);
										} ?></td>
									<td>-</td>
									<td><?php if ($totjum) {
											echo number_format($totjum, 1);
										} ?></td>
								<?php } ?>
							</tr>
						</tfoot>
					</table>
					<div class="col-xs-5 right">,</div>
					<div class="col-xs-4 right"></div>
					<div class="col-xs-3 right">Bangun, <?php echo date('d M Y'); ?></div>
					<div class="row">
						<div class="col-xs-3 ">DiBukukan,</div>
						<div class="col-xs-3 ">Disetujui,</div>
						<div class="col-xs-3 ">Diperiksa,</div>
						<div class="col-xs-2">Dibuat,</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
			$('document').ready(function() {

				$('#table1').dataTable({
					responsive: true,
					"scrollX": true,
					buttons: [
						'print'
					]
				});

				$(".cetak").click(function() {
					$("div").removeClass("scroll");
					window.print();
					loadData();
				})


			})
		</script>
</body>

</html>