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
<div class="container">	
	<div class="row">
			<div class="col-md-6">			
			</div>
			<div class="col-md-5">			
			</div>
			<div class="col-md-1">
				<a href="<?php echo  base_url();?>./index.php/utama/report_pdf_barang"><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;			
				<a href="<?php echo base_url()?>./index.php/bulanan/lap_rekap_lembur_excell/<?php echo $bulan?>/<?php echo $tahun?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	
			</div>
	</div>
	<div class="row">	
		<div class="col">
			<table class="table table-striped" id="table1">
				<thead >
					<tr>
						<td>No</td>
						<td>Seksi</td>
						<td>Jumlah</td>
						<td>SPL+LT/LT</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no =0;
						foreach($data as $d)
						{
							$no++;
							$spllt = $d['spl'] + $d['lt'];
							$kdseksi = $d['seksi'];
							$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							echo "<tr>";
								echo "<td>". $no ."</td>";
								echo "<td>";
								 	echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>". number_format($d['lembur']) ."</td>";
								echo "<td>".$spllt."/".$d['lt']."</td>";
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