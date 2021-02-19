<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- <script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	 -->

</head>
<body>
<div role="main">	
	<div class="row">
			<div class="col-md-6">			
			</div>
			<div class="col-md-5">			
			</div>
			<div class="col-md-1">
				<a href="#"><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;			
				<a href="<?php echo base_url()?>./index.php/bulanan/lap_rekap_upah_bulanan_sby_org_excell/<?php echo $bulan?>/<?php echo $tahun?>/<?php echo $status ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	
			</div>
	</div>
	<div class="row">	
		<div class="col-xs-12">
			<table class="table table-striped" id="table1">
				<thead >
					<tr>
						<td>No</td>
						<td>Nama</td>
						<td>No. Rekening</td>
						<td>GAJI</td>
						<td>PREMI</td>
						<td>LEMBUR</td>
						<td>ABSEN</td>
						<td>LAIN-LAIN</td>
						<td>BPJS-TK</td>
						<td>BPJS-KES</td>
						<td>SPSI</td>
						<td>KOPERASI</td>
						<td>TRANSFER</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$no =0;	
						$tot_upah ='';
						$tot_premi ='';
						$tot_lembur ='';
						$tot_absensi ='';
						$tot_lain_lain = '';
						$tot_bpjs_tk ='';
						$tot_bpjs_kes ='';
						$tot_spsi ='';
						$tot_koperasi ='';
						$tot_transfer ='';
						foreach($data as $d)
						{
							$no++;
							$noinduk = $d['noinduk'];
							$nama = $this->db->query("select nama from t_karyawan where noinduk='$noinduk'")->result_array();
							echo "<tr>";
							echo "<td>".$no."</td>";
							echo "<td>".$nama[0]['nama']."</td>";
							echo "<td>".$d['norek']."</td>";
							echo "<td>".number_format($d['upah'])."</td>";
							echo "<td>".number_format($d['premi'])."</td>";
							echo "<td>".number_format($d['lembur'])."</td>";
							echo "<td>".number_format($d['absen'])."</td>";
							echo "<td>".number_format($d['lain_lain'])."</td>";
							echo "<td>".number_format($d['bpjs_tk'])."</td>";
							echo "<td>".number_format($d['bpjs_kes'])."</td>";
							echo "<td>".number_format($d['spsi'])."</td>";
							echo "<td>".number_format($d['koperasi'])."</td>";
							echo "<td>".number_format($d['transfer'])."</td>";
							echo "</tr>";
							$tot_upah += $d['upah'];
							$tot_premi += $d['premi'];
							$tot_lembur += $d['lembur'];
							$tot_absensi += $d['absen'];
							$tot_lain_lain += $d['lain_lain'];
							$tot_bpjs_tk += $d['bpjs_tk'];
							$tot_bpjs_kes += $d['bpjs_kes'];
							$tot_spsi += $d['spsi'];
							$tot_koperasi += $d['koperasi'];
							$tot_transfer += $d['transfer'];   
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" style="text-align:center">TOTAL</td>
						<td><?php echo number_format($tot_upah); ?></td>
						<td><?php echo number_format($tot_premi); ?></td>
						<td><?php echo number_format($tot_lembur); ?></td>
						<td><?php echo number_format($tot_absensi); ?></td>
						<td><?php echo number_format($tot_lain_lain); ?></td>
						<td><?php echo number_format($tot_bpjs_tk); ?></td>
						<td><?php echo number_format($tot_bpjs_kes); ?></td>
						<td><?php echo number_format($tot_spsi); ?></td>
						<td><?php echo number_format($tot_koperasi); ?></td>
						<td><?php echo number_format($tot_transfer); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$('document').ready(function(){
	
		$('#table1').dataTable({
			responsive : true
		});
	})


</script>
</body>
</html>