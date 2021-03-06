<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Utama extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{

		$user = $this->session->userdata('user');
		$tipe = $this->session->userdata('tipe');
		$pabrik = $this->session->userdata('pabrik');
		$golongan = $this->session->userdata('golongan');
		$cek_menu = $this->db->query("select * from t_user_acl where user ='$user'")->num_rows();
		$data = array(
			'user' => $user,
			'pabrik' => $pabrik,
			'cek_menu' => $cek_menu,
			'xx' => ''
		);

		$this->load->view('index', $data);
	}

	public function panggil($id)
	{
		$user = $this->session->userdata('user');
		$bagian = $this->session->userdata('bagian');
		$tipe = $this->session->userdata('tipe');
		$pabrik = $this->session->userdata('pabrik');
		$pengguna = $this->mymodel->get_pengguna()->result_array();
		$karyawan = $this->mymodel->get_karyawan_aktif('t_karyawan')->result_array();
		$karyawan_bul = $this->mymodel->get_karyawan_bulanan('t_karyawan')->result_array();
		$karyawan_ming = $this->mymodel->get_karyawan_mingguan('t_karyawan')->result_array();
		$kompgaji = $this->mymodel->get_kompgaji('t_komp_gaji')->result_array();
		$kompgajitetap = $this->mymodel->get_kompgajitetap('t_komp_gaji_sama')->result_array();
		$insentif	= $this->mymodel->get_karyawan_insentif('t_karyawan')->result_array();
		$juminsentif = $this->db->query("select a.*,b.nama,c.nama as nmseksi from t_insentif_mingguan a
										left join t_karyawan b on b.noinduk=a.noinduk
										left join t_seksi c on c.kode=b.seksi where b.saktif='1' order by b.nama")->result_array();
		$seksi_bulanan = $this->db->query("select distinct seksi from t_karyawan where tkaryawan='B' and saktif='1' and upah='Y'")->result_array();
		$seksi_mingguan = $this->db->query("select distinct seksi from t_karyawan where tkaryawan='H' and saktif='1' and upah='Y' and not isnull(seksi)")->result_array();
		$data = array(
			'id' 			=> $id,
			'user' 			=> $user,
			'bagian' 		=> $bagian,
			'tipe' 			=> $tipe,
			'pabrik' 		=> $pabrik,
			'karyawan' 		=> $karyawan,
			'karyawan_bul' 	=> $karyawan_bul,
			'karyawan_ming' => $karyawan_ming,
			'pengguna' 		=> $pengguna,
			'kompgaji' 		=> $kompgaji,
			'kompgajitetap' => $kompgajitetap,
			'insentif' 		=> $insentif,
			'juminsentif' 	=> $juminsentif,
			'seksi_bulanan' => $seksi_bulanan,
			'seksi_mingguan' => $seksi_mingguan
		);

		$this->load->view('index', $data);
	}



	function ambil_absen_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_absen_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
			'bulan' => $bulan
		);
		$this->load->view('upah/bulanan/absensi/view', $data);
	}

	function ambil_lt_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_lt_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/bulanan/lt/view', $data);
	}

	function ambil_karyawan()
	{
		$noinduk = $this->input->post('noinduk');
		$sql 	= "select * from t_karyawan where noinduk ='$noinduk' and saktif='1'";
		$hasil 	= $this->db->query($sql)->result_array();
		$data = array(
			'data' => $hasil,
			'noinduk'	=> $noinduk
		);
		$this->load->view('personalia/view/resign', $data);
	}

	/*function ambil_absen_bulanan()
	{
		$periode = $this->db->query("select * from t_periode_bulanan where tipe='absen_bulanan'")->result_array();
		$bulan = $periode[0]['bulan'];
		$tahun = $periode[0]['tahun'];
		//$data = $this->mymodel->get_absen_bulanan('t_absen_bulanan')->result();
		$data = $this->db->query("select * from t_absen_bulanan where bulan='$bulan' and tahun='$tahun'")->result_array();
		echo json_encode($data);
	}
	
	function jumlah_absen_bulanan()
	{
		$data = $this->mymodel->jumlah_absen_bulanan('t_absen_bulanan')->num_rows();
		echo json_encode($data);
	}
	*/
	function jumlah_absen_bulanan()
	{

		$data = $this->mymodel->jumlah_absen_bulanan('t_absen_bulanan')->num_rows();
		//		$data = $this->db->query("select * from t_absen_bulanan where bulan='$bulan' and tahun='$tahun'")->result_array();
		//		echo json_encode($data);
		echo json_encode($data);
	}

	public function ganti_password()
	{
		$new_pass1 = md5($this->input->post('password1'));
		$new_pass2 = md5($this->input->post('password2'));
		$user  = $this->input->post('user');
		if ($new_pass2 == $new_pass1) {
			$sql = "update t_user set password_user = '$new_pass2'
					where kode ='$user'";
			$res = $this->db->query($sql);
			if ($res >= 1) {
				$this->session->set_flashdata(
					'pesan',
					'Password Berhasil Diubah!!!'
				);
				redirect(base_url() . 'index.php/login/process_logout');
			} else {
				$this->session->set_flashdata(
					'pesan',
					'Password Gagal Diubah!!!'
				);
				redirect(base_url() . 'index.php/utama/panggil/ganti_password');
			}
		} else {
			$this->session->set_flashdata(
				'pesan',
				'Password tidak sama!!!'
			);
			redirect(base_url() . 'index.php/utama/panggil/ganti_password');
		}
	}

	function upload_absensi_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tlap = "absen_bulanan";
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/'; //buat folder dengan nama assets di root folder
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file'))
			$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = './upload/' . $media['file_name'];
		$total = '';

		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk		= $rowData[0][0];
			$jumabsen 	= $rowData[0][9];
			$jumcuti 	= $rowData[0][11];
			$cek = $this->db->query("select * from t_absen_bulanan where noinduk = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_absen_bulanan(noinduk,bulan,tahun,jum_absen,jum_cuti)values('$noinduk','$bulan','$tahun','$jumabsen','$jumcuti')";
			}
			$insert = $this->db->query($sql);
			//hapus yang data absen dan cuti =0

			delete_files($media['file_path']);
			$total += $total;
		}
		/*$cek_periode = $this->db->query("select * from t_periode_bulanan where tipe='$tlap'")->num_rows();
            if($cek_periode <= 0)
            {
	            $this->db->query("insert into t_periode_bulanan(tipe,bulan,tahun)values('$tlap','$bulan','$tahun')");
            }else{
            	$this->db->query("update t_periode_bulanan set bulan = '$bulan', tahun = '$tahun' where tipe='$tlap'");
            }*/
		//            $cek = $this->db->query("select * from t_absen_bulanan where  bulan ='$bulan' and tahun='$tahun'")->num_rows();
		//	$del = $this->db->query("delete from t_absen_bulanan where jum_absen='0' and jum_cuti='0' and bulan='$bulan' and tahun='$tahun'");
		//echo json_encode($cek);

		// $this->session->set_flashdata('msg','Data berhasil di upload'); 	
		//redirect(base_url().'index.php/utama/panggil/absenbul/0');
		//  redirect('excel/');

	}

	function upload_lt_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		//	$tlap = "lt_bulanan";
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/';
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file'))
			$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = './upload/' . $media['file_name'];
		$total = '';

		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk		= $rowData[0][0];
			$jumlt 		= $rowData[0][4];
			$cek = $this->db->query("select * from t_lt_bulanan where noinduk = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_lt_bulanan(noinduk,bulan,tahun,jumlt)values('$noinduk','$bulan','$tahun','$jumlt')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}

		/*cek_periode = $this->db->query("select * from t_periode_bulanan where tipe='$tlap'")->num_rows();
            if($cek_periode <= 0)
            {
	            $this->db->query("insert into t_periode_bulanan(tipe,bulan,tahun)values('$tlap','$bulan','$tahun')");
            }else{
            	$this->db->query("update t_periode_bulanan set bulan = '$bulan', tahun = '$tahun' where tipe='$tlap'");
            }*/
		//            $cek = $this->db->query("select * from t_absen_bulanan where  bulan ='$bulan' and tahun='$tahun'")->num_rows();
		//	$del = $this->db->query("delete from t_absen_bulanan where jum_absen='0' and jum_cuti='0' and bulan='$bulan' and tahun='$tahun'");
		//echo json_encode($cek);

		// $this->session->set_flashdata('msg','Data berhasil di upload'); 	
		//redirect(base_url().'index.php/utama/panggil/absenbul/0');
		//  redirect('excel/');

	}

	function report_csv_barang()
	{
		ini_set('max_execution_time', '3000');

		$sql = "select * from t_barang order by kode";
		$data = $this->db->query($sql)->result_array();

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:G1');
		$object->getActiveSheet()->mergeCells('A2:G2');
		$object->getActiveSheet()->getStyle('A3:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:G3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:G3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'LAPORAN DAFTAR BARANG')
			->setCellValue('A2', 'GSC PT PABRIK KERTAS INDONESIA (PM8)')
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'Kode')
			->setCellValue('C3', 'Nama')
			->setCellValue('D3', 'Satuan')
			->setCellValue('E3', 'Kondisi')
			->setCellValue('F3', 'Lokasi')
			->setCellValue('G3', 'Saldo');


		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		foreach ($data as $d) {
			$kode = $d['kode'];
			$cek = $this->db->query("select * from t_saldo_akhir where kode = '$kode'")->num_rows();
			if ($cek > 0) {
				$sld = $this->db->query("select * from t_saldo_akhir where kode = '$kode'")->result_array();
				$saldo = $sld[0]['qty'];
			} else {
				$sld = $this->db->query("select * from t_saldo_awal where kode = '$kode'")->result_array();

				$saldo = $sld[0]['qty'];
			}
			if ($d['kondisi'] == '1') {
				$kondisi = "Rusak";
			} else {
				$kondisi = "Baik";
			}

			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':G' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $kode);
			$ex->setCellValue("C" . $counter, $d['nama']);
			$ex->setCellValue("D" . $counter, $d['satuan']);
			$ex->setCellValue("E" . $counter, $kondisi);
			$ex->setCellValue("F" . $counter, $d['lokasi1'] . "-" . $d['lokasi2']);
			$ex->setCellValue("G" . $counter, $saldo);

			$counter = $counter + 1;
			$no++;
		}

		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan barang List.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}


	function report_pdf_barang()
	{
		$sql = "select * from t_barang order by kode";
		$data = $this->db->query($sql)->result_array();
		$data = array(
			'data' => $data
		);


		$sumber = $this->load->view('laporan/hasil_report_barang_pdf', $data, TRUE);
		$html = $sumber;


		//this the the PDF filename that user will get to download
		$pdfFilePath = "Laporan Barang.pdf";

		//load mPDF library
		$this->load->library('m_pdf');

		$this->m_pdf->pdf->AddPage('P');
		$this->m_pdf->pdf->WriteHTML($stylesheet, 1);

		//generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML($html);

		//download it.
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
		exit();
	}


	function simpan_user()
	{
		$code = $this->input->post('code');
		$name = $this->input->post('name');
		$pass = md5($this->input->post('password'));
		$tipe = $this->input->post('tipe');
		$img1 = $this->input->post('img1');
		$foto = $this->input->post('foto');

		/*
		//untuk upload gambar tanda tangan
		$nm_file = $code.".jpg";
		$config['upload_path']          = './gambar_ttd/';
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['max_size']             = 1000; //maksimal ukuran file
		$config['max_width']            = 2000; // maksimal lebar
		$config['max_height']           = 2000; // maksimal tinggi
		$config['file_name'] = $nm_file;
		$target = "./gambar_ttd/".$nm_file;
		
		//upload gambar tanda tangan
		$this->load->library('upload', $config);
		if($this->upload->do_upload('img1'))
		{
			$nm_file = $nm_file;
		}else{
			$nm_file = "";
		}
		*/
		//untuk upload gambar foto user
		$nm_file1 = $code . ".jpg";
		$config1['upload_path']          = './gambar_user/';
		$config1['allowed_types']        = 'jpeg|jpg|png';
		$config1['max_size']             = 1000; //maksimal ukuran file
		$config1['max_width']            = 2000; // maksimal lebar
		$config1['max_height']           = 2000; // maksimal tinggi
		$config1['file_name'] = $nm_file1;
		$target = "./gambar_user/" . $nm_file1;

		//upload gambar foto user
		//		$this->upload->initialize($config1);
		$this->load->library('upload', $config1);
		if ($this->upload->do_upload('foto')) {
			$nm_file1 = $nm_file1;
		} else {
			$nm_file1 = "";
		}
		//simpan gambar ke database		

		$res = $this->db->query("insert into t_user(kode,nama,password_user,tipe,foto,status)
									values('$code','$name','$pass','$tipe','$nm_file1','1')");

		if ($res >= 1) {
			$this->session->set_flashdata(
				'pesan',
				'Data Berhasil di Simpan!!!'
			);
			redirect(base_url() . 'index.php/utama/panggil/user');
		} else {

			redirect(base_url() . 'index.php/utama/');
		}
	}


	function user_edit($id, $kode)
	{
		$user = $this->session->userdata('user');
		$pengguna = $this->db->query("select * from t_user where kode='$kode'")->result_array();
		$bagian = $this->mymodel->get_bagian()->result_array();
		if ($id == 'voting') {
			$xx = '1';
		} else {
			$xx = '';
		}

		$data = array(
			'id' => $id,
			'user' => $user,
			'kode' => $pengguna[0]['kode'],
			'pengguna' => $pengguna[0]['nama'],
			'bagian1' => $pengguna[0]['bagian'],
			'bagian' => $bagian,
			'tanda_tangan' => $pengguna[0]['tanda_tangan'],
			'foto' => $pengguna[0]['foto'],
			'xx' => $xx,
		);
		$this->load->view('index', $data);
	}

	function simpan_user_edit()
	{
		$user = $this->session->userdata('user');
		$code = $this->input->post('code');
		$name = $this->input->post('name');
		$bagian = $this->input->post('bagian');
		$img1 = $this->input->post('img1');
		$foto = $this->input->post('fotoh');


		//hapus gambar foto
		if (($_FILES['foto']['name']) && ($foto != "")) {
			$target = "./gambar_user/" . $foto;
			if (file_exists($target)) {
				unlink($target);
			}
		}


		if (($_FILES['foto']['name']) && empty($_FILES['img1']['name'])) {
			//untuk upload gambar foto user
			$nm_file1 = $code . ".jpg";
			$config1['upload_path']          = './gambar_user/';
			$config1['allowed_types']        = 'jpeg|jpg|png';
			$config1['max_size']             = 1000; //maksimal ukuran file
			$config1['max_width']            = 2000; // maksimal lebar
			$config1['max_height']           = 2000; // maksimal tinggi
			$config1['file_name'] = $nm_file1;
			$target = "./gambar_user/" . $nm_file1;


			//upload gambar foto user
			$this->load->library('upload', $config1);
			$this->upload->do_upload('foto');
		} else {
			//untuk upload gambar foto user
			$nm_file1 = $code . ".jpg";
			$config1['upload_path']          = './gambar_user/';
			$config1['allowed_types']        = 'jpeg|jpg|png';
			$config1['max_size']             = 1000; //maksimal ukuran file
			$config1['max_width']            = 2000; // maksimal lebar
			$config1['max_height']           = 2000; // maksimal tinggi
			$config1['file_name'] = $nm_file1;
			$target = "./gambar_user/" . $nm_file1;


			//upload gambar foto user
			$this->upload->initialize($config1);
			$this->upload->do_upload('foto');
		}
		$upd_user = "update t_user set kode='$code',	
										   nama ='$name',
										   bagian ='$bagian',
										   foto = '$nm_file1'
										   where kode='$code'";
		$res = $this->db->query($upd_user);

		if ($res >= 1) {
			$this->session->set_flashdata('pesan', 'Data berhasil diUpdate!!!');

			redirect(base_url() . 'index.php/utama/panggil/user');
		} else {
			$this->session->set_flashdata('pesan', 'Data gagal diUpdate!!!');
			redirect(base_url() . 'index.php/utama/');
		}
	}


	function menu_user($id)
	{
		$pengguna1 = $this->input->post('pengguna');
		$user = $this->session->userdata('user');
		$pengguna = $this->mymodel->get_pengguna()->result_array();
		$data = array(
			'id' => $id,
			'user' => $user,
			'pengguna1' => $pengguna1,
			'pengguna' => $pengguna,
			'xx' => ""
		);
		$this->load->view('index', $data);
	}

	function simpan_menu()
	{
		$pengguna = $this->input->post('penggunah');
		$menu = $this->input->post('menu');
		$x = count($menu);
		//hapus data di table t_user_acl sesuai dengan nama pengguna
		$this->db->query("delete from t_user_acl where user='$pengguna'");
		for ($i = 0; $i < $x; $i++) {
			$menu1 = $menu[$i];
			$res = $this->db->query("insert into t_user_acl(user,acl)values('$pengguna','$menu1')");
		}
		$this->db->query("delete from t_user_acl where user='$pengguna' and acl='0'");
		if ($res > 0) {
			$this->session->set_flashdata('pesan', "Data berhasil di Simpan!!!");
			//$this->session->set_flashdata('pesan',$menu[0]."/".$menu[1]."/".$menu[2]."/".$menu[3]."/".$cek1[0]."/".$cek1[1]."/".$cek1[2]."/".$cek1[3]);
			redirect(base_url() . 'index.php/utama/panggil/menu');
		} else {
			$this->session->set_flashdata('pesan', "Data gagal di Simpan!!!");
			//$this->session->set_flashdata('pesan',$menu[0]."/".$menu[1]."/".$menu[2]."/".$cek2);
			redirect(base_url() . 'index.php/utama/panggil/menu');
		}
	}

	function simpan_karyawan()
	{
		$nip 			= strtoupper($this->input->post('nip'));
		$noslip			= $this->input->post('noslip');
		$noindukh		= $this->input->post('noindukh');
		$fotoh 			= $this->input->post('fotoh');
		$nokop 			= $this->input->post('nokop');
		$nama  			= strtoupper($this->input->post('nama'));
		$alamat 		= strtoupper($this->input->post('alamat'));
		$notlp 			= $this->input->post('notlp');
		$jekel 			= $this->input->post('jekel');
		$agama 			= $this->input->post('agama');
		$tempat_lahir 	= strtoupper($this->input->post('tempat_lahir'));
		$tgl_lahir 		= $this->input->post('tgl_lahir');
		$sperkawinan 	= $this->input->post('sperkawinan');
		$jumanak 		= $this->input->post('jumanak');
		$pendidikan	 	= $this->input->post('pendidikan');
		$tgl_masuk 		= $this->input->post('tgl_masuk');
		$penempatan 	= strtoupper($this->input->post('penempatan'));
		$skill 			= $this->input->post('skill');
		$divisi 		= $this->input->post('divisi');
		$bagian 		= $this->input->post('bagian');
		$seksi 			= $this->input->post('seksi');
		$jabatan 		= $this->input->post('jabatan');
		$tipe 			= $this->input->post('tipe');
		$status 		= $this->input->post('status');
		$cc 	 		= $this->input->post('cc');
		$ktp 			= $this->input->post('ktp');
		$npwp 			= $this->input->post('npwp');
		$kpj 			= $this->input->post('kpj');
		$bpjs 			= $this->input->post('bpjs');
		$norek 			= $this->input->post('norek');
		$penggajian		= $this->input->post('penggajian');
		$ln 			= $this->input->post('ln');
		$pensiun 		= $this->input->post('pensiun');
		$spsi 			= $this->input->post('spsi');

		//mencari no induk paling akhir
		$sqlnoinduk = $this->db->query("select max(noinduk) as noinduk from t_karyawan")->result_array();
		$noindukmax = $sqlnoinduk[0]['noinduk'];
		$noinduk = $noindukmax + 1;

		//hapus gambar foto
		if (($_FILES['file']['name']) && ($fotoh != "")) {
			$target = "./foto/" . $fotoh;
			if (file_exists($target)) {
				unlink($target);
			}
		}


		//untuk upload gambar foto
		$nm_file = $noinduk . ".jpg";
		$config['upload_path']          = './foto/';
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['max_size']             = 1000; //maksimal ukuran file
		$config['max_width']            = 2000; // maksimal lebar
		$config['max_height']           = 2000; // maksimal tinggi
		$config['file_name'] = $nm_file;
		$target = "./foto/" . $nm_file;



		// //upload gambar tanda tangan
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file')) {
			$nm_file = $nm_file;
		} else {
			$nm_file = "";
		}

		$cek = $this->db->query("select * from t_karyawan where noinduk = '$noindukh'")->num_rows();
		if ($cek > 0) {
			$update = $this->db->query("update t_karyawan set 	noslip 		= '$noslip',
			 													nokop 		= '$nokop',
			 													nama 		= '$nama',
			 													alamat		= '$alamat',
			 													foto 		= '$nm_file',
			 													notlp 		= '$notlp',
			 													tmplahir 	= '$tempat_lahir',
			 													tgllahir 	= '$tgl_lahir',
			 													kelamin 	= '$jekel',
			 													sperkawinan = '$sperkawinan',
			 													jumanak 	= '$jumanak',
			 													agama 		= '$agama',
			 													pendidikan 	= '$pendidikan',
			 													divisi 		= '$divisi',
			 													bagian 		= '$bagian',
			 													seksi 		= '$seksi',
			 													jabatan 	= '$jabatan',
			 													tglmasuk 	= '$tgl_masuk',
			 													skerja 		= '$status',
			 													pabrik 		= '$penempatan',
			 													skill 		= '$skill',
			 													tkaryawan 	= '$tipe',
			 													costcenter 	= '$cc',
			 													noktp 		= '$ktp',
			 													nonpwp 		= '$npwp',
			 													nokpj 		= '$kpj',
			 													nobpjs 		= '$bpjs',
			 													norek 		= '$norek',
			 													ln 			= '$ln',
			 													spsi 		= '$spsi' ,
			 													pensiun 	= '$pensiun',
			 													upah 		= '$penggajian'
			 													where noinduk = '$noindukh'");
			$hasil["pesan"] = "data berhasil diUpdate";
		} else {
			$insert = $this->db->query("insert into t_karyawan(nip,noinduk,noslip,nokop,nama,alamat,foto,notlp,tmplahir,tgllahir,kelamin,sperkawinan,jumanak,agama,pendidikan,divisi,bagian,seksi,jabatan,tglmasuk,skerja,pabrik,skill,tkaryawan,costcenter,noktp,nonpwp,nokpj,nobpjs,norek,ln,spsi,pensiun,upah,saktif)values('$nip','$noinduk','$noslip','$nokop','$nama','$alamat','$nm_file','$notlp','$tempat_lahir','$tgl_lahir','$jekel','$sperkawinan','$jumanak','$agama','$pendidikan','$divisi','$bagian','$seksi','$jabatan','$tgl_masuk','$status','$penempatan','$skill','$tipe','$cc','$ktp','$npwp','$kpj','$bpjs','$norek','$ln','$spsi','$pensiun','$penggajian','1')");
			$hasil["pesan"] = "data berhasil diSimpan";
		}




		echo json_encode($hasil);
	}



	function edit_karyawan()
	{
		$noinduk = $this->input->post('noinduk');
		$sql = "select * from t_karyawan where noinduk='$noinduk' and saktif='1'";
		$data = $this->db->query($sql)->result_array();
		$data = array(
			'data' => $data,
		);
		$this->load->view('personalia/view/edit_karyawan', $data);
		//	redirect(base_url().'index.php/utama/panggil/tambahkaryawan',$data);
	}

	function report_pdf_pd($cek, $cat, $kode, $barcode, $bulan, $tahun)
	{
		if ($cek == "1") {
			$kode = "0";
			$barcode = "0";
			$bulan = "0";
			$tahun = "0";
			$sql = "select * from t_product where cat='$cat'";
			$data = $this->db->query($sql)->result_array();
		} elseif ($cek == "2") {
			$cat = "0";
			$barcode = "0";
			$bulan = "0";
			$tahun = "0";

			$data = $this->db->query("select * from t_product where kode='$kode'")->result_array();
		} elseif ($cek == "3") {
			$cat = "0";
			$kode = "0";
			$bulan = "0";
			$tahun = "0";

			$sql = "select a.* from t_product a
					left join t_product_detail b on b.kode=a.kode
					where b.barcode='$barcode'";
			$data = $this->db->query($sql)->result_array();
		} elseif ($cek == "4") {
			$cat = "0";
			$kode = "0";
			$barcode = "0";

			$sql = "select * from t_product where bulan = '$bulan' and tahun='$tahun'";
			$data = $this->db->query($sql)->result_array();
		} else {
			$data = "";
		}
		$data = array(
			'data' => $data,
			'cek' => $cek,
			'cat' => $cat,
			'kode' => $kode,
			'barcode' => $barcode,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'xx' => ""
		);


		$sumber = $this->load->view('product/hasil_report_pdf', $data, TRUE);
		$html = $sumber;


		//this the the PDF filename that user will get to download
		$pdfFilePath = "Report Product List.pdf";

		//load mPDF library
		$this->load->library('m_pdf');

		$this->m_pdf->pdf->AddPage('L');
		$this->m_pdf->pdf->WriteHTML($stylesheet, 1);

		//generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML($html);

		//download it.
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
		exit();
	}



	///excell report
	function report_csv_pd($cek, $cat, $kode, $barcode, $bulan, $tahun)
	{
		ini_set('max_execution_time', '3000');


		if ($cek == "1") {
			$sql = "select * from t_product where cat='$cat'";
			$data = $this->db->query($sql)->result_array();
		} elseif ($cek == "2") {
			$data = $this->db->query("select * from t_product where kode='$kode'")->result_array();
		} elseif ($cek == "3") {
			$sql = "select a.* from t_product a
					left join t_product_detail b on b.kode=a.kode
					where b.barcode='$barcode'";
			$data = $this->db->query($sql)->result_array();
		} elseif ($cek == "4") {
			$sql = "select * from t_product where bulan = '$bulan' and tahun='$tahun'";
			$data = $this->db->query($sql)->result_array();
		} else {
			$data = "";
		}


		// Create new PHPExcel object
		$csv = new PHPExcel();

		// Set properties
		$csv->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");

		$csv->setActiveSheetIndex(0)
			->setCellValue('A1', 'Laporan List Of Product')
			->setCellValue('A2', 'DBL INDONESIA')
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'Category')
			->setCellValue('C3', 'Product')
			->setCellValue('D3', 'Variant')
			->setCellValue('E3', 'Code')
			->setCellValue('F3', 'Supplier')
			->setCellValue('G3', 'Unit Cost')
			->setCellValue('H3', 'Unit Price')
			->setCellValue('I3', 'Release')
			->setCellValue('J3', 'Product Code');



		//add data
		$counter = 4;
		$ex = $csv->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		foreach ($data as $d) {
			$mykode = $d['kode'];
			$hr_ini = date('Y-m-d');
			$bar = $this->db->query("select * from t_product_detail where kode='$mykode'")->result_array();
			$brand = $this->db->query("select * from t_brand where kode='$d[brand]'")->result_array();
			$category = $this->db->query("select * from t_kategori where kode='$d[cat]'")->result_array();
			$tipe = $this->db->query("select * from t_tipe where kode='$d[tipe]'")->result_array();
			$vendor = $this->db->query("select a.vendor,b.nama from t_po a
										left join t_vendor b on b.kode=a.vendor
										where a.kode = '$mykode'
										group by a.kode")->result_array();
			if ($vendor) {
				$supplier = $vendor[0]['nama'];
			} else {
				$supplier = "-";
			}
			$cat = $brand[0]['nama'] . " / " . $category[0]['nama'] . " / " . $tipe[0]['nama'];
			foreach ($bar as $b) {

				$ukuran = $this->db->query("select nama from t_size where kode='$b[size]'")->result_array();


				$ex->setCellValue("A" . $counter, $no);
				$ex->setCellValue("B" . $counter, $cat);
				$ex->setCellValue("C" . $counter, $d['article_name']);
				$ex->setCellValue("D" . $counter, $ukuran[0]['nama']);
				$ex->setCellValue("E" . $counter, $b['barcode']);
				$ex->setCellValue("F" . $counter, $supplier);
				$ex->setCellValue("G" . $counter, $d['unit_cost']);
				$ex->setCellValue("H" . $counter, $d['harga']);
				$ex->setCellValue("I" . $counter, $d['estimasi_end']);
				$ex->setCellValue("J" . $counter, $d['kode']);
				$counter = $counter + 1;
				$no++;
			}
		}

		// Set orientasi kertas jadi LANDSCAPE
		$csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		//set judul file excel nya
		$csv->getActiveSheet(0)->setTitle("Product Report");
		$csv->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Product.csv"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = new PHPExcel_Writer_CSV($csv);
		$write->save('php://output');
	}

	function proses_resign()
	{
		$noinduk = $this->input->post('noinduk');
		$tgl = date('Y-m-d');
		$act = $this->db->query("update t_karyawan set saktif='0' where noinduk ='$noinduk'");
		$upd = $this->db->query("insert into t_resign(noinduk,tgl)value('$noinduk','$tgl')");

		$hasil['pesan'] = 'data berhasil';

		echo json_encode($hasil);
	}

	// Awal Get Data Komp gaji server side
	function get_data_kompgaji()
	{
		$list = $this->mymodel->get_kompgaji_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$noinduk = $field->noinduk;
			$jeneng = $this->db->query("select nama from t_karyawan where noinduk='$noinduk'")->result_array();
			$row = array();
			$row[] = $no;
			$row[] = $field->noinduk;
			$row[] = $field->nama;
			$row[] = number_format($field->gp);
			$row[] = number_format($field->tjab);
			$row[] = number_format($field->t3m);
			$row[] = number_format($field->t3e);
			$row[] = "<a href='#frmgaji' data-toggle='modal' class='badge badge-primary' onclick='submit($field->noinduk)'>edit</a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mymodel->count_all(),
			"recordsFiltered" => $this->mymodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	// Akhir get data Komp gaji server sida
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */