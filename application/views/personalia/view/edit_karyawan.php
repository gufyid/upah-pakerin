<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
	<!--  <script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
</head>

<body>
	<?php
	$nip 			= $data[0]['nip'];
	$noinduk		= $data[0]['noinduk'];
	$noslip			= $data[0]['noslip'];
	$nokop 			= $data[0]['nokop'];
	$nama  			= $data[0]['nama'];
	$alamat 		= $data[0]['alamat'];
	$notlp 			= $data[0]['notlp'];
	$jekel 			= $data[0]['kelamin'];
	$agama 			= $data[0]['agama'];
	$tempat_lahir 	= $data[0]['tmplahir'];
	$tgl_lahir 		= $data[0]['tgllahir'];
	$sperkawinan 	= $data[0]['sperkawinan'];
	$jumanak 		= $data[0]['jumanak'];
	$pendidikan	 	= $data[0]['pendidikan'];
	$tgl_masuk 		= $data[0]['tglmasuk'];
	$penempatan 	= $data[0]['pabrik'];
	$skill 			= $data[0]['skill'];
	$divisi 		= $data[0]['divisi'];
	$bagian 		= $data[0]['bagian'];
	$seksi 			= $data[0]['seksi'];
	$jabatan 		= $data[0]['jabatan'];
	$tipe 			= $data[0]['tkaryawan'];
	$status 		= $data[0]['skerja'];
	$cc 	 		= $data[0]['costcenter'];
	$ktp 			= $data[0]['noktp'];
	$npwp 			= $data[0]['nonpwp'];
	$kpj 			= $data[0]['nokpj'];
	$bpjs 			= $data[0]['nobpjs'];
	$norek 			= $data[0]['norek'];
	$penggajian		= $data[0]['upah'];
	$ln 			= $data[0]['ln'];
	$pensiun 		= $data[0]['pensiun'];
	$spsi 			= $data[0]['spsi'];
	$foto 			= $data[0]['foto'];

	?>
	<div class="container">
		<div class="content">
			<h2>Edit Data Karyawan</h2>
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
								<input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai...." value="<?php echo $nip ?>" readonly>
								<input type="hidden" name="noindukh" value="<?php echo $noinduk ?>">
								<input type="hidden" name="fotoh" value="<?php echo $foto ?>">
							</div>

							<label class="col-sm-2 control-label no-padding-right" for="form-field-2">Foto</label>
							<div class="col-sm-3">
								<input type="file" name="file" id="file" />
							</div>
							* jpeg Only / 1 MB(max)
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-3">
								<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $nama ?>" required>
							</div>

							<label class="col-sm-1 control-label">Alamat</label>
							<div class="col-sm-3">
								<textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $alamat ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">No Telp</label>
							<div class="col-sm-2">
								<input type="text" name="notlp" class="form-control" placeholder="No. telepon" value="<?php echo $notlp ?>">
							</div>
							<label class="col-sm-2 control-label">Jenis Kelamin</label>
							<div class="col-sm-2">
								<select name="jekel" class="form-control" required>
									<option value=""> ----- </option>
									<?php
									if ($jekel == 'L') {
										echo "<option value=\"L\" selected>Laki-Laki</option>";
										echo "<option value=\"P\">Perempuan</option>";
									} else if ($jekel == 'P') {
										echo "<option value=\"L\" >Laki-Laki</option>";
										echo "<option value=\"P\" selected>Perempuan</option>";
									} else {
										echo "<option value=\"L\" >Laki-Laki</option>";
										echo "<option value=\"P\" >Perempuan</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Lahir</label>
							<div class="col-sm-2">
								<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir ?>">
							</div>

							<label class="col-sm-2 control-label">Tanggal Lahir</label>
							<div class="col-sm-2">
								<input class="form-control date-picker" Name="tgl_lahir" id="tgl_lahir" type="text" data-date-format="yyyy-mm-dd" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir ?>" readonly />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Perkawinan</label>
							<div class="col-sm-2">
								<select name="sperkawinan" class="form-control">
									<option value="">----</option>
									<?php
									if ($sperkawinan == 'menikah') {
										echo "<option value= \"menikah\" selected>Menikah</option>";
										echo "<option value= \"belum_menikah\">Belum Menikah</option>";
									} else if ($sperkawinan == 'belum_menikah') {
										echo "<option value= \"menikah\">Menikah</option>";
										echo "<option value= \"belum_menikah\" selected>Belum Menikah</option>";
									} else {
										echo "<option value= \"menikah\">Menikah</option>";
										echo "<option value= \"belum_menikah\">Belum Menikah</option>";
									}
									?>
								</select>
							</div>
							<label class="col-sm-2 control-label">Jumlah Anak</label>
							<div class="col-sm-1">
								<input type="text" name="jumanak" class="form-control" placeholder="Jum. Anak" value="<?php echo $jumanak ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Agama</label>
							<div class="col-sm-2">
								<select name="agama" class="form-control">
									<option value="">---</option>
									<?php
									if ($agama == 'islam') {
										echo "<option value=\"islam\" selected>Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									} else if ($agama == 'protestan') {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\" selected>Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									} else if ($agama == 'katolik') {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\" selected>Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									} else if ($agama == 'hindu') {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\" selected>Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									} else if ($agama == 'budha') {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\" selected>Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									} else if ($agama == 'khong') {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\" selected>Khong Hu Cu</option>";
									} else {
										echo "<option value=\"islam\">Islam</option>";
										echo "<option value=\"protestan\">Protestan</option>";
										echo "<option value=\"katolik\">Katolik</option>";
										echo "<option value=\"hindu\">Hindu</option>";
										echo "<option value=\"budha\">Budha</option>";
										echo "<option value=\"khong\">Khong Hu Cu</option>";
									}
									?>
									}
								</select>
							</div>
							<label class="col-sm-2 control-label">Pendidikan</label>
							<div class="col-sm-2">
								<select name="pendidikan" class="form-control">
									<option value="">---</option>
									<?php
									if ($pendidikan == 's2') {
										echo "<option value=\"s2\" selected>S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									} else if ($pendidikan == 's1') {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\" selected>S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									} else if ($pendidikan == 'diploma') {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\" selected>Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									} else if ($pendidikan == 'sma') {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\" selected>SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									} else if ($pendidikan == 'smp') {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\" selected>SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									} else if ($pendidikan == 'sd') {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\" selected>SD</option>";
									} else {
										echo "<option value=\"s2\">S2</option>";
										echo "<option value=\"s1\">S1</option>";
										echo "<option value=\"diploma\">Diploma</option>";
										echo "<option value=\"sma\">SMA</option>";
										echo "<option value=\"smp\">SMP</option>";
										echo "<option value=\"sd\">SD</option>";
									}
									?>
								</select>
							</div>

						</div>

					</div>

					<!--tab kedua-->
					<div role="tabpanel" class="tab-pane fade" id="2">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal Masuk</label>
							<div class="col-sm-2">
								<input class="form-control date-picker" Name="tgl_masuk" id="tgl_masuk" type="text" data-date-format="yyyy-mm-dd" placeholder="Tanggal Masuk" value="<?php echo $tgl_masuk ?>" readonly required />
							</div>

							<label class="col-sm-2 control-label">Penempatan</label>
							<div class="col-sm-2">
								<select name="penempatan" class="form-control">
									<option value="">---</option>
									<?php
									if ($penempatan == 'PAKERIN') {
										echo "<option value=\"PAKERIN\" selected>PAKERIN</option>";
										echo "<option value=\"JAVA PAPER\">JAVA PAPER</option>";
									} else if ($penempatan == 'JAVA PAPER') {
										echo "<option value=\"PAKERIN\">PAKERIN</option>";
										echo "<option value=\"JAVA PAPER\" selected>JAVA PAPER</option>";
									} else {
										echo "<option value=\"PAKERIN\">PAKERIN</option>";
										echo "<option value=\"JAVA PAPER\">JAVA PAPER</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Skill</label>
							<div class="col-sm-2">
								<select name="skill" class="form-control">
									<option value="">---</option>
									<?php
									if ($skill == '1') {
										echo "<option value=\"1\" selected>Skill 1</option>";
										echo "<option value=\"2\">Skill 2</option>";
										echo "<option value=\"3\">Skill 3</option>";
									} else if ($skill == '2') {
										echo "<option value=\"1\">Skill 1</option>";
										echo "<option value=\"2\" selected>Skill 2</option>";
										echo "<option value=\"3\">Skill 3</option>";
									} else if ($skill == '3') {
										echo "<option value=\"1\">	Skill 1</option>";
										echo "<option value=\"2\">Skill 2</option>";
										echo "<option value=\"3\" selected>Skill 3</option>";
									} else {
										echo "<option value=\"1\">Skill 1</option>";
										echo "<option value=\"2\">Skill 2</option>";
										echo "<option value=\"3\">Skill 3</option>";
									}
									?>
								</select>

							</div>

							<label class="col-sm-2 control-label">Divisi</label>
							<div class="col-sm-2">
								<select name="divisi" class="form-control">
									<option value="">---</option>
									<?php
									$divisi1 = $this->db->query("select * from t_divisi order by kode")->result_array();
									foreach ($divisi1 as $d) {
										if ($divisi == $d['kode']) {
											echo "<option value=" . $d['kode'] . " selected>" . $d['nama'] . "	</option>";
										} else {
											echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Bagian</label>
							<div class="col-sm-2">
								<select name="bagian" class="form-control">
									<option value="" selected>---</option>
									<?php
									$bagian1 = $this->db->query("select * from t_bagian order by kode")->result_array();
									foreach ($bagian1 as $d) {
										if ($bagian == $d['kode']) {
											echo "<option value=" . $d['kode'] . " selected =\"selected\">" . $d['nama'] . "	</option>";
										} else {
											echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
										}
									}
									?>
								</select>
							</div>
							<label class="col-sm-2 control-label">Seksi</label>
							<div class="col-sm-2">
								<select name="seksi" class="form-control">
									<option value="">---</option>
									<?php
									$seksi1 = $this->db->query("select * from t_seksi order by kode")->result_array();
									foreach ($seksi1 as $d) {
										if ($seksi == $d['kode']) {
											echo "<option value=" . $d['kode'] . " selected=\"selected\">" . $d['nama'] . "</option>";
										} else {
											echo "<option value=" . $d['kode'] . ">" . $d['nama'] . "	</option>";
										}
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
									<?php
									if ($jabatan == 'karu') {
										echo "<option value=\"karu\" selected>KARU</option>";
										echo "<option value=\"wakaru\">WAKARU</option>";
									} else if ($jabatan == 'wakaru') {
										echo "<option value=\"karu\">KARU</option>";
										echo "<option value=\"wakaru\" selected>WAKARU</option>";
									} else {
										echo "<option value=\"karu\">KARU</option>";
										echo "<option value=\"wakaru\">WAKARU</option>";
									}
									?>
								</select>
							</div>
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-sm-2">
								<select name="status" class="form-control">
									<option value=""> ----- </option>
									<?php
									if ($status == 'T') {
										echo "<option value=\"T\" selected>Tetap</option>";
										echo "<option value=\"K\">Kontrak</option>";
										echo "<option value=\"H\">Honor</option>";
										echo "<option value=\"M\">Magang</option>";
									} else if ($status == 'K') {
										echo "<option value=\"T\">Tetap</option>";
										echo "<option value=\"K\" selected>Kontrak</option>";
										echo "<option value=\"H\">Honor</option>";
										echo "<option value=\"M\">Magang</option>";
									} else if ($status == 'H') {
										echo "<option value=\"T\">Tetap</option>";
										echo "<option value=\"K\">Kontrak</option>";
										echo "<option value=\"H\" selected>Honor</option>";
										echo "<option value=\"M\">Magang</option>";
									} else if ($status == 'M') {
										echo "<option value=\"T\">Tetap</option>";
										echo "<option value=\"K\">Kontrak</option>";
										echo "<option value=\"H\">Honor</option>";
										echo "<option value=\"M\" selected>Magang</option>";
									} else {
										echo "<option value=\"T\">Tetap</option>";
										echo "<option value=\"K\">Kontrak</option>";
										echo "<option value=\"H\">Honor</option>";
										echo "<option value=\"M\">Magang</option>";
									}

									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tipe</label>
							<div class="col-sm-2">
								<select name="tipe" class="form-control">
									<option value=""> ----- </option>
									<?php
									if ($tipe == 'bulanan') {
										echo "<option value=\"bulanan\" selected>Bulanan</option>";
										echo "<option value=\"harian\">Harian</option>";
									} else if ($tipe == 'harian') {
										echo "<option value=\"bulanan\">	Bulanan</option>";
										echo "<option value=\"harian\" selected>Harian</option>";
									} else {
										echo "<option value=\"bulanan\">Bulanan</option>";
										echo "<option value=\"harian\">Harian</option>";
									}
									?>
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
								<input type="text" name="ktp" class="form-control" placeholder="No KTP" value="<?php echo $ktp ?>">
							</div>

							<label class="col-sm-2 control-label">No. NPWP</label>
							<div class="col-sm-2">
								<input type="text" name="npwp" class="form-control" placeholder="No NPWP" value="<?php echo $npwp ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">No. KPJ</label>
							<div class="col-sm-2">
								<input type="text" name="kpj" class="form-control" placeholder="No KPJ" value="<?php echo $kpj ?>">
							</div>

							<label class="col-sm-2 control-label">No. BPJS</label>
							<div class="col-sm-2">
								<input type="text" name="bpjs" class="form-control" placeholder="No BPJS" value="<?php echo $bpjs ?>">
							</div>
						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">No. Rekening</label>
							<div class="col-sm-2">
								<input type="text" name="norek" class="form-control" placeholder="No Rekening" value="<?php echo $norek ?>">
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
									<?php
									if ($penggajian == 'Y') {
										echo "<option value=\"Y\" selected>Pabrik</option>";
										echo "<option value=\"N\">Surabaya</option>";
									} else if ($penggajian == 'N') {
										echo "<option value=\"Y\">Pabrik</option>";
										echo "<option value=\"N\" selected>Surabaya</option>";
									} else {
										echo "<option value=\"Y\">Pabrik</option>";
										echo "<option value=\"N\">Surabaya</option>";
									}
									?>
								</select>
							</div>
							<label class="col-sm-2 control-label">Lebara/Natalan</label>
							<div class="col-sm-2">
								<select name="ln" class="form-control">
									<option value=""> ----- </option>
									<?php
									if ($ln == 'L') {
										echo "<option value=\"L\" selected>Lebaran</option>";
										echo "<option value=\"N\">Natalan</option>";
									} else if ($ln == 'N') {
										echo "<option value=\"L\">Lebaran</option>";
										echo "<option value=\"N\" selected>Natalan</option>";
									} else {
										echo "<option value=\"L\">Lebaran</option>";
										echo "<option value=\"N\">Natalan</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Pensiun</label>
							<div class="col-sm-2">
								<select name="pensiun" class="form-control">
									<option value=""> ----- </option>
									<?php
									if ($pensiun == '1') {
										echo "<option value=\"1\" selected>YA</option>";
										echo "<option value=\"0\">TIDAK</option>";
									} else if ($pensiun == '0') {
										echo "<option value=\"1\">YA</option>";
										echo "<option value=\"0\"  selected>TIDAK</option>";
									} else {
										echo "<option value=\"1\">YA</option>";
										echo "<option value=\"0\">TIDAK</option>";
									}

									?>
								</select>
							</div>
							<label class="col-sm-2 control-label">SPSI</label>
							<div class="col-sm-2">
								<select name="spsi" class="form-control">
									<option value=""> ----- </option>
									<?php
									if ($spsi == '1') {
										echo "<option value=\"1\" selected>YA</option>";
										echo "<option value=\"0\">TIDAK</option>";
									} else if ($spsi == '0') {
										echo "<option value=\"1\">YA</option>";
										echo "<option value=\"0\" selected>TIDAK</option>";
									} else {
										echo "<option value=\"1\">YA</option>";
										echo "<option value=\"0\">TIDAK</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">No Slip</label>
							<div class="col-sm-2">
								<input type="text" name="noslip" class="form-control" placeholder="Nomor Slip Gaji...." value="<?php echo $noslip ?>">
							</div>

							<label class="col-sm-2 control-label">No. Koperasi</label>
							<div class="col-sm-2">
								<input type="text" name="nokop" class="form-control" placeholder="Nomor Koperasi..." value="<?php echo $nokop ?>">
							</div>
						</div>
					</div><!-- akhir tab ke 4 -->
				</div>
				<!--akhir rangkaian tab-->
				<br>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Karyawan">
						<a href="<?php echo base_url() . 'index.php/utama/panggil/karyawan/0' ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
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
			window.location = '<?php echo base_url() . "index.php/utama/panggil/karyawan" ?>'
		}
	</script>
</body>

</html>