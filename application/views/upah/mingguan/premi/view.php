<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- <script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	
 -->
</head>
<body>
	<table class="table table-striped" id="table1">
		<thead >
			<tr>
				<td>No Induk</td>
				<td>Nama</td>
				<td>Periode Awal</td>
				<td>Periode Akhir</td>
				<td>Jum PREMI</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($data as $d)
				{
					$nama = $this->db->query("select nama from t_karyawan where noinduk='".$d['noinduk']."' and saktif='1'")->result_array();
				echo "<tr>";
					echo "<td>". $d['noinduk'] ."</td>";
					echo "<td>";
					 	if(isset($nama[0]['nama']))
					 	{
					 		echo $nama[0]['nama'];	
					 	} 
					echo "</td>";
					echo "<td>". date('d M Y',strtotime($d['pawal'])) ."</td>";
					echo "<td>". date('d M Y',strtotime($d['pakhir'])) ."</td>";
					echo "<td>". $d['jumpremi'] ."</td>";
					echo "<td> <a href='#modal' data-toggle='modal' class='btn btn-primary' onclick=submit('$d[noinduk],$d[pawal],$d[pakhir]')>EDIT</a></td>";
					echo "</tr>";
				}
			 ?>			
		</tbody>
	</table>
<div class="modal fade" id="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Data Premi</h2>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
							<tr>
								<td>No Induk</td>
								<td><input type="text" name="noinduk">
								</td>
							</tr>	
							<tr>	
								<td>Periode Awal</td>
								<td>
									<input type="text" name="periode_awal">
								</td>	
							</tr>
							<tr>	
								<td>Periode Akhir</td>
								<td>
									<input type="text" name="periode_akhir">
								</td>	
							</tr>				
							<tr>	
								<td>Premi</td>
								<td><input type="text" name="premi"></td>	
							</tr>
							
							<tr>	
								<td>
									<input type="button"  class="btn btn-primary" value="Ubah" onclick="ubahdata()">
									<input type="button"  data-dismiss="modal" value="batal" class="btn btn-primary">
								</td>	
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
		$('#table1').dataTable({
			responsive : true
		});
	})

	function submit(x)
	{
		$.ajax({
			type  : 'POST',
			data : 'id='+x,
			url :'<?php echo base_url()."index.php/mingguan/ambilidpremi" ?>',
			dataType : 'json',
			success : function(hasil){
				$('[name=noinduk]').val(hasil[0].noinduk);
				$('[name=periode_awal]').val(hasil[0].pawal);
				$('[name=periode_akhir]').val(hasil[0].pakhir);
				$('[name=premi]').val(hasil[0].jumpremi);
			}
		});
	}

		function ubahdata(){			
			var noinduk = $('[name=noinduk]').val();
			var pawal = $('[name=periode_awal]').val();
			var pakhir = $('[name=periode_akhir]').val();
			var jumpremi = $('[name=premi]').val();
			$.ajax({
				type : "POST",
				url : '<?php echo base_url()."index.php/mingguan/update_premi_mingguan" ?>',
				dataType : 'json',
				data : 'noinduk='+noinduk+'&pawal='+pawal+'&pakhir='+pakhir+'&jumpremi='+jumpremi,
				success : function(data)
				{
					//menghilangkan modal dengan paksa
					 $(".modal").removeClass("in");
					  $(".modal-backdrop").remove();
					  $('body').removeClass('modal-open');
					  $('body').css('padding-right', '');
					  $(".modal").hide();
					  loadData();

				}
			})
		}

		function loadData(){
			$.ajax({
				type : 'post',
				url : '<?php echo base_url().'index.php/mingguan/ambil_premi_mingguan'?>',
				data : {
					periode_awal : $('[name=periode_awal]').val(),
					periode_akhir : $('[name=periode_akhir]').val()
				},
				success : function(data)
				{
					$('#hasil').html(data);
				}
			})
		}
</script>
</body>
</html>