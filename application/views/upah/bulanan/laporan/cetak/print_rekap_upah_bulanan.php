<!DOCTYPE html>
<html>
<head>
	<title></title>
		<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<!-- <script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
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
	</div>
	<div class="row">	
		<div class="col-xs-12">
			<table border='1'>
				<thead >
					<tr>
						<td>No</td>
						<td>Seksi</td>
						<td>UPAH</td>
						<td>PREMI</td>
						<td>POT. LAIN</td>
						<td>ABSENSI</td>
						<td>BPJS-TK</td>
						<td>BPJS-KES</td>
						<td>SPSI</td>
						<td>KOPERASI</td>
						<td>JUMLAH</td>
					</tr>
				</thead>
				<tbody>
					<?php  
						$no =0;
						$tot_upah ='';
						$tot_premi ='';
						$tot_pot_lain ='';
						$tot_absensi ='';
						$tot_bpjs_tk ='';
						$tot_bpjs_kes ='';
						$tot_spsi ='';
						$tot_koperasi ='';
						$tot_jumlah ='';

					if ($data){
						foreach($data as $d)
						{
							$no++;
							$kdseksi = $d['seksi'];
							$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							$jumlah = ($d['upah'] + $d['premi']) - ($d['absensi'] + $d['bpjs_tk'] + $d['bpjs_kes'] + $d['spsi'] + $d['koperasi']);
							echo "<tr>";
								echo "<td>". $no ."</td>";
								echo "<td>";
								 	echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>". number_format($d['upah'])."</td>";
								echo "<td>". number_format($d['premi']) ."</td>";
								echo "<td>". number_format($d['pot_lain'])."</td>";
								echo "<td>". number_format($d['absensi']) ."</td>";
								echo "<td>". number_format($d['bpjs_tk']) ."</td>";
								echo "<td>". number_format($d['bpjs_kes']) ."</td>";
								echo "<td>". number_format($d['spsi']) ."</td>";
								echo "<td>". number_format($d['koperasi']) ."</td>";
								echo "<td>".number_format($jumlah)."</td>";
							echo "</tr>";
							$tot_upah += $d['upah'];
							$tot_premi += $d['premi'];
							$tot_pot_lain += $d['pot_lain'];
							$tot_absensi += $d['absensi'];
							$tot_bpjs_tk += $d['bpjs_tk'];
							$tot_bpjs_kes += $d['bpjs_kes'];
							$tot_spsi += $d['spsi'];
							$tot_koperasi += $d['koperasi'];
							$tot_jumlah += $jumlah;
						}
					}
					 ?>		
					
				</tbody>
				<tfoot>
					 <tr>
					 <?php if($data){ ?>
						 	<td colspan="2" style="text-align:center">TOTAL</td>
						 	<td><?php echo number_format($tot_upah); ?></td>
						 	<td><?php echo number_format($tot_premi); ?></td>	
						 	<td><?php echo number_format($tot_pot_lain); ?></td>	
						 	<td><?php echo number_format($tot_absensi); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_tk); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_kes); ?></td>	
						 	<td><?php echo number_format($tot_spsi); ?></td>	
						 	<td><?php echo number_format($tot_koperasi); ?></td>	
						 	<td><?php echo number_format($tot_jumlah); ?></td>						
						<?php } ?>	 		
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