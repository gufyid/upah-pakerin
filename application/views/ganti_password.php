<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>

</head>

<body class="no-skin">


	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>


		<div class="main-content">
			<div class="main-content-inner">

				<div class="page-content">
					<div class="ace-settings-container" id="ace-settings-container">

					</div><!-- /.ace-settings-container -->

					<div class="page-header">
						<h1>
							Ganti Password
						</h1>
					</div><!-- /.page-header -->
					<?php echo $this->session->flashdata('pesan'); ?>

					<div class="row">
						<div class="col-xs-8">
							<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url(); ?>index.php/utama/ganti_password">

								<div class="space-4"></div>

								<div class="form-group">
									<label class="col-sm-5 control-label no-padding-right" for="form-field-2"> Masukkan Password Baru Anda </label>

									<div class="col-sm-7">
										<input type="password" name="password1" id="form-field-2" placeholder="Password " class="col-xs-10 col-sm-5" />
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
										<input type="hidden" name="user" value="<?php echo $user; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-5 control-label no-padding-right" for="form-field-2"> Masukkan lagi Password Baru Anda </label>

									<div class="col-sm-7">
										<input type="password" name="password2" id="form-field-2" placeholder="Password " class="col-xs-10 col-sm-5" />
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>

								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-primary" style="border-radius:50px">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>

										&nbsp; &nbsp; &nbsp;
										<button class="btn btn-danger" style="border-radius:50px" type="reset">
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

		<script src="<?php echo base_url(); ?>./assets/js/jquery-2.1.4.min.js"></script>
</body>

</html>