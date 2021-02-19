<?php if ($this->session->userdata('login') != True) redirect('login'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title id="judul">HR Solution - PT. Pabrik Kertas Indonesia Raya</title>
	<link rel="shortcut icon" href="<?php echo base_url() ?>asset/images/pakerin.ico" type="image/x-icon">
	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/daterangepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap-colorpicker.min.css" />
	<!-- text fonts -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<!-- sweetalert -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/sweetalert.css">
	<!-- <style>
		.swal2-popup {
			font-size: 1.5em !important;
		}
	</style> -->
	<!--[if lte IE 9]>
			<link rel="stylesheet" href="asset/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="asset/css/ace-ie.min.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="<?php echo base_url(); ?>./asset/js/ace-extra.min.js"></script>


	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="asset/js/html5shiv.min.js"></script>
		<script src="asset/js/respond.min.js"></script>
		<![endif]-->

	<script type="text/javascript">
		function stopRKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type == "text")) {
				return false;
			}
		}
		document.onkeypress = stopRKey;
	</script>

	<!--
		<script>
			$(document).ready(function() {
				// SET AUTOMATIC PAGE RELOAD TIME TO 5000 MILISECONDS (5 SECONDS).
				setInterval('refreshPage()', 10000);
			});

			function refreshPage() { 
				location.reload(); 
			}
		</script>
		-->

</head>

