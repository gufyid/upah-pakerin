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

 ?>		
<div role="main">	
	<div class="row">
			<div class="col-md-6">			
			</div>
			<div class="col-md-5">			
			</div>
			<div class="col-md-1">
				<a href="#" onclick=submit();><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;		
				<a href="<?php echo base_url()?>./index.php/mingguan/lap_rekap_upah_mingguan_sby_org_excell/<?php echo $periode_awal?>/<?php echo $periode_akhir?>/<?php echo $status?>/<?php echo $pabrik?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>
			</div>
	</div>
	<div class="row">
	<div class="col-xs-12">
			<h4>PT. <?php echo $pabrik ?> <br/>
				LAPORAN UPAH KARYAWAN HARIAN <?php echo $status1 ?> (utk Surabaya) <br/>
				PERIODE : <?php echo date('d M Y',strtotime($periode_awal)) ." s/d ". date('d M Y', strtotime($periode_akhir)) ?></h4>		
	</div>		
		<div class="col-xs-12">
			<table class="display" border="1" style="width:100%">
				<thead >
					<tr>
						<th>Nama</th>
						<th>No. Rekening</th>
						<th>GAJI</th>
						<th>LT</th>
						<th>INSENTIF</th>
						<th>PREMI</th>
						<th>LEMBUR</th>
						<th>ABSEN</th>
						<th>LAIN-LAIN</th>
						<th>BPJS-TK</th>
						<th>BPJS-KES</th>
						<th>SPSI</th>
						<th>KOPERASI</th>
						<th>TRANSFER</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$tot_upah1 		='';
							$tot_lt1 		='';
							$tot_insentif1 	='';
							$tot_premi1 	='';
							$tot_lembur1 	='';
							$tot_absensi1 	='';
							$tot_lain_lain1	= '';
							$tot_bpjs_tk1 	='';
							$tot_bpjs_kes1 	='';
							$tot_spsi1 		='';
							$tot_koperasi1 	='';
							$tot_transfer1 	='';
						foreach($data as $d)
						{
							$tot_upah 		='';
							$tot_lt 		='';
							$tot_insentif 	='';
							$tot_premi 		='';
							$tot_lembur 	='';
							$tot_absensi 	='';
							$tot_lain_lain 	= '';
							$tot_bpjs_tk 	='';
							$tot_bpjs_kes 	='';
							$tot_spsi 		='';
							$tot_koperasi 	='';
							$tot_transfer 	='';

							$kdseksi = $d['seksi'];
							$nmseksi = $d['nama'];
							echo "<tr>";
								echo "<th  colspan='12' style='text-align:left'>&nbsp;".$nmseksi."</th>";
							echo "</tr>";

							$karyawan = $this->db->query("select * from t_rekap_upah_mingguan_sby_org where seksi='$kdseksi'")->result_array();
							foreach ($karyawan as $b ) 
							{	

								$nmkar = $this->db->query("select nama from t_karyawan where noinduk=".$b['noinduk']."")->result_array();

								echo "<tr>";
								echo "<td style='text-align:left'>".$nmkar[0]['nama']."</td>";								
								echo "<td>".$b['norek']."</td>";
								echo "<td>".number_format($b['upah'])."</td>";
								echo "<td>".number_format($b['lt'])."</td>";
								echo "<td>".number_format($b['insentif'])."</td>";
								echo "<td>".number_format($b['premi'])."</td>";
								echo "<td>".number_format($b['lembur'])."</td>";
								echo "<td>".number_format($b['absen'])."</td>";
								echo "<td>".number_format($b['lain_lain'])."</td>";
								echo "<td>".number_format($b['bpjs_tk'])."</td>";
								echo "<td>".number_format($b['bpjs_kes'])."</td>";
								echo "<td>".number_format($b['spsi'])."</td>";
								echo "<td>".number_format($b['koperasi'])."</td>";
								echo "<td>".number_format($b['transfer'])."</td>";
								echo "</tr>";
								$tot_upah 		+= $b['upah'];
								$tot_lt 		+= $b['lt'];
								$tot_insentif 	+= $b['insentif'];
								$tot_premi 		+= $b['premi'];
								$tot_lembur 	+= $b['lembur'];
								$tot_absensi 	+= $b['absen'];
								$tot_lain_lain 	+= $b['lain_lain'];
								$tot_bpjs_tk 	+= $b['bpjs_tk'];
								$tot_bpjs_kes 	+= $b['bpjs_kes'];
								$tot_spsi 		+= $b['spsi'];
								$tot_koperasi 	+= $b['koperasi'];
								$tot_transfer 	+= $b['transfer']; 
							}
								$tot_upah1 		+= $tot_upah;
								$tot_lt1 		+= $tot_lt;
								$tot_insentif1 	+= $tot_insentif;
								$tot_premi1 	+= $tot_premi;
								$tot_lembur1 	+= $tot_lembur;
								$tot_absensi1 	+= $tot_absensi;
								$tot_lain_lain1 += $tot_lain_lain;
								$tot_bpjs_tk1 	+= $tot_bpjs_tk;
								$tot_bpjs_kes1 	+= $tot_bpjs_kes;
								$tot_spsi1 		+= $tot_spsi;
								$tot_koperasi1 	+= $tot_koperasi;
								$tot_transfer1 	+= $tot_transfer; 

							//sub total er seksi
								echo "<tr>";
									if($data)
									{ 
										echo "<td colspan='2' style='text-align:center'>TOTAL</td>";
										echo "<td>".number_format($tot_upah). "</td>";
										echo "<td>".number_format($tot_lt). "</td>";
										echo "<td>".number_format($tot_insentif). "</td>";
										echo "<td>". number_format($tot_premi). "</td>";
										echo "<td>". number_format($tot_lembur). "</td>";
										echo "<td>". number_format($tot_absensi). "</td>";
										echo "<td>". number_format($tot_lain_lain). "</td>";
										echo "<td>". number_format($tot_bpjs_tk). "</td>";
										echo "<td>". number_format($tot_bpjs_kes). "</td>";
										echo "<td>". number_format($tot_spsi). "</td>";
										echo "<td>". number_format($tot_koperasi). "</td>";
										echo "<td>". number_format($tot_transfer). "</td>";
									}
								echo "</tr>"; 
						}
								echo "<tr>";
									if($data)
									{ 
										echo "<td colspan='2' style='text-align:center'>TOTAL</td>";
										echo "<td>".number_format($tot_upah1). "</td>";
										echo "<td>".number_format($tot_lt1). "</td>";
										echo "<td>".number_format($tot_insentif1). "</td>";
										echo "<td>". number_format($tot_premi1). "</td>";
										echo "<td>". number_format($tot_lembur1). "</td>";
										echo "<td>". number_format($tot_absensi1). "</td>";
										echo "<td>". number_format($tot_lain_lain1). "</td>";
										echo "<td>". number_format($tot_bpjs_tk1). "</td>";
										echo "<td>". number_format($tot_bpjs_kes1). "</td>";
										echo "<td>". number_format($tot_spsi1). "</td>";
										echo "<td>". number_format($tot_koperasi1). "</td>";
										echo "<td>". number_format($tot_transfer1). "</td>";
									}
								echo "</tr>"; 
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

	function submit(){
		window.print();
	}

</script>
</body>
</html>