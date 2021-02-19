<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	

</style>
</head>
<body class="no-skin">
	<center>
		<span id="pesan"></span>
	</center>

<div class="main-container ace-save-state" id="main-container">
	<div class="panel panel-success">			
		<div class="panel-heading">
			<h2 class="panel-title">
				Karyawan Mengundurkan Diri
			</h2>
		</div>
	 
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
				<form class="form-horizontal"  method="POST" 
					 enctype="multipart/form-data" id="form_import">
						<div class="space-4"></div>

						<div class="form-group">
							<div class="col-xs-12 col-sm-12">
								<input type="text" name="noinduk" placeholder="Masukkan No Induk">
							</div>
						</div>
														
				</form>

				</div><!-- /.col -->
			</div><!-- /.row -->
				<span id='hasil'></span>
		</div>	
	</div>		
</div>
<div class="modal fade" id="modal1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-dialog-centered">
				<img src="<?php echo base_url().'asset/images/warning/absen_bulanan.jpg' ?>">
		</div>
	</div>
</div>

<div class="modal fade modal-transparent" id="modal2" role="dialog" data-backdrop="static" data-keyboard="false">
	
				<center><img src="<?php echo base_url().'asset/images/gear4.gif' ?>" width="250" height="250"><h4><font color="white">Please Wait!!!!!!!</font><h4></center>	
		
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('[name=noinduk]').val('');	
		$('#table1').dataTable({
			responsive : true
		});
		$('[name=noinduk]').focus();	
		$('[name=noinduk]').keydown(function(e){
			var key = e.which;	
			if(key == 13)
			{	
				loadData();
			}
		})	
	})

	function loadData()
	{
		$.ajax({
			type	: 'POST',
			url 	: '<?php echo base_url()."index.php/utama/ambil_karyawan" ?>',	
			data 	: 
			{
				noinduk : $('[name=noinduk]').val()
			},
			success 	: function(data)
			{
				$('#hasil').html(data);		
				$('[name=noinduk]').val('');
					
			}
		})
	}
</script>
</body>
</html>