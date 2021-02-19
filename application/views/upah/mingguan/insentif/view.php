<!DOCTYPE html>
<html>
<head>
	<title></title>
		 <script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<!--<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	 -->
		
</head>
<body>
	<table class="table table-striped" id="table1">
		<thead >
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			
				foreach($data as $d)
				{
				echo "<tr>";
					echo "<td>". $d['noinduk'] ."</td>";
					echo "<td>". $d['nama'] ."</td>";	
					echo "<td align='center'> <a href='#modal' data-toggle='modal'  class='btn btn-primary' onclick=submit('$d[noinduk],$periode_awal,$periode_akhir,$seksi')>Input Insentif</a></td>";
					echo "</tr>";
				}
			 ?>			
		</tbody>
	</table>

<div class="modal fade" id="modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">Input Data Insentif</h2>
				</div>
				<div class="panel-body">
					<table class="table" id="table3">
						<tr>
							<td>Insentif</td>
							<td>
								<input type="text" name="insentif" class="form-control" width='50%'>
								<input type="hidden" name="noinduk" >
								<input type="hidden" name="periode_awal" >
								<input type="hidden" name="periode_akhir" >
								<input type="hidden" name="seksi" >
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="proses" onclick="simpan()" value="Simpan" class=" btn btn-primary form-control"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){	

	$('#table1,#table2,#table3').dataTable({
		responsive : true
	});


})

function submit(x){	

	$.ajax({
		type : 'POST',
		data : 'y='+x,
		url  : '<?php echo base_url()."index.php/mingguan/pecahdata" ?>',
		dataType : 'json',
		success : function(data)
		{
			
			$('[name=noinduk]').val(data.noinduk);
			$('[name=periode_awal]').val(data.periode_awal);
			$('[name=periode_akhir]').val(data.periode_akhir);	
			$('[name=seksi]').val(data.seksi);	
			ambilinsentif(x);
		}
	});
}

function ambilinsentif(x){	

	$.ajax({
		type : 'POST',
		data : 'z='+x,
		url  : '<?php echo base_url()."index.php/mingguan/ambilinsentif" ?>',
		dataType : 'json',
		success : function(hasil)
		{
			if(hasil.length> 0)
			{
				$('[name=insentif]').val(hasil[0].insentif);
				
			}else{
				$('[name=insentif]').val('');
				
			}

		}
	});
}


function simpan(){

	var noinduk 	  = $('[name=noinduk]').val();
	var periode_awal  = $('[name=periode_awal]').val();
	var periode_akhir = $('[name=periode_akhir]').val();
	var insentif	  = $('[name=insentif]').val();			
	var seksi	  = $('[name=seksi]').val();			
	
	$.ajax({
			type : 'POST',
			url : '<?php echo base_url()."index.php/mingguan/simpan_insentif" ?>',
			dataType : 'json',
			data : 'noinduk='+noinduk+'&periode_awal='+periode_awal+'&periode_akhir='+periode_akhir+'&insentif='+insentif+'&+seksi='+seksi,
			success : function(data){
			//menghilangkan modal dengan paksa
			 $(".modal").removeClass("in");
			  $(".modal-backdrop").remove();
			  $('body').removeClass('modal-open');
			  $('body').css('padding-right', '');
			  $(".modal").hide();	
			  reload();
			  alert('Data berhasil disimpan..')
			  //window.location.reload();
			}
		});
}

function reload()
	{
		
		$.ajax({
			type : "POST",
			data : {
					seksi 			: $('[name=seksi]').val(),
					periode_awal 	: $('[name=periode_awal]').val(),
					periode_akhir 	: $('[name=periode_akhir]').val(),
			},
			url : "<?php echo base_url().'index.php/mingguan/ambil_karyawan_seksi_insentif' ?>",
			
			success : function(hasil)
			{
				$('#target').html(hasil);
			}
		});	
		
	}
</script>
</body>
</html>