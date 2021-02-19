<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- <script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>./asset/js/ace.min.js"></script>	 -->

</head>
<body>

	<table class="table table-striped" id="table1">
		<thead >
			<tr>
				<td>No Koperasi</td>
				<td>Nama</td>
				<td>Periode Awal</td>
				<td>Periode Akhir</td>
				<td>Jum Pinjaman</td>
				<td>Cicilan ke:</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($data as $d)
				{
					$nama = $this->db->query("select nama from t_karyawan where nokop='".$d['noac']."'")->result_array();
				echo "<tr>";
					echo "<td>". $d['noac'] ."</td>";
					echo "<td>";
					 	if(isset($nama[0]['nama']))
					 	{
					 		echo $nama[0]['nama'];	
					 	}else{
					 		echo "-";
					 	} 
					echo "</td>";
					echo "<td>". $d['pawal'] ."</td>";
					echo "<td>". $d['pakhir'] ."</td>";
					echo "<td>". number_format($d['jumkoperasi']) ."</td>";
					echo "<td>". $d['cicilan'] ."</td>";
					echo "<td> <a href='#modal' data-toggle='modal' class='btn btn-primary'  onclick=submit('$d[noac],$d[pawal],$d[pakhir]')>EDIT</a></td>";
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
					<h2 class="panel-title">Edit Data Koperasi</h2>
				</div>
				<div class="panel-body">
					<table class="table table-striped" >
						<tr>
							<td>No AC</td>
							<td><input type="text" name="noac" id="noac" placeholder="No Koperasi">
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
							<td>Koperasi</td>
							<td><input type="text" name="koperasi" id="koperasi" placeholder="Koperasi"></td>
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
			url :'<?php echo base_url()."index.php/mingguan/ambilidkop" ?>',
			dataType : 'json',
			success : function(hasil){
				$('[name=noac]').val(hasil[0].noac);
				$('[name=periode_awal]').val(hasil[0].pawal);
				$('[name=periode_akhir]').val(hasil[0].pakhir);
				$('[name=koperasi]').val(hasil[0].jumkoperasi);	
			}
		});
	}

	function ubahdata(){			
		var noac = $('[name=noac]').val();
		var pawal = $('[name=periode_awal]').val();
		var pakhir = $('[name=periode_akhir]').val();
		var jumkop = $('[name=koperasi]').val();

		$.ajax({
			type : "POST",
			url : '<?php echo base_url()."index.php/mingguan/update_koperasi_mingguan" ?>',
			dataType : 'json',
			data : 'noac='+noac+'&pawal='+pawal+'&pakhir='+pakhir+'&jumkoperasi='+jumkop,
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
			url : '<?php echo base_url().'index.php/mingguan/ambil_koperasi_mingguan'?>',
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