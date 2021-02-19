<?php
	$cek = $this->db->query("select * from t_perusahaan")->num_rows();
?>
<!-- page content -->
<div role="main">
  <div class="">
		<div class="page-title">
		 			
		  <?php echo $this->session->flashdata('pesan');?>

		</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">
	<div class="pull-right "><i>&nbsp;</i></div>
	</div>
	
	<div class="table-header">
		Master Perusahaan
		<?
			if($cek<=0){
		?>
		<div class="pull-right"><a style="color:#ffffff" href="<?php echo base_url()."index.php/utama/panggil/perusahaan_add";?>">
		<i class="ace-icon fa fa-plus ">&nbsp;New&nbsp;&nbsp;</i></a></div>
			<?php
			}
			?>
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
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Address1</th>
							<th style="text-align: center;">Phone1</th>
							<th style="text-align: center;">Address2</th>
							<th style="text-align: center;">Phone2</th>
							<th width="15%" style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						foreach($perusahaan as $d)
						{
							$no++;
					?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $d['nama'];?></td>
							<td><?php echo $d['alamat1'];?></td>
							<td><?php echo $d['telp1'];?></td>
							<td><?php echo $d['alamat2'];?></td>
							<td><?php echo $d['telp2'];?></td>
							
							<td>
								<a href="<?php echo base_url()."index.php/utama/perusahaan_edit/perusahaan_edit/".$d['id'];?>"><i class="ace-icon fa fa-edit ">&nbsp; Edit </i></a>
							</td>
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


	
		