<body class="no-skin">

	<div id="navbar" class="navbar navbar-default  ace-save-state">
		<!-- Header-->
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="index.html" class="navbar-brand">
					<small>
						<!--<i class="fa fa-industry"></i>-->
						<i class="fa fa-users"></i>
						HR & Payroll Solution PT. Pabrik Kertas Indonesia
					</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<?php
					$this->load->view('user_profile');
					//include("user_profile.php");
					?>


				</ul>
			</div>
		</div><!-- /.navbar-container -->
		<!-- //Header-->
	</div>

	<!-- Halaman Utama -->
	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar responsive ace-save-state">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
			</script>

			<ul class="nav nav-list">
				<!-- Menu Kiri -->
				<?php

				$bagian = $this->session->userdata('bagian');
				$this->load->view("/menu/left_menu");
				?>
			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<!-- Halaman Isi-->
		<div class="main-content">
			<div class="main-content-inner">
				<!-- Halaman Isi -->
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="<?php echo base_url(); ?>">Home</a>
						</li>
						<?php

						if (isset($id)) {
							if ($id == "ganti_password") {
								echo "<li class=\"active\">Ganti Password</li>";
							} elseif ($id == "user") {
								echo "<li>Master</li>";
								echo "<li class=\"active\">User</li>";
							} elseif ($id == "user_add") {
								echo "<li>Master</li>";
								echo "<li class=\"active\">User - Tambah</li>";
							} elseif ($id == "user_edit") {
								echo "<li>Master</li>";
								echo "<li class=\"active\">User - Edit</li>";
							} elseif ($id == "proyek") {
								echo "<li>Master</li>";
								echo "<li class=\"active\">Data Proyek</li>";
							} elseif ($id == "proyek_add") {
								echo "<li>Master</li>";
								echo "<li class=\"active\">Proyek - Tambah</li>";
								//personalia
							} elseif ($id == "karyawan") {
								echo "<li>Personalia</li>";
								echo "<li class=\"active\">Data Karyawan</li>";
							} elseif ($id == "resign") {
								echo "<li>Personalia</li>";
								echo "<li class=\"active\">Karyawan Resign/Mengundurkan Diri</li>";
							} elseif ($id == "tambahkaryawan") {
								echo "<li>Personalia</li>";
								echo "<li class=\"active\">Tambah Karyawan</li>";
							} elseif ($id == "menu") {
								echo "<li>Menu</li>";
								echo "<li class=\"active\">Menu User</li>";

								//Payroll	
							} elseif ($id == "karbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Daftar Karyawan Bulanan</li>";
							} elseif ($id == "kompgaji") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Komponen Gaji</li>";
							} elseif ($id == "kompgajisama") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Komponen Gaji Tetap</li>";
							} elseif ($id == "absenbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Absen Bulanan</li>";
							} elseif ($id == "lemburbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Lembur Tetap Bulanan</li>";
							} elseif ($id == "premibul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Premi Bulanan</li>";
							} elseif ($id == "koperasi") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Koperasi Bulanan</li>";
							} elseif ($id == "splbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">SPL Bulanan</li>";
							} elseif ($id == "adjbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Adjustment Bulanan</li>";
							} elseif ($id == "absenming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Absen Mingguan</li>";
							} elseif ($id == "premiming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Premi Mingguan</li>";
							} elseif ($id == "lemburming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Lembur Tetap Mingguan</li>";
							} elseif ($id == "kopming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Koperasi Mingguan</li>";
							} elseif ($id == "splming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">SPL Mingguan</li>";
							} elseif ($id == "prosesgajibul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Proses Gaji Bulanan</li>";
							} elseif ($id == "prosesgajiming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Proses Gaji Mingguan</li>";
							} elseif ($id == "insentif") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Insentif Mingguan</li>";
							} elseif ($id == "slipbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Cetak Slip</li>";

								//Laporan Bulanan Tetap	
							} elseif ($id == "rekapupahbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Bulanan Tetap</li>";
							} elseif ($id == "rekaplemburbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Lembur Bulanan Per Seksi</li>";
							} elseif ($id == "rekapupahbulsby") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Bulanan Untuk Surabaya</li>";
							} elseif ($id == "rekapupahbulsbyorg") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Karyawan Bulanan Untuk Surabaya</li>";
							} elseif ($id == "laplemburbul") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Daftar Upah Lembur Karyawan Bulanan</li>";
								//Bulanan 
							} elseif ($id == "upahbulkontrak") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Bulanan Kontrak</li>";
							} elseif ($id == "cekpremi") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Cek Premi Bulanan</li>";
							} elseif ($id == "cekpotlain") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Cek Potongan Lain-lain Bulanan</li>";
							} elseif ($id == "cekpotabsen") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Cek Potongan Absensi Bulanan</li>";

								// Laporan Mingguan Tetap
							} elseif ($id == "rekapupahming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Mingguan Tetap</li>";
							} elseif ($id == "rekaplemburming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Lembur Mingguan Tetap</li>";
							} elseif ($id == "rekapupahmingsby") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Karyawan (Utk. Surabaya)</li>";
							} elseif ($id == "rekapupahmingsbyorg") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Upah Karyawan Harian / Orang (Utk. Surabaya)</li>";
							} elseif ($id == "laplemburming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Rekap Lembur Karyawan Harian </li>";
							} elseif ($id == "adjming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Adjustment Mingguan Tetap</li>";
							} elseif ($id == "lapinsentif") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Laporan Insentif Mingguan</li>";
							} elseif ($id == "slipming") {
								echo "<li>Payroll</li>";
								echo "<li class=\"active\">Cetak Slip</li>";
							} elseif ($id == "panduan") {
								echo "<li>Bantuan</li>";
								echo "<li class=\"active\">Panduan</li>";
								//Kondite
							} elseif ($id == "incondite") {
								echo "<li>Kondite</li>";
								echo "<li class=\"active\">Import Data Kondite</li>";
							} elseif ($id == "prosesdev") {
								echo "<li>Kondite</li>";
								echo "<li class=\"active\">Proses Deviasi</li>";
							}
						} else {
							echo "<li class=\"active\">Dashboard</li>";
						}
						?>
						<!-- <span style="margin-left:600px"><i class="fa fa-question-circle"></i> Bantuan</span> -->
					</ul>

					<!-- /.breadcrumb -->

					<!--
							<div class="nav-search" id="nav-search">
								<form id="form-search" method="post" action="<?php echo base_url(); ?>index.php/utama/hasil_cari/hasil_cari">
									<span class="input-icon">
										<input type="text" placeholder="Search Product..." class="nav-search-input" name="cari" id="cari" autocomplete="off" />
										<i class="ace-icon fa fa-search nav-search-icon"></i>
										
									</span>
											<button name="submit" style="background-Color:#4992db"><font color="white">Cari</font></button>
								</form>
							</div>
						-->

				</div>

				<div class="page-content">
					<?php
					if (isset($id)) {
						if ($id == 'ganti_password') {
							$this->load->view('ganti_password');
						} elseif ($id == 'user') {
							$this->load->view('master/user/master_user');
						} elseif ($id == 'user_edit') {
							$this->load->view('master/user/user_edit');
						} elseif ($id == 'user_add') {
							$this->load->view('master/user/user_add');
						} elseif ($id == 'proyek') {
							$this->load->view('master/proyek/master_proyek');
						} elseif ($id == 'proyek_add') {
							$this->load->view('master/proyek/proyek_add');
							//Personalia
						} elseif ($id == 'karyawan') {
							$this->load->view('personalia/master_karyawan');
						} elseif ($id == 'resign') {
							$this->load->view('personalia/resign');
						} elseif ($id == 'tambahkaryawan') {
							$this->load->view('personalia/tambah_karyawan');
						} elseif ($id == 'menu') {
							$this->load->view('master/menu/menu');
							//Upah
						} elseif ($id == 'karbul') {
							$this->load->view('upah/bulanan/karyawan/karbul');
						} elseif ($id == 'kompgaji') {
							$this->load->view('upah/gaji/komponen_gaji');
						} elseif ($id == 'kompgajisama') {
							$this->load->view('upah/gaji/komponen_gaji_tetap');
						} elseif ($id == 'absenbul') {
							$this->load->view('upah/bulanan/absensi/absen_bulanan');
						} elseif ($id == 'lemburbul') {
							$this->load->view('upah/bulanan/lt/lembur_bulanan');
						} elseif ($id == 'premibul') {
							$this->load->view('upah/bulanan/premi/premi_bulanan');
						} elseif ($id == 'koperasi') {
							$this->load->view('upah/bulanan/koperasi/koperasi_bulanan');
						} elseif ($id == 'splbul') {
							$this->load->view('upah/bulanan/spl/spl_bulanan');
						} elseif ($id == 'adjbul') {
							$this->load->view('upah/bulanan/adjustment/adjbul');
						} elseif ($id == 'absenming') {
							$this->load->view('upah/mingguan/absensi/absen_mingguan');
						} elseif ($id == 'premiming') {
							$this->load->view('upah/mingguan/premi/premi_mingguan');
						} elseif ($id == 'lemburming') {
							$this->load->view('upah/mingguan/lt/lembur_mingguan');
						} elseif ($id == 'kopming') {
							$this->load->view('upah/mingguan/koperasi/koperasi_mingguan');
						} elseif ($id == 'splming') {
							$this->load->view('upah/mingguan/spl/spl_mingguan');
						} elseif ($id == 'prosesgajibul') {
							$this->load->view('upah/bulanan/proses/proses_gaji');
						} elseif ($id == 'prosesgajiming') {
							$this->load->view('upah/mingguan/proses/proses_gaji');
						} elseif ($id == 'insentif') {
							$this->load->view('upah/mingguan/insentif/insentif');


							//laporan bulanan
						} elseif ($id == 'rekapupahbul') {
							$this->load->view('upah/bulanan/laporan/rekapupahbul');
						} elseif ($id == 'rekaplemburbul') {
							$this->load->view('upah/bulanan/laporan/rekaplemburbul');
						} elseif ($id == 'rekapupahbulsby') {
							$this->load->view('upah/bulanan/laporan/rekapupahbulsby');
						} elseif ($id == 'rekapupahbulsbyorg') {
							$this->load->view('upah/bulanan/laporan/rekapupahbulsbyorg');
						} elseif ($id == 'laplemburbul') {
							$this->load->view('upah/bulanan/laporan/laplemburbul');
						} elseif ($id == 'cekpremi') {
							$this->load->view('upah/bulanan/laporan/lapcekpremi');
						} elseif ($id == 'cekpotlain') {
							$this->load->view('upah/bulanan/laporan/lapcekpotlain');
						} elseif ($id == 'cekpotabsen') {
							$this->load->view('upah/bulanan/laporan/lapcekpotabsen');
						} elseif ($id == 'slipbul') {
							$this->load->view('upah/bulanan/laporan/lapslip');
						} elseif ($id == 'panduan') {
							$this->load->view('panduan.php');

							//Laporan Mingguan
						} elseif ($id == 'rekapupahming') {
							$this->load->view('upah/mingguan/laporan/rekapupahming');
						} elseif ($id == 'rekaplemburming') {
							$this->load->view('upah/mingguan/laporan/rekaplemburming');
						} elseif ($id == 'adjming') {
							$this->load->view('upah/mingguan/adjustment/adjming');
						} elseif ($id == 'rekapupahmingsby') {
							$this->load->view('upah/mingguan/laporan/rekapupahmingsby');
						} elseif ($id == 'rekapupahmingsbyorg') {
							$this->load->view('upah/mingguan/laporan/rekapupahmingsbyorg');
						} elseif ($id == 'laplemburming') {
							$this->load->view('upah/mingguan/laporan/laplemburming');
						} elseif ($id == 'lapinsentif') {
							$this->load->view('upah/mingguan/laporan/lapinsentif');
						} elseif ($id == 'slipming') {
							$this->load->view('upah/mingguan/laporan/lapslip');
							//kondite			
						} elseif ($id == 'incondite') {
							$this->load->view('upah/kondite/inkondite');
						} elseif ($id == 'prosesdev') {
							$this->load->view('upah/kondite/prosesdev');
						}
					} else {
						if ($cek_menu > 0) {
							$this->load->view('dashboard/dashboard');
						} else {
							$this->load->view('dashboard/error');
						}
					}
					?>
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
		<!-- //Halaman Isi-->
		<div class="clearfix"></div>
		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<!-- Footer-->
					<?php
					$this->load->view("footer");
					?>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>asset/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<script src="<?php echo base_url(); ?>asset/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.dataTables.bootstrap.min.js"></script>
	<!-- sweetalert -->
	<script src="<?php echo base_url(); ?>asset/js/sweetalert.js"></script>

	<script src="<?php echo base_url(); ?>asset/js/jquery-ui.custom.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.sparkline.index.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.flot.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.flot.resize.min.js"></script>

	<!-- ace scripts -->
	<script src="<?php echo base_url(); ?>asset/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/ace.min.js"></script>

</body>

</html>