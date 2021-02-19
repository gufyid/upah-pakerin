<!DOCTYPE html>
<html>
<head>
	<title></title>

<style rel="stylesheet" type="text/css" href="<?php echo base_url();?>./assets/css/bootstrap.min.css"></style>
<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>

</head>
<body>
<div role="main">
  <div class="">
		<div class="page-title">
		 			
		  <?php echo $this->session->flashdata('pesan');?>

		</div>
	<div class="clearfix">
		<a href="#frmgaji" data-toggle="modal" class="btn btn-warning">TAMBAH KOMPONEN GAJI</a>
		<div class="pull-right "><i>&nbsp;</i></div>
	</div>
	<div class="table-header">
		KOMPONEN GAJI BULANAN
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
							<th style="text-align: center;">NO INDUK</th>
							<th style="text-align: center;">NAMA</th>
							<th style="text-align: center;">UMK</th>
							<th style="text-align: center;">GP</th>
							<th style="text-align: center;">TJAB</th>
							<th style="text-align: center;">TMAKAN</th>
							<th style="text-align: center;">T3M</th>
							<th style="text-align: center;">T3E</th>
							<th style="text-align: center;">INSENTIF</th>
				
							<th width="20%" style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!----
					<?php
						$no=0;
						foreach($kompgaji as $d)
						{
							$no++;
							$noinduk = $d['noinduk'];
							$nama = $this->db->query("select nama from t_karyawan where noinduk = '$noinduk'")->result_array();
					?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $d['noinduk'];?></td>
							<td><?php echo $nama[0]['nama'];?></td>
							<td><?php echo number_format($d['umk']);?></td>
							<td><?php echo number_format($d['gp']);?></td>
							<td><?php echo number_format($d['tjab']);?></td>
							<td><?php echo number_format($d['tmakan']);?></td>
							<td><?php echo number_format($d['t3e']);?></td>
							<td><?php echo number_format($d['t3m']);?></td>
							<td><?php echo number_format($d['insentif']);?></td>

							<td>-
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
					-->
					</tbody>
				</table>
				<div class="modal fade" id="frmgaji" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1>Tambah Komponen Gaji</h1>
							</div>
							<table class="table table-striped">
								<tr>
									<td>UMK</td>
									<td>
										<input type="text" name="umk" placeholder="Input UMK">
									</td>	
									<td>GP</td>
									<td>
										<input type="text" name="gp" placeholder="Gaji Pokok">
									</td>	
								</tr>
								<tr>
									<td>T. JABATAN</td>
									<td>
										<input type="text" name="tjab" placeholder="Tunjangan Jabatan..">
									</td>	
									<td>T. MAKAN</td>
									<td>
										<input type="text" name="gp" placeholder="tunjangan Makan...">
									</td>	
								</tr>
								<tr>
									<td>T3M</td>
									<td>
										<input type="text" name="t3m" placeholder="T3M">
									</td>	
									<td>T3E</td>
									<td>
										<input type="text" name="t3e" placeholder="T3E">
									</td>	
								</tr>
								<tr>
									<td>INSENTIF</td>
									<td>
										<input type="text" name="insentif" placeholder="INSENTIF">
									</td>	
								</tr>
								<tr>
									<td>
										<input type="button" name="submit" onclick="peringatan()" class="btn btn-primary" value="SIMPAN">
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
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table1').dataTable({
			responsive : true
		});

		
	})
	
</script>
</body>
</html><!-- page content -->



	
		