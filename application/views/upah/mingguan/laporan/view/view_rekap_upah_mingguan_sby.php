<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">	
	@media print
	{
		#cetak { display: none; }
	    .non-printable { display: none; }
	    .footer { display: none; }
	 	.breadcrumbs { display: none; }  
	 	.printable { display: block; }
	    #print { display: none; }
	    #pesan { display: none; }
	  	 a { display: none; }
	  	td { font-size: 10px; } 
	  	th { font-size: 10px; } 
	  	/*r { height: 10px }*/
	}
	td
		{
			text-align: right;
			padding-right: 5px;
			padding-left: 5px
		}
		th
		{
			text-align: center;
		}
	
</style>		

</head>
<body>
<?php 
	if($status == "T")
		{
			$status1 = "TETAP";
		}elseif($status == "K")
		{
			$status1 = "KONTRAK";
		}elseif($status == "H")
		{
			$status1 = "HONOR";
		}else{
			$status1 = "MAGANG";
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
				<a href="<?php echo base_url()?>./index.php/mingguan/lap_rekap_upah_mingguan_sby_excell/<?php echo $periode_awal?>/<?php echo $periode_akhir?>/<?php echo $status?>/<?php echo $pabrik?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
	</div>
	<div class="row">	
		<div class="col-xs-12 center">
			<h4>LAPORAN REKAP UPAH KARYAWAN HARIAN <?php echo $status1 ?>  PT. <?php echo $pabrik ?> (Utk. Surabaya)<br/>
				PERIODE : <?php echo date('d M Y',strtotime($periode_awal)) ." s/d ". date('d M Y',strtotime($periode_akhir)) ?></h4>		
		</div>		
		<div class="col-xs-12">
			<table class="table table-striped" id="table1">
				<thead >
					<tr>
						<td>No</td>
						<td>Seksi</td>
						<td>Jumlah Orang</td>
						<td>Transfer</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no =0;
						$tot_org = '';
						$tot_transfer = '';
						foreach($data as $d)
						{
							$no++;
							$kdseksi = $d['seksi'];
							$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							echo "<tr>";
								echo "<td>". $no ."</td>";
								echo "<td>";
								 	echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>".$d['orang']."</td>";
								echo "<td>". number_format($d['transfer']) ."</td>";
							echo "</tr>";
							$tot_org += $d['orang'];
							$tot_transfer += $d['transfer'];
						}
					 ?>			
				</tbody>
				<tfoot>
					<tr>
						<?php if($data){?>
						<td colspan="2" style="text-align:center">TOTAL</td>
						<td><?php echo number_format($tot_org); ?></td>
						<td><?php echo number_format($tot_transfer); ?></td>
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
	function submit(){
		window.print();
	}

</script>
</body>
</html>