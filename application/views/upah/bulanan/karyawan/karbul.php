<!DOCTYPE html>
<html>
<head>
	<title></title>
	
		<style rel="stylesheet" type="text/css" href="<?php echo base_url();?>./asset/css/bootstrap.min.css"></style>
		<script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
	<style type="text/css">
		.modal-dialog {
	    width: 75%;
	    height: 100%;
	    padding-left: 15%;
	    margin:0;

	}
</style>
</head>
<body>
<div role="main">
  <div class="">
		<div class="page-title">
		 			
		  <?php echo $this->session->flashdata('pesan');?>

		</div>
	<div class="clearfix">
		<!--<a href="#form_modal" data-toggle="modal" class="btn btn-warning">TAMBAH KARYAWAN</a>-->
		<a href="<?php echo base_url().'index.php/utama/panggil/tambahkaryawan/0' ?>" class="btn btn-primary">Tambah Data Karyawan</a>
		<div class="pull-right "><i>&nbsp;</i></div>
	</div><br>
	<div class="table-header">
		DAFTAR KARYAWAN PT. PABRIK KERTAS INDONESIA
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
							<th width="5%" style="text-align: center;">No</th>
							<th style="text-align: center;">NIP</th>
							<th style="text-align: center;">NO INDUK</th>
							<th style="text-align: center;">NAMA</th>
							<th style="text-align: center;">BAGIAN</th>
							<th style="text-align: center;">SEKSI</th>
							<th width="20%" style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						foreach($karyawan_bul as $d)
						{
							$no++;
							$kdbag = $d['bagian'];
							$kdsek = $d['seksi'];
							$bagian = $this->db->query("select * from t_bagian where kode='$kdbag'")->result_array();
							$seksi = $this->db->query("select * from t_seksi where kode='$kdsek'")->result_array();
					?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $d['nip'];?></td>
							<td><?php echo $d['noinduk'];?></td>
							<td><?php echo $d['nama'];?></td>
							<td><?php echo $bagian[0]['nama'];?></td>
							<td><?php echo $seksi[0]['nama'];?></td>
							<td>
								<input type="button" class="btn btn-primary" value="Edit">
								<input type="button" class="btn btn-warning" value="Delete">
								<!--
								<center><a href="<?php echo base_url()."index.php/utama/barang_edit/barang_edit/".$d['kode'];?>/0"><i class="ace-icon fa fa-edit ">&nbsp; Edit </i></a>&nbsp;</center>
								
								|&nbsp;
								<a href="<?php echo base_url()."index.php/utama/hapus_barang/".$d['kode'];?>" onclick="javascript: return confirm('Anda yakin ingin menghapus barang ini ?')"><i class="ace-icon fa fa-trash ">&nbsp; Hapus </i></a>
								-->
							</td>
						</tr>
					<?php
						}
					?>						
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	

</div>
</div>

<!--modal target-->
<div class="modal fade" id="form_modal" >
	<dir class="modal-dialog">
		<div class ="modal-content">
			
			<div class="modal-header">
				<h1>Tambah Karyawan</h1>	
				
				<table class="table table-striped	">
					<tr>
						<td>NIP</td>
						<td><input type="text" name="nip"></td>
						<td>No Induk</td>
						<td><input type="text" name="noinduk"></td>

					<tr>
						<td>No Slip</td>
						<td><input type="text" name="noslip"></td>
						<td>No AC</td>
						<td><input type="text" name="noac"></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama"></td>
						<td>Alamat</td>
						<td><input type="text" name="alamat"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td><input type="text" name="notelp"></td>
						<td>Tempat Lahir</td>
						<td><input type="text" name="tempatlahir"></td>
					</tr>
					<tr>
						<td>
							<button type="button" class="btn btn-primary" name="proses">SIMPAN</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal" name="">BATAL</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</dir>
</div>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./asset/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table1').dataTable({
			responsive : true
		});
	})
</script>
</body>
</html><!-- page content -->



	
		