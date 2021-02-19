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
	// echo $status . " " . $bulan . " " . $tahun . " " . $pabrik . " " . $seksi . " " . $susulan . " " . $proyek;
	if ($status == "T") {
		$status = "TETAP";
	} elseif ($status == "K") {
		$status = "KONTRAK";
	} elseif ($status == "H") {
		$status = "HONOR";
	} else {
		$status = "MAGANG";
	}

	$proyek1 = $this->db->query("select * from t_proyek where id='$proyek'")->row();

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
	$nmseksi = $this->db->query("select nama from t_seksi where kode='$seksi'")->result_array();
	$seksi = $nmseksi[0]['nama'];
	?>
	<div role="main">
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-5">
			</div>
			<div class="col-md-1">
				<a href="#" class="cetak"><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;
				<a href="<?php echo base_url() ?>./index.php/bulanan/lap_rekap_spl_excell/<?php echo $bulan ?>/<?php echo $tahun ?>/<?php echo $status ?>/<?php echo $seksi ?>/<?php echo $proyek ?>/<?php echo $susulan ?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 center">
				<h4>DAFTAR UPAH LEMBUR KARYAWAN BULANAN (<?php echo $status ?>) <br />
					PT. <?php echo $pabrik ?></h4>
			</div>
			<div class="col-xs-12">
				BAGIAN :
			</div>
			<div class="col-xs-12">
				SEKSI : <?php echo $seksi ?>
			</div>
			<div class="col-xs-12">
				BULAN : <?php echo $bul[$bulan] . ' ' . $tahun ?>
			</div>

			<div class="col-xs-12">
				<div class="scroll" id="scroll">
					<table class="display" border="1" style="width:100%">
						<thead>
							<tr>
								<th rowspan="2" tyle="text-align:center;">NAMA</th>
								<th style="text-align:center" colspan="32">TANGGAL</th>
								<th rowspan="2">JAM</th>
								<th rowspan="2">L/JAM</th>
								<th rowspan="2">JUMLAH</th>
							</tr>
							<tr>
								<th>01</th>
								<th>02</th>
								<th>03</th>
								<th>04</th>
								<th>05</th>
								<th>06</th>
								<th>07</th>
								<th>08</th>
								<th>09</th>
								<th>10</th>
								<th>11</th>
								<th>12</th>
								<th>13</th>
								<th>14</th>
								<th>15</th>
								<th>16</th>
								<th>17</th>
								<th>18</th>
								<th>19</th>
								<th>20</th>
								<th>21</th>
								<th>22</th>
								<th>23</th>
								<th>24</th>
								<th>25</th>
								<th>26</th>
								<th>27</th>
								<th>28</th>
								<th>29</th>
								<th>30</th>
								<th>31</th>
								<th>LT</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$totjam = '';
							$totjum = '';
							foreach ($data as $d) {
								$noinduk = $d['noinduk'];
								$nm = $this->db->query("select nama,bagian,seksi from t_karyawan where noinduk='$noinduk'")->result_array();
							?>
								<tr>
									<td><?php echo $nm[0]['nama']; ?></td>

									<?php
									for ($i = 1; $i <= 31; $i++) {
										$tgl = $d['tgl' . $i];
										echo "<td>";
										if ($tgl != 0) {
											echo $tgl;
										}
										echo "</td>";
									}
									?>
									<td>
										<?php
										echo number_format($d['lt'],1);
										?>
									</td>
									<td>
										<?php
										echo number_format(($d['jam']) + ($d['lt']),1);
										?>
									</td>
									<td>
										<?php
										echo number_format($d['l_jam']);
										?>
									</td>
									<td>
										<?php
										echo number_format($d['jumlah']);
										?>
									</td>
								</tr>
							<?php
								$totjam += ($d['jam']) + ($d['lt']);
								$totjum += $d['jumlah'];
							}

							?>
							<tr>
								<td colspan="30" style="text-align: center;"><?= $proyek1->nama ?></td>
								<td colspan="3" style="text-align: right;">Jumlah Rp.</td>
								<td><?php if ($totjam) {
										echo number_format($totjam,1);
									} ?></td>
								<td>-</td>
								<td><?php if ($totjum) {
										echo number_format($totjum,1);
									} ?></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<!-- <?php if ($data) { ?>
						<td colspan="2" style="text-align:center">TOTAL</td>
						<td><?php echo number_format($tot_jumlah); ?></td>
						<td><?php echo number_format($tot_spllt) . "/" . number_format($tot_lt); ?></td>
					<?php } ?> -->
							</tr>
						</tfoot>
					</table>
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