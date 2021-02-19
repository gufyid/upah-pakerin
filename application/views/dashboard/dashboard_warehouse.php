<html>
<head>
	<title></title>
</head>
<body>
<?php
	$sql = "select a.kode,a.no_po,a.vendor from t_po a
			left join t_tracking b on b.kode=a.kode 
			where a.dp='1' and a.status = '0' group by a.no_po order by a.kode";
	$res = $this->db->query($sql)->result_array();
	$data = array(
				'res' => $res,
				);
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
	
			<div class="col-sm-0 infobox-container">
			
			</div>
		
			<div class="vspace-12-sm"></div>
			<?php
				$this->load->view('note/position_warehouse');
				$this->load->view('note/alert_warehouse',$data);
			?>
	
	
			
		</div>


	</div><!-- /.widget-main -->
</div><!-- /.widget-body -->
</div><!-- /.widget-box -->
</div><!-- /.col -->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table2').DataTable({
		responsive : true,
		
		});
	});						
</script>		
</body>
</html>


