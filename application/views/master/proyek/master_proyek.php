<!-- page content -->
<div role="main">
	<div class="">
		<div class="page-title">

			<?php echo $this->session->flashdata('pesan'); ?>

		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">
			<div class="pull-right "><i>&nbsp;</i></div>

		</div>

		<div class="table-header">
			Daftar Proyek
			<div class="pull-right"><a style="color:#ffffff" href="<?php echo base_url(); ?>index.php/utama/panggil/proyek_add/0"><i class="ace-icon fa fa-plus ">
						&nbsp;Tambah&nbsp;&nbsp;</i></a></div>
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
									<th style="text-align: center;">Nama Proyek</th>
									<th width="20%" style="text-align: center;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 0;
								foreach ($proyek as $d) {
									$no++;
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $d['nama']; ?></td>
										<td>
											<a href="<?php echo base_url() . "index.php/utama/user_edit/user_edit/" . $d['id']; ?>"><i class="ace-icon fa fa-edit ">&nbsp; Edit </i></a>&nbsp;|&nbsp;
											<a href="<?php echo base_url() . "index.php/utama/hapus_user/" . $d['id']; ?>" onclick="javascript: return confirm('Anda yakin ingin menghapus brand ini ?')"><i class="ace-icon fa fa-trash ">&nbsp; Hapus </i></a>
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
<script src="<?php echo base_url(); ?>./assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>./assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table1').DataTable();
	});
</script>