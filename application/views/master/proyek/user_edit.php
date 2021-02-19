<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./assets/js/ace.min.js"></script>	
	</head>

	<body class="no-skin">
		

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div class="main-content">
				<div class="main-content-inner">
					
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								Edit User
							</h1>
						</div><!-- /.page-header -->
						<?php echo $this->session->flashdata('pesan'); 
						?>

						<div class="row">
							<div class="col-xs-8">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal"  method="POST" 
								action="<?php echo base_url();?>index.php/utama/simpan_user_edit" enctype="multipart/form-data">
								
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-2">User Name</label>

										<div class="col-sm-7">
											<input type="text"  autocomplete="off" name="code" id="code" placeholder="User Name" class="col-xs-10 col-sm-5" value="<?php echo $kode;?>"/>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
											<input type="hidden" name="user" value="<?php echo $user;?>">
											<input type="hidden" name="fotoh" value="<?php echo $foto;?>">
										</div>
									</div>
											
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-2"> Name </label>

										<div class="col-sm-7">
											<input type="text"  autocomplete="off" name="name" id="name" placeholder="Nama User " class="col-xs-10 col-sm-5" value="<?php echo $pengguna;?>"/>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-2">Bagian</label>

										<div class="col-sm-7">
											<select class="col-xs-10 col-sm-5" name="bagian" id="bagian">
												<option value="">Pilih</option>
													<?php
														foreach($bagian as $d)
														{
															if($d['kode'] == $bagian1)
															{
																echo "<option value=$d[kode] selected=\"selected\">$d[nama]</opion>";
															
															}else{
																echo "<option value=$d[kode]>$d[nama]</opion>";
															}
														}
													?>
											</select>
												
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>
									
				
									
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-2">Foto</label>
											<div class="col-sm-3">
												<input type="file" name="foto" id="foto" /> 
											</div>
											<label class="col-sm-4 control-label no-padding-left" for="form-field-2">Size <= 2 MB &nbsp;&nbsp;jpeg|jpg|png</label>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>	
									
								</form>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
	<script>
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
		return true;
	}
	
	jQuery(function($){
		$('#img1,#foto').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
		});
	 
		
		  $(".add-more").click(function(){ 
			  var html = $(".copy").html();
			  $(".after-add-more").after(html);
		  });
		  $("body").on("click",".remove",function(){ 
			  $(this).parents(".form-group").remove();
		  });
	});	
	</script>
	</body>
</html>