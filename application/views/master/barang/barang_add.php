<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>

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
								Barang Baru
							</h1>
						</div><!-- /.page-header -->
						<?php echo $this->session->flashdata('pesan'); 
						?>

						<div class="row">
							<div class="col-xs-8">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal"  method="POST" 
								action="<?php echo base_url();?>index.php/utama/simpan_barang">
								
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Kode</label>

										<div class="col-sm-7">
											<input type="text" name="kode" id="kode" placeholder="Kode Barang " class="col-xs-10 col-sm-5" autofocus />
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
											<input type="hidden" name="user" value="<?php echo $user;?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> Nama</label>

										<div class="col-sm-7">
											<input type="text" name="nama" id="nama" placeholder="Nama Barang" class="col-xs-10 col-sm-15" />
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Satuan</label>
										<div class="col-sm-7">
											<select class="col-xs-10 col-sm-5" name="satuan" id="satuan">
												<option value="">Pilih</option>
												<option value="buah">BH</option>
												<option value="set">SET</option>
											</select>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Lokasi 1</label>
										<div class="col-sm-7">
											<select class="col-xs-10 col-sm-5" name="lokasi1" id="lokasi1">
												<option value="" selected="selected">Pilih</option>
												<?php
													$barang = $this->db->query("select 	distinct lokasi1 from t_barang order by nama")->result_array();
													foreach($barang as $d)
													{
														echo "<option value=".$d['lokasi1'].">".$d['lokasi1']."<option>";
													}
												?>
											</select>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>

									<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Lokasi 2</label>
										<div class="col-sm-7">
											<select class="col-xs-10 col-sm-5" name="lokasi2" id="lokasi2"  multiple >
												<option value="" selected="selected">Pilih</option>
												<?php
													$barang = $this->db->query("select * from t_barang")->result_array();
													foreach($barang as $d)
													{														
														echo "<option value=$d[lokasi2]>$d[lokasi2]<option>";
													}
												?>
											</select>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Kondisi</label>
										<div class="col-sm-7">
											<select class="col-xs-10 col-sm-5" name="kondisi" id="kondisi">
												<option value="">Pilih</option>
												<option value="1">Baik</option>
												<option value="0">Rusak</option>
											</select>
											<span class="help-inline col-xs-12 col-sm-7">
											</span>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Simpan
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Batal
											</button>
										</div>
									</div>	
									
								</form>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
	<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
	</body>
</html>