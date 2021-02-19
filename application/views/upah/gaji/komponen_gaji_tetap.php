<!DOCTYPE html>
<html>
<head>
	<title></title>

<style rel="stylesheet" type="text/css" href="<?php echo base_url();?>./asset/css/bootstrap.min.css"></style>
<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>


</head>
<body>
<div role="main">
  <div class="">
		<div class="page-title">
		</div>
	<div class="clearfix">
	</div>
	<br />
	<div class="table-header">
		KOMPONEN GAJI TETAP
	</div>
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		    <div class="col-xs-12 col-md-6 u-no-padding text-md-right text-xs-center">
			</div>
			<div class="x_title">
				<table class="table table-striped table-bordered table-hover" id="table1">
					<thead>
						<tr>
							<th style="text-align: center;">UMK</th>
							<th style="text-align: center;">T. MAKAN</th>
							<th style="text-align: center;">SPSI</th>				
							<th width="20%" style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						
					<?php
						$no=0;
						foreach($kompgajitetap as $d)
						{
					?>
						<tr>
							<td><?php echo number_format($d['ump'],2);?></td>
							<td><?php echo number_format($d['t_makan']);?></td>
							<td><?php echo number_format($d['spsi']);?></td>

							<td>
								<a href="#frmgaji" data-toggle="modal" class="btn btn-primary" onclick="submit(<?php echo $d['id']?>)">Ubah</a>
							</td>
						</tr>
					<?php
						}
					?>						
					
					</tbody>
				</table>
				<div class="modal fade" id="frmgaji" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1>Tambah Komponen Gaji</h1>
							</div>
							<span id="target"></span>
							<table class="table table-striped">
								
								<tr>
									<td>UMK</td>
									<td>
										<input type="text" name="umk" id="umk" placeholder="UMK">
									</td>	

									<td>T. MAKAN</td>
									<td>
										<input type="text" name="tmakan" id="tmakan" placeholder="Tunjangan Makan">
									</td>	
								
								</tr>
								<tr>
									<td>SPSI</td>
									<td>
										<input type="text" name="spsi" id="spsi" placeholder="SPSI">
									</td>
	
								</tr>
								<tr>
									<td>
										<input type="button" id="btn-ubah" onclick="ubahdata()" class="btn btn-primary" value="UBAH">
									</td>	
									<td>
											<input type="button" data-dismiss="modal" class="btn btn-warning" value="BATAL">
									</td>	
								</tr>
							</table>
						</div>
						</div>
		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

</div>
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table1').dataTable({
			responsive : true
		});
		$("#nama").on('keyup',function(){
			var x = $(this).val();
			$.ajax({
				type :'post',
				url : '<?php echo base_url().'index.php/gaji/ambilid' ?>',
				data : 'id='+x,
					
				success : function(data){
					$('#target').html(data);
				} 
			})
		})
		$('[name=nama]').val('');
	
	})

	function submit(x)
	{
		$.ajax({
			type : 'POST',
			url  : '<?php echo base_url()."index.php/gaji/datagajitetap" ?>',
			data : 'id='+x,
			dataType : 'json',
			success : function(data)
			{
				$('[name=umk]').val(data[0].ump);				
				$('[name=tmakan').val(data[0].t_makan);				
				$('[name=spsi]').val(data[0].spsi);

			}
		});

	}

	function ubahdata()
	{
		
		var ump = $('[name=umk]').val();
		var tmakan = $('[name=tmakan]').val();
		var spsi = $('[name=spsi]').val();
		
		$.ajax({
			type : 'POST',
			data : 'ump='+ump+'&tmakan='+tmakan+'&spsi='+spsi,
			url : '<?php echo base_url()."index.php/gaji/update_komp_gaji_sama" ?>',
			
			dataType : 'json',
			success : function(hasil)
			{
				
				$(".modal").removeClass("in");
		 		 $(".modal-backdrop").remove();
				  $('body').removeClass('modal-open');
				  $('body').css('padding-right', '');
				  $(".modal").hide();
				  alert('Berhasil di update');
				  location.reload();	
			}	

		});
	}
</script>
</body>
</html><!-- page content -->



	
		