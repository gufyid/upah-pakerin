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
						foreach($data as $d)
						{
							$no++;
							$noinduk = $d['noinduk'];
							echo "<tr>";
							echo "<td>".$no."</td>";
							echo "<td>".$noinduk."</td>";
							echo "<td>".$d['norek']."</td>";
							echo "<td>".number_format($d['upah'])."</td>";
							echo "<td>".number_format($d['premi'])."</td>";
							echo "<td>".number_format($d['lembur'])."</td>";
							echo "<td>".number_format($d['lain_lain'])."</td>";
							echo "<td>".number_format($d['bpjs_tk'])."</td>";
							echo "<td>".number_format($d['bpjs_kes'])."</td>";
							echo "<td>".number_format($d['spsi'])."</td>";
							echo "<td>".number_format($d['koperasi'])."</td>";
							echo "<td>".number_format($d['transfer'])."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
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