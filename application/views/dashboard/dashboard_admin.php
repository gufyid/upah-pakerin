<html>
<head>
	<title></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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
		<!-- PAGE CONTENT BEGINS -->
		<div class="alert alert-block alert-success">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>

			<i class="ace-icon fa fa-check green"></i>

			Welcome to
			<strong class="green">
				Tracking Product DBL INDONESIA 
				<small>(v1.0)</small>
			</strong>
		</div>
	

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
						
						<div class="widget-body" >
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
					$this->load->view('note/position_admin');
				?>				
		

		
		<div class="hr hr32 hr-dotted"></div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery-ui.custom.min.js"></script>

<script type="text/javascript">
		$(document).ready(function() {
			$('#table2').DataTable({
						responsive : true,
			
			});
		});		
		
		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
				
</script>
</body>
</html>	