<html>
<head>
<title></title>
	<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
	
</head>
<body>

<div class="page-header">
	
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<div class="row">
				
			<div class="col-sm-6">
				<div class="widget-box">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
							<i class="ace-icon fa fa-signal"></i>
							Laporan Persediaan
						</h5>
					</div>

					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal"  method="POST" 
								action="<?php echo base_url();?>index.php/utama/report_persediaan/hasil_report_persediaan" enctype="multipart/form-data" />
								<div class="space-4"></div>
								<div class="form-group"></div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Barang</label>
									<div class="col-sm-7">
										<input type="text" id="barang1" placeholder = "Cari Barang"/>
										<select name="kode" id="kode"  class="col-xs-10 col-sm-10" multiple />
										<option value="">Pilih</option>
										<?php
											foreach($barang as $d)
											{
													echo "<option value=".$d['kode'].">".$d['kode']."-".$d['nama']."</option>";
											}
										?>
										</select>
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" id="proses">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Proses
										</button>
									</div>
								</div>	
							</form>
							<div class="hr hr8 hr-double"></div>

						<div class="x_title">
			
						</div>
						</div><!-- /.widget-main -->
					</div><!-- /.widget-body -->
				</div><!-- /.widget-box -->
			</div><!-- /.col -->
		</div><!-- /.row -->


		
		<div class="hr hr32 hr-dotted"></div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#table1').DataTable();
		});	

		$('#barang1').keyup(function () {
		  var valthis = $(this).val().toLowerCase();
		  var num = 0;
		  $('select#kode>option').each(function () {
			  var text = $(this).text().toLowerCase();
			  if(text.indexOf(valthis) !== -1)  
				  {$(this).show(); $(this).prop('selected',true);}
			  else{$(this).hide();}
			   });
		});		
</script>
</body>
</html>
