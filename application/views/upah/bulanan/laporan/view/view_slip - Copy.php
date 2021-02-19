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
	  	td { font-size: 12px; } 
	  	th { font-size: 12px; } 
	  	/*r { height: 10px }*/
	
		td
		{
			text-align: right;
			padding-right: 5px;
			padding-left: 5px;
		}
		
		.kiri 
		{
		text-align: left;
		}
		
		.page-break	{ display: block; page-break-before: always; }
	}

	@media screen
	{
			    #data { display: none; }
	}
</style>

</head>
<body>
<?php 
	// if($status == "T")
	// 	{
	// 		$status = "TETAP";
	// 	}elseif($status == "K")
	// 	{
	// 		$status = "KONTRAK";
	// 	}elseif($status == "H")
	// 	{
	// 		$status = "HONOR";
	// 	}else{
	// 		$status = "MAGANG";
	// 	}

	// 	$bul = array(
	// 		'1' => 'Januari',
	// 		'2' => 'Februari',
	// 		'3' => 'Maret',
	// 		'4' => 'April',
	// 		'5' => 'Mei',
	// 		'6' => 'Juni',
	// 		'7' => 'Juli',
	// 		'8' => 'Agustus',
	// 		'9' => 'September',
	// 		'10' => 'Oktober',
	// 		'11' => 'November',
	// 		'12' => 'Desember',
	// 	);
 ?>

<div class="container">	
	<div class="row">
			<div class="col-md-6">			
			</div>
			<div class="col-md-5">			
			</div>
			<div class="col-md-1">
				<!-- <a href="#" onclick=submit();><i class="ace-icon fa fa-print fa-2x"></i></a> -->
			</div>
	</div>
	<?php
		$no = 1; 
		foreach($data as $d){

		if($no != 1)
		{
			echo "<div class=\"row\">&nbsp;</div>";
		}
		$no++;
			// if($no != 1)
			// {
			// 	echo "<div class=\"page-break\">";
			// }
			// $no++;		

		$kdseksi = $d['seksi'];
		$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();

		//jika status tetap dan kontrak maka bentuk slipnya....
		if (($status == 'T') || ($status == 'K'))
		{
	 ?>
			<div class="row" id="data">	
			<div class="col-xs-12">
				<table>
					<tr>
						<th class="kiri">
							SLIP UPAH BULANAN 
							<td>:</td>
							<td><?php echo $bulan.'-'.$tahun?></td> 
						</th>
					</tr>
					<tr>
						<th class="kiri">	
							N o m o r 
							<td>:</td>
							<td><?php echo $d['noslip'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="kiri">	
							S e k s i 
							<td>:</td>
							<td><?php echo $seksi[0]['nama'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="kiri">
							N a m a         
							<td>:</td>
							<td><?php echo $d['nama'] ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Upah Pokok         
							<td>:</td>
							<td>Rp. <?php echo number_format($d['gp']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							<u>Tunj. Tetap</u>         
							<td>:</td>
						</th>
					</tr>
					</tr>
					<tr>
						<th class="kiri">
							Tunj. Jabatan      
							<td>:</td>
							<td>Rp. <?php echo number_format($d['tjab']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Tunj. Makan        
							<td>:</td>
							<td>Rp. <u><?php echo number_format($d['tmakan']) ?></u> +</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							UPAH        
							<td>:</td>
							<td>Rp. <?php number_format($d['gp'] + $d['tjab'] + $d['tmakan'])?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							<u>Tunj. Tak Tetap</u>        
							<td>:</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							TTT Murni        
							<td>:</td>
							<td>Rp. <u><?php echo number_format($d['t3m']) ?></u> +</td>
						</th>
					</tr>
					
					<tr>
						<th class="kiri">
							JUMLAH PENDAPATAN        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							<u>Potongan</u>        
							<td>:</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Absensi        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['pot_absen']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							*)Koperasi        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['koperasi'])?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							S P S I        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['spsi']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							BPJS TK/KES    
							<td>:</td>
							<td>Rp. <?php echo number_format($d['jht'] + $d['bpjs_kes']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Lain-lain       
							<td>:</td>
							<td>Rp. <?php echo number_format($d['pot_t3m']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							TOTAL POTONGAN        
							<td>:</td>
							<td>Rp. <u><?php echo number_format($d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ?></u></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							UANG DITERIMA        
							<td>:</td>
							<td>Rp. <?php echo number_format(($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) - ($d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							PREMI HADIR        
							<td>:</td>
							<td>Rp. <u><?php echo number_format($d['premi']) ?></u> +</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							JUMLAH        
							<td>:</td>
							<td>Rp. <?php echo number_format(($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) - ($d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) + $d['premi']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							*) ke - 0        
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Lb LT 14 Jam        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['lt']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Lb SPL  5 Jam       
							<td>:</td>
							<td>Rp. <?php echo number_format($d['lembur']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							@ 22.000/Jam       
							<td>:</td>
							<td>Rp. 124.000</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							TOTAL DITERIMA        
							<td>:</td>
							<td>Rp. 4.200.000</td>
						</th>
					</tr>

				</table> 
			</div>		
			</div>&nbsp;
	
	<?php 	
		}else{
			//jika magang dan honor

	?>

			<div class="col-xs-12">
				<table>
					<tr>
						<th class="kiri">
							SLIP HONOR
							<td>:</td>
							<td><?php echo $bulan.'-'.$tahun?></td> 
						</th>
					</tr>
					<tr>
						<th class="kiri">	
							N o m o r 
							<td>:</td>
							<td><?php echo $d['noslip'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="kiri">	
							S e k s i 
							<td>:</td>
							<td><?php echo $seksi[0]['nama'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="kiri">
							N a m a         
							<td>:</td>
							<td><?php echo $d['nama'] ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							H o n o r       
							<td>:</td>
							<td>Rp. <?php echo number_format($d['gp']) ?></td>
						</th>
					</tr>
					
					<tr>
						<th class="kiri">
							<u>Potongan</u>        
							<td>:</td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Absensi        
							<td>:</td>
							<td>Rp. <?php echo number_format($d['pot_absen']) ?></td>
						</th>
					</tr>
					
					<tr>
						<th class="kiri">
							ASTEK    
							<td>:</td>
							<td>Rp. <?php echo number_format($d['jht'] + $d['bpjs_kes']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							Lain-lain       
							<td>:</td>
							<td>Rp. <?php echo number_format($d['pot_t3m']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							TOTAL POTONGAN        
							<td>:</td>
							<td>Rp. <u><?php echo number_format( $d['pot_absen'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ?></u></td>
						</th>
					</tr>
					<tr>
						<th class="kiri">
							HONOR DITERIMA        
							<td>:</td>
							<td>Rp. <?php echo number_format(($d['gp']) - ( $d['pot_absen'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ) ?></td>
						</th>
					</tr>

				</table> 
			</div>		
			</div>&nbsp;
			</div>

	<?php 
		}
	}
 	?>
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$('document').ready(function(){
		window.print();	
		$('#table1').dataTable({
			responsive : true
		});

	})

	function submit()
	{
		window.print();
	}
</script>
</body>
</html>