<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="<?php echo base_url().'asset/css/datepicker-ui.css' ?>">
  <script src="<?php echo base_url();?>./asset/js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src ="<?php echo base_url();?>./asset/js/jquery-ui.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Tambah Data Karyawan</h2>
			<hr />

			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label">NIK</label>
					<div class="col-sm-2">
						<input type="text" name="nik" class="form-control" placeholder="NIK" required>
					</div>

				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-3">
						<input type="text" name="nama" class="form-control" placeholder="Nama" required>
					</div>
					<label class="col-sm-1 control-label">Alamat</label>
					<div class="col-sm-3">
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">No Telp</label>
					<div class="col-sm-2">
						<input type="text" name="notlp" class="form-control" placeholder="No. telepon">
					</div>
					<label class="col-sm-2 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> ----- </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tempat Lahir</label>
					<div class="col-sm-2">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
					</div>

					<label class="col-sm-2 control-label">Tanggal Lahir</label>
					<div class="col-sm-2">
						<input type="text" name="tanggal_lahir" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Perkawinan</label>
					<div class="col-sm-2">
						<select name="sperkawinan" class="form-control">
							<option value="" >----</option>
							<option value="menikah">Menikah</option>	
							<option value="belum_menikah">Belum Menikah</option>						
						</select>
					</div>
					<label class="col-sm-2 control-label">Jumlah Anak</label>
					<div class="col-sm-1">
						<input type="text" name="jumanak" class="form-control" placeholder="Jumlah Anak" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Agama</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control">
							<option value="">---</option>
							<option value="Islam">Islam</option>							
							<option value="Kristen">Kristen</option>							
							<option value="hindu">Hindu</option>							
							<option value="budha">Budha</option>							
						</select>
					</div>
					<label class="col-sm-2 control-label">Pendidikan</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control">
							<option value="">---</option>
							<option value="S2">S2</option>							
							<option value="S1">S1</option>							
							<option value="d4">D4</option>							
							<option value="d3">D3</option>
							<option value="d2">D2</option>
							<option value="smk">SMK</option>
							<option value="smp">SMP</option>
							<option value="sd">SMP</option>							
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tanggal Masuk</label>
					<div class="col-sm-2">
						<input type="text" name="tglmasuk" id="tglmasuk" class="form-control" placeholder="Tanggal Masuk" required>
					</div>
					<label class="col-sm-2 control-label">Devisi</label>
					<div class="col-sm-2">
						<select name="divisi" class="form-control">
							<option value="">---</option>
							<?php 
							$divisi = $this->db->query("select * from t_divisi order by kode")->result_array();
								foreach ($bagian as $d) {
									echo "<option value=".$d['kode'].">".$d['nama']."	</option>";
								}
							 ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Bagian</label>
					<div class="col-sm-2">
						<select name="bagian" class="form-control">
							<option value="">---</option>
							<?php 
							$bagian = $this->db->query("select * from t_bagian order by kode")->result_array();
								foreach ($bagian as $d) {
									echo "<option value=".$d['kode'].">".$d['nama']."	</option>";
								}
							 ?>
						</select>
					</div>
					<label class="col-sm-2 control-label">Seksi</label>
					<div class="col-sm-2">
						<select name="seksi" class="form-control">
							<option value="">---</option>
							<?php 
								$seksi = $this->db->query("select * from t_seksi order by kode")->result_array();
								foreach ($seksi as $d) {
									echo "<option value=".$d['kode'].">".$d['nama']."	</option>";
								}
							 ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Jabatan</label>
					<div class="col-sm-2">
						<select name="jabatan" class="form-control" required>
							<option value=""> ----- </option>
							<option value="karu">KARU</option>
							<option value="wakaru">WAKARU</option>
						</select>
					</div>
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-sm-2">
						<select name="status" class="form-control">
							<option value=""> ----- </option>
							<option value="T">Tetap</option>
							<option value="K">Kontrak</option>
							<option value="H">Honor</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tipe</label>
					<div class="col-sm-2">
						<select name="tipe" class="form-control">
							<option value=""> ----- </option>
                            <option value="B">Bulanan</option>
							<option value="H">Harian</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" class="form-control" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Ulangi Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass2" class="form-control" placeholder="Ulangi Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Karyawan">
						<a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<script type="text/javascript">
	jQuery(function($){
			$("#tglmasuk").datepicker(
				{
				  changeMonth: true,
				  changeYear: true,
					dateFormat: 'yy-mm-dd',
					yearRange: '-55:-0',
					hideIfNoPrevNext: true,
					autoclose: true,
					todayHighlight: true
				}
			);
			});	
</script>	
</body>
</html>