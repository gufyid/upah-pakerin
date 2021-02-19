<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>HR Solution - PT. Pabrik Kertas Indonesia</title>
	<link rel="shortcut icon" href="<?php echo base_url() ?>./asset/images/pakerin.ico" type="image/x-icon">

	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>./asset/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>./asset/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>./asset/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>./asset/css/ace.min.css" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="asset/css/ace-part2.min.css" />
		<![endif]-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>./asset/css/ace-rtl.min.css" />
	<script type="text/javascript">
		function stopRKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type == "text")) {
				return false;
			}
		}
		document.onkeypress = stopRKey;
	</script>

</head>

<body class="login-layout light-login">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h2>
								<i class="ace-icon fa fa-users blue"></i>
								<span class="red">HR</span>
								<span class="white" id="id-text2">Solution</span>
							</h2>
							<h4 class="blue" id="id-company-text">&copy; PT. Pabrik Kertas Indonesia</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<?php
										echo "<center><font color=red>" . $this->session->flashdata('message') . "</font></center>";
										?>
										<h4 class="header blue lighter bigger">
											<i class="ace-icon fa fa-lock green"></i>
											Please Login
										</h4>

										<div class="space-6"></div>

										<?php echo form_open("login/process_login"); ?>
										<fieldset>
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" autofocus />
													<i class="ace-icon fa fa-user"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" name="password" id="password" class="form-control" placeholder="Password" />
													<i class="ace-icon fa fa-lock"></i>
												</span>
											</label>

											<div class="space"></div>

											<div class="clearfix">
												<button class="width-35 pull-right btn btn-sm btn-primary" style="border-radius:50px">
													<i class="ace-icon fa fa-key"></i>
													<span class="bigger-110">Login</span>
												</button>
											</div>

											<div class="space-4"></div>
										</fieldset>
										<?php echo form_close(); ?>

									</div><!-- /.widget-main -->


								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->


						</div><!-- /.position-relative -->

					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>

	<!-- <![endif]-->

</body>
<script>
	$(document).ready(function() {
		$('#username').on('keypress', function(e) {
			if (e.which == 13) {
				$('#password').focus();
			}
		});
	});
</script>

</html>