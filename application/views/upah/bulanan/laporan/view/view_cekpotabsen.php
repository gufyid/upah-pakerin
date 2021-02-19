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
		$bulan1 = $bulan + 1;
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
				<a href="#" onclick='print()'><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;
				<!-- <a href="<?php echo base_url()?>./index.php/bulanan/lap_rekap_upah_bulanan_sby_org_excell/<?php echo $bulan?>/<?php echo $tahun?>/<?php echo $status ?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	 -->
			</div>
	</div>
	<div class="row">
	<div class="col-xs-12">
			<h4 class="text-center">DAFTAR POTONGAN ABSENSI KARYAWAN BULANAN PT. PAKERIN  <br/>
			 <?php echo $bul[$bulan] ." ".$tahun ?></h4>		
	</div>		
		<div class="col-xs-12">
			<table class="display" border="1" style="width:100%">
				<thead >
					<tr>
						<th>SEKSI</th>
						<th>NO</th>
						<th>NAMA</th>
						<th><?php echo $bul[$bulan]; ?></th>
						<th><?php echo $bul[$bulan1]; ?></th>
						<th>JUMLAH</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					
					foreach($data as $d)
					{
						$no=0;
						$totpot = '';
						$seksi   = $d['seksi'];
						$nmseksi = $d['nama'];
						$sql = "SELECT a.*,b.nama,b.seksi,c.nama AS nmseksi ,d.pot_absen FROM t_premi_bulanan a
						    LEFT JOIN t_karyawan b ON b.noinduk=a.noinduk
							LEFT JOIN t_seksi c ON c.kode=b.seksi
							LEFT JOIN t_gaji_bulanan d ON d.noinduk=a.noinduk
							WHERE a.bulan='$bulan' AND a.tahun='$tahun' AND d.bulan='$bulan' AND d.tahun='$tahun' and b.seksi='$seksi' AND d.pot_absen != 0  	ORDER BY c.nama ";
						$potlain = $this->db->query($sql)->result_array();
						if($potlain)
						{
							foreach($potlain as $p)
							{	
							
									$no++;
									echo "<tr>";
										echo "<td class=text-left>".$p['nmseksi']."</td>";
										echo "<td class=text-center>".$no."</td>";
										echo "<td class=text-left>".$p['nama']."</td>";
										echo "<td class=text-center> </td>";
										echo "<td class=text-center>".number_format($p['pot_absen'])."</td>";
										echo "<td class=text-center>".number_format($p['pot_absen'])."</td>";
									echo "</tr>";
								
								$totpot += $p['pot_absen'];
								
							}
							
								echo "<tr>";
									echo "<td colspan='5'><b>SUB TOTAL ".$nmseksi."</b></td>";
									echo "<td class=text-center><b>".number_format($totpot)."</b></td>";
								
								echo "</tr>";
						}
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