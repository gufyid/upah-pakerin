<?php 
	ini_set('display_errors',1);
	error_reporting(0);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		
</head>
<body>

	<table class="table table-striped" id="table1">
		<thead >
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Seksi</td>
				<td>Pabrik</td>
				<td>Status</td>
				<td>Kelompok</td>
				<td>Keterangan</td>
				<td>Kondite</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($data as $d)
				{
					$noinduk = $d['noinduk'];
					$kary = $this->db->query("select * from t_karyawan where noinduk='".$d['noinduk']."'")->result_array();
				echo "<tr>";
					echo "<td>". $noinduk ."</td>";
					echo "<td>". $kary[0]['nama'] . "</td>";
					echo "<td>". $d['seksi'] ."</td>";
					echo "<td>". $kary[0]['pabrik'] ."</td>";
					echo "<td>". $kary[0]['skerja'] ."</td>";
					echo "<td>". $d['karu'] ."</td>";
					echo "<td>". $d['keterangan'] ."</td>";
					echo "<td>". $d['kondite'] ."</td>";

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