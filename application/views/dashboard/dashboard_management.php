<html>
<head>
	<title></title>
</head>
<body>
<?php
	$sql = "select * from(
					select * from(
						select * from t_tracking where id in(select max(id) from t_tracking group by kode) 
						and posisi = 'qty order' order by id)
						as x
						where kode in (select kode from t_product where status_product ='0')) as y
				left join t_product on  t_product.kode=y.kode where t_product.approved_by='$user' and approve2='0'";
	
	$res = $this->db->query($sql)->result_array();
	$daftar = $this->db->query("select * from t_product where approved_by='$user'")->result_array();
	$data = array(
				'res' => $res,
				)
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
					<div class="widget-header widget-header-flat widget-header-small">
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
						<div class="widget-main">
							<br/>
							<center><img width="60%" src="<?php echo base_url();?>./assets/images/flow.jpg"></img></center>
							<br/>&nbsp;					
						<div class="clearfix"></div>
						</div>
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
				$this->load->view('note/position_management',$data);
				$this->load->view('note/alert_management',$data);
			
			?>
		
			
			
				</div>
			</div>
			
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


