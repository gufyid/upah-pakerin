
<!-- page content -->
	<link rel="stylesheet" href="<?php echo base_url();?>./assets/css/colorbox.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>./assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" href="<?php echo base_url();?>./assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>./assets/css/ace-rtl.min.css" />

<div role="main">
  <div class="">
		<div class="page-title">
	
		</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">
	
	<div class="pull-right ">
	<?php
		if($persediaan)
		{
	?>
		<a href="<?php echo  base_url();?>./index.php/utama/report_csv_persediaan/<?php echo $mycode;?>"><i class="ace-icon fa fa-file-excel-o fa-2x green"></i></a>&nbsp;&nbsp;
		<a href="<?php echo  base_url();?>./index.php/utama/report_pdf_persediaan/<?php echo $mycode;?>"><i class="ace-icon fa fa-file-pdf-o fa-2x red"></i></a>&nbsp;&nbsp;
	<?php
		}
	?>
	</div>
	</div>
	<div>&nbsp;</div>
	<div class="table-header">
		Laporan Persediaan 
	</div> 
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		    <div class="col-xs-12 col-md-6 u-no-padding text-md-right text-xs-center">
				
			</div>
			<div class="x_title">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
						<th width="5%" style="text-align: center;">No</th>
						<th style="text-align: center;">Kode</th>
						<th style="text-align: center;">Nama</th>
						<th style="text-align: center;">No BON</th>
						<th style="text-align: center;">Tanggal</th>
						<th style="text-align: center;">Keterangan</th>
						<th style="text-align: center;">Masuk</th>
						<th style="text-align: center;">Keluar</th>
						<th style="text-align: center;">Saldo</th>
						</tr>
					</thead>
					<tbody>
					
					<?php
					if($persediaan)
					{
						$this->db->query("truncate t_saldo_transaksi");
						$no=0;
						foreach($persediaan as $d)
						{
							$no++;
							$code = $d['kode'];
							$nobon = $d['no_bon'];
							$nm = $this->db->query("select * from t_barang where kode = '$code'")->result_array();
							if($d['masuk'] > 0)
							{
								$sql = "select keterangan from t_masuk where kode = '$code' and no_bon = '$nobon'";								
							}else{
								$sql = "select keterangan from t_keluar where kode = '$code' and no_bon = '$nobon'";
							}
							
							$ket = $this->db->query($sql)->result_array();
								if(isset($ket[0]['keterangan']))
								{
									$keterangan = $ket[0]['keterangan'];
								}else{
									$keterangan = "";
								}
							if ($no == 1)
							{	
								$masuk = $d['masuk'];
								$saldo = ($masuk + $saldo_awal) - $d['keluar'];
								$this->db->query("insert into t_saldo_transaksi (kode,qty) values('$code','$saldo')");
							}else{
								$sld = $this->db->query("select qty from t_saldo_transaksi where kode = '$code'")->result_array();
								$masuk = $d['masuk'];
								$saldo = ($sld[0]['qty'] + $masuk) - $d['keluar'];
								$this->db->query("update t_saldo_transaksi set qty = '$saldo' where kode = '$code'");
							}
							
						
					?>
						<tr>
						<?php 
							if($no == 1)
							{
						?>
							<tr>
								<td colspan = "8" style="text-align: center;">Saldo Awal</td>
								<td><?php echo $saldo_awal;?></td>
							</tr>
							<td><?php echo $no;?></td>
							<td><?php echo $d['kode'];?></td>
							<td><?php echo $nm[0]['nama'];?></td>
							<td><?php echo $d['no_bon'];?></td>
							<td><?php echo date("d M Y", strtotime($d['tanggal']));?></td>
							<td><?php echo $keterangan;?></td>
							<td><?php echo $masuk;?></td>
							<td><font color = "red"><?php echo $d['keluar'];?></font></td>
							<td><?php echo $saldo;?></td>
						<?php
							}else{
						?>	
							<td><?php echo $no;?></td>
							<td><?php echo $d['kode'];?></td>
							<td><?php echo $nm[0]['nama'];?></td>
							<td><?php echo $d['no_bon'];?></td>
							<td><?php echo date("d M Y", strtotime($d['tanggal']));?></td>
							<td><?php echo $keterangan;?></td>
							<td><?php echo $masuk;?></td>
							<td><font color = "red"><?php echo $d['keluar'];?></font></td>
							<td><?php echo $saldo;?></td>
						<?php
							}
						?>							
						</tr>									
					<?php
						}
					}else{
						echo "<tr>";
						echo "<td>1</td>";
						echo "<td>".$mycode."</td>";
						echo "<td>".$nama_brg."</td>";
						echo "<td colspan = \"5\" style=\"text-align: center;\">Saldo</td>";
						echo "<td>".$saldo_awal."</td>";
						echo "</tr>";
					}
					?>																	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	

</div>
</div>
<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.colorbox.min.js"></script>

<script src="<?php echo base_url();?>./assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/ace.min.js"></script>


<script type="text/javascript">

	$('.show-details-btn').on('click', function(e) {
		e.preventDefault();
		$(this).closest('tr').next().toggleClass('open');
		$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
	});
	
	$(document).ready(function() {
			$('#table1').DataTable();
		});		
</script>

	
		