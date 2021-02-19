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
			text-align: left;
			padding-right: 5px;
			padding-left: 5px;
		}
		
		table{

			/*font-family: Arial, Helvetica, sans-serif;*/
			  font-family: Merchant Copy Wide;
			 
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

		// if($no != 1)
		// {
		// 	echo "<div class=\"row\">&nbsp;</div>";
		// }
		// $no++;
			if($no != 1)
			{

				echo "<div class=\"page-break\">&nbsp;</div>";

			}else{

			}
			$no++;		

		$kdseksi 		= $d['seksi'];
		$noinduk 		= $d['noinduk'];
		$periode_awal	= $d['periode_awal_data'];
		$periode_akhir	= $d['periode_akhir_data'];

		//mencari nama seksi
		$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();

		//mencari jam lt dan spl
		$lt = $this->db->query("select jumlt from t_lt_mingguan where noinduk='$noinduk' and pawal ='$periode_awal' and pakhir ='$periode_akhir'")->result_array();
		if($lt)
		{
			$jumlt = $lt[0]['jumlt'];			
		}else{
			$jumlt = 0;
		}

		$spl = $this->db->query("select (tgl1+tgl2+tgl3+tgl4+tgl5+tgl6+tgl7+tgl8+tgl9+tgl10+tgl11+tgl12+tgl13+tgl14+tgl15+tgl16+tgl17+tgl18+tgl19+tgl20+tgl21+tgl22+tgl23+tgl24+tgl25+tgl26+tgl27+tgl28+tgl29+tgl30+tgl31) as jumlahspl from t_spl_mingguan where noinduk='$noinduk' and periode_awal ='$periode_awal' and periode_akhir ='$periode_akhir'")->result_array();
		if($spl)
		{
			$jumspl = $spl[0]['jumlahspl'];			
		}else{
			$jumspl = 0;
		}

		//mencari insentif
		$insentif = $this->db->query("select insentif from t_insentif_mingguan where noinduk='$noinduk' and periode_awal ='$periode_awal' and periode_akhir ='$periode_akhir'")->result_array();
		if($insentif)
		{
			$juminsentif = $insentif[0]['insentif'];
		}else{
			$juminsentif = 0;
		}
		//lembur per jam
		$lembur_per_jam = ($d['gp'] + $d['tjab'] + $d['tmakan'])/173 ;

		//jika status tetap dan kontrak maka bentuk slipnya....
		if (($status == 'T') || ($status == 'K'))
		{
	 ?>
			<div class="row" id="data">	
			<div class="col-ms-12">
				<table>
					<tr>
						<th class="col-ms-6">
							SLIP UPAH MINGGUAN
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo date('d M Y',strtotime($periode_awal)).' s/d '.date('d M Y',strtotime($periode_akhir)) ?></td> 
						
					</tr>
					<tr>
						<th class="col-ms-6">	
							N o m o r 
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo $d['noslip'] ?></td>        	
					</tr>
					<tr>
						<th class="col-ms-2">	
							S e k s i 
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-9"><?php echo $seksi[0]['nama'] ?></td>        						
					</tr>
					<tr>
						<th class="col-ms-5">
							N a m a         
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6"><?php echo $d['nama'] ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Upah Pokok         
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6">Rp. <?php echo number_format($d['gp']) ?></td>		
					</tr>
					<tr>
						<th class="col-ms-6">
							<u>Tunj. Tetap</u> 
						</th>	        
							<td class="col-ms-1">:</td>
					</tr>
					</tr>
					<tr>
						<th class="col-ms-6">
							Tunj. Jabatan      
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['tjab']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Tunj. Makan        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format($d['tmakan']) ?></u> +</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							UPAH        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php number_format($d['gp'] + $d['tjab'] + $d['tmakan'])?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							<u>Tunj. Tak Tetap</u>
						</th>	        
							<td class="col-ms-1">:</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							TTT Murni        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format($d['t3m']) ?></u> +</td>
					</tr>
					
					<tr>
						<th class="col-ms-6">
							JUMLAH PENDAPATAN
						</th>	        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) ?></td>
					</tr>
					<?php if($status == 'T') {?>
					<tr>
						<th class="col-ms-6">
							Insentif
						</th>	        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($juminsentif) ?></td>
					</tr>
					<?php } ?>

					<tr>
						<th class="col-ms-6">
							<u>Potongan</u>
						</th>	        
							<td class="col-ms-1">:</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Absensi        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['pot_absen']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Koperasi        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['koperasi'])?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							S P S I        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['spsi']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							BPJS TK   
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['jht']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							BPJS KES    
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['bpjs_kes']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lain-lain       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6">Rp. <?php echo number_format($d['pot_t3m']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							TOTAL POTONGAN        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format($d['pot_absen'] + $d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ?></u></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							UANG DITERIMA
						</th>	        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format(($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) - ($d['pot_absen'] + $d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							PREMI HADIR        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format($d['premi']) ?></u> +</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							JUMLAH        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format(($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) - ($d['pot_absen'] + $d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) + $d['premi'] + $juminsentif) ?></td>
					</tr>
					
					<tr>
						<th class="col-ms-6">
							Lb LT <?php echo $jumlt ?> Jam        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['lt']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lb SPL  <?php echo $jumspl ?> Jam       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['lembur']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							@ <?php echo number_format($lembur_per_jam,2) ?>/jam       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['lt'] + $d['lembur']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							TOTAL DITERIMA        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format(($d['gp'] + $d['tjab'] + $d['tmakan'] + $d['t3m']) - ($d['koperasi'] + $d['spsi'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) + $d['premi'] + $d['lt'] + $d['lembur'] + $juminsentif) ?></td>
					</tr>

				</table> 
			</div>		
			</div>
	<?php 	
		}else if ($status == 'M'){
			//jika magang dan honor

	?>
			<div class="row" id="data">	
			<div class="col-ms-12">
				<table>
					<tr>
						<th class="col-ms-6">
							SLIP MAGANG
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo date('d M Y',strtotime($periode_awal)).' s/d'.date('d M Y',strtotime($periode_akhir)) ?></td> 
 
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">	
							N o m o r 
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo $d['noslip'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="col-ms-5">	
							S e k s i 
							<td class="col-ms-1">:</td>
							<td class="col-ms-1"><?php echo $seksi[0]['nama'] ?></td>        
						</th>
					</tr>
					<tr>
						<th class="col-ms-5">
							N a m a         
							<td class="col-ms-1">:</td>
							<td class="col-ms-6"><?php echo $d['nama'] ?></td>
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">
							H o n o r       
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['gp']) ?></td>
						</th>
					</tr>
					
					<tr>
						<th class="col-ms-6">
							<u>Potongan</u>        
							<td class="col-ms-1">:</td>
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">
							Absensi        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['pot_absen']) ?></td>
						</th>
					</tr>
					
					<tr>
						<th class="col-ms-6">
							ASTEK    
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['jht'] + $d['bpjs_kes']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lain-lain       
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['pot_t3m']) ?></td>
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">
							TOTAL POTONGAN        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format( $d['pot_absen'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ?></u></td>
						</th>
					</tr>
					<tr>
						<th class="col-ms-6">
							HONOR DITERIMA        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format(($d['gp']) - ( $d['pot_absen'] + $d['jht'] + $d['bpjs_kes'] + $d['pot_t3m']) ) ?></td>
						</th>
					</tr>

				</table> 
			</div>		
			</div>
			

	<?php 
		}else if ($status == 'H'){
	?>
		<div class="row" id="data">	
			<div class="col-ms-12">
				<table>
					<tr>
						<th class="col-ms-6">
							SLIP HONOR MINGGUAN
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo date('d M Y',strtotime($periode_awal)).' s/d'.date('d M Y',strtotime($periode_akhir)) ?></td> 
 
						
					</tr>
					<tr>
						<th class="col-ms-6">	
							N o m o r 
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5"><?php echo $d['noslip'] ?></td>        	
					</tr>
					<tr>
						<th class="col-ms-2">	
							S e k s i 
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-9"><?php echo $seksi[0]['nama'] ?></td>        						
					</tr>
					<tr>
						<th class="col-ms-5">
							N a m a         
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6"><?php echo $d['nama'] ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							H o n o r        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6">Rp. <?php echo number_format($d['gp']) ?></td>		
					</tr>
					<tr>
						<th class="col-ms-6">
							<u>Potongan</u>
						</th>	        
							<td class="col-ms-1">:</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Absensi        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['pot_absen']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							BPJS TK   
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['jht']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lain-lain       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-6">Rp. <?php echo number_format($d['pot_t3m']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							TOTAL POTONGAN        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <u><?php echo number_format( $d['jht'] + $d['pot_t3m']) ?></u></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							HONOR DITERIMA
						</th>	        
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format(($d['gp'] + $d['bpjs_kes'] + $d['pot_t3m'])) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lb LT  <?php echo $jumlt ?> Jam        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['lt']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							Lb SPL  <?php echo $jumspl ?> Jam       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. <?php echo number_format($d['lembur']) ?></td>
					</tr>
					<tr>
						<th class="col-ms-6">
							@ 22.000/Jam       
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. 124.000</td>
					</tr>
					<tr>
						<th class="col-ms-6">
							TOTAL DITERIMA        
						</th>	
							<td class="col-ms-1">:</td>
							<td class="col-ms-5">Rp. 4.200.000</td>
					</tr>

				</table> 
			</div>		
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