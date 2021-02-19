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
			$status = "TETAP";
		}elseif($status == "K")
		{
			$status = "KONTRAK";
		}elseif($status == "H")
		{
			$status = "HONOR";
		}else{
			$status = "MAGANG";
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
				<a href="<?php echo base_url()?>./index.php/mingguan/lap_rekap_upah_mingguan_excell/<?php echo $periode_awal?>/<?php echo $periode_akhir?>/<?php echo $status?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	
			</div>
	</div>
	<div class="row">
	<div class="col-xs-12 center">
				<h4>REKAP UPAH MINGGUAN <?php echo $status ?> PT. <?php echo $pabrik ?> <br/>
				PERIODE : <?php echo date('d M Y',strtotime($periode_awal)) ." s/d ". date('d M Y',strtotime($periode_akhir)) ?></h4>		
	</div>		
		<div class="col-xs-12">
			<table class="display" border="1" style="width:100%">
				<thead >
					<tr>
						<th>No</th>
						<th>Seksi</th>
						<th>UPAH</th>
						<th>LT</th>
						<th>PREMI</th>
						<th>BPJS-TK</th>
						<th>BPJS-KES</th>
						<th>KOPERASI</th>
						<th>SPSI</th>
						<th>LAIN2</th>
						<th>JUMLAH</th>
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
								echo "<td style='text-align:center'>". $no ."</td>";
								echo "<td style='text-align:left'>";
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
					 	<?php if($data){?>
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
						 <?php } ?>	 		
						 </tr>	 
				</tfoot>
			</table>
			<div class="col-xs-5 right">,</div>
			<div class="col-xs-4 right"></div>
			<div class="col-xs-3 right">Bangun, <?php echo date('d M Y');?></div>
			<div class="row">
			<div class="col-xs-1 "></div>
			<div class="col-xs-3 ">Disetujui,</div>
			<div class="col-xs-5 ">Diperiksa,</div>
			<div class="col-xs-2 ">Dibuat,</div>
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