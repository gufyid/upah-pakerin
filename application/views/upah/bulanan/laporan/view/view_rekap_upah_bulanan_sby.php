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
				<a href="#" onclick='print()'><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;	
				<a href="<?php echo base_url()?>./index.php/bulanan/lap_rekap_upah_bulanan_sby_excell/<?php echo $bulan?>/<?php echo $tahun?>/<?php echo $status?>/<?php echo $pabrik?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	
			</div>
	</div>
	<div class="row">	
		<div class="col-xs-12 center">
			<h4>LAPORAN REKAP UPAH KARYAWAN BULANAN PT. <?php echo $pabrik.'  '.$status ?> (utk Surabaya) <br/>
			BULAN : <?php echo $bul[$bulan] ." ".$tahun ?></h4>		
		</div>	

		<div class="col-xs-12">
			<table class="display" border="1" style="width:100%">
				<thead >
					<tr>
						<th>No</th>
						<th>Seksi</th>
						<th>Jumlah Orang</th>
						<th>Transfer</th>
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
								echo "<td style='text-align:center'>". $no ."</td>";
								echo "<td style='text-align:left'>";
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
					<?php if($data){ ?>
						<td colspan="2" style="text-align:center">TOTAL</td>
						<td><?php echo number_format($tot_org); ?></td>
						<td><?php echo number_format($tot_transfer); ?></td>
					<?php } ?>
					</tr>
				</tfoot>
			</table>
			<div class="col-xs-5 right">,</div>
			<div class="col-xs-4 right"></div>
			<div class="col-xs-3 right">Bangun, <?php echo date('d M Y');?></div>
			<div class="row">
			<div class="col-xs-2 "></div>
			<div class="col-xs-3 ">Disetujui,</div>
			<div class="col-xs-4 ">Diperiksa,</div>
			<div class="col-xs-3 ">Dibuat,</div>
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

		function print()
		{
			window.print();
		}
	})
</script>
</body>
</html>