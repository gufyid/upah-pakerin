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
	
		/*.modal-dialog {
		    width: 100%;
		    height: 100%;
		    padding: 0;
		    margin: :0;
		}
		.modal-content {
		    height: 100%;
		    border-radius: 0;
		    color:#333;
		    overflow:auto;
		}
		.modal-title {
		    font-size: 3em;
		    font-weight: 300;
		    margin: 0 0 10px 0;
		}*/
</style>

</head>
<body >
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
<div role="main" class="printable">	
	<div class="row">
			<div class="col-md-6">			
			</div>
			<div class="col-md-5">			
			</div>
			<div class="col-md-1">
				<a href="#" onclick=submit('<?php echo $bulan.','.$tahun.','.$status ?>');><i class="ace-icon fa fa-print fa-2x"></i></a>&nbsp;&nbsp;			
				<a href="<?php echo base_url()?>./index.php/bulanan/lap_rekap_upah_bulanan_excell/<?php echo $bulan?>/<?php echo $tahun?>/<?php echo $status?>/<?php echo $pabrik ?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>	
			</div>
	</div>
	<div class="row">
		<div class="col-xs-12 center">
				<h4>REKAPITULASI UPAH BULANAN <?php echo $status ?> PT. <?php echo $pabrik ?> <br/>
				BULAN : <?php echo $bul[$bulan] ." ".$tahun ?></h4>		
		</div>	
		<div class="col-xs-12">
			<table class="display" border="1" style="width:100%">
				<thead >
					<tr>
						<th>No</th>
						<th>Seksi</th>
						<th>UPAH</th>
						<th>PREMI</th>
						<th>POT. LAIN</th>
						<th>ABSENSI</th>
						<th>BPJS-TK</th>
						<th>BPJS-KES</th>
						<th>SPSI</th>
						<th>KOPERASI</th>
						<th>JUMLAH</td>
					</tr>
				</thead>
				<tbody>
					<?php  
						$no =0;
						$tot_upah ='';
						$tot_premi ='';
						$tot_pot_lain ='';
						$tot_absensi ='';
						$tot_bpjs_tk ='';
						$tot_bpjs_kes ='';
						$tot_spsi ='';
						$tot_koperasi ='';
						$tot_jumlah ='';

					if ($data){
						foreach($data as $d)
						{
							$no++;
							$kdseksi = $d['seksi'];
							$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
							$jumlah = ($d['upah'] + $d['premi']) - ($d['absensi'] + $d['bpjs_tk'] + $d['bpjs_kes'] + $d['spsi'] + $d['koperasi']);
							echo "<tr>";
								echo "<td style='text-align:center'>". $no ."</td>";
								echo "<td  style='text-align:left'>";
								 	echo $seksi[0]['nama'];
								echo "</td>";
								echo "<td>". number_format($d['upah'])."</td>";
								echo "<td>". number_format($d['premi']) ."</td>";
								echo "<td>". number_format($d['pot_lain'])."</td>";
								echo "<td>". number_format($d['absensi']) ."</td>";
								echo "<td>". number_format($d['bpjs_tk']) ."</td>";
								echo "<td>". number_format($d['bpjs_kes']) ."</td>";
								echo "<td>". number_format($d['spsi']) ."</td>";
								echo "<td>". number_format($d['koperasi']) ."</td>";
								echo "<td>".number_format($jumlah)."</td>";
							echo "</tr>";
							$tot_upah += $d['upah'];
							$tot_premi += $d['premi'];
							$tot_pot_lain += $d['pot_lain'];
							$tot_absensi += $d['absensi'];
							$tot_bpjs_tk += $d['bpjs_tk'];
							$tot_bpjs_kes += $d['bpjs_kes'];
							$tot_spsi += $d['spsi'];
							$tot_koperasi += $d['koperasi'];
							$tot_jumlah += $jumlah;
						}
					}
					 ?>		
						<!--  <tr>
						 	<td colspan="2">TOTAL</td>
						 	<td><?php echo number_format($tot_upah); ?></td>
						 	<td><?php echo number_format($tot_premi); ?></td>	
						 	<td><?php echo number_format($tot_pot_lain); ?></td>	
						 	<td><?php echo number_format($tot_absensi); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_tk); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_kes); ?></td>	
						 	<td><?php echo number_format($tot_spsi); ?></td>	
						 	<td><?php echo number_format($tot_koperasi); ?></td>	
						 	<td><?php echo number_format($tot_jumlah); ?></td>							 		
						 </tr>	 -->
				</tbody>
				
					 <tr>
					 <?php if($data){ ?>
						 	<td colspan="2" style="text-align:center">TOTAL</td>
						 	<td><?php echo number_format($tot_upah); ?></td>
						 	<td><?php echo number_format($tot_premi); ?></td>	
						 	<td><?php echo number_format($tot_pot_lain); ?></td>	
						 	<td><?php echo number_format($tot_absensi); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_tk); ?></td>	
						 	<td><?php echo number_format($tot_bpjs_kes); ?></td>	
						 	<td><?php echo number_format($tot_spsi); ?></td>	
						 	<td><?php echo number_format($tot_koperasi); ?></td>	
						 	<td><?php echo number_format($tot_jumlah); ?></td>						
						<?php } ?>	 		
						 </tr>	 
				
			</table>
			<div class="col-xs-5 right">,</div>
			<div class="col-xs-4 right"></div>
			<div class="col-xs-3 right">Bangun, <?php echo date('d M Y');?></div>
			<div class="row">
			<div class="col-xs-5 "></div>
			<div class="col-xs-2 ">Disetujui,</div>
			<div class="col-xs-2 ">Diperiksa,</div>
			<div class="col-xs-3 ">Dibuat,</div>
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="print" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-dialog-centered">
				<div class="modal-header">
					<h2>Hello</h2>
				</div>
				<table class="table" id="table1">
					<thead id="target1">
						
					</thead>
					<tbody id="target">
					</tbody>
					<tfoot>
						<tr>
							<td>
								
							</td>
						</tr>
					</tfoot>
				</table>
				<!--<input type="button" name="cetak" id="cetak" class="btn btn-primary" value="Cetak" onclick="window.print()">-->
		</div>
	</div>
