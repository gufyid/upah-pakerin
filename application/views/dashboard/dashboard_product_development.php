<html>
<head>
	<title></title>
	
</head>
<body>
<?php
	$sql1 = "select * from(
				select * from t_tracking where id in(select max(id) from t_tracking group by kode) 
				and posisi = 'voting' order by id)
				as x
				where kode in (select kode from t_product where status_vote1 ='0')";
	$sql2 = "select * from t_tracking where id in(select max(id) from t_tracking group by kode) 
			 and posisi = 'create sampling' order by id";
				
	$res1 = $this->db->query($sql1)->result_array();
	$res2 = $this->db->query($sql2)->result_array();
	$reject = $this->db->query("select * from t_product where status_vote1='1' and status_vote2='0'")->result_array();
?>
<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			DBL INDONESIA
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<div class="row">
				<div class="col-sm-12">
					<div class="widget-box collapsed">
						<div class="widget-header">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-sitemap"></i>
								Flow Diagram Web Tracking System
							</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-down"></i>
								</a>

								<a href="#" data-action="close">
									<i class="ace-icon fa fa-times"></i>
								</a>
							</div>
						</div>
						
						
						<div class="widget-body">
						<br/>
						<center><img width="60%" src="<?php echo base_url();?>./assets/images/flow.jpg"></img></center>
						<br/>&nbsp;
						</div>
					</div>
				</div>
		</div>
			
<div class="row">
		<div class="space-6"></div>

		<div class="col-sm-5 infobox-container">
			
		</div>
	
		<div class="vspace-12-sm"></div>
			<?php
				$this->load->view('note/position_product_development');		
			?>

		<div class="row">
			<div class="space-6"></div>
	
			<div class="col-sm-0 infobox-container">
				
			</div>
		
			<div class="vspace-12-sm"></div>
			<div class="col-sm-6">
				<div class="widget-box">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
							<i class="ace-icon fa fa-bullhorn"></i>
							<font color=red>Alert!!!</font>
							</h5>

						<div class="widget-toolbar no-border">
						
						</div>
					</div>

					<div class="widget-body">
						<div class="widget-main">
						<?php
							if($res1){
						?>						
							Ada Product yang harus di buatkan Sampling <a href="<?php echo base_url();?>./index.php/utama/panggil/sampling"> klik disini untuk sampling</a>
						<?php
							}
						?>							

						<div class="hr hr8 hr-double"></div>
						<?php
							if($res2){
						?>						
							Ada Product yang harus di upload gambar samplinnya <a href="<?php echo base_url();?>./index.php/utama/panggil/sampling_on_hand"> klik disini untuk upload sampling</a>
						<?php
							}
						?>	
						<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			

		</div><!-- /.row -->



	</div><!-- /.widget-main -->
</div><!-- /.widget-body -->
</div><!-- /.widget-box -->
</div><!-- /.col -->
</div>
		
<div class="hr hr32 hr-dotted"></div>

		<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#table2').DataTable({
					responsive : true,
		
		});
	});						
</script>		

</body>
</html>

