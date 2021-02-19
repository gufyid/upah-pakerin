<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Mingguan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function ambil_absen_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
		$hasil = $this->mymodel->jumlah_absen_mingguan($pawal, $pakhir)->result_array();
		$data = array(
			'data' => $hasil,
			'awal' => $pawal,
			'akhir' => $pakhir
		);
		$this->load->view('upah/mingguan/absensi/view', $data);
	}

	function ambil_gaji_mingguan()
	{
		$periode_awal_upah = $this->input->post('periode_awal_upah');
		$periode_akhir_upah = $this->input->post('periode_akhir_upah');
		$hasil = $this->mymodel->jumlah_gaji_mingguan($periode_awal_upah, $periode_akhir_upah)->result_array();
		$data = array(
			'data' => $hasil,
			'periode_awal_upah' => $periode_awal_upah,
			'periode_akhir_upah' => $periode_akhir_upah
		);
		$this->load->view('upah/mingguan/proses/view', $data);
	}

	function hitung_tanggal()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$data = array(
			'tgl_awal' => $tgl_awal
		);
		$this->load->view('upah/mingguan/absensi/vtgl', $data);
	}

	function ambil_lt_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
		$hasil = $this->mymodel->jumlah_lt_mingguan($pawal, $pakhir)->result_array();
		$data = array(
			'data' => $hasil,
			'awal' => $pawal,
			'akhir' => $pakhir
		);
		$this->load->view('upah/mingguan/lt/view', $data);
	}

	function ambil_rekap_lembur_mingguan()
	{
		$periode_awal 	= $this->input->post('periode_awal');
		$periode_akhir 	= $this->input->post('periode_akhir');
		$status 		= $this->input->post('status');
		$pabrik 		= $this->input->post('pabrik');

		$hasil = $this->db->query("select seksi,sum(lembur) as lembur, sum(jam) as jam  from t_rekap_lembur_mingguan where  periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$status' and (lembur != 0 or jam != 0) group by seksi")->result_array();

		$data = array(
			'data' => $hasil,
			'periode_awal'  => $periode_awal,
			'periode_akhir' => $periode_akhir,
			'status' 		=> $status,
			'pabrik'		=> $pabrik
		);
		$this->load->view('upah/mingguan/laporan/view/view_rekap_lembur', $data);
	}

	function jumlah_absen_mingguan()
	{

		$data = $this->mymodel->jumlah_absen_mingguan('t_absen_mingguan')->num_rows();
		echo json_encode($data);
	}

	function datainsentif()
	{
		$noinduk = $this->input->post('id');
		$sql = "select a.*,b.nama from t_insentif_mingguan a
				left join t_karyawan b on b.noinduk=a.noinduk
				where a.noinduk = '$noinduk'";

		$dataku = $this->db->query($sql)->result();

		echo json_encode($dataku);
	}

	function ambil_premi_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
		$hasil = $this->mymodel->jumlah_premi_mingguan($pawal, $pakhir)->result_array();
		$data = array(
			'data' => $hasil,
			'awal' => $pawal,
			'akhir' => $pakhir
		);
		$this->load->view('upah/mingguan/premi/view', $data);
	}

	function ambil_koperasi_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
		$hasil = $this->mymodel->jumlah_koperasi_mingguan($pawal, $pakhir)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/mingguan/koperasi/view', $data);
	}


	function ambilid()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$pawal = $pecah[1];
		$pakhir = $pecah[2];
		$data = $this->db->query("select * from t_absen_mingguan where noinduk='$id' and pawal='$pawal' and pakhir='$pakhir'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidpremi()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$pawal = $pecah[1];
		$pakhir = $pecah[2];
		$data = $this->db->query("select * from t_premi_mingguan where noinduk='$noinduk' and pawal='$pawal' and pakhir='$pakhir'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidlt()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$pawal = $pecah[1];
		$pakhir = $pecah[2];
		$data = $this->db->query("select * from t_lt_mingguan where noinduk='$noinduk' and pawal='$pawal' and pakhir='$pakhir'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidkop()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noac = $pecah[0];
		$pawal = $pecah[1];
		$pakhir = $pecah[2];
		$data = $this->db->query("select * from t_koperasi_mingguan where noac='$noac' and pawal='$pawal' and pakhir='$pakhir'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidspl()
	{
		$id 			= $this->input->post('y');
		$pecah 			= explode(",", $id);
		$noinduk 		= $pecah[0];
		$periode_awal 	= $pecah[1];
		$periode_akhir 	= $pecah[2];
		$status 	 	= $pecah[3];
		$data = $this->db->query("select * from t_spl_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$status'")->result();

		echo json_encode($data);
	}

	function ambilinsentif()
	{
		$id = $this->input->post('z');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$periode_awal = $pecah[1];
		$periode_akhir = $pecah[2];
		$data = $this->db->query("select * from t_insentif_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'")->result();

		echo json_encode($data);
	}

	function ambiladjustment()
	{
		$id 			= $this->input->post('z');
		$pecah 			= explode(",", $id);
		$noinduk 		= $pecah[0];
		$periode_awal   = $pecah[1];
		$periode_akhir  = $pecah[2];
		$komponen 		= $pecah[3];
		$data = $this->db->query("select * from t_adjustment_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$komponen'")->result_array();
		/*$data = array(
			'noinduk' => $noinduk,
			'komponen' => $komponen,
			'awal' => $periode_awal,
			'akhir' => $periode_akhir
		);*/
		echo json_encode($data);
	}

	function pecahdata()
	{
		$id 			= $this->input->post('y');
		$pecah 			= explode(",", $id);
		$noinduk 		= $pecah[0];
		$periode_awal 	= $pecah[1];
		$periode_akhir 	= $pecah[2];
		$komponen 		= $pecah[3];
		/*$data = $this->db->query("select * from t_insentif_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'")->result();*/
		$data = array(
			'noinduk'		 => $noinduk,
			'periode_awal'	 => $periode_awal,
			'periode_akhir'  => $periode_akhir,
			'komponen'		     => $komponen

		);

		echo json_encode($data);
	}

	function ambil_karyawan_seksi()
	{
		$seksi 		  = $this->input->post('seksi');
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		$status = $this->input->post('status');


		$result = $this->db->query("select * from t_karyawan where seksi='$seksi' and upah='Y' and tkaryawan='harian' and saktif='1'")->result_array();

		$data = array(
			'data' 			=> $result,
			'seksi'			=> $seksi,
			'periode_awal'	=> $periode_awal,
			'periode_akhir'	=> $periode_akhir,
			'status'		=> $status,
		);
		$this->load->view('upah/mingguan/spl/view', $data);
	}

	function ambil_karyawan_seksi_insentif()
	{
		$seksi 		  = $this->input->post('seksi');
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');


		$result = $this->db->query("select * from t_karyawan where seksi='$seksi' and upah='Y' and tkaryawan='harian' and saktif='1' and skerja='T'")->result_array();

		$data = array(
			'data' 			=> $result,
			'seksi'			=> $seksi,
			'periode_awal'	=> $periode_awal,
			'periode_akhir'	=> $periode_akhir
		);
		$this->load->view('upah/mingguan/insentif/view', $data);
	}

	function ambil_karyawan_seksi_adjustment()
	{
		$seksi 		   = $this->input->post('seksi');
		$komponen 	   = $this->input->post('komponen');
		$periode_awal  = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');


		$result = $this->db->query("select * from t_karyawan where seksi='$seksi' and upah='Y' and tkaryawan='harian' and saktif='1'")->result_array();

		$data = array(
			'data' 			=> $result,
			'seksi'			=> $seksi,
			'komponen'		=> $komponen,
			'periode_awal'	=> $periode_awal,
			'periode_akhir'	=> $periode_akhir
		);
		$this->load->view('upah/mingguan/adjustment/view', $data);
	}

	function hitung_tgl()
	{
		$id 			= $this->input->post('id');
		$pecah 			= explode(',', $id);
		$noinduk 		= $pecah[0];
		$periode_awal	= $pecah[1];
		$periode_akhir	= $pecah[2];
		$arraytgl		= [];

		$tanggal1 = new DateTime($periode_awal);
		$tanggal2 = new DateTime($periode_akhir);

		//selisih tanggal
		$perbedaan = $tanggal1->diff($tanggal2);
		$selisih = $perbedaan->d;

		for ($i = 0; $i <= $selisih; $i++) {
			$tgl2 = date("Y-m-d", strtotime('+' . $i . ' days', strtotime($periode_awal)));
			$pecah = explode('-', $tgl2);

			$arraytgl[] = $pecah[2];
		};

		$data = array(
			'noinduk' 		=> $noinduk,
			'arraytgl'		=> $arraytgl,
			'periode_awal'	=> $periode_awal,
			'periode_akhir' => $periode_akhir,
			'beda'			=> $selisih
		);
		echo json_encode($data);
		//	$this->load->view('upah/mingguan/spl/viewtgl',$data);
	}

	function upload_absensi_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
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
		//hapus data dengan bulan dan tahun yang sama
		$del = $this->db->query("delete from t_absen_mingguan where pawal ='$pawal' and pakhir='$pakhir'");

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk	= $rowData[0][0];
			$jumabsen 	= $rowData[0][12];
			$jumcuti 	= $rowData[0][14];
			$cek = $this->db->query("select * from t_absen_mingguan where noinduk = '$noinduk' and pawal ='$periode_awal' and pakhir='$periode_akhir'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_absen_mingguan(noinduk,pawal,pakhir,jum_absen,jum_cuti)values('$noinduk','$pawal','$pakhir','$jumabsen','$jumcuti')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_lt_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
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
		//hapus data dengan bulan dan tahun yang sama
		$del = $this->db->query("delete from t_lt_mingguan where pawal ='$pawal' and pakhir='$pakhir'");

		for ($row = 3; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk	= $rowData[0][0];
			$jumlt 		= $rowData[0][26];
			$cek = $this->db->query("select * from t_lt_mingguan where noinduk = '$noinduk' and pawal ='$pawal' and pakhir='$pakhir'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_lt_mingguan(noinduk,pawal,pakhir,jumlt)values('$noinduk','$pawal','$pakhir','$jumlt')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_premi_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
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
		//hapus data dengan bulan dan tahun yang sama
		$del = $this->db->query("delete from t_premi_mingguan where pawal ='$pawal' and pakhir='$pakhir'");

		for ($row = 5; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk	= $rowData[0][0];
			$jumpremi 	= $rowData[0][5];
			$cek = $this->db->query("select * from t_premi_mingguan where noinduk = '$noinduk' and pawal ='$pawal' and pakhir='$pakhir'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_premi_mingguan(noinduk,pawal,pakhir,jumpremi)values('$noinduk','$pawal','$pakhir','$jumpremi')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_koperasi_mingguan()
	{
		$pawal = $this->input->post('periode_awal');
		$pakhir = $this->input->post('periode_akhir');
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
		//hapus data dengan bulan dan tahun yang sama
		$del = $this->db->query("delete from t_koperasi_mingguan where pawal ='$pawal' and pakhir='$pakhir'");

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noac		 = $rowData[0][0];
			$status 	 = $rowData[0][1];
			$jumkoperasi = $rowData[0][2];
			$cicilan 	 = $rowData[0][3];

			$cek = $this->db->query("select * from t_koperasi_mingguan where noac = '$noinduk' and pawal ='$pawal' and pakhir='$pakhir'")->num_rows();
			if ($cek <= 0) {
				if ($status == 'H') {
					$sql = "insert into t_koperasi_mingguan(noac,pawal,pakhir,jumkoperasi,cicilan)values('$noac','$pawal','$pakhir','$jumkoperasi','$cicilan')";
					$insert = $this->db->query($sql);
				}
			}

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function update_absen_mingguan()
	{
		$noinduk = $this->input->post('noinduk');
		$pawal = $this->input->post('pawal');
		$pakhir = $this->input->post('pakhir');
		$jum_absen = $this->input->post('jum_absen');
		$jum_cuti = $this->input->post('jum_cuti');
		$update = $this->db->query("update t_absen_mingguan set jum_absen='$jum_absen',jum_cuti='$jum_cuti' where noinduk='$noinduk' and pawal='$pawal' and pakhir='$pakhir'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_premi_mingguan()
	{
		$noinduk = $this->input->post('noinduk');
		$pawal = $this->input->post('pawal');
		$pakhir = $this->input->post('pakhir');
		$jumpremi = $this->input->post('jumpremi');
		$update = $this->db->query("update t_premi_mingguan set jumpremi='$jumpremi' where noinduk='$noinduk' and pawal='$pawal' and pakhir='$pakhir'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_lt_mingguan()
	{
		$noinduk = $this->input->post('noinduk');
		$pawal = $this->input->post('pawal');
		$pakhir = $this->input->post('pakhir');
		$jumlt = $this->input->post('jumlt');
		$update = $this->db->query("update t_lt_mingguan set jumlt='$jumlt' where noinduk='$noinduk' and pawal='$pawal' and pakhir='$pakhir'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_koperasi_mingguan()
	{
		$noac = $this->input->post('noac');
		$pawal = $this->input->post('pawal');
		$pakhir = $this->input->post('pakhir');
		$jumkop = $this->input->post('jumkoperasi');
		$update = $this->db->query("update t_koperasi_mingguan set jumkoperasi='$jumkop' where noac='$noac' and pawal='$pawal' and pakhir='$pakhir'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_insentif()
	{
		$noinduk = $this->input->post('noinduk');
		$insentif = $this->input->post('insentif');
		$update = $this->db->query("update t_insentif_mingguan set insentif = '$insentif' where noinduk ='$noinduk'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function simpan_insentif()
	{
		$noinduk = $this->input->post('noinduk');
		$insentif = $this->input->post('insentif');
		$sqlseksi = $this->db->query("select * from t_karyawan where noinduk='$noinduk' and tkaryawan = 'harian' and saktif='1'")->result_array();
		if ($sqlseksi) {
			$cek = $this->db->query("select * from t_insentif_mingguan where noinduk='$noinduk'")->num_rows();
			if ($cek <= 0) {
				$seksi = $sqlseksi[0]['seksi'];
				$simpan = $this->db->query("insert into t_insentif_mingguan(noinduk,insentif,seksi)values('$noinduk','$insentif','$seksi')");
				$result['pesan'] = 'Berhasil Disimpan';
			} else {
				$seksi = $sqlseksi[0]['seksi'];
				$update = $this->db->query("update t_insentif_mingguan set insentif = '$insentif' where noinduk='$noinduk'");
				$result['pesan'] = 'Berhasil diUpdate';
			}
		} else {
			$result['pesan'] = 'No Induk Tidak Ada';
		}

		echo json_encode($result);
	}

	function simpan_spl()
	{
		$noinduk 		= $this->input->post('noinduk');
		$periode_awal	= $this->input->post('periode_awal');
		$periode_akhir	= $this->input->post('periode_akhir');
		$status 		= $this->input->post('status');
		$proyek			= $this->input->post('proyek');
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$tgl3 = $this->input->post('tgl3');
		$tgl4 = $this->input->post('tgl4');
		$tgl5 = $this->input->post('tgl5');
		$tgl6 = $this->input->post('tgl6');
		$tgl7 = $this->input->post('tgl7');
		$tgl8 = $this->input->post('tgl8');
		$tgl9 = $this->input->post('tgl9');
		$tgl10 = $this->input->post('tgl10');
		$tgl11 = $this->input->post('tgl11');
		$tgl12 = $this->input->post('tgl12');
		$tgl13 = $this->input->post('tgl13');
		$tgl14 = $this->input->post('tgl14');
		$tgl15 = $this->input->post('tgl15');
		$tgl16 = $this->input->post('tgl16');
		$tgl17 = $this->input->post('tgl17');
		$tgl18 = $this->input->post('tgl18');
		$tgl19 = $this->input->post('tgl19');
		$tgl20 = $this->input->post('tgl20');
		$tgl21 = $this->input->post('tgl21');
		$tgl22 = $this->input->post('tgl22');
		$tgl23 = $this->input->post('tgl23');
		$tgl24 = $this->input->post('tgl24');
		$tgl25 = $this->input->post('tgl25');
		$tgl26 = $this->input->post('tgl26');
		$tgl27 = $this->input->post('tgl27');
		$tgl28 = $this->input->post('tgl28');
		$tgl29 = $this->input->post('tgl29');
		$tgl30 = $this->input->post('tgl30');
		$tgl31 = $this->input->post('tgl31');
		$cek = $this->db->query("select * from t_spl_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$status'")->num_rows();
		if ($cek > 0) {
			$act = $this->db->query("update t_spl_mingguan set status = '$status',
															   proyek = '$proyek',
																tgl1='$tgl1',
																 tgl2='$tgl2',
																 tgl3='$tgl3',
																 tgl4='$tgl4',
																 tgl5='$tgl5',
																 tgl6='$tgl6',
																 tgl7='$tgl7',
																 tgl8='$tgl8',
																 tgl9='$tgl9',
																 tgl10='$tgl10',
																 tgl11='$tgl11',
																 tgl12='$tgl12',
																 tgl13='$tgl13',
																 tgl14='$tgl14',
																 tgl15='$tgl15',
																 tgl16='$tgl16',
																 tgl17='$tgl17',
																 tgl18='$tgl18',
																 tgl19='$tgl19',
																 tgl20='$tgl20',
																 tgl21='$tgl21',
																 tgl22='$tgl22',
																 tgl23='$tgl23',
																 tgl24='$tgl24',
																 tgl25='$tgl25',
																 tgl26='$tgl26',
																 tgl27='$tgl27',
																 tgl28='$tgl28',
																 tgl29='$tgl29',
																 tgl30='$tgl30',
																 tgl31='$tgl31' where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'");
		} else {
			$act = $this->db->query("insert into t_spl_mingguan(noinduk,periode_awal,periode_akhir,proyek,tgl1,tgl2,tgl3,tgl4,tgl5,tgl6,tgl7,tgl8,tgl9,tgl10,tgl11,tgl12,tgl13,tgl14,tgl15,tgl16,tgl17,tgl18,tgl19,tgl20,tgl21,tgl22,tgl23,tgl24,tgl25,tgl26,tgl27,tgl28,tgl29,tgl30,tgl31,status)values('$noinduk','$periode_awal','$periode_akhir','$proyek','$tgl1','$tgl2','$tgl3','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$tgl10','$tgl11','$tgl12','$tgl13','$tgl14','$tgl15','$tgl16','$tgl17','$tgl18','$tgl19','$tgl20','$tgl21','$tgl22','$tgl23','$tgl24','$tgl25','$tgl26','$tgl27','$tgl28','$tgl29','$tgl30','$tgl31','$status')");
		}
		echo json_encode($act);
	}

	// function simpan_insentif()
	// {
	// 	$noinduk 		= $this->input->post('noinduk');
	// 	$periode_awal	= $this->input->post('periode_awal');
	// 	$periode_akhir	= $this->input->post('periode_akhir');
	// 	$insentif       = $this->input->post('insentif');
	// 	$seksi 	        = $this->input->post('seksi');

	// 	$cek = $this->db->query("select * from t_insentif_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'")->num_rows();
	// 	if($cek > 0)
	// 	{
	// 		$act = $this->db->query("update t_insentif_mingguan set insentif='$insentif'
	// 															    where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'");	
	// 	}else{
	// 		$act = $this->db->query("insert into t_insentif_mingguan(noinduk,periode_awal,periode_akhir,insentif,seksi)values('$noinduk','$periode_awal','$periode_akhir','$insentif','$seksi')");
	// 	}
	// 	echo json_encode($act);

	// }

	function simpan_adjustment()
	{
		$noinduk 		= $this->input->post('noinduk');
		$komponen 		= $this->input->post('komponen');
		$periode_awal   = $this->input->post('periode_awal');
		$periode_akhir	= $this->input->post('periode_akhir');
		$adjustment     = $this->input->post('adjustment');
		$cek = $this->db->query("select * from t_adjustment_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$komponen'")->num_rows();
		if ($cek > 0) {
			$act = $this->db->query("update t_adjustment_mingguan set adjustment='$adjustment'
																    where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$komponen'");
		} else {
			$act = $this->db->query("insert into t_adjustment_mingguan(noinduk,periode_awal,periode_akhir,adjustment,status)values('$noinduk','$periode_awal','$periode_akhir','$adjustment','$komponen')");
		}
		echo json_encode($act);
	}

	function proses_gaji()
	{
		$periode_awal_data = $this->input->post('periode_awal_data');
		$periode_akhir_data = $this->input->post('periode_akhir_data');
		$periode_awal_upah = $this->input->post('periode_awal_upah');
		$periode_akhir_upah = $this->input->post('periode_akhir_upah');


		//ambil komponen gaji sama (umk,tmakan,spsi)
		$komp_gaji_tetap = $this->db->query("select * from t_komp_gaji_sama")->result_array();
		$umk 	= $komp_gaji_tetap[0]['ump'];
		$tmakan = $komp_gaji_tetap[0]['t_makan'];
		$spsi 	= $komp_gaji_tetap[0]['spsi'];

		//cek premi
		$cekpremi = $this->db->query("select jumpremi from t_premi_mingguan where pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->num_rows();

		//ambil semua karyawan mingguan yg aktif
		$karyawan = $this->db->query("select * from t_karyawan where tkaryawan='harian' and saktif='1' and upah='Y'")->result_array();
		foreach ($karyawan as $d) {
			//perhitungan semua komponen gaji
			$noinduk 	= $d['noinduk'];
			$noac 		= $d['nokop'];
			$skerja		= $d['skerja'];

			$komp_gaji = $this->db->query("select * from t_komp_gaji where noinduk='$noinduk'")->result_array();

			//hapus data jika sudah ada
			$this->db->query("delete from t_gaji_mingguan where noinduk='$noinduk' and periode_awal_upah ='$periode_awal_upah' and periode_akhir_upah='$periode_akhir_upah'");

			//mencari jumlah absen dan jumlah cuti
			$absen = $this->db->query("select jum_absen,jum_cuti from t_absen_mingguan where noinduk='$noinduk' and pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->result_array();

			//mencari jumlah pinjaman koperasi
			$koperasi = $this->db->query("select jumkoperasi from t_koperasi_mingguan where noac='$noac' and pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->result_array();

			//mencari jumlah lt
			$lt = $this->db->query("select jumlt from t_lt_mingguan where noinduk='$noinduk' and pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->result_array();

			//mencari jumlah SPL
			$sql = "select (tgl1 + tgl2 + tgl3 + tgl4 + tgl5 + tgl6 + tgl7 + tgl8 + tgl9 + tgl10 + tgl11 + tgl12 + tgl13 + tgl14 + tgl15 + tgl16 + tgl17 + tgl18 + tgl19 + tgl20 + tgl21 + tgl22 + tgl23 + tgl24 + tgl25 + tgl26 + tgl27 + tgl28 + tgl29 + tgl30 + tgl31) as jumspl from t_spl_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal_data' and periode_akhir='$periode_akhir_data'";
			$spl = $this->db->query($sql)->result_array();

			//mencari jumlah premi
			$premi = $this->db->query("select jumpremi from t_premi_mingguan where noinduk='$noinduk' and pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->result_array();

			//mencari insentif
			$insentif = $this->db->query("select * from t_insentif_mingguan where noinduk='$noinduk'")->result_array();
			$juminsentif = $insentif[0]['insentif'];


			if ($absen) {
				$jumabsen = $absen[0]['jum_absen'];
				$jumcuti  = $absen[0]['jum_cuti'];
			} else {
				$jumabsen = 0;
				$jumcuti  = 0;
			}

			if ($koperasi) {
				$jumkop = $koperasi[0]['jumkoperasi'];
			} else {
				$jumkop = 0;
			}

			if ($lt) {
				$jumlt = $lt[0]['jumlt'];
			} else {
				$jumlt = 0;
			}

			if ($spl) {
				$jumspl = $spl[0]['jumspl'];
			} else {
				$jumspl = 0;
			}

			if ($premi) {
				$jumpremi = $premi[0]['jumpremi'];
			} else {
				$jumpremi = 0;
			}

			$tp = $komp_gaji[0]['pendapatan'];
			$gp = $komp_gaji[0]['gp'];
			$tjab = $komp_gaji[0]['tjab'];
			$t3m = $komp_gaji[0]['t3m'];
			$t3e = $komp_gaji[0]['t3e'];
			$komp_jam_lembur = ($gp + $tjab + $tmakan) / 173;

			//komponen penambahan
			$upah = (($gp + $tjab + $tmakan) / 30) * 14;
			$premi = (($gp + $tjab + $tmakan) * $jumpremi) / 100; //(upah x % premi)-->round
			$lt = $komp_jam_lembur * $jumlt; // (komp_jam_lembur x jam lt)
			$spl = $komp_jam_lembur * $jumspl; //(komp_jam_lembur x jam spl)

			//komponen pemotong
			if ($d['skerja'] == 'T') //jika karyawan tetap
			{
				$jht = (($gp + $tjab + $tmakan) * 2) / 100; //jht,jkn dan jkk ,jika karyawan tetap (upah x 2%)-->round
				$pensiun = (($gp + $tjab + $tmakan) * 1) / 100; //jika karyawan tetap (upah x 1%)-->round
			} else {
				$jht = 0;
				$pensiun = 0;
			}

			if (($cekpremi > 0) && ($d['potbpjs'] == '1')) {
				$bpjs_kes = ($umk * 1) / 100; // jika ada kartu (umk x 1%) --> round				
			} else {
				$bpjs_kes = 0;
			}

			$pot_t3m = (($t3m + $t3e) / 30) * $jumcuti; //(t3m + t3e)/30 x jumlah CH/IA ---> cuti haid/ijin alpha

			if ($skerja == 'T') {
				$pot_absen = ((($gp + $t3m + $t3e) * 4) / 100) * $jumabsen; //(gp + t3m + t3e) x 4% x jumlah absen (TETAP)
			} else {
				$pot_absen = ($tp / 30) * $jumabsen; //(gp + t3m + t3e) x 4% x jumlah absen (TETAP)
			}

			$koperasi = $jumkop;

			if (($cekpremi > 0) && ($d['spsi'] == '1')) {
				$spsi1     = $spsi;
			} else {
				$spsi1 = 0;
			}

			//$faktor = ($jht + $pensiun + $bpjs_kes + $pot_t3m + $pot_absen + $koperasi + $spsi1);
			//total gaji diterima
			$thp = ((($tp / 30) * 14) + $premi + $lt + $spl + $juminsentif) - ($jht + $pensiun + $bpjs_kes + $pot_t3m + $pot_absen + $koperasi + $spsi1);


			$insert = $this->db->query("insert into t_gaji_mingguan(periode_awal_data,periode_akhir_data,periode_awal_upah,periode_akhir_upah,noinduk,gp,tjab,tmakan,t3m,t3e,jht,pensiun,bpjs_kes,premi,lt,lembur,pot_t3m,pot_absen,koperasi,spsi,insentif,thp)values('$periode_awal_data','$periode_akhir_data','$periode_awal_upah','$periode_akhir_upah','$noinduk','$gp','$tjab','$tmakan','$t3m','$t3e','$jht','$pensiun','$bpjs_kes','$premi','$lt','$spl','$pot_t3m','$pot_absen','$koperasi','$spsi1','$juminsentif','$thp')");



			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_slip()
	{
		$periode_awal 	= $this->input->post('periode_awal');
		$periode_akhir 	= $this->input->post('periode_akhir');
		$status = $this->input->post('status');

		$sql = "select a.*,b.noslip,b.seksi,b.nama from t_gaji_mingguan a
				join t_karyawan b on b.noinduk=a.noinduk where a.periode_awal_upah='$periode_awal' and a.periode_akhir_upah ='$periode_akhir' and b.tkaryawan ='harian' and skerja='$status'";
		$data = $this->db->query($sql)->result_array();

		$hasil = array(
			'data'			=> $data,
			'periode_awal' 	=> $periode_awal,
			'periode_akhir'	=> $periode_akhir,
			'status'	=> $status
		);

		$this->load->view('upah/mingguan/laporan/view/view_slip', $hasil);
	}


	//proses laporan
	function proses_lap_upah_mingguan()
	{
		$periode_awal 	 = $this->input->post('periode_awal');
		$periode_akhir   = $this->input->post('periode_akhir');
		$status 		 = $this->input->post('status');
		$pabrik 		 = $this->input->post('pabrik');
		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_upah_mingguan");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();


		//mencari periode awal data
		$period = $this->db->query("select periode_awal_data,periode_akhir_data from t_gaji_mingguan where periode_awal_upah='$periode_awal' and periode_akhir_upah='$periode_akhir' limit 0,1")->result_array();
		$periode_awal_data = $period[0]['periode_awal_data'];
		$periode_akhir_data = $period[0]['periode_akhir_data'];

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi 		= $d['seksi'];
			$upah1 		= '';
			$lt1 		= '';
			$premi1 	= '';
			$bpjs_tk1 	= '';
			$bpjs_kes1 	= '';
			$koperasi1	= '';
			$spsi1 		= '';
			$lain_lain1 = '';
			$jum_kar1 	= '';
			$jumadj1 	= '';


			$sql = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sql)->result_array();

			$jum = 0;
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];
				$jum++;

				//mencari adjustment
				$sqladj = "select * from t_adjustment_mingguan where periode_awal ='$periode_awal_data' and periode_akhir='$periode_akhir_data'  and noinduk='$noinduk'";
				$adj 	= $this->db->query($sqladj)->result_array();

				//$status1 = $adj[0]['status'];
				$sql = "select (gp + tjab + tmakan + t3m + t3e) as upah,premi,lt,pot_absen,(jht + pensiun) as bpjs_tk,bpjs_kes,pot_t3m,spsi,koperasi from t_gaji_mingguan where noinduk='$noinduk' and periode_awal_upah='$periode_awal' and periode_akhir_upah='$periode_akhir' and noinduk='$noinduk'";

				$jumlah 	= $this->db->query($sql)->result_array();


				$jumadj 	= $adj[0]['adjustment'];

				$lt  		= $jumlah[0]['lt'];
				$premi 		= $jumlah[0]['premi'];
				$bpjs_tk 	= $jumlah[0]['bpjs_tk'];
				$bpjs_kes 	= $jumlah[0]['bpjs_kes'];
				$spsi 		= $jumlah[0]['spsi'];
				$koperasi 	= $jumlah[0]['koperasi'];

				if (($adj) && ($adj[0]['status'] == 'Y')) {
					$upah 		= (((($jumlah[0]['upah']) / 30) * 14) + $jumadj);
					$lain_lain 	= $jumlah[0]['pot_t3m'];
				} else if (($adj) && ($adj[0]['status'] == 'N')) {
					$upah 		= (($jumlah[0]['upah']) / 30) * 14;
					$lain_lain 	= $jumlah[0]['pot_t3m'] +  $jumadj;
				} else {
					$upah 		= (($jumlah[0]['upah']) / 30) * 14;
					$lain_lain 	= $jumlah[0]['pot_t3m'];
				}

				$upah1 		+= $upah;
				$lt1	 	+= $lt;
				$premi1 	+= $premi;
				$bpjs_tk1 	+= $bpjs_tk;
				$bpjs_kes1	+= $bpjs_kes;
				$spsi1		+= $spsi;
				$koperasi1	+= $koperasi;
				$lain_lain1 += $lain_lain;
				$jum_kar1   += $jum;
				$jumadj1 	+= $jumadj;
			}

			$insert = $this->db->query("insert into t_rekap_upah_mingguan(periode_awal,periode_akhir,seksi,upah,lt,premi,bpjs_tk,bpjs_kes,koperasi,spsi,lain_lain,status,jum)values('$periode_awal','$periode_akhir','$seksi','$upah1','$lt1','$premi1','$bpjs_tk1','$bpjs_kes1','$koperasi1','$spsi1','$lain_lain1','$status','$jum_kar1')");

			$hasil['pesan'] = $sqladj;
		}
		echo json_encode($hasil);
	}

	function proses_lap_upah_mingguan_sby()
	{
		$periode_awal  = $this->input->post('periode_awal');
		$periode_akhir  = $this->input->post('periode_akhir');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		//hapus data di table t_rekap_upah_mingguan_sby
		$this->db->query("truncate t_rekap_upah_mingguan_sby");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi = $d['seksi'];
			$thp1 = '';
			$jum_orang = 0;
			$sql = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sql)->result_array();
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];

				//mencari jumlah upah per karyawan dari table t_gaji_mingguan
				$sql = "select thp from t_gaji_mingguan where noinduk='$noinduk' and periode_awal_upah='$periode_awal' and periode_akhir_upah='$periode_akhir'";
				$jumthp = $this->db->query($sql)->result_array();
				$thp = $jumthp[0]['thp'];
				$thp1 += $thp;
				$jum_orang = $jum_orang + 1;
			}

			$insert = $this->db->query("insert into t_rekap_upah_mingguan_sby(pawal,pakhir,seksi,orang,transfer,status)values('$periode_awal','$periode_akhir','$seksi','$jum_orang','$thp1','$status')");

			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_upah_mingguan_sby_org()
	{

		$periode_awal  = $this->input->post('periode_awal');
		$periode_akhir  = $this->input->post('periode_akhir');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		//hapus data di table t_rekap_upah_bulanan_sby
		$this->db->query("truncate t_rekap_upah_mingguan_sby_org");

		//ambil seksi dari tabel karyawan
		$sql = "select * from t_karyawan where tkaryawan='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$karyawan = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($karyawan as $d) {
			$noinduk 	= $d['noinduk'];
			$seksi 		= $d['seksi'];
			$norek		= $d['norek'];

			$sqlgaji = "select * from t_gaji_mingguan where noinduk='$noinduk' and periode_awal_upah ='$periode_awal' and periode_akhir_upah ='$periode_akhir'";
			$gaji = $this->db->query($sqlgaji)->result_array();


			foreach ($gaji as $b) {

				$upah = (($b['gp'] + $b['tjab'] + $b['tmakan'] + $b['t3m'] + $b['t3e']) / 30) * 14;

				$premi 		= $b['premi'];
				$lembur 	= $b['lembur'];
				$absen  	= $b['pot_absen'];
				$pot_lain 	= $b['pot_t3m'];
				$lt 	  	= $b['lt'];
				$insentif 	= $b['insentif'];
				$bpjs_tk 	= $b['jht'] + $b['pensiun'];
				$bpjs_kes 	= $b['bpjs_kes'];
				$spsi 		= $b['spsi'];
				$koperasi 	= $b['koperasi'];
				$transfer 	= $b['thp'];


				$insert = $this->db->query("insert into t_rekap_upah_mingguan_sby_org(noinduk,pawal,pakhir,seksi,norek,upah,lt,insentif,premi,lembur,absen,lain_lain,bpjs_tk,bpjs_kes,spsi,koperasi,transfer,status)values('$noinduk','$periode_awal','$periode_akhir','$seksi','$norek','$upah','$lt','$insentif','$premi','$lembur','$absen','$pot_lain','$bpjs_tk','$bpjs_kes','$spsi','$koperasi','$transfer','$status')");
			}


			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_lembur_mingguan()
	{
		$periode_awal  = $this->input->post('periode_awal');
		$periode_akhir  = $this->input->post('periode_akhir');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_lembur_mingguan");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi = $d['seksi'];
			//	$lembur1 = '';
			//	$jam	= '';
			$sqlkary = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sqlkary)->result_array();
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];

				//mencari jumlah lembur per karyawan dari table t_gaji_mingguan
				$sql = "select periode_awal_data,periode_akhir_data,(lt + lembur) as lembur from t_gaji_mingguan where noinduk='$noinduk' and periode_awal_upah='$periode_awal' and periode_akhir_upah='$periode_akhir'";
				$jumlembur = $this->db->query($sql)->result_array();
				$lembur = $jumlembur[0]['lembur'];
				//		$lembur1 += $lembur;
				$periode_awal_data = $jumlembur[0]['periode_awal_data'];
				$periode_akhir_data = $jumlembur[0]['periode_akhir_data'];

				// ambil jam lt
				$lt = $this->db->query("select jumlt from t_lt_mingguan where noinduk='$noinduk' and pawal='$periode_awal_data' and pakhir='$periode_akhir_data'")->result_array();
				$jumlt = $lt[0]['jumlt'];

				// //mencari jam spl
				$spl = "select (tgl1+tgl2+tgl3+tgl4+tgl5+tgl6+tgl7+tgl8+tgl9+tgl10
						+tgl11+tgl12+tgl13+tgl14+tgl15+tgl16+tgl17+tgl18+tgl19+tgl20+tgl21+tgl22+tgl23+tgl24
						+tgl25+tgl26+tgl27+tgl28+tgl29+tgl30+tgl31) as jumspl  from t_spl_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal_data' and periode_akhir='$periode_akhir_data'";
				$jumspl = $this->db->query($spl)->result_array();
				$spl = $jumspl[0]['jumspl'];

				$totjam = $jumlt + $spl;

				$insert = $this->db->query("insert into t_rekap_lembur_mingguan(periode_awal,periode_akhir,seksi,lembur,jam,status,noinduk)values('$periode_awal','$periode_akhir','$seksi','$lembur','$totjam','$status','$noinduk')");
			}



			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_spl_mingguan()
	{
		$periode_awal   = $this->input->post('periode_awal');
		$periode_akhir  = $this->input->post('periode_akhir');
		$seksi 			= $this->input->post('seksi');
		$status 		= $this->input->post('status'); //status tetap,kontrak dll
		$susulan 		= $this->input->post('susulan'); //spl susulan apa bukan susulan
		$pabrik 		= $this->input->post('pabrik');
		$proyek 		= $this->input->post('proyek');
		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_spl_mingguan");

		//ambil komponen gaji sama (umk,tmakan,spsi)
		$komp_gaji_tetap = $this->db->query("select * from t_komp_gaji_sama")->result_array();
		$tmakan = $komp_gaji_tetap[0]['t_makan'];

		//mencari karyawan sesuai status,seksi
		$sql = "select * from t_karyawan where seksi='$seksi' and tkaryawan ='harian' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$karyawan = $this->db->query($sql)->result_array();

		//mencari data spl
		foreach ($karyawan as $d) {
			$noinduk = $d['noinduk'];

			$sql1 = "select * from t_spl_mingguan where noinduk='$noinduk' and periode_awal='$periode_awal' and periode_akhir='$periode_akhir'   and status='$susulan' and proyek='$proyek'";

			$dtspl = $this->db->query($sql1)->result_array();

			// // //mencari jumlah lt per noinduk
			//   $dtlt = $this->db->query("select * from t_lt_mingguan where noinduk='$noinduk' and pawal ='$periode_awal' and pakhir ='$periode_akhir'")->result_array();
			//   $lt = $dtlt[0]['jumlt'];

			// // //mencari komponen gaji untuk hitung rupiah lembur per jam
			$komp_gaji = $this->db->query("select * from t_komp_gaji where noinduk='$noinduk'")->result_array();
			$gp = $komp_gaji[0]['gp'];
			$tjab = $komp_gaji[0]['tjab'];
			$lembur_jam = ($gp + $tjab + $tmakan) / 173;


			foreach ($dtspl as $b) {
				$tgl1 	= $dtspl[0]['tgl1'];
				$tgl2 	= $dtspl[0]['tgl2'];
				$tgl3 	= $dtspl[0]['tgl3'];
				$tgl4 	= $dtspl[0]['tgl4'];
				$tgl5 	= $dtspl[0]['tgl5'];
				$tgl6 	= $dtspl[0]['tgl6'];
				$tgl7 	= $dtspl[0]['tgl7'];
				$tgl8 	= $dtspl[0]['tgl8'];
				$tgl9 	= $dtspl[0]['tgl9'];
				$tgl10 	= $dtspl[0]['tgl10'];
				$tgl11 	= $dtspl[0]['tgl11'];
				$tgl12 	= $dtspl[0]['tgl12'];
				$tgl13 	= $dtspl[0]['tgl13'];
				$tgl14 	= $dtspl[0]['tgl14'];
				$tgl15 	= $dtspl[0]['tgl15'];
				$tgl16 	= $dtspl[0]['tgl16'];
				$tgl17 	= $dtspl[0]['tgl17'];
				$tgl18 	= $dtspl[0]['tgl18'];
				$tgl19 	= $dtspl[0]['tgl19'];
				$tgl20 	= $dtspl[0]['tgl20'];
				$tgl21 	= $dtspl[0]['tgl21'];
				$tgl22 	= $dtspl[0]['tgl22'];
				$tgl23 	= $dtspl[0]['tgl23'];
				$tgl24 	= $dtspl[0]['tgl24'];
				$tgl25 	= $dtspl[0]['tgl25'];
				$tgl26 	= $dtspl[0]['tgl26'];
				$tgl27 	= $dtspl[0]['tgl27'];
				$tgl28 	= $dtspl[0]['tgl28'];
				$tgl29 	= $dtspl[0]['tgl29'];
				$tgl30 	= $dtspl[0]['tgl30'];
				$tgl31 	= $dtspl[0]['tgl31'];
				$jumjam = $tgl1 + $tgl2 + $tgl3 + $tgl4 + $tgl5 + $tgl6 + $tgl7 + $tgl8 + $tgl9 + $tgl10 + $tgl11 + $tgl12 + $tgl13 + $tgl14 + $tgl15 + $tgl16 + $tgl17 + $tgl18 + $tgl19 + $tgl20 + $tgl21 + $tgl22 + $tgl23 + $tgl24 + $tgl25 + $tgl26 + $tgl27 + $tgl28 + $tgl29 + $tgl30 + $tgl31;

				$total_lembur = $jumjam * $lembur_jam;


				$act = $this->db->query("insert into t_rekap_spl_mingguan(noinduk,seksi,pawal,pakhir,tgl1,tgl2,tgl3,tgl4,tgl5,tgl6,tgl7,tgl8,tgl9,tgl10,tgl11,tgl12,tgl13,tgl14,tgl15,tgl16,tgl17,tgl18,tgl19,tgl20,tgl21,tgl22,tgl23,tgl24,tgl25,tgl26,tgl27,tgl28,tgl29,tgl30,tgl31,jam,l_jam,jumlah,status,susulan,proyek)values('$noinduk','$seksi','$periode_awal','$periode_akhir','$tgl1','$tgl2','$tgl3','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$tgl10','$tgl11','$tgl12','$tgl13','$tgl14','$tgl15','$tgl16','$tgl17','$tgl18','$tgl19','$tgl20','$tgl21','$tgl22','$tgl23','$tgl24','$tgl25','$tgl26','$tgl27','$tgl28','$tgl29','$tgl30','$tgl31','$jumjam','$lembur_jam','$total_lembur','$status','$susulan','$proyek')");
				//}
				//$act = $this->db->query("insert into t_rekap_spl_mingguan(noinduk,seksi,pawal,pakhir,tgl1,jam,l_jam,jumlah,status,susulan)values('$noinduk','$seksi','$periode_awal','$periode_akhir','$tgl1','$jumjam','lembur_jam','$total_lembur','$status','$susulan')");

				$hasil['pesan'] = 'Proses Berhasil';
			}
		}

		echo json_encode($hasil);
	}

	function proses_lap_insentif()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$pabrik = $this->input->post('pabrik');

		// $hasil = $this->db->query("select a.seksi,sum(a.insentif) as insentif,b.nama from 					t_insentif_mingguan a left join t_seksi b on b.kode=a.seksi
		// 				where month(periode_awal) = '$bulan' and year(periode_akhir) = '$tahun'
		// 					group by seksi")->result_array();
		$hasil = $this->db->query("select a.seksi,sum(a.insentif) as insentif,b.nama from t_insentif_mingguan a 
										left join t_seksi b on b.kode=a.seksi
										left join t_karyawan c on c.noinduk=a.noinduk
										where c.pabrik='$pabrik' group by a.seksi")->result_array();


		$data = array(
			'data' 		=> $hasil,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'pabrik' 	=> $pabrik
		);
		$this->load->view('upah/mingguan/laporan/view/view_rekap_insentif', $data);
	}

	function ambil_rekap_upah_mingguan()
	{
		$periode_awal 	= $this->input->post('periode_awal');
		$periode_akhir 	= $this->input->post('periode_akhir');
		$status 		= $this->input->post('status');
		$pabrik 		= $this->input->post('pabrik');

		$hasil = $this->db->query("select a.* from t_rekap_upah_mingguan a													left join t_seksi b on b.kode=a.seksi where  a.periode_awal='$periode_awal' and a.periode_akhir='$periode_akhir' and a.status='$status' and a.seksi!='0' order by b.nama")->result_array();

		$data = array(
			'data' => $hasil,
			'periode_awal' 	=> $periode_awal,
			'periode_akhir' => $periode_akhir,
			'status' 		=> $status,
			'pabrik' 		=> $pabrik
		);


		$this->load->view('upah/mingguan/laporan/view/view_rekap_upah_mingguan', $data);
	}

	function ambil_rekap_upah_mingguan_sby()
	{
		$periode_awal 	= $this->input->post('periode_awal');
		$periode_akhir 	= $this->input->post('periode_akhir');
		$status 		= $this->input->post('status');
		$pabrik 		= $this->input->post('pabrik');

		$hasil = $this->db->query("select * from t_rekap_upah_mingguan_sby where  pawal='$periode_awal' and pakhir='$periode_akhir' and status='$status'  and seksi!='0'")->result_array();
		$data = array(
			'data' => $hasil,
			'periode_awal' => $periode_awal,
			'periode_akhir' => $periode_akhir,
			'status' => $status,
			'pabrik' => $pabrik
		);

		$this->load->view('upah/mingguan/laporan/view/view_rekap_upah_mingguan_sby', $data);
	}

	function ambil_rekap_upah_mingguan_sby_org()
	{
		$periode_awal 	= $this->input->post('periode_awal');
		$periode_akhir 	= $this->input->post('periode_akhir');
		$status 		= $this->input->post('status');
		$pabrik 		= $this->input->post('pabrik');

		// $hasil = $this->db->query("select * from t_rekap_upah_bulanan_sby_org where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();	
		$hasil = $this->db->query("select distinct a.seksi,b.nama from t_rekap_upah_mingguan_sby_org a
								   left join t_seksi b on b.kode=a.seksi where a.status='$status' order by b.nama")->result_array();

		$data = array(
			'data' 			=> $hasil,
			'periode_awal'  => $periode_awal,
			'periode_akhir' => $periode_akhir,
			'status'	    => $status,
			'pabrik'		=> $pabrik
		);

		$this->load->view('upah/mingguan/laporan/view/view_rekap_upah_mingguan_sby_org', $data);
	}

	function ambil_rekap_spl_mingguan()
	{
		$periode_awal  = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		$status = $this->input->post('status');
		$seksi = $this->input->post('seksi');
		$susulan = $this->input->post('susulan');
		$pabrik = $this->input->post('pabrik');
		$proyek = $this->input->post('proyek');
		$arraytgl = [];

		$tanggal1 = new DateTime($periode_awal);
		$tanggal2 = new DateTime($periode_akhir);

		//selisih tanggal
		$perbedaan = $tanggal1->diff($tanggal2);
		$selisih = $perbedaan->d;

		for ($i = 0; $i <= $selisih; $i++) {
			$tgl2 = date("Y-m-d", strtotime('+' . $i . ' days', strtotime($periode_awal)));
			$pecah = explode('-', $tgl2);

			$arraytgl[] = $pecah[2];
		};

		$hasil = $this->db->query("select * from t_rekap_spl_mingguan where jam != 0 and status='$status' and susulan='$susulan' and seksi='$seksi' and pawal='$periode_awal' and pakhir ='$periode_akhir' and proyek='$proyek'")->result_array();
		$data = array(
			'data' 				=> $hasil,
			'periode_awal'	 	=> $periode_awal,
			'periode_akhir' 	=> $periode_akhir,
			'status' 			=> $status,
			'seksi'	 			=> $seksi,
			'susulan' 			=> $susulan,
			'arraytgl'			=> $arraytgl,
			'selisih'			=> $selisih,
			'pabrik'			=> $pabrik,
			'proyek'			=> $proyek
		);


		$this->load->view('upah/mingguan/laporan/view/view_rekap_spl', $data);
	}

	function lap_rekap_upah_mingguan_excell($periode_awal, $periode_akhir, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select a.*,b.nama from t_rekap_upah_mingguan a
					join t_seksi b on b.kode=a.seksi
 					order by b.nama";
		$data = $this->db->query($sql)->result_array();
		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

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
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:K1');
		$object->getActiveSheet()->mergeCells('A2:K2');
		$object->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:K3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:K3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'REKAPITULASI UPAH MINGGUAN' . ' ' . $status . ' PT. ' . $pabrik)
			->setCellValue('A2', 'PERIODE : ' . date('d M Y', strtotime($periode_awal)) . ' s/d ' . date('d M Y', strtotime($periode_akhir)))
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'UPAH')
			->setCellValue('D3', 'LT')
			->setCellValue('E3', 'PREMI')
			->setCellValue('F3', 'BPJS-TK')
			->setCellValue('G3', 'BPJS-KES')
			->setCellValue('H3', 'KOPERASI')
			->setCellValue('I3', 'SPSI')
			->setCellValue('J3', 'LAIN2')
			->setCellValue('K3', 'JUMLAH');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_upah = '';
		$tot_lt = '';
		$tot_premi = '';
		$tot_bpjs_tk = '';
		$tot_bpjs_kes = '';
		$tot_koperasi = '';
		$tot_spsi = '';
		$tot_lain2 = '';
		$tot_jumlah = '';
		foreach ($data as $d) {
			$jumlah = ($d['upah'] + $d['premi'] + $d['lt']) - ($d['bpjs_tk'] + $d['bpjs_kes'] + $d['spsi'] + $d['koperasi'] +  $d['lain_lain']);
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':K' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $d['nama']);
			$ex->setCellValue("C" . $counter, $d['upah']);
			$ex->setCellValue("D" . $counter, $d['lt']);
			$ex->setCellValue("E" . $counter, $d['premi']);
			$ex->setCellValue("F" . $counter, $d['bpjs_tk']);
			$ex->setCellValue("G" . $counter, $d['bpjs_kes']);
			$ex->setCellValue("H" . $counter, $d['koperasi']);
			$ex->setCellValue("I" . $counter, $d['spsi']);
			$ex->setCellValue("J" . $counter, $d['lain_lain']);
			$ex->setCellValue("K" . $counter, $jumlah);

			$counter = $counter + 1;
			$no++;
			$tot_upah += $d['upah'];
			$tot_lt += $d['lt'];
			$tot_premi += $d['premi'];
			$tot_bpjs_tk += $d['bpjs_tk'];
			$tot_bpjs_kes += $d['bpjs_kes'];
			$tot_koperasi += $d['koperasi'];
			$tot_spsi += $d['spsi'];
			$tot_lain2 += $d['lain_lain'];
			$tot_jumlah += $jumlah;
		}
		$object->getSheet(0)->getStyle('A' . $counter . ':K' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_upah);
		$ex->setCellValue("D" . $counter, $tot_lt);
		$ex->setCellValue("E" . $counter, $tot_premi);
		$ex->setCellValue("F" . $counter, $tot_bpjs_tk);
		$ex->setCellValue("G" . $counter, $tot_bpjs_kes);
		$ex->setCellValue("H" . $counter, $tot_koperasi);
		$ex->setCellValue("I" . $counter, $tot_spsi);
		$ex->setCellValue("J" . $counter, $tot_lain2);
		$ex->setCellValue("K" . $counter, $tot_jumlah);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("J" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("D" . $x1, 'Disetujui,');
		$ex->setCellValue("F" . $x1, 'Diperiksa,');
		$ex->setCellValue("J" . $x1, 'Dibuat,');

		$object->getActiveSheet()->setTitle('Laporan Upah mingguan tetap');

		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Mingguan Tetap.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_upah_mingguan_sby_excell($periode_awal, $periode_akhir, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select * from t_rekap_upah_mingguan_sby where  pawal='$periode_awal' and pakhir='$periode_akhir' and status='$status' and seksi!='0'";
		$data = $this->db->query($sql)->result_array();

		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}

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
		$object->getActiveSheet()->mergeCells('A1:D1');
		$object->getActiveSheet()->mergeCells('A2:D2');
		$object->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'LAPORAN UPAH BULANAN PT. ' . $pabrik . ' (' . $status . ') Utk. Surabaya')
			->setCellValue('A2', 'PERIODE : ' . date('d M Y', strtotime($periode_awal)) . ' s/d ' . date('d M Y', strtotime($periode_akhir)))
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'JUMLAH ORANG')
			->setCellValue('D3', 'TRANSFER');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_org = '';
		$tot_transfer = '';
		foreach ($data as $d) {
			$kdseksi = $d['seksi'];
			$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $seksi[0]['nama']);
			$ex->setCellValue("C" . $counter, $d['orang']);
			$ex->setCellValue("D" . $counter, $d['transfer']);

			$counter = $counter + 1;
			$no++;
			$tot_org += $d['orang'];
			$tot_transfer += $d['transfer'];
		}
		$object->getSheet(0)->getStyle('A' . $counter . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_org);
		$ex->setCellValue("D" . $counter, $tot_transfer);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("D" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("A" . $x1, 'Disetujui,');
		$ex->setCellValue("C" . $x1, 'Diperiksa,');
		$ex->setCellValue("D" . $x1, 'Dibuat,');
		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan Upah Bulanan Sby');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Bulanan Sby.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_upah_mingguan_sby_org_excell($periode_awal, $periode_akhir, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select distinct a.seksi,b.nama from t_rekap_upah_mingguan_sby_org a
				   left join t_seksi b on b.kode=a.seksi where a.status='$status'  order by b.nama";
		$data = $this->db->query($sql)->result_array();

		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

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
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:N1');
		$object->getActiveSheet()->mergeCells('A2:N2');
		$object->getActiveSheet()->mergeCells('A3:N3');

		$object->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:N3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:N3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'PT. ' . $pabrik)
			->setCellValue('A2', 'LAPORAN UPAH KARYAWAN MINGGUAN ' . $status . '(Utk. Surabaya)')
			->setCellValue('A3', 'PERIODE : ' . date('d M Y', strtotime($periode_akhir)) . ' ' . date('d M Y', strtotime($periode_akhir)))
			->setCellValue('A4', 'Nama')
			->setCellValue('B4', 'No. Rekening')
			->setCellValue('C4', 'GAJI')
			->setCellValue('D4', 'LT')
			->setCellValue('E4', 'INSENTIF')
			->setCellValue('F4', 'PREMI')
			->setCellValue('G4', 'LEMBUR')
			->setCellValue('H4', 'ABSEN')
			->setCellValue('I4', 'LAIN-LAIN')
			->setCellValue('J4', 'BPJS-TK')
			->setCellValue('K4', 'BPJS-KES')
			->setCellValue('L4', 'SPSI')
			->setCellValue('M4', 'KOPERASI')
			->setCellValue('N4', 'TRANSFER');


		//add data
		$counter = 5;
		$ex = $object->setActiveSheetIndex(0);
		$baris1 = 4;

		foreach ($data as $d) {
			$tot_upah = '';
			$tot_lt = '';
			$tot_insentif = '';
			$tot_premi = '';
			$tot_lembur = '';
			$tot_absensi = '';
			$tot_lain_lain = '';
			$tot_bpjs_tk = '';
			$tot_bpjs_kes = '';
			$tot_spsi = '';
			$tot_koperasi = '';
			$tot_transfer = '';

			$kdseksi = $d['seksi'];
			$nmseksi = $d['nama'];

			$karyawan = $this->db->query("select * from t_rekap_upah_mingguan_sby_org where seksi='$kdseksi'")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':N' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			//tempat nama seksi
			$object->getActiveSheet()->mergeCells('A' . $counter . ':N' . $counter);


			//tampilkan nama seksi
			$ex->setCellValue("A" . $counter, $nmseksi);
			$object->getActiveSheet()->getStyle('A' . $counter)->getFont()->setBold(true);
			foreach ($karyawan as $b) {
				$nmkar = $this->db->query("select nama from t_karyawan where noinduk=" . $b['noinduk'] . "")->result_array();
				$counter = $counter + 1;
				$ex->setCellValue("A" . $counter, $nmkar[0]['nama']);
				$ex->setCellValue("B" . $counter, $b['norek']);
				$ex->setCellValue("C" . $counter, $b['upah']);
				$ex->setCellValue("D" . $counter, $b['lt']);
				$ex->setCellValue("E" . $counter, $b['insentif']);
				$ex->setCellValue("F" . $counter, $b['premi']);
				$ex->setCellValue("G" . $counter, $b['lembur']);
				$ex->setCellValue("H" . $counter, $b['absen']);
				$ex->setCellValue("I" . $counter, $b['lain_lain']);
				$ex->setCellValue("J" . $counter, $b['bpjs_tk']);
				$ex->setCellValue("K" . $counter, $b['bpjs_kes']);
				$ex->setCellValue("L" . $counter, $b['spsi']);
				$ex->setCellValue("M" . $counter, $b['koperasi']);
				$ex->setCellValue("N" . $counter, $b['transfer']);



				$tot_upah += $b['upah'];
				$tot_lt += $b['lt'];
				$tot_insentif += $b['insentif'];
				$tot_premi += $b['premi'];
				$tot_lembur += $b['lembur'];
				$tot_absensi += $b['absen'];
				$tot_lain_lain += $b['lain_lain'];
				$tot_bpjs_tk += $b['bpjs_tk'];
				$tot_bpjs_kes += $b['bpjs_kes'];
				$tot_spsi += $b['spsi'];
				$tot_koperasi += $b['koperasi'];
				$tot_transfer += $b['transfer'];
			}
			$counter = $counter + 1;
			$object->getActiveSheet()->getStyle('A' . $counter . ':N' . $counter)->getFont()->setBold(true);
			$ex->setCellValue("A" . $counter, 'TOTAL');
			$ex->setCellValue("C" . $counter, $tot_upah);
			$ex->setCellValue("D" . $counter, $tot_lt);
			$ex->setCellValue("E" . $counter, $tot_insentif);
			$ex->setCellValue("F" . $counter, $tot_premi);
			$ex->setCellValue("G" . $counter, $tot_lembur);
			$ex->setCellValue("H" . $counter, $tot_absensi);
			$ex->setCellValue("I" . $counter, $tot_lain_lain);
			$ex->setCellValue("J" . $counter, $tot_bpjs_tk);
			$ex->setCellValue("K" . $counter, $tot_bpjs_kes);
			$ex->setCellValue("L" . $counter, $tot_spsi);
			$ex->setCellValue("M" . $counter, $tot_koperasi);
			$ex->setCellValue("N" . $counter, $tot_transfer);
			$counter = $counter + 1;
		}

		$object->getActiveSheet()->setTitle('Laporan Upah Harian Per Orang');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Harian Per Orang.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}


	function lap_rekap_lembur_excell($periode_awal, $periode_akhir, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select seksi,sum(lembur) as lembur, sum(jam) as jam  from t_rekap_lembur_mingguan where  periode_awal='$periode_awal' and periode_akhir='$periode_akhir' and status='$status' and (lembur != 0 or jam != 0) group by seksi";

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
		$object->getActiveSheet()->mergeCells('A1:D1');
		$object->getActiveSheet()->mergeCells('A2:D2');
		$object->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'REKAP LEMBUR MINGGUAN PT. ' . $pabrik . ' (' . $status . ')')
			->setCellValue('A2', 'PERIODE : ' . $periode_awal . ' s/d ' . $periode_akhir)
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'JUMLAH Rp.')
			->setCellValue('D3', 'JUMLAH JAM');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_jumlah = '';
		$tot_jam = '';
		foreach ($data as $d) {
			$kdseksi = $d['seksi'];
			$seksi = $this->db->query("select nama from t_seksi where kode='$kdseksi'")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $seksi[0]['nama']);
			$ex->setCellValue("C" . $counter, $d['lembur']);
			$ex->setCellValue("D" . $counter, $d['jam']);

			$counter = $counter + 1;
			$no++;
			$tot_jumlah += $d['lembur'];
			$tot_jam += $d['jam'];
		}

		$object->getSheet(0)->getStyle('A' . $counter . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_jumlah);
		$ex->setCellValue("D" . $counter, $tot_jam);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("D" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("A" . $x1, 'Disetujui,');
		$ex->setCellValue("C" . $x1, 'Diperiksa,');
		$ex->setCellValue("D" . $x1, 'Dibuat,');

		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan Upah Lembur');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Lembur Bulanan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_spl_excell($periode_awal, $periode_akhir, $status, $seksi, $susulan, $pabrik)
	{
		ini_set('max_execution_time', '3000');
		$arraytgl = [];

		$tanggal1 = new DateTime($periode_awal);
		$tanggal2 = new DateTime($periode_akhir);

		//selisih tanggal
		$perbedaan = $tanggal1->diff($tanggal2);
		$selisih = $perbedaan->d;

		for ($i = 0; $i <= $selisih; $i++) {
			$tgl2 = date("Y-m-d", strtotime('+' . $i . ' days', strtotime($periode_awal)));
			$pecah = explode('-', $tgl2);

			$arraytgl[] = $pecah[2];
		};
		$sql = "select * from t_rekap_spl_mingguan where jam != 0 and status='$status' and 	susulan='$susulan' and seksi='$seksi'";
		$data = $this->db->query($sql)->result_array();

		$nmseksi = $this->db->query("select nama from t_seksi where kode='$seksi'")->result_array();


		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else if ($status == "M") {
			$status = "MAGANG";
		}

		if ($susulan == '0') {
			$susulan = '';
		} else if ($susulan == '1') {
			$susulan = 'SUSULAN';
		}

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
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('O')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('P')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('Q')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('R')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('S')->setAutoSize(true);

		$object->getActiveSheet()->mergeCells('A1:S1');
		$object->getActiveSheet()->mergeCells('A2:S2');
		$object->getActiveSheet()->mergeCells('C6:P6');
		$object->getActiveSheet()->mergeCells('A6:A7');
		$object->getActiveSheet()->mergeCells('B6:B7');
		$object->getActiveSheet()->mergeCells('Q6:Q7');
		$object->getActiveSheet()->mergeCells('R6:R7');
		$object->getActiveSheet()->mergeCells('S6:S7');

		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('C6:P6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A6:A7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('A6:A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('B6:B7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('B6:B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$object->getActiveSheet()->getStyle('Q6:Q7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('Q6:Q7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$object->getActiveSheet()->getStyle('R6:R7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('R6:R7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$object->getActiveSheet()->getStyle('S6:S7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('S6:S7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A6:S6')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A6:S6')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'DAFTAR LEMBUR ' . $susulan . ' KARYAWAN MINGGUAN ' . $status)
			->setCellValue('A2', 'PT. ' . $pabrik)
			->setCellValue('A3', 'BAGIAN :')
			->setCellValue('B3', '')
			->setCellValue('A4', 'SEKSI :')
			->setCellValue('B4', $nmseksi[0]['nama'])
			->setCellValue('A5', 'PERIODE')
			->setCellValue('B5', date('d M Y', strtotime($periode_awal)) . ' s/d ' . date('d M Y', strtotime($periode_akhir)))
			->setCellValue('A6', 'NO')
			->setCellValue('B6', 'NAMA')
			->setCellValue('C6', 'TANGGAL')
			->setCellValue('Q6', 'JAM')
			->setCellValue('R6', 'L/JAM')
			->setCellValue('S6', 'JUMLAH')
			//tanggal
			->setCellValue('C7', $arraytgl[0])
			->setCellValue('D7', $arraytgl[1])
			->setCellValue('E7', $arraytgl[2])
			->setCellValue('F7', $arraytgl[3])
			->setCellValue('G7', $arraytgl[4])
			->setCellValue('H7', $arraytgl[5])
			->setCellValue('I7', $arraytgl[6])
			->setCellValue('J7', $arraytgl[7])
			->setCellValue('K7', $arraytgl[8])
			->setCellValue('L7', $arraytgl[9])
			->setCellValue('M7', $arraytgl[10])
			->setCellValue('N7', $arraytgl[11])
			->setCellValue('O7', $arraytgl[12])
			->setCellValue('P7', $arraytgl[13]);

		//add data
		$counter = 8;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 6;
		$tot_jam = '';
		$tot_jumlah = '';
		//memecah nilai tanggal 1-9 (ada nol diddepan)
		if (substr($arraytgl[0], 0, 1) == '0') {
			$tgl1 = substr($arraytgl[0], 1, 1);
		} else {
			$tgl1 = $arraytgl[0];
		}

		if (substr($arraytgl[1], 0, 1) == '0') {
			$tgl2 = substr($arraytgl[1], 1, 1);
		} else {
			$tgl2 = $arraytgl[1];
		}

		if (substr($arraytgl[2], 0, 1) == '0') {
			$tgl3 = substr($arraytgl[2], 1, 1);
		} else {
			$tgl3 = $arraytgl[2];
		}

		if (substr($arraytgl[3], 0, 1) == '0') {
			$tgl4 = substr($arraytgl[3], 1, 1);
		} else {
			$tgl4 = $arraytgl[3];
		}

		if (substr($arraytgl[4], 0, 1) == '0') {
			$tgl5 = substr($arraytgl[4], 1, 1);
		} else {
			$tgl5 = $arraytgl[4];
		}

		if (substr($arraytgl[5], 0, 1) == '0') {
			$tgl6 = substr($arraytgl[5], 1, 1);
		} else {
			$tgl6 = $arraytgl[5];
		}

		if (substr($arraytgl[6], 0, 1) == '0') {
			$tgl7 = substr($arraytgl[6], 1, 1);
		} else {
			$tgl7 = $arraytgl[6];
		}

		if (substr($arraytgl[7], 0, 1) == '0') {
			$tgl8 = substr($arraytgl[7], 1, 1);
		} else {
			$tgl8 = $arraytgl[7];
		}

		if (substr($arraytgl[8], 0, 1) == '0') {
			$tgl9 = substr($arraytgl[8], 1, 1);
		} else {
			$tgl9 = $arraytgl[8];
		}
		foreach ($data as $d) {

			$noinduk = $d['noinduk'];
			$nm = $this->db->query("select nama from t_karyawan where noinduk='$noinduk'")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':S' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			//jumlah jam
			$jam = $d['tgl' . $tgl1] + $d['tgl' . $tgl2] + $d['tgl' . $tgl3] + $d['tgl' . $tgl4] + $d['tgl' . $tgl5] + $d['tgl' . $tgl6] + $d['tgl' . $tgl7] + $d['tgl' . $tgl8] + $d['tgl' . $tgl9] + $d['tgl' . $arraytgl[9]] + $d['tgl' . $arraytgl[10]] + $d['tgl' . $arraytgl[11]] + $d['tgl' . $arraytgl[12]] + $d['tgl' . $arraytgl[13]];
			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $nm[0]['nama']);
			$ex->setCellValue("C" . $counter, $d['tgl' . $tgl1]);
			$ex->setCellValue("D" . $counter, $d['tgl' . $tgl2]);
			$ex->setCellValue("E" . $counter, $d['tgl' . $tgl3]);
			$ex->setCellValue("F" . $counter, $d['tgl' . $tgl4]);
			$ex->setCellValue("G" . $counter, $d['tgl' . $tgl5]);
			$ex->setCellValue("H" . $counter, $d['tgl' . $tgl6]);
			$ex->setCellValue("I" . $counter, $d['tgl' . $tgl7]);
			$ex->setCellValue("J" . $counter, $d['tgl' . $tgl8]);
			$ex->setCellValue("K" . $counter, $d['tgl' . $tgl9]);
			$ex->setCellValue("L" . $counter, $d['tgl' . $arraytgl[9]]);
			$ex->setCellValue("M" . $counter, $d['tgl' . $arraytgl[10]]);
			$ex->setCellValue("N" . $counter, $d['tgl' . $arraytgl[11]]);
			$ex->setCellValue("O" . $counter, $d['tgl' . $arraytgl[12]]);
			$ex->setCellValue("P" . $counter, $d['tgl' . $arraytgl[13]]);
			// $ex->setCellValue("C".$counter,$d['tgl1']);
			// $ex->setCellValue("D".$counter,$d['tgl2']);
			// $ex->setCellValue("E".$counter,$d['tgl3']);	  
			// $ex->setCellValue("F".$counter,$d['tgl4']);	  
			// $ex->setCellValue("G".$counter,$d['tgl5']);	  
			// $ex->setCellValue("H".$counter,$d['tgl6']);	  
			// $ex->setCellValue("I".$counter,$d['tgl7']);	  
			// $ex->setCellValue("J".$counter,$d['tgl8']);	  
			// $ex->setCellValue("K".$counter,$d['tgl9']);	  
			// $ex->setCellValue("L".$counter,$d['tgl10']);	  
			// $ex->setCellValue("M".$counter,$d['tgl11']);	  
			// $ex->setCellValue("N".$counter,$d['tgl12']);	  
			// $ex->setCellValue("O".$counter,$d['tgl13']);	  
			// $ex->setCellValue("P".$counter,$d['tgl14']);	  
			$ex->setCellValue("Q" . $counter, $jam);
			$ex->setCellValue("R" . $counter, $d['l_jam']);
			$ex->setCellValue("S" . $counter, ($d['l_jam'] * $jam));

			$counter = $counter + 1;
			$no++;
			$tot_jumlah += ($d['l_jam'] * $jam);
			$tot_jam += $jam;
		}

		$object->getSheet(0)->getStyle('A' . $counter . ':S' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->getStyle('B' . $counter . ':B' . $counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "P" . $counter);

		$ex->setCellValue("A" . $counter, 'JUMLAH Rp.');
		$ex->setCellValue("Q" . $counter, $tot_jam);
		$ex->setCellValue("S" . $counter, $tot_jumlah);
		/*$x = $counter + 2;
			 $x1 = $counter + 3;
			 //membuat ttd bawah
 			$ex->setCellValue("D".$x,'Bangun'.'  '.date('d-m-Y'));			 
			$ex->setCellValue("A".$x1,'Disetujui,');			 
			$ex->setCellValue("C".$x1,'Diperiksa,');		 
			$ex->setCellValue("D".$x1,'Dibuat,');	*/

		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan SPL Mingguan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan spl Mingguan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}
}/* End of file bulanan.php */
