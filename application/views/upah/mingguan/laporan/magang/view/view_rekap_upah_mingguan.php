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
				<a href="<?php echo base_url()?>./index.php/mingguan/lap_rekap_upah_mingguan_excell/<?php echo $periode_awal?>/<?php echo $periode_akhir?>/<?php echo $status?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
	</div>
	<div class="row">	
		<div class="col-xs-12">
			<table class="table table-striped" id="table1">
				<thead >
					<tr>
						<td>No</td>
						<td>Seksi</td>
						<td>UPAH</td>
						<td>LT</td>
						<td>PREMI</td>
						<td>BPJS-TK</td>
						<td>BPJS-KES</td>
						<td>KOPERASI</td>
						<td>SPSI</td>
						<td>LAIN2</td>
						<td>JUMLAH</td>
					</tr>
				</thead>
				<tbody>
					<?php  
						$no =0;
						$tot_upah ='';
						$tot_lt ='';
						$tot_premi ='';
						$tot_bpjs_tk ='';
						$tot_bpjs_kes ='';
						$tot_koperasi ='';
						$tot_spsi ='';
						$tot_lain2 ='';
						$tot_jumlah ='';

						foreach($data as $d)
						{
							$no++;
							$kdseksi = $d['seksi'];
							$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							$jumlah = ($d['upah'] + $d['premi'] + $d['lt']) - ( $d['bpjs_tk'] + $d['bpjs_kes'] + $d['spsi'] + $d['koperasi'] + $d['lain_lain']);
							echo "<tr>";
								echo "<td>". $no ."</td>";
								echo "<td>";
								 	echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>". number_format($d['upah'])."</td>";
								echo "<td>". number_format($d['lt']) ."</td>";
								echo "<td>". number_format($d['premi']) ."</td>";
								echo "<td>". number_format($d['bpjs_tk']) ."</td>";
								echo "<td>". number_format($d['bpjs_kes']) ."</td>";
								echo "<td>". number_format($d['koperasi']) ."</td>";
								echo "<td>". number_format($d['spsi']) ."</td>";
								echo "<td>". number_format($d['lain_lain']) ."</td>";
								echo "<td>".number_format($jumlah)."</td>";
							echo "</tr>";
							$tot_upah += $d['upah'];
							$tot_lt += $d['lt'];
							$tot_premi += $d['premi'];
							$tot_bpjs_tk += $d['bpjs_tk'];
							$tot_bpjs_kes += $d['bpjs_kes'];
							$tot_koperasi += $d['koperasi'];
							$tot_spsi += $d['spsi'];
							$tot_lain2 += $d['lain_lain'];
							$tot_jumlah += $jumlah;
						}
					 ?>		
						
				</tbody>
				<tfoot>
					 <tr>
						 	<td colspan="2" style="text-align:center">TOTAL</td>
						 	<td><?php echo number_format($tot_upah); ?></td>
						 	<td><?php echo number_format($tot_lt); ?></td>	
						 	<td><?php echo number_format($tot_premi); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_tk); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_kes); ?></td>	
						 	<td><?php echo number_format($tot_koperasi); ?></td>	
						 	<td><?php echo number_format($tot_spsi); ?></td>	
						 	<td><?php echo number_format($tot_lain2); ?></td>	
						 	<td><?php echo number_format($tot_jumlah); ?></td>												 		
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