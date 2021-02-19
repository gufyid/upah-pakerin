<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
</head>

<body>

	<div class="container">
		<div class="content">
			<h2>Tambah Data Karyawan</h2>
			<hr />

			<form class="form-horizontal" action="" method="post" id="frm_karyawan">
				<!--awal tab list-->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link " href="#1" role="tab" data-toggle="tab">Data Pribadi</a>
					</li> <!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
					<li class="nav-item">
						<a class="nav-link" href="#2" role="tab" data-toggle="tab">Data Perusahaan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="#3" role="tab" data-toggle="tab">Data Pendukung</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="#4" role="tab" data-toggle="tab">Data Upah</a>
					</li>
				</ul>
				<!--isi tablist -->
				<div class="tab-content">
					<!--tab pertama-->
					<div role="tab-panel" class="tab-pane fade in active" id="1">
						<div class="form-group">
							<label class="col-sm-2 control-label">NIP</label>
							<div class="col-sm-2">
								<input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai...." required autocomplete="off">
							</div>

							<label class="col-sm-2 control-label" for="file">Foto</label>
							<div class="col-sm-3">
								<input type="file" name="file" id="file" />
							</div>
							* jpeg Only / 1 MB(max)
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-3">
								<input type="text" name="nama" class="form-control" autocomplete="off" placeholder="Nama" required>
							</div>

							<label class="col-sm-1 control-label">Alamat</label>
							<div class="col-sm-3">
								<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">No Telp</label>
							<div class="col-sm-2">
								<input type="text" name="notlp" class="form-control" autocomplete="off" placeholder="No. telepon">
							</div>
							<label class="col-sm-2 control-label">Jenis Kelamin</label>
							<div class="col-sm-2">
								<select name="jekel" class="form-control" required>
									<option value=""> ----- </option>
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Lahir</label>
							<div class="col-sm-2">
								<input type="text" name="tempat_lahir" class="form-control" autocomplete="off" placeholder="Tempat Lahir">
							</div>

							<label class="col-sm-2 control-label">Tanggal Lahir</label>
							<div class="col-sm-2">
								<input class="form-control date-picker" Name="tgl_lahir" id="tgl_lahir" type="text" data-date-format="yyyy-mm-dd" placeholder="Tanggal Lahir" readonly />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Perkawinan</label>
							<div class="col-sm-2">
								<select name="sperkawinan" class="form-control">
									<option value="">----</option>
									<option value="menikah">Menikah</option>
									<option value="belum_menikah">Belum Menikah</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Jumlah Anak</label>
							<div class="col-sm-1">
								<input type="text" name="jumanak" class="form-control" autocomplete="off" placeholder="Jum. Anak">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Agama</label>
							<div class="col-sm-2">
								<select name="agama" class="form-control">
									<option value="">---</option>
									<option value="islam">Islam</option>
									<option value="protestan">Protestan</option>
									<option value="katolik">Katolik</option>
									<option value="hindu">Hindu</option>
									<option value="budha">Budha</option>
									<option value="khong">Khong Hu Cu</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Pendidikan</label>
							<div class="col-sm-2">
								<select name="pendidikan" class="form-control">
									<option value="">---</option>
									<option value="s2">S2</option>
									<option value="s1">S1</option>
									<option value="diploma">Diploma</option>
									<option value="sma">SMA</option>
									<option value="smp">SMP</option>
									<option value="sd">SD</option>
								</select>
							</div>

						</div>

					</div>

					<!--tab kedua-->
					<div role="tabpanel" class="tab-pane fade" id="2">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal Masuk</label>
							<div class="col-sm-2">
								<input class="form-control date-picker" Name="tgl_masuk" id="tgl_masuk" type="text" data-date-format="yyyy-mm-dd" placeholder="Tanggal Masuk" readonly required />
							</div>

							<label class="col-sm-2 control-label">Penempatan</label>
							<div class="col-sm-2">
								<select name="penempatan" class="form-control">
									<option value="">---</option>
									<option value="pakerin">PAKERIN</option>
									<option value="java">JAVA PAPER</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Skill</label>
							<div class="col-sm-2">
								<select name="skill" class="form-control">
									<option value="">---</option>
									<option value="1">Skill 1</option>
									<option value="2">Skill 2</option>
									<option value="3">Skill 3</option>
								</select>

							</div>

							<label class="col-sm-2 control-label">Divisi</label>
							<div class="col-sm-2">
								<select name="divisi" class="form-control">
									<option value="">---</option>
									<?php
									$divisi = $this->db->query("select * from t_divisi order by kode")->result_array();
									foreach ($divisi as $d) {
										echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
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
										echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
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
										echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jabatan</label>
							<div class="col-sm-2">
								<select name="jabatan" class="form-control">
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
									<option value="M">Magang</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tipe</label>
							<div class="col-sm-2">
								<select name="tipe" class="form-control">
									<option value=""> ----- </option>
									<option value="bulanan">Bulanan</option>
									<option value="harian">Harian</option>
								</select>
							</div>

							<label class="col-sm-2 control-label">Cost Center</label>
							<div class="col-sm-2">
								<select name="cc" class="form-control">
									<option value=""> ----- </option>
									<!--  <option value="B">Bulanan</option>
									<option value="H">Harian</option> -->
								</select>
							</div>
						</div>

					</div>
					<!--akhir tab ke 2-->

					<!--awal tab3-->
					<div role="tabpanel" class="tab-pane fade" id="3">
						<div class="form-group">
							<label class="col-sm-2 control-label">No. KTP</label>
							<div class="col-sm-2">
								<input type="text" name="ktp" class="form-control" autocomplete="off" placeholder="No KTP">
							</div>

							<label class="col-sm-2 control-label">No. NPWP</label>
							<div class="col-sm-2">
								<input type="text" name="npwp" class="form-control" autocomplete="off" placeholder="No NPWP">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">No. KPJ</label>
							<div class="col-sm-2">
								<input type="text" name="kpj" class="form-control" autocomplete="off" placeholder="No KPJ">
							</div>

							<label class="col-sm-2 control-label">No. BPJS</label>
							<div class="col-sm-2">
								<input type="text" name="bpjs" class="form-control" autocomplete="off" placeholder="No BPJS">
							</div>
						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">No. Rekening</label>
							<div class="col-sm-2">
								<input type="text" name="norek" class="form-control" autocomplete="off" placeholder="No Rekening">
							</div>

						</div>

					</div>
					<!--akhir tab 3-->

					<!--awal tab ke empat-->
					<div role="tabpanel" class="tab-pane fade" id="4">
						<div class="form-group">
							<label class="col-sm-2 control-label">Penggajian</label>
							<div class="col-sm-2">
								<select name="penggajian" class="form-control">
									<option value=""> ----- </option>
									<option value="Y">Pabrik</option>
									<option value="N">Surabaya</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Lebaran/Natalan</label>
							<div class="col-sm-2">
								<select name="ln" class="form-control">
									<option value=""> ----- </option>
									<option value="L">Lebaran</option>
									<option value="N">Natalan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Pensiun</label>
							<div class="col-sm-2">
								<select name="pensiun" class="form-control">
									<option value=""> ----- </option>
									<option value="1">YA</option>
									<option value="0">TIDAK</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">SPSI</label>
							<div class="col-sm-2">
								<select name="spsi" class="form-control">
									<option value=""> ----- </option>
									<option value="1">YA</option>
									<option value="0">TIDAK</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">No Slip</label>
							<div class="col-sm-2">
								<input type="text" name="noslip" class="form-control" autocomplete="off" placeholder="Nomor Slip Gaji....">
							</div>

							<label class="col-sm-2 control-label">No. Koperasi</label>
							<div class="col-sm-2">
								<input type="text" name="nokop" class="form-control" autocomplete="off" placeholder="Nomor Koperasi...">
							</div>
						</div>
					</div><!-- akhir tab ke 4 -->
				</div>
				<!--akhir rangkaian tab-->
				<br>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Karyawan" style="border-radius:50px">
						<a href="<?php echo base_url() . 'index.php/utama/panggil/karyawan/0' ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal" style="border-radius:50px">Batal</a>
					</div>
				</div>

			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->

	<script type="text/javascript">
		$(document).ready(function() {
			$('[name=nip]').focus();
			$('#frm_karyawan').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url() . "index.php/utama/simpan_karyawan" ?>',
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					//  	data : {
					// 		nik 	: $('[name=nik]').val(),
					// 		nama 	: $('[name=nama]').val(),	  				
					// 		alamat 	: $('[name=alamat]').val()
					// //img 	: $('[name=img]').val()
					// 	},
					dataType: 'json',
					success: function(data) {
						alert(data.pesan);
						resetForm();
					}
				});
			});

			activaTab('1');

			function activaTab(tab) {
				$('.nav-tabs a[href="#' + tab + '"]').tab('show');
			};
		})

		jQuery(function($) {
			// $(document).ready(function(){	
			$("#tgl_masuk,#tgl_lahir").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				yearRange: '-55:-0',
				hideIfNoPrevNext: true,
				autoclose: true,
				todayHighlight: true
			});

			$('#file').ace_file_input({
				no_file: 'No File ...',
				btn_choose: 'Choose',
				btn_change: 'Change',
				droppable: false,
				onchange: null,
				thumbnail: false, //| true | large
				whitelist: 'xls'
				//blacklist:'exe|php'
				//onchange:''
				//
			});
		});

		function resetForm() {
			$("#frm_karyawan")[0].reset();
			window.location = '<?php echo base_url() . "index.php/utama/panggil/karyawan"	 ?>'
		}
	</script>
</body>

</html>