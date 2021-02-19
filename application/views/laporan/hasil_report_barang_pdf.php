<!-- page content -->
<html>
<head>
	<title></title>
</head>
<body>
<div role="main">
  <div class="">
		<div class="page-title">
		 			
		  <?php echo $this->session->flashdata('pesan');?>

		</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">
	<div class="pull-right ">
	</div>
	</div>
	
	<div class="table-header">
		Daftar Barang
	</div>
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		    <div class="col-xs-12 col-md-6 u-no-padding text-md-right text-xs-center">
				
			</div>
			<div class="x_title">
				<table class="table table-striped table-bordered table-hover" id="table1">
					<thead>
						<tr>
							<th width="5%" style="text-align: center;">No</th>
							<th style="text-align: center;">Kode</th>
							<th style="text-align: center;">Nama</th>
							<th style="text-align: center;">Satuan</th>
							<th style="text-align: center;">Kondisi</th>
							<th style="text-align: center;">Lokasi</th>
							<th style="text-align: center;">Saldo</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						foreach($data as $d)
						{
							$no++;
							$kode = $d['kode'];
							$cek = $this->db->query("select * from t_saldo_akhir where kode = '$kode'")->num_rows();
							if($cek > 0)
							{
								$sld = $this->db->query("select * from t_saldo_akhir where kode = '$kode'")->result_array();
								$saldo = $sld[0]['qty'];
							}else{
								$sld = $this->db->query("select * from t_saldo_awal where kode = '$kode'")->result_array();

									$saldo = $sld[0]['qty'];
							}
					?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $d['kode'];?></td>
							<td><?php echo $d['nama'];?></td>
							<td><?php echo $d['satuan'];?></td>
							<td>
								<?php
									if($d['kondisi'] == '1')
										{
											echo "Rusak";
										}else{
											echo "Baik";
										}
								?>
							</td>
							<td><?php echo $d['lokasi1']." - ". $d['lokasi2'];?></td>
							<td><?php echo $saldo;?></td>
						</tr>
					<?php
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
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#table1').DataTable();
			});
			
			
</script>
</body>
</html>	


	
		