<html>
<head>
	<title></title>
</head>
<body>
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
				$this->load->view('note/position_finance');
				$this->load->view('note/alert_finance');			
			?>			
		</div>
	</div><!-- /.widget-main -->
</div><!-- /.widget-body -->
</div><!-- /.widget-box -->
</div><!-- /.col -->
</div>
<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#table2').DataTable({
						responsive : true,
			
			});
		});		
		
		
				
</script>	
</body>
</html>


