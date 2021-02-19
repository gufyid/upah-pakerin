<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>

</head>
<body class="no-skin">
	<center><span id="pesan"></span></center>
<div class="main-container ace-save-state" id="main-container">
	<div class="main-content">
		<div class="main-content-inner">
			
			<div class="page-content">
				<div class="ace-settings-container" id="ace-settings-container">
					
				</div><!-- /.ace-settings-container -->

				<div class="page-header">
					<h4>Laporan Rekap Upah Lembur Bulanan Per Seksi </h4>
				</div><!-- /.page-header -->
				

				<div class="row">
					<div class="col-xs-8">
						<!-- PAGE CONTENT BEGINS -->
					<form class="form-horizontal"  method="POST" 
						 enctype="multipart/form-data" id="form_lt">
							<div class="space-4"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Bulan</label>
								<div class="col-sm-7">
								<?php
									$bulan=array("1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni",
												 "7"=>"Juli","8"=>"Agustus","9"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
								?>
									<select class="col-xs-10 col-sm-5" name="bulan" id="bulan">
										<option value="">Pilih Bulan... </option>
										<?php
										
											for($i=1;$i<=12;$i++)
											{
											echo "<option value=$i>".$bulan[$i]."</option>";
											}
											
										
										?>
									</select>		
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>
									
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Tahun</label>
								<div class="col-sm-7">
									<select class="col-xs-10 col-sm-5" name="tahun" id="tahun">
										<option value="">Pilih Tahun...</option>
										<?php
									//	$last = date("Y")-1;
										$last = date("Y")-1;
									//	for($i=$last;$i<=$last+2;$i++)
										for($i=$last;$i<=$last+1;$i++)
										{
											echo "<option value=$i>$i</option>";	
										}								
										?>
									</select>		
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

							<div class="clearfix">
								<div class="col-md-offset-0 col-md-9">
									<input type="submit" class="btn btn-info" id="proses" name="proses" value="Proses">
								</div>
							</div>	
							
					</form>
					<hr />

					</div><!-- /.col -->
				</div><!-- /.row -->
				</div>
			</div><!-- /.page-content -->
		</div>
	</div><!-- /.main-content -->
<div class="modal fade modal-transparent" id="mymodal" role="dialog" data-backdrop="static" data-keyboard="false">
	<center><img src="<?php echo base_url().'asset/images/gear4.gif' ?>" width="250" height="250"><h4><font color="white">Please Wait!!!!!!!</font><h4></center>	
</div>

<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

		$('#proses').click(function(){
			var bulan = $('[name=bulan]').val();
			var tahun = $('[name=bulan]').val();
			$.ajax({
				type : 'POST',
				url  : '<?php echo base_url()."index.php/mingguan/proses_lap_lembur_bulanan" ?>',
				data : {
					bulan 	: $('[name=bulan]').val(),
					tahun 	: $('[name=tahun]').val()
				},
				dataType : 'json',
				
				beforeSend : function(){
					//$("#mymodal").modal('show');
				},
				success : function(data){
				//	$("#mymodal").modal('hide');
					//$('#pesan').html(data.pesan);
					alert('sukses');
				}
			});
		})
	
</script>
</body>
</html>