</div>

	<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
	$('document').ready(function(){
		$('#table1').dataTable({
			 dom: 'Bfrtip',
        buttons: [
            'print'
        ]
		//	responsive : true
			/* dom: 'Bfrtip',
	        buttons: [
	            {
	                extend: 'print',
	                customize: function ( win ) {
	                    $(win.document.body)
	                        .css( 'font-size', '10pt' )
	                        .prepend(
	                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:20; left:0;" />'
	                        );
	 
	                    $(win.document.body).find( 'table' )
	                        .addClass( 'compact' )
	                        .css( 'font-size', 'inherit' );
	                }
	            }
        	]*/
    	} );
	});
	function submit(x){
		$('#print').modal('hide');
		
		var pecah  = x.split(",");
		var bulan  = pecah[0];
		var tahun  = pecah[1];
		var status = pecah[2];
		//alert(bulan+tahun+status);

		$.ajax({
			type : 'POST',
			url  : '<?php echo base_url()."index.php/bulanan/print_rekap_upah_bulanan" ?>',
			data : 'bulan='+bulan+'&tahun='+tahun+'&status='+status,
			dataType : 'json',
			success :function(data){
				//console.log(data);
				var baris = '';
				var baris1 = '';

				baris1 += '<tr>' +
							'<td>Seksi</td>' +
							'<td>UPAH</td>' +
							'<td>PREMI</td>' +
							'<td>POT. LAIN</td>' +
							'<td>ABSENSI</td>' +
							'<td>BPJS-TK</td>' +
							'<td>BPJS-KES</td>' +
							'<td>SPSI</td>' +
							'<td>KOPERASI</td>' +
							'<td>JUMLAH</td>' +
						'</tr>';
				$('#target1').html(baris1);		
				for(var i=0;i<data.length;i++)
				{
					baris +='<tr>' +
								'<td>'+ data[i].seksi + '</td>' +
								'<td>'+ data[i].upah + '</td>' +
								'<td>'+ data[i].premi + '</td>' +
								'<td>'+ data[i].pot_lain + '</td>' +
								'<td>'+ data[i].absensi + '</td>' +
								'<td>'+ data[i].bpjs_tk + '</td>' +
								'<td>'+ data[i].bpjs_kes + '</td>' +
								'<td>'+ data[i].spsi + '</td>' +
								'<td>'+ data[i].koperasi + '</td>' +
								'<td>-</td>' +
							'</tr>';	
				}
				$('#target').html(baris);
				//alert('sukses');
				window.print();
			}
		});
	}

	$('.modal').on('show',function(){
		window.print();
	})


</script>
</body>
</html>