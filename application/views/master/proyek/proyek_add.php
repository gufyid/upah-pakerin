<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
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
							New Proyek
						</h1>
					</div><!-- /.page-header -->
					<?php echo $this->session->flashdata('pesan');
					?>

					<div class="row">
						<div class="col-xs-8">
							<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" method="POST" action="<?= site_url('utama/simpan_proyek') ?>" />
							<div class="space-4"></div>

							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-2"> Nama Proyek </label>
								<div class="col-sm-7">
									<input type="text" autocomplete="off" name="proyek" id="proyek" placeholder="Nama Proyek " class="col-xs-10 col-sm-5" />
									<span class="help-inline col-xs-12 col-sm-7">
									</span>
								</div>
							</div>

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
		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
		jQuery(function($) {
			$('#img1,#foto').ace_file_input({
				no_file: 'No File ...',
				btn_choose: 'Choose',
				btn_change: 'Change',
				droppable: false,
				onchange: null,
				thumbnail: false //| true | large
				//whitelist:'gif|png|jpg|jpeg'
				//blacklist:'exe|php'
				//onchange:''
				//
			});


			$(".add-more").click(function() {
				var html = $(".copy").html();
				$(".after-add-more").after(html);
			});
			$("body").on("click", ".remove", function() {
				$(this).parents(".form-group").remove();
			});


		});
	</script>
</body>

</html>