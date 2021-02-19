<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 	<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	 -->

</head>
<body>
	<div class="page-header">
		<h2>
			Data Gaji Mingguan Periode Upah: <?php echo date('d M Y',strtotime($periode_awal_upah)) ." s/d ".date('d M Y', strtotime($periode_akhir_upah)) ?>
		</h2>
	</div>
	<table class="table table-striped" id="table1">
		<thead >
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>GP</td>
				<td>T2</td>
				<td>T3</td>
				<td>JHT</td>
				<td>Pensiun</td>
				<td>BPJS</td>
				<td>Premi</td>
				<td>LT</td>
				<td>Lembur</td>
				<td>P.T3m</td>
				<td>P.abs</td>
				<td>Kop+spsi</td>
				<td>THP</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($data as $d)
				{
					$nama = $this->db->query("select nama from t_karyawan where noinduk='".$d['noinduk']."'")->result_array();
				echo "<tr>";
					echo "<td>". $d['noinduk'] ."</td>";
					echo "<td>";
					 	if(isset($nama[0]['nama']))
					 	{
					 		echo $nama[0]['nama'];	
					 	}else{
					 		echo "-";
					 	} 
					echo "</td>";
					echo "<td>". number_format($d['gp']) ."</td>";
					echo "<td>". number_format($d['tmakan'] + $d['tjab']) ."</td>";
					echo "<td>". number_format($d['t3m'] + $d['t3e']) ."</td>";
					echo "<td>". number_format($d['jht']) ."</td>";
					echo "<td>". number_format($d['pensiun']) ."</td>";
					echo "<td>". number_format($d['bpjs_kes']) ."</td>";
					echo "<td>". number_format($d['premi']) ."</td>";		
					echo "<td>". number_format($d['lt']) ."</td>";		
					echo "<td>". number_format($d['lembur']) ."</td>";		
					echo "<td>". number_format($d['pot_t3m']) ."</td>";		
					echo "<td>". number_format($d['pot_absen']) ."</td>";		
					echo "<td>". number_format($d['koperasi'] + $d['spsi'] ) ."</td>";		
					echo "<td>". number_format($d['thp']) ."</td>";
					echo "</tr>";
				}
			 ?>			
		</tbody>
	</table>

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